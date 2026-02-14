<?php
include("../pdoconnect.php");

if($_GET['key']==$ayarlar['apikey']){
	
$query = @$_GET['runquery'];
$fetchtype = @$_GET['fetchtype'];

if(strstr($query,strtolower("UPDATE"))){
	$q = "exec";
}else{
	$q = "query";
}


if($fetchtype=="fetchAll"){
	$sys = $db->$q($query)->fetchAll(PDO::FETCH_ASSOC);

}elseif($fetchtype=="fetch"){
		$sys = $db->$q($query)->fetch(PDO::FETCH_ASSOC);

}else{
	
			$sys = $db->$q($query);

}

if(!empty($fetchtype)){
$sys = json_encode($sys);
print_r($sys);
}

}else{
	yonlendir($site."/404",0);
	exit();
}
?>
