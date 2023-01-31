<?php
require_once "../App/Views/inc/header.php";
require_once("../App/Controllers/RegisterController.php");
    $stmt = new RegisterController();
    $arr = $stmt->showUsers();

    $array = $stmt->selectUser();

?>

<body>
    <h2>Formulaire de modifications des users</h2>
    <div class="content">
        <form action="/RegisterController/updateUsers" method="POST">
            <div class="addUsers">

                <div class="left">
                    <input type="hidden" name="user_id" id="id2" value="<?= $array[0]["user_id"] ?>">

                    <label for="firstname">Firstname</label>
                    <input type="text" name="firstname" id="firstname" value="<?= $array[0]["user_firstname"] ?>">

                    <label for="lastname">Lastname</label>
                    <input type="text" name="lastname" id="lastname" value="<?= $array[0]["user_lastname"] ?>">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" value="<?= $array[0]["user_email"] ?>">
 
                </div>

                <div class="right">

                    <label for="user_role">Rôle de l'utilisateur</label>
                    <select name="user_role" id="role">
                        <option  selected disabled></option>
                        <option value="0">Administrateur Service</option>
                        <option value="1">Utilisateur Service</option>
                    </select>

                    <label for="password">Password</label>
                    <input type="password" name="password">

                    <label for="pwd">Confirmation password</label>
                    <input type="password" name="confirm_pwd">
                </div>
                <div>
                    <label for="service">Service de l'utilisateur</label>
                    <select name="service">
                        <option value="" selected disabled>Selectionner le service</option>
                        <?php
                            $controleur = new RegisterController();
                            $stmt = $controleur->selectServiceUser();
                            foreach ($stmt as $key => $value) {
                        ?>
                        <option value="<?php echo $stmt[$key]["service_id"];?>"> <?php echo $stmt[$key]["service_lib"];?> </option>
                        <?php   
                            }                      
                        ?>
                    </select>   
                </div>
            </div>
            <button type="submit" name="update">Modifier</button>
        </form>
    </div>    
</body>