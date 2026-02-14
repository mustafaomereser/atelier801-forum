<?php
include("pdoconnect.php");

if(isset($_SESSION['id'])){
	$sonuc = $db->exec("UPDATE profilesuser SET online='".time()."' WHERE player='".$uye['id']."'");
	cikis();
	geri();
}else{
	popupn("Yarrak :)");
}


?>