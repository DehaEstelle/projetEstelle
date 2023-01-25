<?php
require_once("../App/Controllers/Connexion.php");

    //la classe Salle hérite de la classe Connexion
    class Salle extends Connexion {

        //variable pour la connexion avec la bd
        public $db; 

        //variables du formulaire
        public $salle_id;
        public $salle_lib;

        public function insertSalle($salle_lib) {
            $this->salle_lib = $salle_lib;
    
            //connection à la base de données
            $db = $this->connect();
    
            //requete pour faire l'ajout d'une salle à la bd
            $sql = "INSERT INTO `bootcamp_projet`.salles(salle_lib) VALUES (?)";
    
            //les requetes preparées
            $stmt = $db->prepare($sql);
            $stmt->execute([$this->salle_lib]);
        }

        public function findSalle($salle_lib){
            $this->salle_lib = $salle_lib;

            //connection à la base de données
            $db = $this->connect();
    
            //requete pour faire la recuperation et l'affichage d'une salle de la bd
            $sql = "SELECT * FROM `bootcamp_projet`.salles WHERE salle_lib = ?";
    
            //les requetes preparées
            $stmt = $db->prepare($sql);
            $stmt->execute([$this->salle_lib]);

            //stockage des données sous forme de tableau
            $result = $stmt->fetchAll();
            return $result;
        }

        public function deleteSalle($salle_id){
            $this->salle_id = $salle_id;

            //connection à la base de données
            $db = $this->connect();
    
            //requete pour faire la suppression d'une salle de la bd
            $sql = "DELETE FROM `bootcamp_projet`.salles WHERE salle_id = ?";
    
            //les requetes preparées
            $stmt = $db->prepare($sql);
            $stmt->execute([$this->salle_id]);
        }

        public function showSalle() {
    
            //connection à la base de données
            $db = $this->connect();
    
            //requete pour faire la recuperation et l'affichage d'une salle de la bd
            $sql = "SELECT * FROM `bootcamp_projet`.salles";
    
            //les requetes preparées
            $stmt = $db->prepare($sql);
            $stmt->execute();

            //stockage des données sous forme de tableau
            $result = $stmt->fetchAll();
            return $result;
        }

        public function updateSalle($salle_id, $salle_lib) {
            $this->salle_id = $salle_id;
            $this->salle_lib = $salle_lib;

            //connection à la base de données
            $db = $this->connect();

            //requete pour faire la modification d'un salle de la bd
            $req = "UPDATE `salles` SET salle_lib = :libelle WHERE salle_id = :id";

            //les requetes preparées
            $stmt = $db->prepare($req);
            $stmt->execute([
                ":id" => $this->salle_id,
                ":libelle" => $this->salle_lib
            ]);
        }
    }