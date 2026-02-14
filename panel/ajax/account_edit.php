<?php
include("../../pdoconnect.php");
yetkisinir(9);

$veri = $_POST['query'];
if(empty($veri)){
yonlendir($site."/404",0);
exit();
}else{
	
$id = $veri['id'];

if($yetkim>=9){
	
$usr = $db->query("SELECT * FROM users where PlayerID = '".$id."'")->fetch(PDO::FETCH_ASSOC);
$yetkisi = max(explode(",",$usr['PrivLevel']));

if($yetkim>$yetkisi || $usr['PlayerID']==$uye['id']){

$degisen = 0;

function calc_exp($level){
	return $level < 30 ? (32 + ($level - 1) * ($level + 2)) : ($level < 60 ? (900 + 5 * ($level - 29) * ($level + 30)) : (14250 + (15 * ($level - 59) * ($level + 60) / 2)));;
}

if($yetkim>=11 || $op>=1){
	$kadi = ucwords($veri['kadi']);
	if($usr['Username']!=$kadi && !empty($kadi)){
			$kadidegisonay=0;

		$cnt = $db->query("SELECT Username FROM users where Username = '".$kadi."'")->fetch(PDO::FETCH_ASSOC);
		if(empty($cnt['Username'])){
			$kadidegisonay++;
		}else{
			alert("danger",tfmdil('Pseudo_Invalide'));
		}

		if($kadidegisonay==1){
			$degisen++;
			$dzn = $db->query("UPDATE users set Username = '".$kadi."' where PlayerID = '".$id."' ");
			
			if(user_check($usr['PlayerID'])==1){
				
				socket("data|".$id."|playerName|".$kadi);
				
			}
			
			//$kadideg = 1;
			//yonlendir($site."/panel/account_edit?user=".cpr($kadi),0);
		}
	}
}

$email = $veri['email'];

if($usr['Email']!=$email){
    $degisen++;
    $dzn = $db->query("UPDATE users set Email = '".$email."' where PlayerID = '".$id."' ");
}

$sifre = str_replace(" ","",strip_tags(trim($veri['sifre'])));
$hadi_degis_hadi=0;
if($usr['Password']!=sifrele($sifre) && !empty($sifre)){
		if(strlen($sifre)>=8 && strlen($sifre)<=16){
			$hadi_degis_hadi++;
		}else{
			alert("danger",$plang['account_shortlongpw'],1);
		}
		
		if($hadi_degis_hadi>=1){	
			$sifre = sifrele($sifre);
			$degisen++;
			$dzn = $db->query("UPDATE users set Password = '".$sifre."' where PlayerID = '".$id."' ");
			alert("success",$plang['account_pwchanged'],1);
		}
}

$cheese = $veri['cheese'];
if($usr['CheeseCount']!=$cheese || (socket("getdata|".$id."|cheeseCount",1) && user_check($id)==1)){
    $degisen++;
	
	if(user_check($id)==1){
		socket("data|".$id."|cheeseCount|".$cheese);
	}else{
		$dzn = $db->query("UPDATE users set CheeseCount = '".$cheese."' where PlayerID = '".$id."' ");
	}
}


$level = $veri['level'];

if(($usr['ShamanLevel']!=$level  || (socket("getdata|".$id."|sheeseLevel",1) && user_check($id)==1))){
	if($level>=1){
    $degisen++;
	
	if($level!=1){
		$shm_exp = calc_exp(($level-1));
	}else{
		$shm_exp = 0;
	}
	
	if(user_check($id)==1){
		socket("data|".$id."|shamanLevel|".$level);
		socket("data|".$id."|shamanExpNext|".calc_exp($level));
		socket("data|".$id."|shamanExp|".$shm_exp);
	}else{
		$dzn = $db->query("UPDATE users set ShamanLevel = '".$level."', ShamanExpNext = '".calc_exp($level)."', ShamanExp = '".$shm_exp."' where PlayerID = '".$id."' ");
	}
}else{
	alert("info", "Level must be 1 or bigger than 1", 1);
}

}
$first = $veri['first'];

if($usr['FirstCount']!=$first || (socket("getdata|".$id."|firstCount",1) && user_check($id)==1)){
    $degisen++;
	
	if(user_check($id)==1){
		socket("data|".$id."|firstCount|".$first);
	}else{
		$dzn = $db->query("UPDATE users set FirstCount = '".$first."' where PlayerID = '".$id."' ");
	}
}

$bootcamp = $veri['bootcamp'];

if($usr['BootcampCount']!=$bootcamp || (socket("getdata|".$id."|bootcampCount",1) && user_check($id)==1)){
    $degisen++;
	
	if(user_check($id)==1){
		socket("data|".$id."|bootcampCount|".$bootcamp);
	}else{
		$dzn = $db->query("UPDATE users set BootcampCount = '".$bootcamp."' where PlayerID = '".$id."' ");
	}
}

$tag = $veri['tag'];

if(!empty($tag)){
	if(strstr($tag,"#")){

		if($tag=="#"){
			$tag="";
		}

		if($usr['Tag']!=$tag){
			$degisen++;
			$dzn = $db->query("UPDATE users set Tag = '".$tag."' where PlayerID = '".$id."' ");
			socket("komut|changetag ".$usr['Username']." ".end(explode("#",$tag))."");
		}

	}else{
		alert("warning", "Please with <strong>#</strong> write tag", 1);

	}

}

$psada = rtrim(ltrim(str_replace("12","",$usr['PrivLevel']),","),",");
$priv = array_reverse($veri['priv']);
	$privs = "";
	
	foreach($priv as $x){
		if($x<$yetkim){
		$privs = $privs.",".$x;
		}
	}
	
	
	$privs = ltrim($privs.",1",",");

//echo $privs." * ".$psada;
	
if($privs!=$psada){
	if($uye['id']!=$id){

if(strlen($privs)>=0 && $yetkim>=11 || $op>=1){
	
    $dzn = $db->query("UPDATE users set PrivLevel = '".$privs."' where PlayerID = '".$id."' "); 
	$db->exec("INSERT INTO logs(player,log,text,type) values ('".$uye['Username'].$uye['Tag']."','Change privLevel to ".$usr['Username'].$usr['Tag']."','Old PrivList : ".$psada." | Now PrivList : ".$privs."','priv')");
    socket("data|".$id."|privLevel|".$privs."");
	
	if($dzn>0){
		$degisen++;
	}else{
		alert("danger",tfmdil('Erreur_Droit'),1);

	}
	
}
}else{
			alert("danger",tfmdil('Erreur_Droit'),1);

}
}



if($degisen>=1){
	
	alert("success",tfmdil('texte.resultat.succes'),1);
	if(empty($kadideg)){
		?>
		<script>
			$("#usrnm").load("../../ajax/user.php?v=<?=$id?>");
		</script>
		<?php
	}
}



}else{
	popup(tfmdil('Erreur_Droit'));
}

}

}
?>
<script>
	$("#p").block({timeout: 1});
</script>