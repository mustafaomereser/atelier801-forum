<?php
include("../pdoconnect.php");

$id = $_POST['prp'];
$link = $_POST['link'];

if($id==$uye['TribeCode']){

	if(!empty($t_rank['10'])){
		if(is_array($_FILES)) {
			if(is_uploaded_file($_FILES['fichier']['tmp_name'])) {
				$sourcePath = $_FILES['fichier']['tmp_name'];

				$uzn = explode(".",$_FILES['fichier']['name']);
				$filename = "tribe_".$id.".".end($uzn);
				$targetPath = "../img/tribes/".$filename;


				$snc = $db->query("UPDATE profilestribe set avatar = '".$filename."' WHERE tribe = '".$id."'");

				if($snc > 0){
					yonlendir($link,0.7);
					imgresize($sourcePath,$targetPath);
				}
			}
		}

	}else{
		popup(tfmdil('texte.resultat.droitsInsuffisants'));
	}

}
?>
