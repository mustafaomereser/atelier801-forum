<?php
$li = "http://".$_SERVER['SERVER_NAME'];
$str = "http://".$_SERVER['SERVER_NAME'].strtok($_SERVER['REQUEST_URI'],"?");

/* if(strstr($_SERVER['REQUEST_URI'],".php")){
		
} */


$link = null;

if(!strstr($str,"/sys/onl")){
	$link = $str;
}

//echo $link;

$yasakli = array(
"/sys/",
"config",
"pdoconnect",
"footer",
"seconder-menu",
"/ajax/lasttitleid"
);

$izinli = array(
"/sys/test",
"/sys/socket"
); 

$izinlid=0;

foreach($yasakli as $key => $list){
	
	foreach($izinli as $e){	
		if(strstr($link,$e)){
			$izinlid=1;
		}
	}

	if($izinlid==0){
		if(strstr($link,$list)){
			echo '<meta http-equiv="refresh" content="0;URL='.$li.'/404">';
			exit();
		}
	}
}


?>

