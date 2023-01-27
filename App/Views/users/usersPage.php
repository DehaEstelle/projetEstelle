
 <?php 
  session_start();
  $_SESSION["role"] === 0 ? require("../App/Views/inc/header.php"):require("../App/Views/inc/headerUser.php");

  require('../App/Models/Planning.php');
//  echo $_SESSION["firstname"]; 
//  echo $_SESSION["lastname"];
//  echo $_SESSION["email"] ;
//  echo $_SESSION["role"] ;
  $id_ser= $_SESSION["service"];
                      
    $month= new Month($_GET['month']?? null, $_GET['year'] ?? null);
    $events=new Planning() ;

    $start = $month->getStartingDay();
    $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');

    $weeks=$month->getWeeks();
           
    $end= (clone $start)->modify('+'.(6 + 7 * ($weeks -1)).'days' );
    $eventes=$events->getEventsBetweenByDay($start, $end );
?>

   <!-- Calandrier -->

    <div class="calendar">
        <div class="d-flex flex-row align-items-center justify-content-between mx-sm-3">
            <h2><?=$month->toString(); ?></h1>
        <div class="next">
            <a href="/retrieve/<?=$id_ser;?>/index?month=<?=$month->previousMonth()->month; ?>&year=<?=$month->previousMonth()->year;?>" class="btn btn-primary">&lt;</a>
            <a href="/retrieve/<?=$id_ser;?>/index?month=<?=$month->nextMonth()->month; ?>&year=<?=$month->nextMonth()->year;?>"  class="btn btn-primary">&gt;</a>
        </div>
    </div>
                        
    <table class="calendartable calendartable--<?=$weeks; ?>weeks">
    <?php for ($i=0; $i < $weeks ; $i++): ?>
    <tr>
<?php
    foreach ( $month->days as $k => $day):
    $date=(clone $start)->modify("+".($k + $i * 7)." days");
    $eventsForDays=$eventes[$date->format('Y-m-d')] ?? []; 
?>
    <td class="<?= $month->withinMonth($date)  ? '' : 'calendarOverMonth'; ?>">
    <?php if($i===0): ?>
    <div class="calencarweekdays"><?= $day; ?></div>
        <?php endif; ?>
        <div class="calencardays"><?=$date->format('d'); ?></div>
        <?php foreach($eventsForDays as $tt): ?>
        <div class="calendarevents">
        <?=(new DateTime( $tt['start']??''))->format('H:i'); ?> - <a href="/retrieve/<?=$id_ser;?>/showPlanning?id=<?=$tt['id'];?>"><?php echo $tt['name']??'' ; ?></a>
    </div>
        <?php endforeach;  ?>
        </td>
        <?php endforeach; ?>
        </tr>
        <?php endfor; ?>
        </table>
        <a href="/retrieve/addEVent" class="calendarbtn">+</a>
    </div>
            
           