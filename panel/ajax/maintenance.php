<?php
include("../../pdoconnect.php");
yetkisinir(11);

$veri = $_POST['query'];

if(empty($veri)){
	echo "YAV Bİ SİKTİR GİT";	
}else{

		if($ayardb['bakim']==1){
			$d = 0;
			echo "<font color='red'>OFF</font>";
		}else{
			$d = 1;
			echo "<font color='green'>ON</font>";
		}
	
		$db->exec("UPDATE forum_settings set bakim = '".$d."'");
}
?>