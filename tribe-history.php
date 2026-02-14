  <?php
include("config.php");
$kabileid = $_GET['tr'];

$tribe = $db->query("SELECT * FROM tribe where Code = '".$kabileid."'")->fetch(PDO::FETCH_ASSOC);
$members = explode(",",$tribe['Members']);
$id = $tribe['Name'];
$tribe_events = explode("|",$tribe['Historique']);
$limit_page = 100;
$event_count = count($tribe_events);
$page_count = ceil($event_count / $limit_page);
$event_mod = $event_count % $limit_page;
$page = $_GET['p'];
if(empty($page)){
$page = 1 ; 
}
if(!in_array($uye['PlayerID'],$members)){
yonlendir($site."/404",0);
exit();
}
if($page>($page_count)){
yonlendir($site."/404",0);
exit();
}
if(empty($id)){
	yonlendir($site."/404",0);
	exit();
}

$start_event = (($page - 1) * $limit_page);
if(($page * $limit_page)>$event_count){
$stop_event = $event_count - 1;
}else{
$stop_event = ($page * $limit_page) - 1;
}

?>
 
 

  
  <div id="corps" class="corps clear container" bis_skin_checked="1">    
  <div class="cadre cadre-tribu" bis_skin_checked="1">
<!--
<span class="cadre-tribu-titre cadre-tribu-nom">
<center>
    <a class="dropdown" href="<?=$site?>/tribe?tr=<?=$tribe['Code']?>"> 
  <span class="cadre-tribu-titre cadre-tribu-nom">
<?=$tribe['Name']?>
  </span> 
  </a> 

</center>
</span> 
  </div>
  <div class="cadre cadre-tribu" bis_skin_checked="1"> 
-->
  <table>
  <tbody> 
  
<?php
for ($c = $start_event; $c <= $stop_event; $c++){
$event = explode("/",$tribe_events[$c]);
?>

  <tr>
  <td class="texte-date">[<span class=""><?=date("d/m/Y h:i",($event[1]*60))?>] </span></td> 
  <?php
  if($event[0] == 1){
	  $eventb = tfmdil('historique.tribu.creation');
	  $eventb = str_replace("%1",$event[2],$eventb);
	  $eventb = str_replace("%2",$event[3],$eventb);

   ?>
   <td> <?=$eventb?> </td>
  <?php
  }elseif($event[0] == 2){
   ?>
   
   <?php

	  $eventb = tfmdil('historique.tribu.membreInvite');
	  $eventb = str_replace("%2",$event[2],$eventb);
	  $eventb = str_replace("%1",$event[3],$eventb);

   ?>
   <td> <?=$eventb?> </td>
   
   
  <?php
  }elseif($event[0] == 3){
   ?>
   
   <?php

$eventb = tfmdil('chat.tribu.signaleExclusion');
$eventb = str_replace("%2",$event[3],$eventb);
$eventb = str_replace("%1",$event[2],$eventb);

?>
<td> <?=$eventb?> </td>  

  <?php
  }elseif($event[0] == 4){
   ?>

  <?php

$eventb = tfmdil('chat.tribu.signaleDepartMembre');
$eventb = str_replace("%1",$event[2],$eventb);

?>
<td> <?=$eventb?> </td> 


  <?php
  }elseif($event[0] == 5){
   ?>
   
   <?php

	  $eventb = tfmdil('historique.tribu.membreChangeDeRang');
	  $eventb = str_replace("%2",$event[2],$eventb);
	  $eventb = str_replace("%1",$event[5],$eventb);
	  $eventb = str_replace("%3",tfmdil($event[4]),$eventb);

   ?>
   <td> <?=$eventb?> </td>   


  <?php
  }elseif($event[0] == 6){
   ?>
   <td> <?=str_replace("%1",$event[3],tfmdil('chat.tribu.signaleChangementMessageJour'))?> <?=$event[2]?></td>
  <?php
  }elseif($event[0] == 7){
   ?>
   <td> Ahmet395#0000 götten sikti. </td>
  <?php
  }elseif($event[0] == 8){
   ?>

<?php

$eventb = tfmdil('historique.tribu.changementCodeMaisonTFM');
$eventb = str_replace("%1",$event[2],$eventb);
$eventb = str_replace("%2",$event[3],$eventb);

?>
<td> <?=$eventb?> </td> 



  <?php
  }
   ?>   
  </tr>  
<?php
}
?>  
   </tbody>
   </table>
   </div>
   </div> 
   
   
   
   
     <?php
include("footer.php");
?>