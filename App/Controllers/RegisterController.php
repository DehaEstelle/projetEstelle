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

    public function emptyUpdate($data) {
        $data = $this->sanitize($data);
        $id = $_POST["user_id"];
        if (empty($data)) {
            header("Location:/retrieve/$id/modify");
            exit();
        }
        return $data;
    }

    public function checkMail(string $user_email,  $user_id): array{
        $this->model = new Register();
            $array = $this->model->VerifyUsers($this->user_email);
            $data=[];
            foreach($array as $k=>$user){
                if ($user["user_email"]===$user_email && $user["user_id"]!=$user_id) {
                //    echo $user["user_email"];
                //    exit();
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
            $this->user_id = $_POST["user_id"];
            
            $this->model = new Register();
            $array = $this->model->VerifyUsers($this->user_email);
            $lenght = count($array);
            
            $exist_adminService = $this->model->findUsersByServiceAndRole($this->service_id, 0);
            $count = count($exist_adminService);
                
                if($lenght>0) {
                    header("Location:/retrieve/addUsers?user_exist");
                    exit();
                    
                } else {
                         if($this->user_password === $this->confirm_pwd ){
                            if($count>0) {
                                if($this->user_role == 1) {
                                    $this->model->findInsertUser($this->user_firstname, $this->user_lastname, $this->user_email, $this->user_password, $this->user_role, $this->service_id);
                                    header("Location:/retrieve/addUsers?validate");
                                    exit();
                                } else {
                                    header("Location:/retrieve/addUsers?admin_exit_service");
                                    exit();
                                }
                            
                        } else {
                            if($this->user_role == 1) {
                                $this->model->findInsertUser($this->user_firstname, $this->user_lastname, $this->user_email, $this->user_password, $this->user_role, $this->service_id);
                                header("Location:/retrieve/addUsers?validate");
                                exit();
                            } else {
                                header("Location:/retrieve/addUsers?admin_exit_service");
                                exit();
                            }
                        }
                    }  else {
                        
                        header("Location:/retrieve/addUsers?not_correspond");
                        exit();
                    }
        }
        }
                
    } 
    public function updateUsers() {
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["update"]))
        {  
            $this->user_firstname = $this->emptyUpdate($_POST["firstname"]);
            $this->user_lastname = $this->emptyUpdate($_POST["lastname"]);
            $this->user_email = $this->emptyUpdate($_POST["email"]);
            $this->user_password = $this->emptyUpdate($_POST["password"]);
            $this->confirm_pwd = $this->emptyUpdate($_POST["confirm_pwd"]);
            $this->user_role = $_POST["user_role"];
            $this->service_id = $_POST["service"];
            $this->user_id = $_POST["user_id"];
            
            $this->model = new Register();
            $array0 = $this->model->selectUser($this->user_id);
            $array = $this->model->VerifyUsers($this->user_email);
            $lenght = count($array);
            
            $exist_adminService = $this->model->findUsersByServiceAndRole($this->service_id, 0);
            $count = count($exist_adminService);
               
                if($lenght>0) {
                    if($array[0]["user_email"] == $array0[0]["user_email"]) {
                        if($this->user_password === $this->confirm_pwd ){
                            if($count>0) {
                                if($this->user_role == 1) {
                         $this->model->updateUsers($this->user_firstname, $this->user_lastname, $this->user_email, $this->user_password, $this->user_role, $this->service_id, $this->user_id);
                                header("Location:/retrieve/addUsers");
                                exit();
                                } 
                                else {
                                    echo "bad";
                                    header("Location:/retrieve/$this->user_id/modify?user_exist_service");
                                    exit;
                                }
                                } else {
                                     $this->model->updateUsers($this->user_firstname, $this->user_lastname, $this->user_email, $this->user_password, $this->user_role, $this->service_id, $this->user_id);
                                header("Location:/retrieve/addUsers");
                                exit();
                                    
                                    }
                        } else {
                            header("Location:/retrieve/$this->user_id/modify?password_incorrect");
                            exit;
                        }
                    }  else {
                        header("Location:/retrieve/$this->user_id/modify?email_exist");
                        exit;
                    }
                } else {
                    if($this->user_password === $this->confirm_pwd ){
                        if($count>0) {
                                if($this->user_role == 1) {
                             $this->model->updateUsers($this->user_firstname, $this->user_lastname, $this->user_email, $this->user_password, $this->user_role, $this->service_id, $this->user_id);
                                header("Location:/retrieve/addUsers");
                                exit();
                                } 
                                else {
                                    header("Location:/retrieve/$this->user_id/modify?user_exist_service");
                                    exit;
                                }
                        } else {
                                 $this->model->updateUsers($this->user_firstname, $this->user_lastname, $this->user_email, $this->user_password, $this->user_role, $this->service_id, $this->user_id);
                                header("Location:/retrieve/addUsers");
                                exit();
                        }
                    } else {
                        header("Location:/retrieve/$this->user_id/modify?password_incorrect");
                        exit();
                    }
                    }
        }
                      
    } 

    

    public function selectUser() {
        $url = $_SERVER["QUERY_STRING"];
        preg_match("/(?<id>\d+)/", $url, $matches);
        $id = $matches["id"];
        $this->model = new Register();
        $stmt = $this->model->selectUser($id);
        return $stmt;  
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

