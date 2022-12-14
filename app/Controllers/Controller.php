<?php

namespace App\Controllers;

use Database\DBConnection;

abstract class Controller
{

    protected $db;

    public function __construct(DBConnection $db)
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $this->db = $db;
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


    protected function getDB()
    {
        return $this->db;
    }
    protected function isAdmin()
    {
        if (isset($_SESSION['auth']) && is_int($_SESSION['auth'])) {
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
