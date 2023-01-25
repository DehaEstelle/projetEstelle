<?php
  require('../App/Models/Planning.php'); 
  require('../App/Views/inc/header.php');
 
    $events= new Planning();
    
   try {
     $event=$events->find($_GET['id']);
   } catch (\Exception $th) {
        echo 'PAGE INTROUVABLE';
        exit();
   }
  
    //print_r( $event);
?>
<h1><?= htmlentities($event['name']?? '') ; ?></h1>

<ul>
    <li>Date: <?= (new DateTime($event['start']?? ' ' ))->format('d/m/Y') ?? ''; ?></li>
    <li>HEURE DE DEMARRAGE: <?= (new DateTime($event['start']?? ' '))->format('H:i')?? ''; ?></li>
    <li>HEURE DE FIN: <?= (new DateTime($event['end']?? ''))->format('H:i')?? ''; ?></li>
    <li>DETAIL:
         <br>
         <?= htmlentities($event['description']??''); ?>
    </li>
</ul>



<?php  require('../App/Views/inc/footer.php');  ?>   
