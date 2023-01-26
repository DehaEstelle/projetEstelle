<?php
require_once('../App/Controllers/Connexion.php');

    //la classe User hérite de la classe Connexion
    class User extends Connexion {

        //variable pour la connexion avec la bd
        public $db;  

        //variables du formulaire
        public $user_email;

        //findUserByEmail($email), pour trouver un user a partir d'un email
        // public function UserByEmail($email) {
        //     $this->email = $email;
    
        //     //connection à la base de données
        //     $db = $this->connect();
    
        //     //requete pour verifier si cet email existe dans la bd
        //     $req = "SELECT * FROM `bootcamp_projet`.users WHERE user_email = ?;";
    
        //     //les requetes preparées
            
        //     $stmt = $db->prepare($req);
        //     $stmt->execute([$this->email]);

        //     //stockage des données sous forme de tableau
        //     $result = $stmt->fetchAll();
        //     return $result;
        // }

        public function findUserByEmail($user_email){
            $this->user_email = $user_email;

            //connection à la base de données
            $db = $this->connect();
    
            //requete pour faire la recuperation et l'affichage d'une salle de la bd
            $sql = "SELECT * FROM `bootcamp_projet`.users WHERE user_email = ?";
    
            //les requetes preparées
            $stmt = $db->prepare($sql);
            $stmt->execute([$this->user_email]);

            //stockage des données sous forme de tableau
            $result = $stmt->fetchAll();
            return $result;
        }

        
    }