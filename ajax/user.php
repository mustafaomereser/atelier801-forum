<?php
include("../pdoconnect.php");

$users = $_GET['v'];

if(is_numeric($users)){
	$usr = $db->query("SELECT Username,Tag FROM users WHERE PlayerID = '".$users."'")->fetch(PDO::FETCH_ASSOC);
	if(!empty($usr['Username'])){
		isim($usr['Username'].$usr['Tag'],"o");
	}else{
		echo tfmdil('erreur.tribulle.11');
	}
}else{
	echo "Amına kodum müptezeli napıyon burda sen?";
	exit();
}

?>
