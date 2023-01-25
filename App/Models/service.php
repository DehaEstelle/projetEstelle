<?php
require_once("../App/Controllers/Connexion.php");

    //la classe Service hérite de la classe Connexion
    class Service extends Connexion {

        //variable pour la connexion avec la bd
        public $db; 

        //variables du formulaire
        public $service_id;
        public $service_lib;

        public function insertService($service_lib) {
            $this->service_lib = $service_lib;
    
            //connection à la base de données
            $db = $this->connect();
    
            //requete pour faire l'ajout d'un service à la bd
            $req = "INSERT INTO `bootcamp_projet`.services(service_lib) VALUES (?)";
    
            //les requetes preparées
            $stmt = $db->prepare($req);
            $stmt->execute([$this->service_lib]);
        }

        public function findService($service_lib) {
            $this->service_lib = $service_lib;
    
            //connection à la base de données
            $db = $this->connect();
    
            //requete pour faire la recuperation et l'affichage d'un service de la bd
            $req = "SELECT * FROM `bootcamp_projet`.services WHERE service_lib = ?";
    
            //les requetes preparées
            $stmt = $db->prepare($req);
            $stmt->execute([$this->service_lib]);

            //stockage des données sous forme de tableau
            $result = $stmt->fetchAll();
            return $result;
        }

        public function deleteService($service_id) { 
            $this->service_id = $service_id;
    
            //connection à la base de données
            $db = $this->connect();
    
            //requete pour faire la suppression d'un service de la bd
            $req = "DELETE FROM `bootcamp_projet`.services WHERE service_id = ?";
    
            //les requetes preparées
            $stmt = $db->prepare($req);
            $stmt->execute([$this->service_id]);
        }

        public function showService() {
            //connection à la base de données
            $db = $this->connect();
    
            //requete pour faire la recuperation et l'affichage d'un service de la bd
            $req = "SELECT * FROM `bootcamp_projet`.services";
    
            //les requetes preparées
            $stmt = $db->prepare($req);
            $stmt->execute();

            //stockage des données sous forme de tableau
            $result = $stmt->fetchAll();
            return $result;
        }

        public function updateService($service_id, $service_lib) {

            $this->service_id = $service_id;
            $this->service_lib = $service_lib;

            //connection à la base de données
            $db = $this->connect();

            //requete pour faire la modification d'un service de la bd
            $req = "UPDATE `services` SET service_lib = :libelle WHERE service_id = :id";

            //les requetes preparées
            $stmt = $db->prepare($req);
            $stmt->execute([
                ":id" => $this->service_id,
                ":libelle" => $this->service_lib
            ]);
        }
    }