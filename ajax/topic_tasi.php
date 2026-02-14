<?php
include("../pdoconnect.php");
yetkisinir(11);
$veri = $_POST['query'];

if(empty($veri)){
    echo "hata !";

}else{
	

if($yetkim>=11 || $op>=1){
$id = $veri['id'];

$topic = $db->query("select * from topic where id = '".$id."'")->fetch(PDO::FETCH_ASSOC);

$text= "
<form method='POST'>
";

$forums = $db->query("Select * from forums")->fetchAll(PDO::FETCH_ASSOC);
foreach($forums as $row){
$sections = $db->query("Select * from section where (lang = '".strtolower($dilim)."' or lang = 'xx') and forum='".$row['id']."'")->fetchAll(PDO::FETCH_ASSOC);

if(empty($row['sub_section'])){
	$text.= "<h3>-> ".$row['title']."</h3>";
}else{
	$seg = $db->query("Select * from section where id = '".$row['sub_section']."' ")->fetch(PDO::FETCH_ASSOC);
	$frm = $db->query("Select * from forums where id = '".$seg['forum']."' ")->fetch(PDO::FETCH_ASSOC);

	$text.= "<h3>-> ".$frm['title']." / ".$seg['title']." / Sub forum</h3>";
}


foreach($sections as $sec){
	if(empty($sec['tribe'])){
	
		$selected = "";
		
		if($sec['id']==$topic['section']){
			$selected = "checked";
		}

		$text.= "<label for='sec_".$sec['id']."'><input type='radio' name='sectionsec' id='sec_".$sec['id']."' value='".$sec['id']."' ".$selected."> ".$sec['title']."</label>";
	}
}


}
$text.= "
<input type='hidden' name='topictasi' value='".$id."'>
<input class='btn btn-primary' style='float:right;' type='submit' value='".$plang['move']."'>
</form>
";


popup($text,0,$plang['move']);





}
	
}
?>
