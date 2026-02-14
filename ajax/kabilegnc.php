<?php
include("../pdoconnect.php");

$veri = $_POST['query'];
if(empty($veri)){
yonlendir($site."/404",0);
exit();
}else{
	
$id = $veri['id'];
if($id==$uye['TribeCode']){
$degisen = 0;

$dz = $db->query("SELECT * FROM profilestribe where tribe = '".$id."'")->fetch(PDO::FETCH_ASSOC);

if(!empty($t_rank['10'])){

$lang = $veri['lang'];

if($dz['lang']!=$lang){
	
	if(!empty($dilrs[$lang])){
		$degisen++;
		$dzn = $db->query("UPDATE profilestribe set lang = '".$lang."' where tribe = '".$id."' ");
	}else{
		popup(tfmdil('erreur.tribulle.33')." : ".tfmdil('texte.communaute'));
		exit();
	}
	
}else{
	
}


	$msg = temizle($veri['msg']);

	if(!empty($msg)){
		if($tri['Message']!=$msg){
			if(!empty($t_rank['2']) || !empty($t_rank['1'])){
				$degisen++;
				$dzn = $db->query("UPDATE tribe set Message = '".$msg."' where Code = '".$id."' ");
			}else{
				popup(tfmdil('texte.resultat.droitsInsuffisants'));
			}
		}
	}


$reisg = $veri['reisg'];
if(!empty($reisg)){
if($reisg=="true"){
	$reisg = 1;
}
if($reisg=="false"){
	$reisg = 0;
}

if($dz['reisg']!=$reisg){
    $degisen++;
    $dzn = $db->query("UPDATE profilestribe set reisg = '".$reisg."' where tribe = '".$id."' ");
}

}


$msgg = $veri['msgg'];


if(!empty($msgg)){
if($msgg=="true"){
	$msgg = 1;
}
if($msgg=="false"){
	$msgg = 0;
}

if($dz['msgg']!=$msgg){
    $degisen++;
    $dzn = $db->query("UPDATE profilestribe set msgg = '".$msgg."' where tribe = '".$id."' ");
}

}


$msgaciklama = $veri['msgaciklama'];


if(!empty($msgaciklama)){
if($msgaciklama=="true"){
	$msgaciklama = 1;
}
if($msgaciklama=="false"){
	$msgaciklama = 0;
}

if($dz['msgaciklama']!=$msgaciklama){
    $degisen++;
    $dzn = $db->query("UPDATE profilestribe set msgaciklama = '".$msgaciklama."' where tribe = '".$id."' ");
}

}


$alim = $veri['alim'];
if($tri['alimlar']!=$alim){
    $degisen++;
    $dzn = $db->query("UPDATE tribe set alimlar = '".$alim."' where Code = '".$id."' ");
}

$aciklama = $veri['aciklama'];
if(!empty($aciklama)){
	if($dz['aciklama']!=$aciklama){
		$degisen++;
		$dzn = $db->query("UPDATE profilestribe set aciklama = '".$aciklama."' where tribe = '".$id."' ");
	}
}

}

?>
<script>
location.reload();
</script>
<?php
}else{

}




}
?>
