<?php

namespace Project\Models;

use Exception;

class Manager{

    private static $bdd = null;

    protected function dbConnect()
    {
        // si PDO a déjà été instancié, il retourne $bdd sinon il crée une nouvelle instance
        if(isset(self::$bdd)){
            return self::$bdd;
        }else{
        try{                
            
            self::$bdd  = new \PDO("mysql:host=".$_ENV['DB_HOST'].":".$_ENV['DB_PORT'].";dbname=".$_ENV['DB_NAME'].";charset=utf8", $_ENV['DB_USER'], $_ENV['DB_PASSWORD']); // connexion à la bdd
            return self::$bdd;
        }catch(Exception $e){
            die('Erreur: ' . $e->getMessage());
        }
        }
    }
}

