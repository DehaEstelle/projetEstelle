<?php
require_once "../App/Views/inc/header.php";    
?>
<body>   
    <div class="container">
        <h2>Ajout de tâche</h2>

        <?php if (!empty($errors)):   ?>
            <div class="alert alert-danger">
                Merci de corriger vos erreurs
            </div>
        <?php endif ;   ?>
        <form action="/PlanningController/insertPlanning" method="post" class="form">
            
            <div class="form-group">
                <label for="name">Titre</label>
                <input type="text" class="form-control" required name="name" id="name"
                    value="<?= isset($data['name'])? htmlentities($data['name']):'' ?>">
                    <?php if (isset($errors['name'])):   ?>
                    <small style="color:red;"><?= $errors['name'];   ?></small>
                    <?php endif ;   ?>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="start">Demarrage</label>
                    <input class="form-control" type="datetime-local" required name="start" id="start" placeholder="HH:MM"
                        value="<?= isset($data['start'])? htmlentities($data['start']):'' ?>">
                        <?php if (isset($errors['start'])):   ?>
                            <small style="color:red;"><?= $errors['start'];   ?></small>
                        <?php endif ;   ?>
                </div>

                <div class="form-group">
                    <label for="end">Fin</label>
                    <input class="form-control" type="datetime-local" required name="end" id="end" placeholder="HH:MM"
                        value="<?= isset($data['end'])? htmlentities($data['end']):'' ?>">
                        <?php if (isset($errors['end'])):   ?>
                            <small style="color:red;"><?= $errors['end'];   ?></small>
                        <?php endif ;   ?>
                </div>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description"><?= isset($data['name'])? htmlentities($data['name']):'' ?></textarea>
            </div>
            
            <div class="row">
                <div class="form-group">
                    <label for="service">Service</label>
                    <select name="service" id="service">
                        <option value="" selected disabled></option>
                        <?php
                        foreach ($service as $key => $value) {
                        ?>
                        <option value="<?php echo $service[$key]["service_id"];?>"> <?php echo $service[$key]["service_lib"];?> </option>
                        <?php   
                            }                      
                        ?>
                    </select>   
                </div>
                <div class="form-group">
                    <label for="salle">Salle</label>
                    <select name="salle" id="salle">
                        <option value="" selected disabled></option>
                        <?php
                        foreach ($stmt as $key => $value) {
                        ?>
                        <option value="<?php echo $stmt[$key]["salle_id"];?>"> <?php echo $stmt[$key]["salle_lib"];?> </option>
                        <?php   
                            }                      
                        ?>
                    </select>   
                </div>
            </div>

            <button class="btn btn-primary" type="submit" name="ajouter">Ajouter</button>
        </form>

    </div>

    <?php  require('../App/Views/inc/footer.php');  ?> 

</body> 