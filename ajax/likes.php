<?php
include("../pdoconnect.php");

$veri = $_POST['query'];
if(empty($veri)){
echo tfmdil('text.error');
}else{
	
	
	function show($topic,$begen){
	global $db,$veri,$ayarlar;
	$dem = $db->query("SELECT * FROM likes where topic = '".$topic."' and data = '".$begen."'")->rowCount();
	
	if($dem>=$ayarlar['hit_like']){
		echo '<script>$("#m'.$veri['sira'].'").addClass("cadre-message-like");</script>';
	}
?>
    <span class="coeur">
&nbsp;
</span>
&nbsp;<?=$dem?> 

<?php	
	}	
	
$begen = $veri['veri'];
$topic = end(explode("t=",$veri['link']));

/* if($mute_control['durum']==1){
	popup(i_rep('MuteInfo1', ceil(abs(time()/3600 - $mute_control['date']/3600)), $mute_control['sebep']));
	echo '<script>$("#'.$begen.'").removeClass("bouton-like-enfonce").addClass("bouton-like-actif");</script>';
	show($topic,$begen);
	exit();
} */
	
	
if(!empty($uye['id'])){
$dem = $db->query("SELECT player FROM topicm where id = '".$begen."'")->fetch(PDO::FETCH_ASSOC);

$control = $db->query("SELECT player FROM likes where player = '".$uye['id']."' and data = '".$begen."' and topic = '".$topic."'")->fetch(PDO::FETCH_ASSOC);


if(($uye['id']!=$dem['player'] && $_SESSION['liketime']<time()) && $control['player']!=$uye['id']){
	$_SESSION['liketime'] = time()+2;
	$dm = $db->exec("INSERT INTO likes (player,data,topic) values ('".$uye['id']."','".$begen."','".$topic."')");
	if($dm>0){
show($topic,$begen);
	}else{
		echo tfmdil('text.error');

	}
}else{
	popup(tfmdil('text.error'));
show($topic,$begen);
}


}else{
	echo tfmdil('text.error');
		popup(tfmdil('texte.resultat.auteurInvalide'));
}

}
?>
