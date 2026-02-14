<?php
include("config.php");
$f = $_GET['f'];
$s = $_GET['s'];
$tr = $_GET['tr'];

if(!empty($s)){
	$sect = $db->query("SELECT id,locked,tribe FROM section where id = '".$s."'")->fetch(PDO::FETCH_ASSOC);
}


if(!empty($tr) && $sect['tribe']==$tr){
	
	if(empty($f)){
		$f = $tr;
	}else{
		popupn(tfmdil('texte.resultat.interdit'),1,null,$site."/forums");
		_exit();
	}
	
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


if((!empty($frm['id']) || !empty($sect['tribe']))){
$onay++;

	if($yetkim>=9){
		
	}else{
		if(!empty($sect['tribe'])){
			if($sect['tribe']!=$uye['TribeCode'] || $tr != $uye['TribeCode']){
				popupn(tfmdil('texte.resultat.droitsInsuffisants'),1,null,$site."/forums");
				_exit();
			}
		}
	}

if(!empty($sect['id']) && ($sect['locked']<=0 || $yetkim>=10)){
$onay++;

	
$titre = temizle(htmlspecialchars($_GET['titre']));
$mesaj = temizle(htmlspecialchars($_GET['message_sujet']));

 
 
$cevaplar = "";
foreach($_GET['polls'] as $k => $row){
	$cevaplar = ltrim($cevaplar.",".$row,",");
}	
 

//echo $_SESSION['topicac']-time();

/* if(time()<$_SESSION['topicac']){
	$_SESSION['topicac'] = time();
} */

if(!empty($titre) && !empty($mesaj)){
	$hatamsj = "";
	$konuac=0;

 if($enazcvp>=2){
	$konuac++;
 }


if(strlen($titre)>=4){
	$konuac++;
}else{
	$hatamsj = $hatamsj.str_replace("%1","4",tfmdil('texte.resultat.titreTropCourt'))."<br>";
}

if(strlen($mesaj)>=4){
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
			$forpoll = $db->lastInsertId();	
			$pollac = $db->exec("INSERT INTO polls (mid,answers,mode) values ('".$forpoll."','".$cevaplar."','0')");
			
			if(empty($sect['tribe'])){
				$y_lnk = "f=".$f;
			}else{
				$y_lnk = "tr=".$sect['tribe'];
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

<?php
if($onay==2 && !empty($uye['id'])){
?>
 
 
 <div id="corps" class="corps clear container">
   <div class="row">
 <div class="span12 cadre cadre-formulaire ltr">
 <form id="formulaire" class="form-horizontal" method="GET" autocomplete="off">
 <fieldset>
 <legend>
<?=$plang['new_forum_poll']?>
</legend>

 <input type="hidden" name="f" value="<?=$f?>">
 <input type="hidden" name="s" value="<?=$s?>">
 <div class="control-group">
 <label class="control-label " for="titre">
<?=tfmdil('texte.titreSujet')?>
</label>
 <div class="controls ">
 <input type="text" id="titre" name="titre" class="input-xxlarge" maxlength="256" value=""/>
 </div>
 </div>

<div class="control-group">
 <label class="control-label " for="message_sujet">
<?=tfmdil('texte.question')?>
</label>
 <div class="controls  ltr">
<?=txed("message_sujet","message_sujet")?>
 </div>
 </div>

<input type="hidden" name="sondage" id="sondage" value="on">

 <div class="control-group element-sondage">
 <label class="control-label ">
<?=tfmdil('Sondage_Reponse')?>
</label>
 <div class="controls ">
 <div id="bloc_reponses">
   </div>
 </div>
 </div>
 <div class="control-group element-sondage">
 <div class="controls ">
 <button class="btn" type="button" onclick="ajouterReponse(true,function(){jQuery(this).closest('#bloc_reponses').trigger('change');});">
<?=tfmdil('bouton.ajouter')?>
</button>
 </div>
 </div>
 <br>
 <div class="control-group">
 <div class="controls ">
 <button type="submit" class="btn" onclick="formsubmit('formulaire');">
<?=tfmdil('bouton.valider')?>
</button>
 </div>
 </div>
  
 </fieldset> 
</form> 
</div> 
</div> 
 
 
 <script type="text/javascript">
//			jQuery('.element-sondage').addClass('hidden');

			function valider(element) {
				var reponses = "";
				jQuery('.reponse').each(function() {
					reponses += jQuery(this).val() + SEPARATEUR;
				});
				jQuery('#reponses').val(reponses);

//				jQuery('#formulaire').submit();
				submitEtDesactive(element);
			}
	
	var numeroReponse = 0;
	function ajouterReponse(supprimable,handlerChangement) {
		var idReponse = "nouvelle_reponse_" + ++numeroReponse;

		var html = '<div id="';
		html += idReponse;
		html += '" class="input-append bloc-reponse-sondage">';
		html += '<textarea name="polls[]" class="input-xxlarge reponse" required></textarea>';

		if (supprimable) {
			html += '<button class="btn bouton-suppression" type="button"><?=tfmdil("Supprimer")?></button>';
		}

		html += '<input type="hidden" class="id-reponse" value="0">';
		html += '<input type="hidden" class="etat-reponse" value="0">';
		html += '</div>';

		jQuery('#bloc_reponses').append(html);
		jQuery("#" + idReponse + ' textarea').caret(0, 0);

		if (supprimable) {
			jQuery("#" + idReponse + ' .bouton-suppression').click(function() {
				supprimerReponse(idReponse);
				if (!estNull (handlerChangement)) {
					handlerChangement();
				}
			});
		}

		if (handlerChangement) {
			jQuery("#" + idReponse + ' textarea').bind('keyup keydown', handlerChangement);
			//jQuery("#" + idReponse + ' .bouton-suppression').click(handlerChangement);
		}
	}

	function ajouterReponses(nombre,supprimables,handlerChangement) {
		for (var i = 0; i < nombre; i++) {
			ajouterReponse(supprimables,handlerChangement);
		}
	}

	function supprimerReponse(idReponse) {
		jQuery('#' + idReponse).remove();
	}



				var demanderConfirmationSortie = true;

				var creationValidee = false;

				ajouterReponse(false);
				ajouterReponse(false);

					lierChampsTexteASauvegarde(jQuery('#bloc_reponses')[0],'reponse','reponses_nouveau_sondage_forum_6_section_41',function(nombre) {
					ajouterReponses(nombre-2,true,function() {
						jQuery('#bloc_reponses').trigger('change');
					});
				}, function(){return creationValidee;});

				jQuery('#formulaire').on('submit',function(){
					creationValidee = true;
				});

				jQuery("#formulaire,#formulaire_deconnexion").on('submit',function() {
					demanderConfirmationSortie = false;
				});

			
		</script>   
		
		</div> 
 
 
 
<?php
}else{
	popupn(tfmdil('text.error'));
}
?>

 


<?php

include("footer.php");
?>
