<?php
require_once("../App/Controllers/Connexion.php");

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
        public $date;

        public function addPlanning($planning_titre, $planning_description, $start, $end, $salle_id, $service_id, $date) {
            $this->planning_titre = $planning_titre;
            $this->planning_description = $planning_description;
            $this->start = $start;
            $this->end = $end;
            $this->salle_id = $salle_id;
            $this->service_id = $service_id;
            $this->date = $date;

            $db = $this->connect();

            $sql = "INSERT INTO `bootcamp_projet`.planning VALUES(NULL, :planning_titre,:planning_description,:start,:end,:salle_id,:service_id,:date)";

            $stmt = $db->prepare($sql);
            $stmt->execute([
                ":planning_titre" => $this->planning_titre,
                ":planning_description" => $this->planning_description,
                ":start" => $this-> start, 
                ":end" => $this->end, 
                ":service_id" => $this->service_id,
                ":salle_id" => $this->salle_id, 
                ":service_id" => $this->service_id,
                ":date" => $this->date,
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
            $sql=" SELECT * FROM planning WHERE planning.start BETWEEN '{$start->format('Y-m-d 00:00:00')}' 
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


       

}
?>

<?php
    
    class Month  {

        public $days=['LUNDI', 'MARDI','MERCREDI', 'JEUDI', 'VENDREDI', 'SAMEDI', 
        'DIMANCHE'];

        private $months=['Janvier', 'Février','Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août',
        'Septembre', 'Octobre', 'Novembre', 'Décembre'];
        public $month;
        public $year;
        /**
         * Constructeur de month
         * @params int $month compris entre 1 et 12
         * @params int $year L'Année
         * @throw Exception
         */
        public function __construct(?int $month = null, ?int $year=null){
            if ($month === null || $month <1 || $month > 12) {
                $month=intval(date('m'));
            }
            if ($year === null) {
                $year=intval(date('Y'));
            }
           
              $this->month=$month;
              $this->year=$year;
        }
        /**
         * Return le mois en lettre
         */
        public function toString(): string{
            return $this->months[$this->month-1].' '.$this->year;
        }

        /**
         * Return le nombre de semaines dans le mois en int
         */
        public function getWeeks(): int{
            $start= $this->getStartingDay();
            $end= (clone $start)->modify('+1 month -1 day');
            $week= intval($end->format('W')) - intval($start->format('W'))+1;
            if ($week < 0) {
                $week= intval($end->format('W'));
            }
            return $week; 
        }

        /**
         * Renvoie le premier jour du mois
         */
        public function getStartingDay(): DateTime{
            return new DateTime("{$this->year}-{$this->month}-01");
        }

        /**
         * Vérifie le jour dans le mois
         */
        public function withinMonth(DateTime $date): bool{
            return $this->getStartingDay()->format('Y-m')===$date->format('Y-m');
        }

        /**Recupere le mois Suivant */
        public function nextMonth():Month{
            $month=$this->month +1;
            $year=$this->year;
            if ($month > 12) {
                $month=1;
                $year +=1;

            }
            return new Month($month, $year);
        }

        /**Recupere le mois precedant */
        public function previousMonth():Month{
            $month=$this->month -1;
            $year=$this->year;
            if ($month < 1) {
                $month = 12;
                $year -= 1;

            }
            return new Month($month, $year);
        }


}
?>
