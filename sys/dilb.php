<?php
include("linkaccess.php");

if(empty($_GET['d'])){
$dil = "tfz_".strtolower($dilim);
}else{
	$dil = "tfz_".$_GET['d'];

}

$goster = @$_GET['g'];

$myfile = "_langues/".$dil;
$myfile = file_ex($myfile);


@$dil = file_get_contents($myfile);
@$dil = zlib_decode($dil);

$ayir = explode("¤",$dil);
$tfmdil = array();
$titlelist = array();

	@$deg = array("Atelier801","Atelier 801","Transformice","transformice");
	@$degg = $ayarlar['title'];
	  
foreach($ayir as $ayir1){
	$e="";
	$ay = explode("=",$ayir1);
	
 	$ayc = count($ay);
	
	for($word=2;$word<$ayc;$word++){
		$d = array("color","'#",'"');
		$b = array("color=","='#","'");
	$e .= str_replace($d,$b,$ay[$word]); 
		
	} 
	
	/* 
	if(!empty($ay[2])){
	@$e = "=".$ay[2]."=".$ay[3];
	}
	 */
	
		@$ay[1] = $ay[1].str_replace("==","=",$e);

	
	if(strstr($ay[0],"T_")){
	@$asama = end(explode("_",$ay[0]));
	
	if(is_numeric($asama) && $asama>=1100){

	$titlelist[$ay[0]] = $ay[1];
	}
	
	}else{
 @$ay[1] = strip_tags($ay[1]);
	}

if(!empty($ay[1])){
	$tfmdil[$ay[0]]=str_replace($deg,$degg,$ay[1]);
}

}


if($goster>=1){
//echo $dil;
?>
<pre>
<?php
	print_r($tfmdil);
?>

<?php
	print_r($titlelist); 
?>


</pre>
	<?php
}

?>


