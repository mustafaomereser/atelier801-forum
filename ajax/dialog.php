<?php
include("../pdoconnect.php");

$veri = $_POST['query'];
if(empty($veri)){
yonlendir($site."/404",0);
exit();
}else{
$msg = temizle($veri['msg']);
$conv = strtok(end(explode("co=",$veri['link'])),"&");

$tdb = $db->query("SELECT * FROM conversations where hash = '".$conv."'")->fetchAll(PDO::FETCH_ASSOC);

foreach($tdb as $row){
	
	if($uye['id']!=$row['player']){
		$karsi = $db->query("SELECT Username,Tag,PlayerID FROM users where PlayerID = '".$row['player']."'")->fetch(PDO::FETCH_ASSOC);
	}else{
		$ben = $db->query("SELECT Username,Tag,PlayerID FROM users where PlayerID = '".$row['player']."'")->fetch(PDO::FETCH_ASSOC);
	}

	
}
		if($ben['PlayerID']!=$uye['PlayerID']){
		popup(tfmdil('Erreur_Droit'),1);
		exit();
	} 



$minmsg = 5;

if(!empty($uye['id'])){

	if($_SESSION['dialogmsg']<=time()){
	if(strlen($msg)>=$minmsg){
	$tpm = $db->exec("INSERT INTO conversation (player,hash,text,date) values ('".$uye['id']."','".$conv."','".$msg."','".time()."')");
	if($tpm>0){
	$etkilesim = $db->exec("UPDATE conversations set etkilesim = '".time()."' where hash = '".$conv."'");
	$_SESSION['dialogmsg'] = time()+3;
	yonlendir($site."/conversation?co=".$conv,0);
	}
	}else{
		popup(str_replace("%1",$minmsg,tfmdil('texte.resultat.messageTropCourt')));
	}
	
}else{
	popup(tfmdil('texte.resultat.delaiAttenteDepasse'),1);
}


}else{
	popup(tfmdil('texte.resultat.auteurInvalide'),1);
}

}
?>
