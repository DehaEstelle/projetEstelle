<?php
require_once("../App/Controllers/Connexion.php");

    //la classe User hérite de la classe Connexion
    class Register extends Connexion {


        //variable pour la connexion avec la bd
        public $db;  

        //variables du formulaire
        public $user_id;
        public $user_firstname;
        public $user_lastname;
        public $user_email;
        public $user_password;
        public $user_role; 
        public $service_id;    
    /**
    * findInsertUser(), pour insérer dans la bd des utilisateurs
    */
        public function findInsertUser($user_firstname, $user_lastname, $user_email, $user_password, $user_role, $service_id) {

            $this->user_firstname = $user_firstname;
            $this->user_lastname = $user_lastname;
            $this->user_email = $user_email;
            $this->user_password = $user_password;
            $this->user_role = $user_role;
            $this->service_id = $service_id;
            
            $db = $this->connect();

        /**
        * $sql, pour les requêtes vers la base de données
        */
        $sql = "INSERT INTO `bootcamp_projet`.users VALUES(NULL, :user_firstname, :user_lastname, :user_email, :user_password, :user_role, :service_id)";
        
        $stmt = $db->prepare($sql);
        $stmt->execute([
           ":user_firstname" => $this->user_firstname,
            ":user_lastname" => $this->user_lastname,
            ":user_email" => $this->user_email,
            ":user_password" => password_hash($this->user_password, PASSWORD_DEFAULT),
            ":user_role" => $this->user_role,
            ":service_id" => $this->service_id
        ]);

    }

    public function selectService() {
        $conn = $this->connect();
        /** * $sql, pour les requêtes vers la base de données */
            $sql = "SELECT * FROM `bootcamp_projet`.services";

            /*** $stmt, pour recupérer la requête préparée*/
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        return $result;
    }

    public function selectSalle() {
        $conn = $this->connect();
        /** * $sql, pour les requêtes vers la base de données */
            $sql = "SELECT * FROM `bootcamp_projet`.salles";

            /*** $stmt, pour recupérer la requête préparée*/
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
        return $result;
    }

    /**
     * vérifier si il y a un utilisateur dans la base de données ayant dejà cet email
    */
    public function VerifyUsers($user_email){
        $this->user_email = $user_email; 
        //connection à la base de données
        $db = $this->connect();

        $sql = "SELECT * FROM `bootcamp_projet`.users WHERE user_email = ?";

        //les requetes preparées
        $stmt = $db->prepare($sql);
        
        $stmt->execute([$this->user_email]);

        //stockage des données sous forme de tableau
        $result = $stmt->fetchAll();
        return $result;
    }

    public function showUsers() {
        //connection à la base de données
        $db = $this->connect();

        //requete pour faire la recuperation et l'affichage d'un utilisateur de la bd
        $sql = "SELECT * FROM `bootcamp_projet`.users, `bootcamp_projet`.services  WHERE `users`.service_id = `services`.service_id";

        //les requetes preparées
        $stmt = $db->prepare($sql);
        $stmt->execute();

        //stockage des données sous forme de tableau
        $result = $stmt->fetchAll();
        return $result;
    }

    public function findUsers($user_firstname, $user_lastname, $user_email, $user_password, $user_role, $service_id) {
        
        $this->user_firstname = $user_firstname;
        $this->user_lastname = $user_lastname;
        $this->user_email = $user_email;
        $this->user_password = $user_password;
        $this->user_role = $user_role;
        $this->service_id = $service_id;
        
        //connection à la base de données
        $db = $this->connect();

        //requete pour faire la recuperation et l'affichage d'une salle de la bd
        $sql = "SELECT * FROM `bootcamp_projet`.users";

        //les requetes preparées
        $stmt = $db->prepare($sql);
        $stmt->execute();

        //stockage des données sous forme de tableau
        $result = $stmt->fetchAll();
        return $result;
    } 

    public function updateUsers($user_firstname,$user_lastname,$user_email,$user_role,$service_id, $user_id) {
        $this->user_id = $user_id;
        $this->user_firstname = $user_firstname;
        $this->user_lastname = $user_lastname;
        $this->user_email = $user_email;
        $this->user_role = $user_role;
        $this->service_id = $service_id;
        //connection à la base de données
        $db = $this->connect();

        //requete pour faire la modification d'un salle de la bd
        $req = "UPDATE `users` SET user_firstname =:user_firstname, user_lastname =:user_lastname, user_email =:user_email, user_role =:user_role, service_id =:service_id WHERE user_id=:id";

        //les requetes preparées
        $stmt = $db->prepare($req);
        $stmt->execute([
            ":id" => $this->user_id,
            ":user_firstname" => $this->user_firstname,
            ":user_lastname" => $this->user_lastname,
            ":user_email" => $this->user_email,
            ":user_role" => $this->user_role,
            ":service_id" => $this->service_id    
        ]);

    }

    public function findUsersByServiceAndRole($service_id, $user_role){

        //connection à la base de données
        $db = $this->connect();

        //requete pour faire la suppression d'un utilisateur de la bd
        $sql = "SELECT *  FROM `bootcamp_projet`.users WHERE service_id = ? AND user_role=?";

        //les requetes preparées
        $stmt = $db->prepare($sql);
        $stmt->execute([$service_id, $user_role]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function selectUser($user_id){

        //connection à la base de données
        $db = $this->connect();

        //requete pour faire la suppression d'un utilisateur de la bd
        $sql = "SELECT *  FROM `bootcamp_projet`.users WHERE user_id = ? ";

        //les requetes preparées
        $stmt = $db->prepare($sql);
        $stmt->execute([$user_id]);
        $result = $stmt->fetchAll();
        return $result;
    }

    public function deleteUsers($user_id){
        $this->user_id = $user_id;

        //connection à la base de données
        $db = $this->connect();

        //requete pour faire la suppression d'un utilisateur de la bd
        $sql = "DELETE FROM `bootcamp_projet`.users WHERE user_id = ?";

        //les requetes preparées
        $stmt = $db->prepare($sql);
        $stmt->execute([$this->user_id]);
    }

}