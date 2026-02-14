<?php
include("config.php");
$kabileid = $_GET['tr'];

$tribe = $db->query("SELECT * FROM tribe where Code = '".$kabileid."'")->fetch(PDO::FETCH_ASSOC);
$members = explode(",",$tribe['Members']);
$id = $tribe['Name'];
$ranks = explode(";",$tribe['Ranks']);
$rc = count($ranks);

$member_count = count($members);
$page_count = ceil($member_count / 30);
$member_mod = $member_count % 30;
$page = $_GET['p'];

if(empty($page)){
$page = 1 ; 
}
/*if(!in_array($uye['PlayerID'],$members)){
yonlendir($site."/404",0);
exit();
}*/
if($page>($page_count)){
yonlendir($site."/404",0);
exit();
}
if(empty($id)){
yonlendir($site."/404",0);
exit();
}

$start_event = (($page - 1) * 30);
if(($page * 30)>$member_count){
$stop_event = $member_count - 1;
}else{
$stop_event = ($page * 30) - 1;
}



?>
 <script>title("<?=$tribe['Name']?>");</script>

 <div id="corps" class="corps clear container">       
 <div class="row"> 
 <div class="span8">        
 <div class="cadre cadre-defaut ltr"> 
 <table class="table-datatable table-cadre table-cadre-centree table-striped"> 
 <thead> 
 <tr>
 <th>
<?=tfmdil('Avatar')?>
 </th> 
 
 <th>
 </th> 
 <th><?=tfmdil('texte.nom')?></th> 
 <th><?=tfmdil('text.rangTribu')?></th> 
  <th><?=str_replace("%1","",tfmdil('texte.dateEntreeTribu'))?></th> 
 </tr> 
 </thead> 
 <tbody> 
 
 
 <?php
 for ($c = $start_event; $c <= $stop_event; $c++){
 $member = $db->query("SELECT * FROM users where PlayerID = '".$members[$c]."'")->fetch(PDO::FETCH_ASSOC);
 ?>
 
 <tr> 
 <td> 
 <img src="<?=$site?>/img/avatars/<?=getavatar($member)?>" class="element-composant-auteur img50 default-avatar-50" alt="" />
 </td> 
 <td data-search="<?=strtolower($member['Langue'])?>"><img src="<?=$site?>/img/pays/<?=strtolower($member['Langue'])?>.png" class="img16 espace-2-2" /> </td> 
 <td class="table-cadre-cellule-principale">                
 <div class="cadre-auteur-message cadre-auteur-message-court element-composant-auteur display-inline-block">  
 
 <?=isim($member['Username'].$member['Tag'],"tm")?>
 </div>
 </td> 
 <td>
 <div class="rang-tribu"> <?php $sl = $ranks[$member['TribeRank']]; $sl = explode("|",$sl); echo tfmdil($sl[1]);?> </div> 
 </td>
 
 <td>
  <?php echo date("d/m/Y H:i:s",($member['TribeJoined']*60));?>

 </td>
 
 </tr>  
<?php
}
?>


 </table>
 </ul> 
 </div>  
 </div>
 </td>
   
   </tbody> 
   </table> 
   <div class="span4"> <div class="cadre cadre-defaut"> <h4><?=tfmdil('interface.tribu.bouton.rangs')?></h4>
   
    <?php
	 
	
 for($x=$rc;$x>0;$x--){
 ?>
  
   <div class="rang-tribu">  <?php $sl = $ranks[$x]; $sl = explode("|",$sl); echo tfmdil($sl[1]);?> </div> 
   <?php
}
?>
   </div>
   </div> 
   </div> 
 
  <?php
include("footer.php");
?>