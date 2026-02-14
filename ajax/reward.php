<?php
include("../pdoconnect.php");

$get = $_GET['v'];
$saat = 3600;

if(!empty($get)){
if(user_check($uye['id'])==1){

$check = $db->query("SELECT PlayerID,Reward,Username FROM users WHERE PlayerID = '".$uye['id']."'")->fetch(PDO::FETCH_ASSOC);
if(time()>=$check['Reward'] || $yetkim>=12){
$k = $db->exec("UPDATE users set Reward = '".(time()+($saat*24))."' Where PlayerID = '".$uye['PlayerID']."'");

$items = array(6,8,5,1,11,9,12,13,17,18,23,2,16,3,14,7,15,4,10);
$rand = array_rand($items);
$item = $items[$rand];
$amount = rand(1,7);


if($k>0){
socket("komut|reward ".$uye['Username']." ".$item." ".$amount."");
		popup($plang['reward'].": <div style='height:70px;'><br><img src='http://transformice.com/images/x_transformice/x_inventaire/".$item.".jpg' style='position:absolute'/> <p style='position:absolute;top:65.6%;left:8.5%;color:white;font-family: sans-serif;font-size:12px'>".$amount."</p></div>");



}else{
		popup(tfmdil('ErreurGeneriqueSurvenue'));

}

}else{
	
	popup(" ".convertSecToStr(str_replace("-","",time()-$check['Reward']))." ".$plang['reward_left']);
	
}



}


}else{


$veri = $_POST['query'];

if(empty($veri)){
	yonlendir($site."/404",0);
	exit();
}else{
	


if(user_check($uye['id'])==1){

$check = $db->query("SELECT PlayerID,Reward,Username FROM users WHERE PlayerID = '".$uye['id']."'")->fetch(PDO::FETCH_ASSOC);

$saniye = 100;


if(time()>=$check['Reward'] || $yetkim>=12){
?>

<script>
  var angle = 0;
  var randm = Math.floor(Math.random() * 2);
  
  console.log("Mode : "+randm);
  
  var dur = <?=$saniye?>;
  angle = <?=$saniye?>;
  var dondur = "#mill_rotate";
  if(randm==1){
		cevir360();
  }
  
 var anan = setInterval(function() {
	  if(dur>1){
    angle = angle - 10;
	if(randm==0){
		$(dondur).rotate(angle);
	}
		dur--;
	  }
	  console.log(dur);
	  
	  if(dur==1){
		   	dur--;
		  $("#result_rulet").load("ajax/reward.php?v=cekveriyiiste");
	  }
	  
	  
	  if(dur==0){
		    clearInterval(anan);
	  }
	  
  }, 50);
  
</script>


<?php
}else{
	
	popup(" ".convertSecToStr(str_replace("-","",time()-$check['Reward']))." ".$plang['reward_left']);
	
}

}else{
	
	popup(tfmdil('erreur.tribulle.2'));
	
}




}

}
?>
