<?php
include("../pdoconnect.php");

$dil=strtolower($_GET['dil']);

if(!empty($dil)){
$_SESSION['dil']="diller/".$dil.".php";

geri();
}else{
	yonlendir($site."/404",0);
	exit();
	
}

?>
