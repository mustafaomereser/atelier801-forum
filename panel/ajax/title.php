<?php
include("../../pdoconnect.php");
yetkisinir(10);
//$lastid = file_get_contents("lasttitleid");


$veri = $_POST['query'];

if(empty($veri)){

yonlendir($site."/404",0);
exit();
	
}else{
	$title = $veri['title'];

$mode = $veri['mode'];


$files = glob("../../_langues/*");

$diller = array();
foreach($files as $r){
	$titlecount=0;

	$file = zlib_decode(file_get_contents($r));

	
	$test = explode("¤",$file);
	
	foreach($test as $b){
	$as = explode("=",$b);
	

	if(strstr($as[0],"T_")){
		
	@$asama = end(explode("_",$as[0]));

	if(is_numeric($asama)){
	$titlecount++;
	}

	}


	}
		
	@$s = end(explode("/",$r));
	
	@$id = end(explode("_",$s));
	
	$diller[$id] = $r;
	
		
	if($mode==1){
	$lastid = array();
	foreach($titlelist as $key => $yarrak){
		$lastid[str_replace("T_","",$key)] = str_replace("T_","",$key);
	}
	$lastid = (max($lastid)+1);
	
	$titlb = "T_".($lastid)."=".str_replace('"',"'",$title)."¤";

	$s = $file.$titlb;
	geri();
	
	}
	if($mode==2){
		
	$s = str_replace("T_".$title."¤","",$file);
	?>
	<script>
	
		$('#'+<?=strtok($title,"=")?>).remove();

	</script>
	
	<?php
	
	}
	
	
	if($mode==3){

		
	$newtitle = str_replace('"',"'",$veri['newtitle']);
	$newc = strlen($newtitle);
	$tam = $veri['tam'];
	// .substr($newtitle,0,$newc)
	//exit();	
	$tit = explode("=",$tam);
		
		
	$s = str_replace($tam,$tit[0]."=".$newtitle,$file);
	
	?>
	
	<script>
		$('#titlename_'+<?=strtok(substr($tam,2),"=")?>).html("<?=$newtitle?>");
	</script>
	
	<?php
	
	}
	
	if(!empty($mode)){
		
		$new = zlib_encode($s, ZLIB_ENCODING_DEFLATE);

		$file = fopen($r, "w");
		fwrite($file, $new);
	
	}

}
/* 
if($mode==1){
		$lasti = fopen("lasttitleid", "w");
		fwrite($lasti, ($lastid+1));
} */

//geri();

}

?>