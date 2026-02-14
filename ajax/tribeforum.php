<?php
include("../pdoconnect.php");

$tribe = $_GET['tribe'];

if($yetkim>=11 && !empty($tribe)){
}else{
	$tribe = $uye['TribeCode'];
}


if(!empty($tribe)){
$tribeforum = $db->query("SELECT * FROM tribe where Code = '".$tribe."'")->fetch(PDO::FETCH_ASSOC);

if($tribeforum['Code']){
	
$p_t = $db->query("SELECT * FROM profilestribe where tribe = '".$tribeforum['Code']."'")->fetch(PDO::FETCH_ASSOC);
$filter = "&lang%5B%5D=xx";
?>

<div class="span12">
<div id="tribe_<?=$tribeforum['Code']?>" class="cadre cadre-relief cadre-forum ltr"> 
 <div id="tribe2_<?=$tribeforum['Code']?>"> 
 <div class="accordion accordeon-forum" id="accordion787483"> 
 <div class="accordion-group"> 
 <div class="accordion-heading cadre-forum-titre"> 
   <table> 
 <tbody> 
<tr> 

 <td class="table-cadre-cellule-principale"> 

 <a class="accordion-toggle lien-blanc" data-toggle="collapse" data-parent="#accordiontribe<?=$tribeforum['Code']?>" id="tribe" onclick="plus(this);" href="#collapsetribe<?=$tribeforum['Code']?>"> 
 <?php
 if(!empty($p_t['avatar'])){
 ?>
	 <img src="<?=$site?>/img/tribes/<?=$p_t['avatar']?>" class="img32 espace-2-2">
<?php
 }
 ?>
		<?=$tribeforum['Name']?>
	 <img src="<?=$site?>/img/icones/moins24-2.png" alt="" id="c_tribe" class="espace-2-2 pull-right image-accordeon">
 </a> 

 </td> 
 <td>
<?php
if($tribe == $uye['TribeCode'] && !empty($t_rank['10'])){
?>
 <div class="btn-group cadre-sujet-actions  pull-right">
 <a class="dropdown-toggle btn btn-inverse bouton-action" data-toggle="dropdown" href="#">
 <img src="<?=$site?>/img/icones/roue-dentee.png" class="img20">
 </a>
 <ul class="dropdown-menu menu-contextuel pull-right">

 <li class="nav-header">
<?=tfmdil('Tribu')?>
</li>

 <li>
 <a href='<?=$site?>/new-section?t=<?=$tribe?>' class="element-menu-contextuel">
 <?=$plang['new_section']?>
 </a>
 </li>

  </ul>
  </div>
<?php
}
?>

</td>
 <td class="cellule-onglet-tribu"> 
 <div class="pull-right"> 
       <div class="btn-group "> 
    <a class="btn btn-inverse btn-serre ltr " href="<?=$site?>/tribe?tr=<?=$tribeforum['Code']?>"> 
<img src="<?=$site?>/img/icones/16/1tribu.png" class="espace-2-2" alt=""> 
</a> 
 <a class="btn btn-inverse btn-serre ltr " href="<?=$site?>/tribe-forum?tr=<?=$tribeforum['Code']?>"> 
<img src="<?=$site?>/img/icones/16/topic.png" class="img16 espace-2-2" alt=""> 
</a> 
 <a class="btn btn-inverse btn-serre ltr " href="<?=$site?>/tribe-members?tr=<?=$tribeforum['Code']?>"> 
<img src="<?=$site?>/img/icones/16/1tribu-membres.png" class="espace-2-2" alt=""> 
</a> 
  <a class="btn btn-inverse btn-serre ltr " href="<?=$site?>/tribe-history?tr=<?=$tribeforum['Code']?>"> 
<img src="<?=$site?>/img/icones/16/1tribu-activite.png" class="espace-2-2" alt=""> 
</a> 
     </div> 
 </div> 
 </td> 
 </tr> 
 </tbody> 
</table> 
    </div> 
	
	
	
 <div id="collapsetribe<?=$tribeforum['Code']?>" class="accordion-body collapse-forum-actu in collapse" style="height: auto;"> 
 <div class="accordion-inner"> 

 <div id="tribeload_<?=$tribeforum['Code']?>" class="cadre-sections-actu">
 
<script>
$("#tribeload_<?=$tribeforum['Code']?>").load("ajax/forum-ajax?forum=1&tribe=<?=$tribeforum['Code']?><?=$filter?>");
</script>
 
</div>
 
 </div> 
 </div>


 
 </div> 
 </div> 
 </div> 
 </div> 
 </div> 

<?php
}

}
?>