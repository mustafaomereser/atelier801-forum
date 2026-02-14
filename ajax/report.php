<?php
include("../pdoconnect.php");

$veri = $_POST['query'];
if(empty($veri)){
yonlendir($site."/404",0);
exit();
}else{

if($mute_control['durum']==1){
	popup(i_rep('MuteInfo1', ceil(abs(time()/3600 - $mute_control['date']/3600)), $mute_control['sebep']));
	exit();
}


$id = $veri['id'];
$reas = temizle(htmlspecialchars($veri['reas']));
$link = $veri['link'];

if(strstr($link,"profile")){
	$mode="profil";
}elseif(strstr($link,"tribe")){
	$mode="tribe";

}elseif(strstr($link,"topic")){
	$mode="topic";
}else{
	$mode = "Bilinmiyor";
}



$time_out = $db->query("SELECT * FROM reports where byid = '".$uye['id']."' order by id DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
if((strtotime($time_out['date'])+7)<time()){
if(strlen($reas)>=3){
$reason = $db->exec("INSERT INTO reports (byid,reportid,reason,mode,link) values ('".$uye['id']."','".$id."','".$reas."','".$mode."','".$link."')");

if($reason > 0){
	echo "Reported";
	yonlendir($link,0.3);

}else{
	popup(tfmdil('erreur.tribulle.11'),1);
}
}else{
	echo $plang['report_short'];
}
}else{
	popup(tfmdil('erreur.tribulle.11'),1);

}

}
?>
