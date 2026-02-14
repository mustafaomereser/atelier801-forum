<?php
include("../../pdoconnect.php");
yetkisinir(8);
$veri = $_POST['query'];
if(empty($veri)){
yonlendir($site."/404",0);
exit();
}else{
	
$id = $veri['id'];
$mode = $veri['mode'];



if($mode=="deleted"){
$dzn = $db->query("DELETE FROM reports WHERE id='".$id."'");
}elseif($mode=="handled"){
	
	$dzn = $db->query("UPDATE reports set handled = '1' where id = '".$id."' ");

}


	if($dzn>0){
		echo ucwords($mode);
	}else{
		alert("danger",tfmdil('Erreur_Droit'),1);
	}

}
 

?>