<?php
include("../pdoconnect.php");

if($yetkim>=12 || $op>=1){
	
	$v = $_GET['v'];
	echo $v."<br>";
	
	if(!empty($v)){
		echo socket($v,1);
	}
}

?>