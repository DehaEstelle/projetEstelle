<?php
require("../App/Models/service.php");

class ServiceController {
    
    //variable pour instancier la classe service
    public $model;

    //variables du formulaire
    public $service_id;
    public $service_lib;

    public function sanitize($verif)
    {
        $verif = trim($verif);
        $verif = stripcslashes($verif);
        $verif = htmlspecialchars($verif);
        
        return $verif;
    }

    public function empty($data) {
        //service_lib
        $data = $this->sanitize($_POST["service"]);
        if (empty($data)) {
            header("Location:/retrieve/addService");
            exit();
        } else {
            $service_lib = $this->sanitize($data);
        }
        return $data;
    } 

    public function insertService() {
        //On vérifie si la méthode utilisée pour le formulaire est "POST" et que le nom du bouton de soumission est "enregistrer"
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ajouter"]))
        {
            $this->service_lib = $this->empty($_POST["service"]);
            

            $this->model = new Service();
            $arr=$this->model->findService($this->service_lib);
            if ($_POST["id"]) {
                $arr=$this->model->findService($this->service_lib);
                if (count($arr) > 0) {
                    header("Location:/retrieve/addService?service_exist");
                    exit();
                }else{
                    $this->service_id=$_POST["id"];
                    $this->model->updateService($this->service_id, $this->service_lib);
                    header("Location:/retrieve/addService");
                    exit();
                }
               
                
            }
            else {
                if (count($arr) > 0) {
                    header("Location:/retrieve/addService?service_exist");
                    exit();
                }else{
                    
                $this->model->insertService($this->service_lib);
                header("Location:/retrieve/addService");
                exit();
                }   
            }
        }
    }
            
    public function showService() {
        $this->model = new Service();
        $array = $this->model->showService();
        return $array;
    }

    public function deleteService() {
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
            $this->service_id = $_POST["service_id"];
            $this->model = new Service();
            $this->model->deleteService($this->service_id);
            header("Location:/retrieve/addService");
            exit();
        }
    }
}