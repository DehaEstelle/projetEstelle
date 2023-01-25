<?php
require_once('../App/Controllers/Connexion.php');

    //la classe User hérite de la classe Connexion
    class User extends Connexion {

        //variable pour la connexion avec la bd
        public $db;  

        //variables du formulaire
        public $email;


        //findUserByEmail($email), pour trouver un user a partir d'un email
        public function findUserByEmail($email) {
            $this->email = $email;
    
            //connection à la base de données
            $db = $this->connect();
    
            //requete pour verifier si cet email existe dans la bd
            $req = "SELECT * FROM `bootcamp_projet`.users WHERE user_email = ?;";
    
            //les requetes preparées
            
            $stmt = $db->prepare($req);
            $stmt->execute([$this->email]);

            //stockage des données sous forme de tableau
            $result = $stmt->fetchAll();
            return $result;
        }

        
    }