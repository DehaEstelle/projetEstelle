<?php
require_once("../App/Controllers/Connexion.php");
require_once("monthPlanning.php");

    //la classe User hérite de la classe Connexion
    class Planning extends Connexion {
        
        public $db;

        public $planning_id;
        public $planning_titre;
        public $planning_description;
        public $start;
        public $end;
        public $salle_id;
        public $service_id;

        public function addPlanning($planning_titre, $planning_description, $start, $end, $salle_id, $service_id) {
            $this->planning_titre = $planning_titre;
            $this->planning_description = $planning_description;
            $this->start = $start;
            $this->end = $end;
            $this->salle_id = $salle_id;
            $this->service_id = $service_id;

            $db = $this->connect();

            $sql = "INSERT INTO `bootcamp_projet`.planning VALUES(NULL, :planning_titre,:planning_description,:start,:end,:salle_id,:service_id)";

            $stmt = $db->prepare($sql);
            $stmt->execute([
                ":planning_titre" => $this->planning_titre,
                ":planning_description" => $this->planning_description,
                ":start" => $this-> start, 
                ":end" => $this->end, 
                ":service_id" => $this->service_id,
                ":salle_id" => $this->salle_id, 
                ":service_id" => $this->service_id,
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
         * Récupère le élement entre deux dates
         */
        public function getEventsBetween(DateTime $start, DateTime $end):array {
            $db = $this->connect();
            $sql=" SELECT * FROM planning WHERE `planning`.start BETWEEN '{$start->format('Y-m-d 00:00:00')}' 
            AND '{$end->format('Y-m-d 23:59:59')}'";
            
           $stm=$db->prepare($sql);
           $stm->execute();
           $results=$stm->fetchAll();
            return $results;
        }

        public function getEventsBetweenByDay(DateTime $start, DateTime $end):array{
            $events=$this->getEventsBetween($start,$end);
            $days=[]; 
           
            foreach($events as $event){
                $date= explode(' ', $event['start'])[0];
                if (!isset($days[$date])) {
                    $days[$date]=[$event];
                }else{
                    $days[$date][]=[$event];
                }
            }
           
            return $days;
        }

        /**REcupere un evenement */

        public function find(int $id):array{
            $db = $this->connect();
           $results= $db->query("SELECT * FROM planning WHERE id=$id LIMIT 1")->fetch();

           if ($results===false) {
                throw new Exception("Aucun Résultat ");

           }
           return $results;

        }

        public function showPlanning()
        {
           //connection à la base de données
           $db = $this->connect();
           $sql = "SELECT * FROM `bootcamp_projet`.planning";
           //les requetes preparées
           $tabPlan = $db->prepare($sql);
           $tabPlan->execute();

           //stockage des données sous forme de tableau
           $resultP = $tabPlan->fetchAll();
           return $resultP;
        }
       

}
?>


