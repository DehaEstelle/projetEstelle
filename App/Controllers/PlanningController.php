<?php
require("../App/Models/Planning.php");
class PlanningController {

    public $model;

    public $planning_id;
    public $planning_titre;
    public $planning_description;
    public $start;
    public $end;
    public $salle_id;
    public $service_id;
    public $date;

    public function sanitize($verif)
    {
        $verif = trim($verif);
        $verif = stripcslashes($verif);
        $verif = htmlspecialchars($verif);
        
        return $verif;
    }

    public function empty($data) {
     
        $data = $this->sanitize($data);
        

        if (empty($data)) {
            header("Location:/retrieve/addEvent");
            exit();
        }
        return $data;
    }

    public function insertPlanning() {
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ajouter"]))
        {

            
            $this->planning_titre = $this->empty($_POST["name"]);
            $this->planning_description = $this->empty($_POST["description"]);
            $this->start = $this->empty($_POST["start"]);
            $this->end = $this->empty($_POST["end"]);
            
            $this->service_id = $_POST["service"];
            $this->salle_id=$_POST["salle"];
            $this->date = $_POST["date"];
            
            // var_dump($_POST);
            // exit();

            $this->model = new planning();
            $array = $this->model->addPlanning($this->planning_titre, $this->planning_description, $this->start, $this->end, $this->salle_id, $this->service_id, $this->date);
            // die($_POST['id2']);
            // exit();
        }
    }

}