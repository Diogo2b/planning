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

    protected $table = 'session';
    // Fonction qui permet d'afficher toutes les session de la table session
    public function index_session() :array {

        
        $sessions= $this->query(" SELECT *,
        `session`.`id` AS `session_id`,`module`.`id`
        AS `module_id`,`salle`.`id` 
        AS `salle_id`,`salle`.`name`
        AS `salle_name`,`module`.`name` 
        AS `module_name` 
        FROM $this->table
                INNER JOIN `module` ON `session`.`module_id` = `module`.`id` 
                INNER JOIN `salle` ON `session`.`salle_id`= `salle`.`id`
                 INNER JOIN `user` ON `session`.`user_id`= `user`.`id`
        WHERE `session`.`formation_id` = '".$_POST['events']."'");
        


    
        return $sessions;
   }
    // Fonction qui permet d'afficher toutes les session de la table session correspondant a l'utilisateur avec le rôle élève connecté
    public function index_session_eleve():array  {

        return $this->query("SELECT *,`session`.`id` AS `session_id`,
        `module`.`id` AS `module_id`,
        `salle`.`id` AS `salle_id`,
        `salle`.`name` AS `salle_name`,
        `module`.`name` AS `module_name`
         FROM $this->table 
         INNER JOIN `module` ON `session`.`module_id` = `module`.`id` 
         INNER JOIN `salle` ON `session`.`salle_id`= `salle`.`id` 
         INNER JOIN `user` ON `session`.`user_id`= `user`.`id` 
         WHERE `session`.`formation_id` = (SELECT `formation_id` FROM `user_formation` WHERE `user_id` = '".$_POST['user_id']."' ); ");   
        

   }
  // Fonction qui permet d'afficher toutes les session de la table session correspondant a l'utilisateur avec le rôle intervenant connecté

    public function index_session_intervenant():array  {
        return $this->query("SELECT *,`session`.`id` AS `session_id`,
         `module`.`id` AS `module_id`,
          `salle`.`id` AS `salle_id`,
           `salle`.`name` AS `salle_name`,
            `module`.`name` AS `module_name` 
            FROM `session`
            INNER JOIN `module` ON `session`.`module_id` = `module`.`id` 
            INNER JOIN `salle` ON `session`.`salle_id`= `salle`.`id` 
            INNER JOIN `user` ON `session`.`user_id`= `user`.`id` 
            WHERE `session`.`user_id` = '".$_POST['user_id']."'; )");
        }
        




}