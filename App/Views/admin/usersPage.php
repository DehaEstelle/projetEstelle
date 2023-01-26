<?php
require_once "../App/Views/inc/header.php";
require_once("../App/Controllers/RegisterController.php");
    $stmt = new RegisterController();
    $arr = $stmt->showUsers();

    // echo "<pre>";
    // var_dump($arr);
    // echo "<pre>";
    // exit();
?>

<body>
    <h2>Formulaire d'ajout des users</h2>
    <div class="content">
        <form action="/RegisterController/insertUsers" method="POST">
            <div class="addUsers">

                <div class="left">
                    <input type="hidden" name="user_id" id="id2">

                    <label for="firstname">Firstname</label>
                    <input type="text" name="firstname" id="firstname">

                    <label for="lastname">Lastname</label>
                    <input type="text" name="lastname" id="lastname">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="email">

                    
                </div>

                <div class="right">

                    <label for="user_role">Rôle de l'utilisateur</label>
                    <select name="user_role" id="role">
                        <option value="" selected desable></option>
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
                        <option value="" selected desable></option>
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
            <button type="submit" name="ajouter">Sauvegarder</button>
        </form>
    </div>    

    <h2>Liste des utilisateurs</h2>
    <table class="table">
        <thead>
            <th>N°</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Service</th>
            <th>Editer</th>
            <th>Supprimer</th>
        </thead>
        <tbody>
            <?php foreach($arr as $key => $value) : ?>
            <tr class="list">
                <td><?= $value["user_id"]; ?></td>
                <td><?= $value["user_firstname"]; ?></td>
                <td><?= $value["user_lastname"]; ?></td>
                <td><?= $value["user_email"]; ?></td>
                <?php
                    $user_role = $value["user_role"];
                    if($user_role === 0) {
                        $user_role = "Administrateur";
                    } else {
                        $user_role = "Utilisateur";
                    }
                ?>
                <td><?= $user_role; ?></td>
                <td><?= $value["service_lib"]; ?></td>
                <td class="colSvg">
                    <button type="submit" name="edit" class="user">
                        <svg fill="yellow" viewBox="0 0 24 24" width="15" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125" />
                        </svg>
                    </button>
                </td>
                <td class="colSvg">
                    <form action="/RegisterController/deleteUsers" method="post">
                        <input type="hidden" name="user_id" value="<?= $value["user_id"] ;?>">
                        <button type="submit" name="delete">
                            <svg fill="red" viewBox="0 0 24 24" width="15" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />
                            </svg>
                        </button>
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table> 
    
    <script src="/js/user.js"></script>
</body>