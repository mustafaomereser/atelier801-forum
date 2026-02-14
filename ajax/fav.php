<?php
include("../pdoconnect.php");

$veri = $_POST['query'];

if(empty($veri)){
    echo "hata !";

}else{
	
	if(!empty($uye['id'])){

		$favorite = $veri['id'];
		$mode = $veri['mode'];
		
	$favs = $db->query("SELECT * FROM favorites where player = '".$uye['id']."' and data = '".$favorite."' and mode = '".$mode."'")->fetch(PDO::FETCH_ASSOC);

		$str = $favs['id'];
		
		if(!empty($favorite)){
		if(empty($str)){
		$fav = $db->exec("INSERT INTO favorites (player,data,mode) values ('".$uye['id']."','".$favorite."','".$mode."')");
		}else{
		$fav = $db->exec("DELETE from favorites where player = '".$uye['id']."' and data = '".$favorite."' and mode = '".$mode."'");
		}
				geri();
		}
		
	}else{
		popup(tfmdil('texte.resultat.auteurInvalide'));
	}
?>



<?php
}
?>
