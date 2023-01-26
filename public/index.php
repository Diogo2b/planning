<?php

use Router\Router;
use App\Exceptions\NotFoundException;

require '../vendor/autoload.php';

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR);
define('SCRIPTS', dirname($_SERVER['SCRIPT_NAME']) . DIRECTORY_SEPARATOR);
define('DB_NAME', 'planning');
define('DB_HOST', 'planning.test');
define('DB_USER', 'root');
define('DB_PWD', '');


$router = new Router($_GET['url']);
$router->get('/', 'App\Controllers\ModuleController@welcome');
//login et logout
$router->get('/login', 'App\Controllers\UserController@login');
$router->post('/login', 'App\Controllers\UserController@loginPost');
$router->get('/logout', 'App\Controllers\UserController@logout');

// modules
$router->get('/modules', 'App\Controllers\ModuleController@index');
$router->get('/modules/create', 'App\Controllers\ModuleController@create');
$router->post('/modules/create', 'App\Controllers\ModuleController@createPost');
$router->get('/modules/update/:id', 'App\Controllers\ModuleController@update');
$router->post('/modules/update/:id', 'App\Controllers\ModuleController@updatePost');
$router->post('/modules/delete/:id', 'App\Controllers\ModuleController@delete');
$router->get('/logout', 'App\Controllers\SiteController@logout');

// formations
$router->get('/formations', 'App\Controllers\FormationController@index');
$router->get('/formations/create', 'App\Controllers\FormationController@create');
$router->post('/formations/create', 'App\Controllers\FormationController@createPost');
$router->get('/formations/update/:id', 'App\Controllers\FormationController@update');
$router->post('/formations/update/:id', 'App\Controllers\FormationController@updatePost');
$router->post('/formations/delete/:id', 'App\Controllers\FormationController@delete');
$router->get('/logout', 'App\Controllers\SiteController@logout');

// resources(ressources)
$router->get('/resources', 'App\Controllers\ResourceController@index');
$router->get('/resources/create', 'App\Controllers\ResourceController@create');
$router->post('/resources/create', 'App\Controllers\ResourceController@createPost');
$router->get('/resources/update/:id', 'App\Controllers\ResourceController@update');
$router->post('/resources/update/:id', 'App\Controllers\ResourceController@updatePost');
$router->post('/resources/delete/:id', 'App\Controllers\ResourceController@delete');
$router->get('/logout', 'App\Controllers\SiteController@logout');

// utilisateus(users)
$router->get('/users', 'App\Controllers\UserController@index');
$router->get('/users/create', 'App\Controllers\UserController@create');
$router->post('/users/create', 'App\Controllers\UserController@createPost');
$router->get('/users/update/:id', 'App\Controllers\UserController@update');
$router->post('/users/update/:id', 'App\Controllers\UserController@updatePost');
$router->post('/users/delete/:id', 'App\Controllers\UserController@delete');
$router->get('/logout', 'App\Controllers\SiteController@logout');

// rôle d'utilisateur(roles)
$router->get('/roles', 'App\Controllers\RoleController@index');
$router->get('/roles/create', 'App\Controllers\RoleController@create');
$router->post('/roles/create', 'App\Controllers\RoleController@createPost');
$router->get('/roles/update/:id', 'App\Controllers\RoleController@update');
$router->post('/roles/update/:id', 'App\Controllers\RoleController@updatePost');
$router->post('/roles/delete/:id', 'App\Controllers\RoleController@delete');
$router->get('/logout', 'App\Controllers\SiteController@logout');


// sites
$router->get('/sites', 'App\Controllers\SiteController@index');
$router->get('/sites/create', 'App\Controllers\SiteController@create');
$router->post('/sites/create', 'App\Controllers\SiteController@createPost');
$router->get('/sites/update/:id', 'App\Controllers\SiteController@update');
$router->post('/sites/update/:id', 'App\Controllers\SiteController@updatePost');
$router->post('/sites/delete/:id', 'App\Controllers\SiteController@delete');
$router->post('/login', 'App\Controllers\SiteController@loginPost');
$router->get('/logout', 'App\Controllers\SiteController@logout');

// salles
$router->get('/salles', 'App\Controllers\SalleController@index');
$router->get('/salles/create', 'App\Controllers\SalleController@create');
$router->post('/salles/create', 'App\Controllers\SalleController@createPost');
$router->get('/salles/update/:id', 'App\Controllers\SalleController@update');
$router->post('/salles/update/:id', 'App\Controllers\SalleController@updatePost');
$router->post('/salles/delete/:id', 'App\Controllers\SalleController@delete');
$router->get('/logout', 'App\Controllers\SiteController@logout');

// sessions
$router->get('/sessions', 'App\Controllers\SessionController@index');
$router->get('/sessions/create', 'App\Controllers\SessionController@create');
$router->post('/sessions/create', 'App\Controllers\SessionController@createPost');
$router->get('/sessions/update/:id', 'App\Controllers\SessionController@update');
$router->post('/sessions/update/:id', 'App\Controllers\SessionController@updatePost');
$router->post('/sessions/delete/:id', 'App\Controllers\SessionController@delete');
$router->get('/logout', 'App\Controllers\SiteController@logout');

// planning
$router->get('/calendriers', 'App\Controllers\CalendrierController@index');
$router->post('/event', 'App\Controllers\EventController@index');
$router->post('/calendriers', 'App\Controllers\EventController@loadEventCalendar');
$router->post('/modal', 'App\Controllers\ModalController@create');
$router->post('modal_CreatePost', 'App\Controllers\ModalController@createPost');
$router->post('event_update', 'App\Controllers\ModalController@update');
$router->post('modal_UpdatePost', 'App\Controllers\ModalController@updatePost');
$router->post('event_delete', 'App\Controllers\ModalController@delete');
$router->post('modal_DeletePost', 'App\Controllers\ModalController@DeletePost');
<<<<<<< HEAD

=======
$router->post('event_occurence', 'App\Controllers\EventController@DeleteOccurence');
$router->get('/logout', 'App\Controllers\SiteController@logout');
>>>>>>> 00c01a9 (fix:auth with 'csrf_token' and unset($post))
try {
    $router->run();
} catch (NotFoundException $e) {
    return $e->error404();
}
