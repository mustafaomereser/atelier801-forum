<?php

include("linkaccess.php");


include("db.php");
$db = class_db::_mysql($servername, $dbname,$username,$password);

	if(isset($_SESSION['id'])){
		$usercheck = $db->query("SELECT PlayerID FROM users where PlayerID = '".$_SESSION['id']."'")->fetch(PDO::FETCH_ASSOC);
		if(!empty($usercheck['PlayerID'])){			
			$sonuc = $db->exec("UPDATE profilesuser SET online='".(time()+6)."' WHERE player='".$_SESSION['id']."'");
			
			if($sonuc>0){
				echo "<!--Çevrimiçi ".date("H:i:s",time())."-->";
			}
			
		}else{
			echo "+Başaramadık abi :(";
		}
	}else{
		echo "<!--Çevrimdışı-->";
	}
?>