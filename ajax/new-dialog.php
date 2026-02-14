<?php
include("../pdoconnect.php");

$veri = $_POST['query'];
if(empty($veri)){
yonlendir($site."/404",0);
exit();
}else{
	
$msg = temizle($veri['msg']);
$konu = temizle($veri['konu']);
$player = temizle($veri['player']);

$player = explode("#",$player);
if(!empty($player[1])){
$player[1] = "#".$player[1];
}

$hash = time()."".createHash(7);

$minmsg = 5;

if(!empty($uye['id'])){
$hatamsj="ssdsd";

$onay=0;

if(strlen($msg)>=$mingmsg){
	$onay++;
}else{
	$hatamsj = $hatamsj.str_replace("%1",$minmsg,tfmdil('texte.resultat.messageTropCourt'));
}

if(strlen($konu)>=$mingmsg){
	$onay++;
}else{
		$hatamsj = $hatamsj.str_replace("%1",$minmsg,tfmdil('texte.resultat.titreTropCourt'));

}

if(!empty($player)){
	$r = $db->query("SELECT * FROM users WHERE Username = '".$player[0]."' and Tag='".$player[1]."'")->fetch(PDO::FETCH_ASSOC);
	if($r['PlayerID']!=$uye['id']){
	$kisi = $r['PlayerID'];
	if(!empty($kisi)){
	$onay++;
	}else{
		popup(tfmdil('texte.resultat.utilisateurInexistant'));
		exit();
	}
	}else{
		popup($plang['dialog_yourself']);
	exit();
	}
	
}else{
	
}

if($_SESSION['conv_time']>time()){
		popup(tfmdil('texte.resultat.timeoutRequete'));
	exit();
}else{
	$onay++;
}


if($onay>=4){

$time = time();
	
$snc = $db->exec("INSERT INTO conversations (title,player,started,date,hash,etkilesim) values ('".$konu."','".$kisi."','".$uye['id']."','".$time."','".$hash."','".$time."')");

if($snc>0){
$snc = $db->exec("INSERT INTO conversations (title,player,started,date,hash,etkilesim) values ('".$konu."','".$uye['id']."','".$uye['id']."','".$time."','".$hash."','".$time."')");
}

if($snc>0){
$snc = $db->exec("INSERT INTO conversation (hash,player,text,date) values ('".$hash."','".$uye['id']."','".$msg."','".$time."')");
}
if($snc>0){
$_SESSION['conv_time']= time()+120;
yonlendir($site."/conversation?co=".$hash);
exit();
}

}else{
	popup($hatamsj);
}


}

}
?>
