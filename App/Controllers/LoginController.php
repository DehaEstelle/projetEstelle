<?php
require("../App/Models/user.php");
class LoginController {
   
    //variable pour instancier la classe User
    public $model;

    //variables du formulaire
    public $user_email;
    public $user_password;

    public function sanitize($verif)
    {
        $data = trim($verif);
        $data = stripcslashes($verif);
        $data = htmlspecialchars($verif);
        return $verif;
    }

    public function empty($data) {
    //email
        if (empty($_POST["user_email"]) ) {
            header("Location:/retrieve/home?empty_email");
            exit();
        }else {
            $email = $this->sanitize($_POST["user_email"]);
        }
 
        //password
        if (empty($_POST["password"]) ) {
            $error_pwd = "password is required!";
            header("Location:/retrieve/home?empty_password");
            exit();
        }else {
            $pwd = $this->sanitize($_POST["password"]);
        }
        return $data;
    }

    //login(), pour l'authentification des users
    public function login(){

        //On vérifie si la méthode utilisée pour le formulaire est "POST" et que le nom du bouton de soumission est "valider"
        if($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["valider"]))
        {
            $this->user_email = $this->empty($_POST["user_email"]);
            $this->user_password = $this->empty($_POST["password"]);

            $this->model = new User();
            $arr = $this->model->findUserByEmail($this->user_email);

            // print_r($arr);
            // exit();
        
            $lenght = count($arr);
            if($lenght>0) {
                if(password_verify($this-> user_password, $arr[0]["user_password"])) {
                    session_start();
                    $_SESSION["user_id"] = $arr[0]["user_id"];
                    $_SESSION["firstname"] = $arr[0]["user_firstname"];
                    $_SESSION["lastname"] = $arr[0]["user_lastname"];
                    $_SESSION["email"] = $arr[0]["user_email"];
                   // $_SESSION["password"] = $arr[0]["user_password"];
                    $_SESSION["role"] = $arr[0]["user_role"];
                    $_SESSION["service"] = $arr[0]["service_id"];

                    if($arr[0]["user_role"] == 0)
                    {
                        $service_id = $arr[0]["service_id"];
                        header("Location:/retrieve/$service_id/index");
                        exit();

                    } else if($arr[0]["user_role"] !== 0){

                        $service_id = $arr[0]["service_id"];
                        header("Location:/retrieve/$service_id/index");
                        exit();
                    }

                } else {
                    //Gerer le message de notification d'erreur
                    header("Location:/retrieve/home?password_incorrect");
                    exit();
                }
                
            } else {
                header("Location:/retrieve/home?not_exist");
                exit;
            } 
        }
    }
 }