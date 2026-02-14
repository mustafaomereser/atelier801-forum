<?php
include("config.php");
$kabileid = $_GET['tr'];

$tribe = $db->query("SELECT * FROM tribe where Code = '".$kabileid."'")->fetch(PDO::FETCH_ASSOC);
$members = explode(",",$tribe['Members']);
$id = $tribe['Name'];

if(!in_array($uye['PlayerID'], $members)){
	popupn(tfmdil('texte.resultat.droitsInsuffisants'),1,null,$site."/forums");
	_exit();
}


if(empty($id)){
	popupn(tfmdil('popup.tribu.erreurInformationsTribu.titre'),1,null,$site."/forums");
	_exit();
}


?>
 

<div id="corps" class="corps clear container">          
  
<div class="row">

<tribeforum><script>$('tribeforum').load("ajax/tribeforum");</script></tribeforum>

 </div>
</div> 

 
     <?php
include("footer.php");
?>