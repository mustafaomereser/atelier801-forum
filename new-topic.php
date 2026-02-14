<?php
include("config.php");
$f = $_GET['f'];
$s = $_GET['s'];
$tr = $_GET['tr'];

if(!empty($s)){
	$sects = $db->query("SELECT id,forum,tribe FROM section where id = '".$s."'")->fetch(PDO::FETCH_ASSOC);
}

if(!empty($tr) && $sects['tribe']==$tr){
	if(empty($f)){
		$f = $tr;
	}else{
		popupn(tfmdil('texte.resultat.interdit'),1,null,$site."/forums");
		_exit();
	}
}


$yetkili_orospu_evladi=0;

if($yetkim > 10 || $op>=1 || !empty($yetkimlist['sentinel'])){
	$yetkili_orospu_evladi++;
	//echo "VAY AMK";
}

if($mute_control['durum']==1){
	popupn(i_rep('MuteInfo1', ceil(abs(time()/3600 - $mute_control['date']/3600)), $mute_control['sebep']));
	_exit();
}


if(!empty($f) && !empty($s)){
	
	$frm = $db->query("SELECT id,priv FROM forums where id = '".$f."'")->fetch(PDO::FETCH_ASSOC);


	if(forum_yetki_kontrol($frm['priv'])!=1){
		popupn(tfmdil('erreur.tribulle.14'));
		_exit();
	}

	 
	if($yetkim>=9){
		
	}else{
		if(!empty($sects['tribe'])){
			if($sects['tribe']!=$uye['TribeCode']){
				popupn(tfmdil('texte.resultat.droitsInsuffisants'),1,null,$site."/forums");
				_exit();
			}
		}
	}


if(((!empty($frm['id']) || !empty($sects['tribe'])) && !empty($sects['id'])) && ($sects['forum']==$frm['id'] || !empty($tr))){
$onay++;
$sect = $db->query("SELECT id,locked FROM section where id = '".$s."'")->fetch(PDO::FETCH_ASSOC);

if(!empty($sect['id']) && ($sect['locked']<=0 || $yetkim>=10)){
$onay++;


$mesaj = temizle(htmlspecialchars($_GET['message_sujet']));


if($yetkili_orospu_evladi>=1){
$titrelang = $_GET['titrelang'];

$titreg = $_GET['titre'];
$titre = "";

$t=count($titreg);

$tit1 = "\$tit = array(";

$tit2 = ");";

$a=0;
foreach($titreg as $key => $den){
$a++;
	if($t==1){
		$titre = temizle(htmlspecialchars($den));
	}else{
		if(!empty($den)){
			$titref .= ',"'.$titrelang[$key].'"=>"'.temizle(htmlspecialchars($den)).'"';
		}
	}

	if($a>=$t & $t!=1){
		 $titre = $tit1.ltrim($titref,",").$tit2;
	}


}

}else{
	$titre = temizle(htmlspecialchars($_GET['titre'][0]));
}

//echo $titre;

if(!empty($titre) && !empty($mesaj) && !empty($uye['id'])){
	$hatamsj = "";
	$konuac=0;
if(strlen($titre)>=4){
	$konuac++;
}else{
	$hatamsj = $hatamsj.str_replace("%1","4",tfmdil('texte.resultat.titreTropCourt'))."<br>";
}

if(strlen($mesaj)>=4 && strlen($mesaj)<=60000){
	$konuac++;
}else{
	$hatamsj = $hatamsj.str_replace("%1","4",tfmdil('texte.resultat.messageTropCourt'));	
}


$time_out = $db->query("SELECT date FROM topic where player = '".$uye['id']."' order by date DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
if(($time_out['date']+300)<=time() || $yetkim>=11){	
	if($konuac>=2){
			$snc = $db->exec("INSERT INTO topic (section,title,player,date,etkilesim) values ('".$s."','".$titre."','".$uye['id']."','".time()."','".time()."')");
			if($snc>0){
				$lastid = $db->lastInsertId();
				$msj = $db->exec("INSERT INTO topicm (topic,text,player,date) values ('".$lastid."','".$mesaj."','".$uye['id']."','".time()."')");
					
				if(empty($sects['tribe'])){
					$y_lnk = "f=".$f;
				}else{
					$y_lnk = "tr=".$sects['tribe'];
				}
				
				yonlendir($site."/topic?".$y_lnk."&t=".$lastid,0);

			}
	}else{
		popupn($hatamsj);
	}
}else{
	popupn(tfmdil('texte.resultat.timeoutRequete'));
}


}

}

}else{
	$onay=0;
}
}

?>

  <div id="corps" class="corps clear container">   
<?php
if($onay==2 && !empty($uye['id'])){
?>
 <div class="row">
 <div class="span12 cadre cadre-formulaire ltr">
 <form id="formulaire" class="form-horizontal" method="GET" autocomplete="off">
 <fieldset>
 <legend>
<?=$plang['new_topic']?>
</legend>
 <?php
 if(empty($sects['tribe'])){
 ?>
  <input type="hidden" name="f" value="<?=$f?>">
 <?php
}else{
 ?>
 <input type="hidden" name="tr" value="<?=$tr?>">
<?php
}
?>
 <input type="hidden" name="s" value="<?=$s?>">
 <div class="control-group">
 <label class="control-label " for="titre">
<?=$plang['topic_name']?>
</label>




 <div class="controls" id="_titres">
<?php

if($yetkili_orospu_evladi>=1){
	?>
	<label>

<?php
	foreach($dilrs as $key => $f){
	//$k++;
	$keys = strtoupper($key);
	if($key!="xx"){
?>

<span onclick="ekle('<?=$keys?>')"><img src="<?=$site?>/img/pays/<?=$key?>.png"></span>

<?php
	}
	}
	//echo $k;
	//echo count($dilrs);
?>
	
	
	</label>
<?php
}
?>

 </div>
 
 
 </div>

<div class="control-group">
 <label class="control-label " for="message_sujet">
<?=tfmdil('Message')?>
</label>

 <div class="controls  ltr">
<?=txed("message_sujet","message_sujet")?>
 </div>

 </div>
 <div class="control-group">
 <div class="controls ">
  <button type="button" class="btn btn-post" onclick="submitEtDesactive(this);return false;">
<?=tfmdil('bouton.valider')?></button>
 </div>
 </div>
 </fieldset>
 </form>
 </div>
 </div>
<?php
}else{
	popupn(tfmdil('text.error'));
}
?>

 
 </div> 

<?php
include("footer.php");

$gege = "";

foreach($dilrs as $key => $row){
	if($key!="xx"){
		$gege .= ",\n".strtoupper($key).": '".$key."'";
	}
}
	$gege = ltrim($gege,",");

?>
<script>
var tane=0;

function ekle(dil){
	
	var diller = { 
		<?=$gege?> 
	}
	
var c = $("#_titres input[value='"+dil+"']").val() ?? 0;

var ehe = "";


if(tane>=1){
	ehe = "<button id='buton_"+dil+"' type='button' onclick='sil(\""+dil+"\");'><?=tfmdil('Supprimer')?></button>";
}else{
	ehe = "";
}

var d = '<input type="hidden" name="titrelang[]" value="'+dil+'"><input type="text" id="titre_'+dil+'" name="titre[]" style="margin-bottom:10px;" class="input-xxlarge" maxlength="256" value="" autocomplete="on"><?php if($yetkili_orospu_evladi>=1){?><img id="img_'+dil+'" src="<?=$site?>/img/pays/'+dil.toLowerCase()+'.png"><?php }?> '+ehe;

if(diller[dil]){

if(c==0){
$("#_titres").append(d);
tane++;
}else{
	alert("Already exist's.");
}

}else{
	alert("You cant this.");
}

}


function sil(dil){
	var c = $("#_titres input[value='"+dil+"']").val() ?? 0;
	
	if(c!=0 && tane!=1){
	$("#_titres input[value='"+dil+"']").remove();
	$("#titre_"+dil+" ").remove();
	$("#buton_"+dil+"").remove();
	$("#img_"+dil+" ").remove();
	tane--;
	}
}
ekle("<?=$dilim?>");

</script>