<?php

namespace App\Models;

use App\Controllers\Controller;
use App\Models\Session;
use App\Models\Module;
use App\Models\Formation;
use App\Models\Salle;
use App\Models\User;
use App\Validation\ValidatorFactory;

class Event extends Model
{

    protected $table = 'sessions';


    // Fonction qui permet d'afficher toutes les session de la table session
    public function index_session() :array {
        
        $sessions= $this->query(" SELECT *,`sessions`.`id` AS `session_id`,`modules`.`id` AS `module_id`,`salles`.`id` AS `salles_id`,`salles`.`name` AS `salles_name`,`modules`.`name` AS `module_name` 
        FROM `sessions`
                 INNER JOIN `modules` ON `sessions`.`module_id` = `modules`.`id` 
                 INNER JOIN `salles` ON `sessions`.`salle_id`= `salles`.`id`
                 INNER JOIN `users` ON `sessions`.`user_id`= `users`.`id`
        WHERE `sessions`.`formation_id` = '".$_POST['events']."'");
        


        $modules_sessions= $sessions;
        return $modules_sessions;
   }

  // Fonction qui permet d'afficher toutes les session de la table session correspondant a l'utilisateur avec le rôle élève connecté
    public function index_session_eleve():array  {
        return $this->query("SELECT *,`sessions`.`id` AS `session_id`,
        `modules`.`id` AS `module_id`,
        `salles`.`id` AS `salles_id`,
        `salles`.`name` AS `salles_name`,
        `modules`.`name` AS `module_name`
         FROM `sessions` 
         INNER JOIN `modules` ON `sessions`.`module_id` = `modules`.`id` 
         INNER JOIN `salles` ON `sessions`.`salle_id`= `salles`.`id` 
         INNER JOIN `users` ON `sessions`.`user_id`= `users`.`id` 
         WHERE `sessions`.`formation_id` = (SELECT `formation_id` FROM `users_formation` WHERE `user_id` = '".$_POST['user_id']."' ); ");
      
      
         
        

   }


  // Fonction qui permet d'afficher toutes les session de la table session correspondant a l'utilisateur avec le rôle intervenant connecté

    public function index_session_intervenant():array  {
        return $this->query("SELECT *,`sessions`.`id` AS `session_id`,
         `modules`.`id` AS `module_id`,
          `salles`.`id` AS `salles_id`,
           `salles`.`name` AS `salles_name`,
            `modules`.`name` AS `module_name` 
            FROM `sessions` 
            INNER JOIN `modules` ON `sessions`.`module_id` = `modules`.`id` 
            INNER JOIN `salles` ON `sessions`.`salle_id`= `salles`.`id` 
            INNER JOIN `users` ON `sessions`.`user_id`= `users`.`id` 
            WHERE `sessions`.`user_id` = 19; )");
        }




}