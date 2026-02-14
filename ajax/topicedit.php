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
$msg = temizle(htmlspecialchars($veri['msg']));

$topicm = $db->query("SELECT player FROM topicm where id = '".$id."'")->fetch(PDO::FETCH_ASSOC);

if($topicm['player']==$uye['id'] || ($yetkim>=8 || $op>=1)){

if(strlen($msg)>=4){
	$snc = $db->exec("UPDATE topicm set text = '".$msg."', lastedit = '".time()."' where id = '".$id."'");
	
	if($snc>0){
		popupn(tfmdil('texte.resultat.succes'),1);
	
	geri();
	}
	
}else{
		popupn(tfmdil('texte.resultat.timeoutRequete'),1);
}
	
}else{
	popupn(tfmdil('Erreur_Droit'),1);
}



}
?>