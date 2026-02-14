<?php
include("linkaccess.php");

@$s = $_GET['v'];

if(empty($s)){
$s = strtolower($dilim);
}


	@$deg = array("Atelier801","Atelier 801","Transformice","transformice");
	@$degg = $ayarlar['title'];

$bul = "../_langues/tfz_".strtolower($s);

//$bul = file_ex($bul);

$d = file_get_contents($bul);

$ayir =  explode("¤",zlib_decode($d));

$titlelist = array();

$dil = array();

$s = 0;
foreach($ayir as $row){
$s++;
$d = explode("=",$row);	

$ew = null;
$sds = 0;

if(!empty($d[0])){

foreach($d as $rw){
	$sds++;

if($sds!=1){	
$ew .= str_replace("'#","='#",$rw);	
}

}

if(strstr($d[0],"T_")){
@$control = end(explode("T_",$d[0]));

if(is_numeric($control) && $control>=1000){
	$titlelist[$d[0]]=$ew;
}

}

$dil[$d[0]]=str_replace("==","=",str_replace($deg,$degg,$ew));

}

}
echo count($dil);

//echo "Parametre sayısı : ".$s;
?>

<pre>
<?php print_r($dil)?>


<?php print_r($titlelist)?>
</pre>