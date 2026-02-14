<?php
include("../../pdoconnect.php");
yetkisinir(9);

$veri = $_POST['query'];
if(empty($veri)){
yonlendir($site."/404",0);
exit();
}else{
	
$kadi = temizle($veri['kadi']);
$amount = temizle($veri['amount']);
$item = temizle($veri['item']);


if(!empty($kadi) && !empty($amount) && is_numeric($item)){

$user = $db->query("SELECT Username,PlayerID FROM users where Username = '".$kadi."'")->fetch(PDO::FETCH_ASSOC);

if(!empty($user['Username'])){	

$control = user_check($user['PlayerID']);
if($control>=1){
socket("komut|mgive ".$kadi." ".$item." ".$amount."");

echo "Gave Success";

}else{
		echo "User offline";
}

}else{
	echo "User doesn't exist";
}

}else{
		echo "Inputs cannot be blank";
}

}

?>