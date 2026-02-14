<?php
include("../pdoconnect.php");

$id = $_POST['prp'];
$link = $_POST['link'];

if($id==$uye['id']){

if(is_array($_FILES)) {
if(is_uploaded_file($_FILES['fichier']['tmp_name'])) {
$sourcePath = $_FILES['fichier']['tmp_name'];
$fil = $id % 10000;
$tr = "../img/avatars/";

if(!file_exists($tr.$fil)){
mkdir($tr.$fil);	
}


$uzn = explode(".",$_FILES['fichier']['name']);

$filename = $fil ."/".$id.".jpg"/* .end($uzn) */;
$targetPath = $tr.$filename;

$_filename = $fil ."/".$id."_50.jpg";
$_targetPath = $tr.$_filename;


$snc = $db->query("UPDATE users set Avatar = '".end(explode("/",$filename))."' WHERE PlayerID = '".$id."'");

if($snc > 0){
	imgresize($sourcePath, $targetPath);
	imgresize($sourcePath, $_targetPath, 50);
		yonlendir($link,0.7);
}



}
}

}

?>
