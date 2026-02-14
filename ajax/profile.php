<?php
include("../pdoconnect.php");

$veri = $_POST['query'];
if(empty($veri)){
yonlendir($site."/404",0);
exit();
}else{
	
	function bti($boolean){
	if($boolean=="true"){
		$r=1;
	}elseif($boolean=="false"){
		$r=0;
	}
		return $r;
	}
	
	
$id = $veri['id'];
if($id==$uye['id']){
	
$dz = $db->query("SELECT * FROM profilesuser where player = '".$id."'")->fetch(PDO::FETCH_ASSOC);
$pz = $db->query("SELECT * FROM users where PlayerID = '".$id."'")->fetch(PDO::FETCH_ASSOC);


$online = bti($veri['online']);
$lang = $veri['lang'];


$ack = temizle(htmlspecialchars($veri['ack']));
$konum = temizle(htmlspecialchars($veri['konum']));
$birthday = temizle(htmlspecialchars($veri['birthday']));
$gender = $veri['gender'];

$staciklama = bti($veri['staciklama']);
$stkonum = bti($veri['stkonum']);
$stbirthday = bti($veri['stbirthday']);
$stgender = bti($veri['stgender']);



if($pz['Gender']!=$gender){
	
	if(($gender>=0 && $gender<3)){
		$degisen++;
		$dzn = $db->query("UPDATE users set Gender = '".$gender."' where PlayerID = '".$id."' ");
		
		if(user_check($id)==1){
			socket("data|".$id."|gender|".$gender."");
		}
		
	}else{
		popup(tfmdil('texte.resultat.interdit'),1);
		exit();
	}

}

if($dz['stonline']!=$online){
    $degisen++;
    $dzn = $db->query("UPDATE profilesuser set stonline = '".$online."', online='".(time()-1)."' where player = '".$id."' ");
}

if($dz['lang']!=$lang){
	
	if(!empty($dilrs[$lang])){
		$degisen++;
		$dzn = $db->query("UPDATE profilesuser set lang = '".$lang."' where player = '".$id."' ");
	}else{
		popup(tfmdil('erreur.tribulle.33')." : ".tfmdil('texte.communaute'));
		exit();
	}
	
}else{
	
}


if($dz['aciklama']!=$ack && $staciklama==1){
    $degisen++;
    $dzn = $db->query("UPDATE profilesuser set aciklama = '".$ack."' where player = '".$id."' ");
}



if($dz['konum']!=$konum){
    $degisen++;
    $dzn = $db->query("UPDATE profilesuser set konum = '".$konum."' where player = '".$id."' ");
}


if($dz['birthday']!=$birthday){
	$b = explode("/",$birthday);
	$dogm=0;
	if(is_numeric($b[0]) && is_numeric($b[1]) && is_numeric($b[2])){
		
		if($b[0]>0 && $b[0]<=31){
			$dogm++;
		}else{
			popup(tfmdil('erreur.tribulle.33')." : ".$plang['gun']);	
		}
		
		if($b[1]>0 && $b[1]<=12){
			$dogm++;
		}else{
			popup(tfmdil('erreur.tribulle.33')." : ".$plang['ay']);
		}
			
			
		if($b[2]>=1980 && $b[2]<=2038){
			$dogm++;
		}else{
			
			popup(tfmdil('erreur.tribulle.33')." : ".$plang['yil']);
			
		}
			
	}else{
		popup(tfmdil('erreur.tribulle.33')." : ".tfmdil('texte.anniversaire'));
	}
	
	
	if(!empty($b[3])){
		popup(tfmdil('R_Hack'),1);
	}else{
		$dogm++;
	}
	
	if($dogm>=4){
		$degisen++;
		$dzn = $db->query("UPDATE profilesuser set birthday = '".$birthday."' where player = '".$id."' ");
	}else{
		exit();
	}
}



if($dz['staciklama']!=$staciklama){
    $degisen++;
    $dzn = $db->query("UPDATE profilesuser set staciklama = '".$staciklama."' where player = '".$id."' ");
}

if($dz['stkonum']!=$stkonum){
    $degisen++;
    $dzn = $db->query("UPDATE profilesuser set stkonum = '".$stkonum."' where player = '".$id."' ");
}

if($dz['stgender']!=$stgender){
    $degisen++;
    $dzn = $db->query("UPDATE profilesuser set stgender = '".$stgender."' where player = '".$id."' ");
}

if($dz['stbirthday']!=$stbirthday){
    $degisen++;
    $dzn = $db->query("UPDATE profilesuser set stbirthday = '".$stbirthday."' where player = '".$id."' ");
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
