<?php
include("config.php");

$kadi = explode("#",$kadi);
if(!empty($kadi[1])){
$kadi[1] = "#".$kadi[1];
}
$pr = $db->query("SELECT * FROM users where Username = '".$kadi[0]."' and Tag = '".$kadi[1]."'")->fetch(PDO::FETCH_ASSOC);
$id = $pr['PlayerID'];


if($uye['id']==$id || $yetkim>=10){
}else{
	popupn(tfmdil('texte.resultat.interdit'));
	_exit();
}

if(empty($id)){
	popupn(tfmdil('Joueur_Existe_Pas'),1,null,$site."/forums");
	_exit();
}

$flist = explode(",",$pr['FriendsList']);
$fcount = count($flist);

if(empty($flist[0])){
echo "<br><span style='color:white;'><center>(".tfmdil('texte.vide').")</center></span><br><br>";
}


if(!empty($flist[0])){
?>
<script>title("<?=$pr['Username']?>");</script>

 <div id="corps" class="corps clear container"> 
 <div class="row"> 
 <div class="span12"> 
 <div class="cadre cadre-defaut ltr">
 <table class="table-datatable table-cadre table-cadre-centree table-striped"> 
 <thead> 
 <tr> 
 <th>
 </th>
 <th>
 </th>
 <th><?=tfmdil('texte.nom')?></th> 
 </tr> 
 </thead>
 <tbody>   

   
 <?php  
foreach($flist as $row){
	 $frend = $db->query("SELECT * FROM users where PlayerID = '".$row."'")->fetch(PDO::FETCH_ASSOC);   
?>

  <tr role="row" class="odd"> 
 <td class="sorting_1"><img src="<?=$site?>/img/avatars/<?=getavatar($frend)?>" class="element-composant-auteur img50" alt=""></td> 
 <td data-search="<?=strtolower($frend['Langue'])?>"><img src="<?=$site?>/img/pays/<?=strtolower($frend['Langue'])?>.png" class="img16 espace-2-2"></td> 
 <td class="table-cadre-cellule-principale">
	<?=isim($frend['Username'].$frend['Tag'],'s')?>
 </td> 
  </tr> 
  
 <?php
 }
 ?>
 
  </tbody>
 </table>
 </div>   
 </div> 
 </div> 
 </div>  
<?php
}
?>
 
<?php

include("footer.php");
?>
