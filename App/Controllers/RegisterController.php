<?php
require("../App/Models/register.php");

class RegisterController {
    //variable pour instancier la classe users
    public $model;

    //variables du formulaire
    public $user_id;
    public $user_firstname;
    public $user_lastname;
    public $user_email;
    public $user_password;
    public $confirm_pwd;
    public $user_role; 
    public $service_id; 
 
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
            header("Location:/retrieve/addUsers");
            exit();
        }
        return $data;
    }

    private function checkMail(string $user_email,  $user_id): array{
        $this->model = new Register();
            $array = $this->model->VerifyUsers($this->user_email);
            $data=[];
            foreach($array as $k=>$user){
                if ($user["user_email"]===$user_email && $user["user_id"]!=$user_id) {
                  // echo $user["user_email"];
                  $data[$k]=$user ;
                
                }
            }
            return $data;
            exit();
    }

    public function insertUsers() {
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["ajouter"]))
        {
            
            $this->user_firstname = $this->empty($_POST["firstname"]);
            $this->user_lastname = $this->empty($_POST["lastname"]);
            $this->user_email = $this->empty($_POST["email"]);
            $this->user_password = $this->empty($_POST["password"]);
            $this->confirm_pwd = $this->empty($_POST["confirm_pwd"]);
            $this->user_role = $_POST["user_role"];
            $this->service_id = $_POST["service"];
            $this->$user_id=$_POST["id2"];

            $this->model = new Register();
            $array = $this->model->VerifyUsers($this->user_email);
            $lenght = count($array);

            $exist_adminService = $this->model->findUsersByServiceAndRole($this->service_id, 0);
            $count = count($exist_adminService);

            
            if(!$_POST['id2']) {
            // var_dump($_POST["id2"]);
            // exit();

                if($lenght>0) {
                    header("Location:/retrieve/addUsers?user_exist");
                    exit();
    
                } else if($this->user_password === $this->confirm_pwd && $count===0){
                   
                    $this->model->findInsertUser($this->user_firstname, $this->user_lastname, $this->user_email, $this->user_password, $this->user_role, $this->service_id);
                    header("Location:/retrieve/addUsers");
                    exit();
                } 
            } else {
                
                if(empty($this->checkMail( $this->user_email, $this->$user_id))) {
                    $this->model->updateUsers($this->user_firstname, $this->user_lastname, $this->user_email, $this->user_role, $this->service_id, $this->$user_id);
                    header("Location:/retrieve/addUsers");
                    exit();
    
                } else {
                    header("Location:/retrieve/addUsers?user_exist");
                    exit();
                } 
                
            } 
        }
                
        } 


    public function selectServiceUser() {
        $this->model = new Register();
        $stmt = $this->model->selectService();
        return $stmt;  
    }
    public function selectSalleUser() {
        $this->model = new Register();
        $stmt = $this->model->selectSalle();
        return $stmt;  
    }

    public function showUsers() {
        $this->model = new Register();
        $array = $this->model->showUsers();
        return $array;
    }

    public function deleteUsers() {
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete"])) {
            $this->user_id = $_POST["user_id"];
            $this->model = new Register();
            $this->model->deleteUsers($this->user_id);
            header("Location:/retrieve/addUsers");
            exit();
        }
    }
}

?>

