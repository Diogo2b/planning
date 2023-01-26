<?php

namespace App\Controllers;

use Database\DBConnection;

abstract class Controller
{

    protected $db;
    protected $expire_time = 1800; // 30 minutes en secondes


    public function __construct(DBConnection $db)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['last_activity'] = time();

        $this->db = $db;
    }
    protected function checkSessionTimeout()
    {
        if (isset($_SESSION['last_activity'])) {
            $inactivity = time() - $_SESSION['last_activity'];
            if ($inactivity > $this->expire_time) {
                session_unset();
                session_destroy();
                header("Location: login.php");
            }
        }
    }



    protected function view(string $path, array $params = [])
    {
        extract($params);
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        $content = ob_get_clean();
        require VIEWS . 'layout.php';
    }
    protected function view2(string $path, array $params = [])
    {
        extract($params);
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        $content_event = ob_get_clean();
        require VIEWS . 'layout_event.php';
    }



    protected function getDB()
    {
        return $this->db;
    }
    protected function isAdmin()
    {
        if (isset($_SESSION['auth']) && is_int($_SESSION['auth']) && $_SESSION['role_id'] === 1) {

            return true;}
        // } else {


        //     return header('Location: /login');
        // }
    }
    protected function isEleve()
    {
        if (isset($_SESSION['auth']) && is_int($_SESSION['auth']) && $_SESSION['role_id'] === 2) {
            error_log(1);
            return true;}
        // } else {
        //     error_log(2);

        //     return header('Location: /login');
        // }
    }
    protected function isIntervenant()
    {
        if (isset($_SESSION['auth']) && is_int($_SESSION['auth']) && $_SESSION['role_id'] === 4) {

            return true;
        } else {


            return header('Location: /login');
        }
    }

    public static function hashPassword(string $password)
    {

        $options = [
            'cost' => 12,
        ];
        $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);
        return $hashed_password;
    }
}
