<?php
include("../../pdoconnect.php");
yetkisinir(8);
$users = $_GET['v'];
$usr = $db->query("SELECT mesaj FROM iletisim WHERE id = '".$users."'")->fetch(PDO::FETCH_ASSOC);
if(!empty($usr['mesaj'])){
echo "<pre><br><br>".$usr['mesaj']."<br><br><br><br></pre>";
}else{
	echo tfmdil('erreur.tribulle.11');
}
?>
