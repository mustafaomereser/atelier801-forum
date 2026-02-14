<?php
include("../pdoconnect.php");
?>
<meta charset="utf-8">
	<div id="popup">
</div> 
<?php
$veri = $_POST['query'];
if(empty($veri)){
    echo "hata !";

}else{

	
	$redirect = $veri['redirect'];
	$kadi = $veri['kadi'];
	$sifre = sifrele($veri['sifre']);
	$giris = $db->query("SELECT * FROM users where (Username = '".$kadi."' or Email = '".$kadi."') and Password ='".$sifre."'");
	$girisc = $giris->rowCount();
	$giris = $giris->fetch(PDO::FETCH_ASSOC);
	
	$ban_control = forum_ban($giris['PlayerID']);
	
	if($ban_control['durum']==1){
		popup(tfmdil('texte.resultat.authentificationRefusee'));
		exit();
	}
	
if($girisc==1){
	
$pt = $db->query("SELECT online FROM profilesuser where player = '".$giris['PlayerID']."'")->fetch(PDO::FETCH_ASSOC);
	
if($pt['online']<time()){
	if(empty($_SESSION['id'])){
	$_SESSION['id'] = $giris['PlayerID'];
	$_SESSION['sifre'] = $sifre;
	//popup(tfmdil('texte.resultat.succes'));
	
	if(!empty($redirect)){
		yonlendir(str_replace("?_","&",$redirect),0.1);
	}else{
		yonlendir($site."/forums");
	}
	
	}
}else{
		popup(tfmdil('Déjà_Connecté'));
}
	
	
}else{
	if($girisc>=1){

	$hesaplar = $db->query("SELECT Username,Tag FROM users where Email = '".$kadi."'")->fetchAll(PDO::FETCH_ASSOC);

	$hsp = "";
	foreach($hesaplar as $row){
		
	
		 $hsp = $hsp."<a onclick='return degistir(\"kadi\",\"".$row['Username']."\");' style='width:93%;margin-top:1px;' class='btn' data-dismiss='modal'>".$row['Username'].$row['Tag']."</a><br>";

	
	}


	popup($hsp,0,tfmdil('texte.utilisateur'));

	}else{
		popup(tfmdil('authentification.erreur.2'));
	}
}

?>



<?php
}
?>
