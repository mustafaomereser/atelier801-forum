<?php
include("../pdoconnect.php");

$veri = $_POST['query'];
if(empty($veri)){
	yonlendir($site."/404",0);
	exit();
}else{		

if($mute_control['durum']==1){
	popup(i_rep('MuteInfo1', ceil(abs(time()/3600 - $mute_control['date']/3600)), $mute_control['sebep']));
	exit();
}

$msg = temizle($veri['msg']);
$link = $veri['link'];
$topic = strtok(end(explode("t=",$veri['link'])),"&");
$forum = strtok(end(explode("f=",$veri['link'])),"&");
$tribe = strtok(end(explode("tr=",$veri['link'])),"&");


if((is_numeric($forum) || is_numeric($tribe)) && is_numeric($topic)){
	
	if(!empty($forum) && is_numeric($forum)){
		$top = $db->query("SELECT section from topic where id = '".$topic."'")->fetch(PDO::FETCH_ASSOC);
		$sec = $db->query("select forum, tribe from section where id = '".$top['section']."'")->fetch(PDO::FETCH_ASSOC);
		$s = $db->query("SELECT id FROM forums where id = '".$sec['forum']."'")->fetch(PDO::FETCH_ASSOC);
	}elseif(!empty($tribe) && is_numeric($tribe)){
		$trb = $db->query("SELECT Code FROM tribe where Code = '".$tribe."'")->fetch(PDO::FETCH_ASSOC);
	}
	
	if((is_numeric($forum) && $s['id'] != $forum) || (empty($tribe) && $trb['Code']!=$uye['TribeCode'])){
		echo "Akıllısın ama ben de salak değilim be hocam";
		exit();
	}
		
	
}else{
	echo "YARRAM NABIYON ÖYLE KOLAY MI BU SİSTEMİ KIRMASI ?";
	exit();
}



	if($yetkim>=9){
		
	}else{
		if(!empty($sec['tribe'])){
			if($sec['tribe']!=$uye['TribeCode']){
				popupn(tfmdil('texte.resultat.droitsInsuffisants'),1,null,$site."/forums");
				_exit();
			}
		}
	}


$tdb = $db->query("SELECT * FROM topic where id = '".$topic."'")->fetch(PDO::FETCH_ASSOC);
$minmsg = 4;

if(!empty($uye['id'])){

if($tdb['locked']==0 or ($yetkim>=10 || $op>=1)){
	
	$time_out = $db->query("SELECT date FROM topicm where topic = '".$topic."' and player = '".$uye['id']."' order by date DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
	if(($time_out['date']+5)<=time() || $yetkim>=11){
		if(strlen($msg)>=$minmsg && strlen($msg)<=60000){
			$tpm = $db->exec("INSERT INTO topicm (player,topic,text,date) values ('".$uye['id']."','".$topic."','".$msg."','".time()."')");
		if($tpm>0){
			$etkilesim = $db->exec("UPDATE topic set etkilesim = '".time()."' where id = '".$topic."'");
			yonlendir($site."/topic?f=".$forum."&t=".$topic, 0);
		}
		}else{
			popup(str_replace("%1",$minmsg,tfmdil('texte.resultat.messageTropCourt')));
		}
	
	}else{
		popup(tfmdil('texte.resultat.delaiAttenteDepasse'),1);
	}
	
}else{
	popup($plang['topic_locked'],1);
}

}else{
	popup(tfmdil('texte.resultat.auteurInvalide'),1);
}

}

//print_r($veri);

?>
