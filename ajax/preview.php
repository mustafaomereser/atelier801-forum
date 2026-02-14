<?php
include("../pdoconnect.php");

$veri = $_POST['query'];

if(empty($veri)){
	yonlendir($site."/404",0);
	exit();
}else{
	
$text = $veri['text'];

?>




 <div class="cadre cadre-message cadre-previsualisation">
 <?=bbcode($text)?>
 </div>

<?php
}
?>
