<?php
include("../pdoconnect.php");
$users = $_GET['v'];
$usr = $db->query("SELECT text FROM topicm WHERE id = '".$users."'")->fetch(PDO::FETCH_ASSOC);
if(!empty($usr['text'])){
echo $usr['text'];
}else{
	echo tfmdil('erreur.tribulle.11');
}
?>
