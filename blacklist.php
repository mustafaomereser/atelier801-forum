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


if($id==$uye['id'] || $yetkim>=9){
	$erisim=1;
}else{
	$erisim=0;
}

if($erisim==1){
	
	$sil = $_GET['sil'];
	if(!empty($sil)){
	$sil = ",".$_GET['sil'];
	$s = $pr['IgnoredsList'];
	if(strstr($s,$sil)){
			$onaysil++;

	}else{
	$sil = $_GET['sil'];

	if(strstr($s,$sil)){
		$onaysil++;
	}else{
	popup(tfmdil('Joueur_Existe_Pas'));
	}
	
	}
	
	if($onaysil>=1){
	 $newlist = rtrim(ltrim(str_replace($sil,"",$s),","),",");
	$sl = $db->query("UPDATE users set IgnoredsList = '".$newlist."' where PlayerID = '".$id."'");
	
	    socket("data|".$uye['id']."|ignoredsList|".$newlistn."");

	
	yenile(0,1,"?pr=".cpr($kadi[0]).str_replace("#","%23",$kadi[1]));
	}
	
	}
	
}


$blist = explode(",",$pr['IgnoredsList']);
$bcount = count($blist);


if(empty($blist[0])){
echo "<br><span style='color:white;'><center>(".tfmdil('texte.vide').")</center></span><br><br>";
}

  if(!empty($blist[0])){
?>
<script>title("<?=$pr['Username']?>");</script>

 <div id="corps" class="corps clear container" bis_skin_checked="1">   
 
  <?php  
foreach($blist as $row){
	 $baned = $db->query("SELECT * FROM users where PlayerID = '".$row."'")->fetch(PDO::FETCH_ASSOC);   

?>

 <div class="row" bis_skin_checked="1"> 
 <div class="span12" bis_skin_checked="1">     
 <div class="cadre cadre-utilisateur cadre-ignore ltr" bis_skin_checked="1">
 <form id="retire_ignore_<?=$baned['Username']?>-<?=$baned['Tag']?>" class="hidden" action="<?=$site?>/remove-ignored" method="POST" autocomplete="off">
 <input type="hidden" name="nom" value="<?=$baned['PlayerID']?>">
 </form>

 <table class="table-cadre table-cadre-centree"> 
 <tbody>
 <tr>
 <td class="table-cadre-cellule-principale" style="height:40px;"> 
 <?php
if($erisim>=1){ 
 ?>
 <div class="btn-group" bis_skin_checked="1"> 
 <a class="dropdown-toggle btn btn-inverse bouton-action" data-toggle="dropdown"> 
 <img src="<?=$site?>/img/icones/roue-dentee.png" class="img20"> 
 </a> 
 <ul class="dropdown-menu menu-contextuel pull-left"> 
 <li class="nav-header"><?=tfmdil('texte.joueur')?></li> 
 <li><a class="element-menu-contextuel" href='?pr=<?=cpr($kadi[0]).str_replace("#","%23",$kadi[1])?>&sil=<?=$baned['PlayerID']?>'><?=tfmdil('Supprimer')?></a></li> 
 </ul> 
 </div> 
<?php
}
 ?>
 
 <?=isim($baned['Username'].$baned['Tag'],"s")?>
 </td> 
 </tr>
 </tbody></table>
 </div>
 </div> 
 </div>  
  
 <?php
 }
  
 ?>
 
 </div>
 
 <?php
 }
include("footer.php");
?>