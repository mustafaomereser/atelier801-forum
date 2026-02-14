<?php
include("config.php");

if(empty($uye['id'])){
	popupn(tfmdil('texte.resultat.droitsInsuffisants'));

	_exit();
	
}

	$sil = $_GET['sil'];
	if(!empty($sil)){
		$sonuc = $db->exec("DELETE FROM favorites WHERE player = '".$uye['id']."' and data = '".$sil."' and mode = '2'");	
		if($sonuc>0){
		
	}else{
	popup(tfmdil('EchecPaiement'));
	}
	}


$favor = $db->query("SELECT * FROM favorites WHERE player = '".$uye['id']."' and mode = '2' ")->fetchAll(PDO::FETCH_ASSOC);
$blist = array();

foreach($favor as $row){
array_push($blist,$row['data']);
}

$bcount = count($blist);

if($bcount<=0){
echo "<br><span style='color:white;'><center>(".tfmdil('texte.vide').")</center></span><br><br>";
}


  if(!empty($blist[0])){
?>
<script>title("<?=$pr['Username']?>");</script>

 <div id="corps" class="corps clear container" bis_skin_checked="1">   
  <?php  
foreach($blist as $row){
	 $tribe = $db->query("SELECT * FROM tribe where Code = '".$row."'")->fetch(PDO::FETCH_ASSOC);   

?>

<div class="row"> 
<div class="span12"> 

   
<div class="cadre cadre-utilisateur cadre-ignore ltr"> 
<table class="table-cadre table-cadre-centree"> 
<tbody>
<tr> 
<td class="table-cadre-cellule-principale"> 
<div class="btn-group"> 
<a class="dropdown-toggle btn btn-inverse bouton-action" data-toggle="dropdown" href="#"> 
<img src="<?=$site?>/img/icones/roue-dentee.png" class="img20"> 
</a> 
<ul class="dropdown-menu menu-contextuel pull-left"> 
<li class="nav-header"><?=$plang['favorite']?></li> 
<li>
 <li><a class="element-menu-contextuel" href='?sil=<?=$tribe['Code']?>'><?=tfmdil('Supprimer')?></a></li> 
</li> 
</ul> 
</div> 
<a class="" href="<?=$site?>/tribe?tr=<?=$tribe['Code']?>"> 
<span class="cadre-ignore-nom"><?=$tribe['Name']?></span> 
</a> 
</td> 
</tr> 
</tbody>
</table> 
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