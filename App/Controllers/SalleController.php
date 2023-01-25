<?php
require("../App/Models/salle.php");

class SalleController {
    
    //variable pour instancier la classe salle
    public $model;

    //variables du formulaire
    public $salle_id;
    public $salle_lib;

    public function sanitize($verif)
    {
        $verif = trim($verif);
        $verif = stripcslashes($verif);
        $verif = htmlspecialchars($verif);
        
        return $verif;
    }

    public function empty($data) {
        //salle_lib
        $data = $this->sanitize($_POST["salle"]);
        if (empty($data)) {
            header("Location:/retrieve/addSalle");
            exit();
        } else {
            $salle_lib = $this->sanitize($data);
        }
        return $data;
    }

    public function insertSalle() {
        //On vérifie si la méthode utilisée pour le formulaire est "POST" et que le nom du bouton de soumission est "enregistrer"
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ajouter"]))
        {
            $this->salle_lib = $this->empty($_POST["salle"]);
            

            $this->model = new Salle();
            $arr=$this->model->findSalle($this->salle_lib);
            if ($_POST["id1"]) {
                $arr=$this->model->findSalle($this->salle_lib);
                if (count($arr) > 0) {
                    header("Location:/retrieve/addSalle?salle_exist");
                    exit();
                }else{
                    $this->salle_id=$_POST["id1"];
                    $this->model->updateSalle($this->salle_id, $this->salle_lib);
                    header("Location:/retrieve/addSalle");
                    exit();
                }
               
                
            } else {
                if (count($arr) > 0) {
                    header("Location:/retrieve/addSalle?salle_exist");
                    exit();
                }else{
                    
                $this->model->insertSalle($this->salle_lib);
                header("Location:/retrieve/addSalle");
                exit();
                }
               
            }
        }
    }

    public function showSalle() {
        $this->model = new Salle();
        $array = $this->model->showSalle();
        return $array;
    }

    public function deleteSalle() {
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
            $this->salle_id = $_POST["salle_id"];
            $this->model = new Salle();
            $this->model->deleteSalle($this->salle_id);
            header("Location:/retrieve/addSalle");
            exit();
        }
    }
}