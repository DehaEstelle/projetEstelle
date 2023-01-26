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