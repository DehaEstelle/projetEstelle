<?php
  require_once('../App/Models/Planning.php'); 
  require_once('../App/Views/inc/header.php');
 
    $events= new Planning();
    
   try {
     $event=$events->find($_GET['id']);
   } catch (\Exception $th) {
        echo 'PAGE INTROUVABLE';
        exit();
   }
  
    //print_r( $event);
?>
<h1><?= htmlentities($event['planning_titre']?? '') ; ?></h1>

<ul>
    <li>Date de demarrage: <?= (new DateTime($event['start']?? ' ' ))->format('d/m/Y') ?? ''; ?></li>
    
    <li>Heure de demarrage: <?= (new DateTime($event['start']?? ' '))->format('H:i')?? ''; ?></li>

    <li>Date de fin: <?= (new DateTime($event['end']?? ' ' ))->format('d/m/Y') ?? ''; ?></li>
    
    <li>Heure de fin: <?= (new DateTime($event['end']?? ''))->format('H:i')?? ''; ?></li>
    
    <li>DETAIL:
         <br>
         <?= htmlentities($event['planning_description']??''); ?>
    </li>
</ul>



<?php  require('../App/Views/inc/footer.php');  ?>   
