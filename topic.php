<?php
include("config.php");
$f = $_GET['f'];
$t = $_GET['t'];
$tr = $_GET['tr'];


if(!empty($tr)){
	$trib = $db->query("SELECT Code FROM tribe where Code = '".$tr."'")->fetch(PDO::FETCH_ASSOC);
}

if(!empty($f)){
	$f_c = $db->query("SELECT id FROM forums where id = '".$f."'")->fetch(PDO::FETCH_ASSOC);
}
 if((!empty($f_c['id']) || (!empty($trib['Code']) && $trib['Code']==$uye['TribeCode'])) && !empty($t)){
	 
 }else{	
	popupn(tfmdil('texte.resultat.droitsInsuffisants'),1,null,$site."/forums");
	_exit();
 }
 
 
 if($yetkim>=11 || $op>=1 ){
 
 $dev = $_GET['dev-tracker'];
 if($dev){
	 popupn($plang['loading']);

	 $td = $db->query("SELECT * FROM topicm where id = '".$dev."'")->fetch(PDO::FETCH_ASSOC); 
	if($td['devtracker']==1){
		$devtr = 0;
	}else{
		$devtr = 1;
	}
		
	 $db->query("UPDATE topicm set devtracker = '".$devtr."' where id='".$dev."'");
	 geri();
	 exit();
 }
 
 }

	$topic = $db->query("SELECT * FROM topic where id = '".$t."'")->fetch(PDO::FETCH_ASSOC); 

	$sectest = $db->query("SELECT id,forum,tribe FROM section where id = '".$topic['section']."'")->fetch(PDO::FETCH_ASSOC);
	if((empty($sectest['tribe']) && !empty($tr)) || (!empty($sectest['tribe']) && !empty($f))){	
		popupn(tfmdil('texte.resultat.interdit'),1,null,$site."/forums");
		_exit();
	}
	
	if($yetkim>=9){
		
	}else{
		if(!empty($sectest['tribe'])){
			if($sectest['tribe']!=$uye['TribeCode'] || $trib['Code'] != $uye['TribeCode']){
				popupn(tfmdil('texte.resultat.droitsInsuffisants'),1,null,$site."/forums");
				_exit();
			}
		}
	}
 

 
	$forum = $db->query("SELECT * FROM forums where id = '".$sectest['forum']."'")->fetch(PDO::FETCH_ASSOC);
 
 //echo $forum['priv']." - ".$yetkim;
 
 if(forum_yetki_kontrol($forum['priv'])!=1){
	 yonlendir($site."/404",0);
	 exit();
 }
 

		$favs = $db->query("SELECT * FROM favorites where player = '".$uye['id']."' and data = '".$topic['id']."' and mode = '1'")->fetch(PDO::FETCH_ASSOC);

		$str = $favs['id'];

		if(empty($str)){
			$favtext = $plang["add_favoritetopic"];
			$favimg = "favori";
		}else{
			$favtext = $plang["delete_favoritetopic"];
			$favimg = "favori2";
		}

$firstdil = cokludil($topic);

//////topic sayfa////////////

$sql = "SELECT * FROM topicm WHERE topic = '".$t."' order by id ASC";

$Sayfa   = @ceil($_GET['p']); //5,2 girilirse eğer get o zaman onu tam sayı yapar yanı 5 yapıyoruz bu kod ile
$Say   = $db->query($sql); //makale sayısını çekiyoruz
$ToplamVeri   = $Say->rowCount(); //makale sayısını saydırıyoruz
$Limit	= $ayarlar['topic_limit']; //bir sayfada kaç içerik çıkacağını belirtiyoruz. 
$Sayfa_Sayisi	= ceil($ToplamVeri/$Limit); //toplam veri ile limiti bölerek her toplam sayfa sayısını buluyoruz

if ($Sayfa <= 0 && $Sayfa_Sayisi!=0) { 
	yonlendir(explode("&p=",links())[0]."&p=".$Sayfa_Sayisi,0);
	exit();
	//$Sayfa = $Sayfa_Sayisi;
	//echo "<script>degistir('page', ".$Sayfa.")</script>";
	//echo "<script>window.history.pushState('Object', 'Title', '".links(null, null, 2)."&p=".$Sayfa."');</script>";
}


if ($Sayfa < 1) { 
$Sayfa = $Sayfa_Sayisi;
//yonlendir(links(),"&p=".$Sayfa_Sayisi);
}


if ($Sayfa > $Sayfa_Sayisi) { 
	popupn(tfmdil('texte.resultat.interdit'),1,null,$site."/topic?f=".$f."&t=".$t);
	_exit();
} 

if($Sayfa > $Sayfa_Sayisi){$Sayfa = $Sayfa_Sayisi;} //eğer yazılan sayı büyükse eğer toplam sayfa sayısından en son sayfaya atıyoruz kullanıcıyı
$Goster   = $Sayfa * $Limit - $Limit; // sayfa= 2 olsun limit=3 olsun 2*3=6 6-3=3 buranın değeri 2. sayfada 3'dür 3-4-5-6... sayfalarda da aynı işlem yapılıp değer bulunur
$GorunenSayfa   = 5; //altta kaç tane sayfa sayısı görüneceğini belirtiyoruz.
try{
$Makale	= $db->query($sql." limit $Goster,$Limit"); //yukarda göstere attıgımız değer diyelim ki 3 o zaman 3.'id den başlayarak limit kadar veri ceker.
$cek = $Makale->fetchAll(PDO::FETCH_ASSOC);
 
//pagecreate("topic",$Sayfa_Sayisi);

}catch(exception $e){
$cek = null;
echo "<br><span style='color:white;'><center>(".tfmdil('texte.vide').")</center></span><br><br>";
}
//////topic sayfa////////////
if(!empty($json_data)){
	if($Sayfa >= $Sayfa_Sayisi){
		if($json_data['forum'][$t] != $ToplamVeri){
			$json_data['forum'][$t] = $ToplamVeri;
		}
	}elseif(empty($json_data['forum'][$t])){
		$json_data['forum'][$t] = "Son sayfayı görmedi.";
	}
}
?>
<input type="hidden" id="maxpage" value="<?=$Sayfa_Sayisi?>">

<script>
maxpage("topic");
</script>

<script>title("<?=$firstdil?>");</script>

<div id='result_fav'></div>

<div id="corps" class="corps clear container">
<div class="row">

 <div class="span12">




  <div class="cadre cadre-relief cadre-sujet ltr  cadre-sujet-postit">
 <table class="table-cadre table-cadre-centree">
 <tr>

 <td>
  <div class="btn-group">
   <?php
if(!empty($uye['id'])){
?>
 <a class="dropdown-toggle btn btn-inverse bouton-action" data-toggle="dropdown" href="#">
 
 <img src="<?=$site?>/img/icones/roue-dentee.png" class="img20"/>
 
 </a>
   
  <?php
  }
  ?>
 <ul class="dropdown-menu menu-contextuel pull-left">
 
<li class="nav-header">
<?=$plang['topic']?>
</li>



     <li>
    <a class="element-menu-contextuel" onclick='fav("<?=$topic['id']?>","1")' class="bouton-favori">

<img src="<?=$site?>/img/icones/16/<?=$favimg?>.png" class="espace-2-2 img16"/>
<?=$favtext?>
</a>

   </li>
   
   
   
 <?php
 if($yetkim>=8 || $op>=1){
 ?>
 


<li>
<a class="element-menu-contextuel" data-toggle="modal" href='<?=$site?>/section?locked=<?=$topic['id']?>'>
<img src="<?=$site?>/img/icones/cadenas.png" class="espace-2-2 img16">

<?php
if($topic['locked']==0){
?>
<?=$plang['lockf']?>
<?php
}else{
?>
<?=$plang['unlock']?>
<?php
}
?>

</a>
</li>



<?php
if($yetkim>=11){
?>
<li>
<a class="element-menu-contextuel" data-toggle="modal" href='<?=$site?>/section?pinned=<?=$topic['id']?>'>
<img src="<?=$site?>/img/icones/postit.png" class="espace-2-2 img16">

<?php
if($topic['pinned']==0){
?>
<?=$plang['pin']?>
<?php
}else{
?>
<?=$plang['unpin']?>
<?php
}
?>
</a>
</li>


<?php
}

 }
?>
   
   
      </ul>
 </div>
  <span class="cadre-sujet-titre">

  <?php
  topicicon($topic);
  ?>

 
   <?php
	if(!empty($str)){
  ?>
<img src="<?=$site?>/img/icones/16/favori.png" class="img24 espace-2-2" />
 <?php
 }

?>
 
<?=titlesystem($topic)?>

 
 </span>
 </td>
 </tr>
 </table>
  </div>

  
 </div>
 </div>


 <?php
 
 $sira=0+($Limit*$Sayfa)-$Limit;
 
 foreach($cek as $row){
	 
	 $sira++;
	 
	 $p = $db->query("SELECT * FROM users where PlayerID = '".$row['player']."'")->fetch(PDO::FETCH_ASSOC);
	 $bgn = $db->query("SELECT * FROM likes where player = '".$uye['id']."' and topic = '".$t."' and data = '".$row['id']."'")->fetch(PDO::FETCH_ASSOC);
	 
	 $row['likes'] = $db->query("SELECT * FROM likes where topic = '".$t."' and data = '".$row['id']."'")->rowCount();
	 
	 if(!empty($bgn['id'])){
		 $begeni = 1;
	 }else{
		 $begeni = 0;
	 }
	 
	 
	 if($row['handled']>=1){
		 $hwho = $db->query("SELECT * FROM users where PlayerID = '".$row['hwho']."'")->fetch(PDO::FETCH_ASSOC);
		 $handled = 1;
	 }else{
		 $handled = 0;
	 }
	 
 ?>
   <div class="row">
 <div class="span12" id="cadre_message_sujet_<?=$row['id']?>">
 <div id="m<?=$sira?>" class="cadre cadre-relief cadre-message ltr <?php if($handled==1){echo "cadre-message-modere"; } if($row['likes']>=$ayarlar['hit_like'] && $handled==0){echo "cadre-message-like"; }?>">
 <table class="table-cadre">
 <tr>

<?=isim($p['Username'].$p['Tag'],"pm",$row['player'],$row['date'],$row,$topic)?>

 <td class="table-cadre-cellule-vide">
</td>
 <td class="table-cadre-cellule-numero position-relative">
 <div>
 
 <div>
	<a class="numero-message" href="<?=$site?>/topic?f=<?=$f?>&t=<?=$t?>&p=<?=$Sayfa?>#m<?=$sira?>">
		#<?=$sira?>
	</a>
	
	<?php
	if($yetkim>=8 || !empty($yetkimlist['sentinel'])){
		$rep_control = $db->query("select * from reports where reportid = '".$row['id']."' && mode = 'topic' && handled = 0 order by id DESC Limit 0,10");
		
		$rep_c = $rep_control->rowCount();
		$reps = $rep_control->fetchAll(PDO::FETCH_ASSOC);

		if($rep_c>=1){
		?>
		<br>
		
	<div class="tooltip-si">
		<div>
		<img src="<?=$site?>/img/icones/16/warn.png" id="r_<?=$row['id']?>" onclick="ouvrirFormulaireCadre('cadre_moderer_message_<?=$row['id']?>');" class="espace-2-2 img16 img-undrag pointer"/>
		</div>
		<span class="tooltip-sitext tooltip-si-left" id="r_list_<?=$row['id']?>">
		<?=$rep_c>1 ? '<center style="padding:10px; border-top: 1px solid white;" id="r_cmenu"><r_count>'.$rep_c.'</r_count></center>' : "" ?>

		<?php
			foreach($reps as $_r){
				$r_reas = strip_tags(trim($_r['reason']));
				$mx = 25;
				if(strlen($r_reas)>=$mx){
					$r_reas = '<r_lab id="r_msg_'.$_r['id'].'"><a class="pointer" onclick="r_showall('.$_r['id'].', \''.$r_reas.'\');">'.kisalt($r_reas, $mx)."</a></r_lab>";
				}
			?>
			<div id="report_mes_<?=$_r['id']?>" style="border-top: 1px solid white; padding:10px;">
				<a class="pointer" style="float:right;" onclick="report_moderate(<?=$_r['id']?>, <?=$row['id']?>);"><?=$plang['mudahale_text']?></a>
				<?=tfmdil('texte.utilisateur')?> : <r_username><script>$('r_username').load("ajax/user.php?v=<?=$_r['byid']?>");</script></r_username>
				<br>
				<?=tfmdil('texte.raison')?> : <?=$r_reas?>
				<br>
				<?=i_rep(tfmdil('DateInscription'), $_r['date'])?>
			</div>
			<?php
			}
			?>
		</span>
		</div>

	<?php
		}
	?>
		
	<?php
	}
	?>

 </div>

 
  </div>
  <?php
  if($handled==0 && !empty($p['PlayerID'])){
  ?>
 <div class="contenant-contenant-popularite-message">
 <div class="contenant-popularite-message empeche-selection-texte">
 <span id="<?=$row['id']?>" class="bouton-like <?php if($row['player']!=$uye['id'] && $begeni == 0){ echo 'bouton-like-actif';}else{ if($begeni==1){echo "bouton-like-enfonce";} }?>" <?php if(($row['player']!=$uye['id'] && $begeni == 0) && !empty($uye['id'])){ echo 'onclick="likes(this,'.$sira.');"'; }?>>
    <span class="coeur">
&nbsp;
</span>
&nbsp;<?=$row['likes']?>   
</span>

    </div>
  </div>
  
    <?php
 }
  ?>
  
 </td>
 </tr>
 <tr>
 <td class="table-cadre-cellule-principale table-cellule-droite_bas">
 <div class="cadre-message-contenu">
 <div class="cadre-message-message">
<?php
if($handled==1){
?>
 <div>
 <span class="cadre-message-modere-texte">
 [<?=sprintf($plang['mudahale'],$hwho['Username'],$row['hreason'])?>]
 </span>
 </div>   
<?php
 }else{
?>
   <div id="message_<?=$row['id']?>">
	<?=bbcode($row['text'])?>
</div>

<?=poll($row['id'])?>

   <?php
   if(!empty($row['lastedit'])){
   ?>
   <br>
   <span class="cadre-message-dates"><?=$plang['last_edit']?> <span class=""><?=toptarih($row['lastedit'])?></span></span>
  <?php
 }
  ?>
  
 <?php
 }
?>

     </div>

  </div>
 </td>
 </tr>
 </table>
 
<?php
 if(!empty($ylist['sentinel']) || $yetkim>=8 || $op>=1 ){
	 
   if($_POST){
	 $etat = $_POST['etat'];
	 $raison = $_POST['raison_topic'];
	 $pmid = $_POST['pmid'];
	 
	// print_r($_POST);
	 
	if(!empty($raison) && !empty($pmid)){
	$as = $db->exec("UPDATE topicm set hreason = '".$raison."', handled = '".($etat-1)."', hwho = '".$uye['id']."' where id = '".$pmid."'");
	 
	 if($as>0){
	 geri();
	 exit();
	 }
	 
	 } 
	 
   }
?>


<form id="cadre_moderer_message_<?=$row['id']?>" class="hidden cadre form-horizontal cadre-formulaire" method="POST" autocomplete="off"> 
<fieldset> 
<legend><?=$plang['mudahale_text']?></legend>
<div class="control-group"> <label class="control-label "><?=tfmdil('texte.etat')?></label> 
<div class="controls"> 
<input type="hidden" name='pmid' value='<?=$row['id']?>'>
<select name="etat"> 
<option value="1" <?php if($row['handled']==0){ echo "selected";  } ?>><?=$plang['ban_active']?></option> 
<option value="2" <?php if($row['handled']==1){ echo "selected";  } ?>><?=$plang['mudahale_text']?></option>  
 </select> 
 </div> 
 </div>  
 <div class="control-group"> 
 <label class="control-label " for="raison_topic"><?=tfmdil('texte.raison')?></label>
 <div class="controls"> 
 <textarea id="raison_topic" name="raison_topic" rows="5" class="input-xxlarge" maxlength="10000"><?=$row['hreason']?></textarea> 
 </div> 
 </div> 
 <div class="control-group">
 <div class="controls">  
 <button type="button" class="btn btn-post" onclick="formsubmit('cadre_moderer_message_<?=$row['id']?>');return false;"><?=tfmdil('bouton.valider')?></button> 
 <button type="button" class="btn" onclick="jQuery('#cadre_moderer_message_<?=$row['id']?>').addClass('hidden');jQuery('#bouton_moderer_message_<?=$row['id']?>').removeClass('active');">
 <?=tfmdil('Annuler')?>
 </button>
 </div> 
 </div>
</fieldset> 
</form>
<?php
 }
?>
<?php
if($uye['id']==$row['player'] || ($yetkim>=8 || $op>=1)){
?>
<form id="cadre_editer_message_<?=$row['id']?>" class="cadre form-horizontal cadre-formulaire hidden" method="POST" autocomplete="off">
 <fieldset class="fieldset-100">
 <legend>
<?=tfmdil('bouton.editer')?></legend>

<div class="control-group">
 <label class="control-label " for="edit_message_<?=$row['id']?>">
<?=tfmdil('texte.message')?>
</label>
 <div class="controls ltr">
           
		   <?=txed("edit_message_".$row['id'],"edit_message_".$row['id'],$row['text'])?>
		    <br>
		    <div id='result_<?=$row['id']?>'></div>

 </div>
 <br>
 <div class="control-group">
 <div class="controls ">
  <button type="button" class="btn btn-post" id="<?=$row['id']?>" onclick="topicedit(this);submitEtDesactive(this);return false;">
<?=tfmdil('bouton.valider')?>
</button>
 <button type="button" class="btn bouton-annulation-edition" onclick="jQuery('#cadre_editer_message_<?=$row['id']?>').addClass('hidden');jQuery('#bouton_editer_message_<?=$row['id']?>').removeClass('active');">
<?=tfmdil('Annuler')?>
</button>
 </div>
 </div>
 </fieldset>
 </form>
 <?php
 }
?>
 <div id="cadre_signaler_element_<?=$row['id']?>" class="hidden cadre form-horizontal cadre-formulaire">
 <fieldset>
 <legend>
<?=tfmdil('bouton.signaler')?></legend>

 <div class="control-group">
 <label class="control-label " for="raison">
<?=tfmdil('texte.raison')?></label>
 <div class="controls ">
 <textarea name="raison" id="raison_<?=$row['id']?>" rows="5" class="input-xxlarge" maxlength="10000">
</textarea>
 </div>
 </div>
 <div class="control-group">
 <div class="controls">

<button type="button" class="btn btn-post" onclick="report('<?=$row['id']?>','_<?=$row['id']?>');submitEtDesactive(this);return false;">
<?=tfmdil('bouton.valider')?>
</button>

<button type="button" class="btn" onclick="jQuery('#cadre_signaler_element_<?=$row['id']?>').addClass('hidden');jQuery('#bouton_signaler_element_<?=$row['id']?>').removeClass('active');">
<?=tfmdil('Annuler')?>
</button>
<br><br>

   <div id="report_result_<?=$row['id']?>"></div>


 </div>

 </div>
 </fieldset>
 </div>
 
     <div id="edit_message_<?=$row['id']?>" class="hidden"><?=$row['text']?></div>
     </div>
 </div>
 </div>
  
  <?php
 }
  ?>
  
  
  <?php
  if(($topic['locked']==0 or ($yetkim>=10 || $op>=1)) && !empty($uye['id'])){
  ?>
   <div class="row">
 <div class="span12">
       <div class="cadre cadre-relief cadre-repondre ltr">
    <form id="cadre_nouveau_message" class="form-horizontal" onsubmit="topic(this);" method="POST" autocomplete="off">

<div id="result_msg"></div>
	
 <fieldset class="fieldset-100">

<legend>
<?=tfmdil('bouton.repondre')?>
</legend>

 <input type="hidden" name="t" id="t" value="<?=$t?>">
<input type="hidden" name="f" id="f" value="<?=$f?>">

<div class="control-group">
 <label class="control-label " for="message_reponse">
<?=tfmdil('texte.message')?>
</label>
 
 <div class="controls ltr">
<?=txed("message_reponse","message_reponse")?>

 </div>
 
 </div>
 <div class="control-group">
 <div class="controls ">

  <button type="submit" class="btn btn-post" onclick="submitEtDesactive(this);return false;">
<?=tfmdil('bouton.valider')?>
</button>

  </div>
 </div>
 </fieldset>
 </form>
    </div>
</div>
</div>
<?php
 }
?>
</div>

<script>


function citer(nom, texte) {

		if (estVideOuNull(texte)) {
			return;
		}

		afficherFormulaireReponse();

		var area = jQuery("#message_reponse");

		var val = area.val();

		if (val.length > 0) {
			val += '\n[quote=' + nom + ']' + texte + '[/quote]\n';
		}
		else {
			val += '[quote=' + nom + ']' + texte + '[/quote]\n';
		}

		area.val(val);
		area.atCaret('setCaretPosition', val.length);

//		jQuery("#message_reponse").append('[quote=' + nom + ']' + texte + '[/quote]\n');
//		jQuery("#message_reponse").caret(jQuery("#message_reponse").html().length, 0);

		window.location.href = "#message_reponse";
	}
</script>
		
		
		<?php
			if($yetkim>=8 || !empty($yetkimlist['sentinel'])){
		?>
		
		<script>
		function r_showall(e, msg){
			$("#r_msg_"+e).html("<br><br>"+msg+"<br>");
		}
		
		function report_moderate(id, id2) {
			
			var max = $("#r_list_"+id2+" div[id^='report_mes']").length;			
			
			var bilgi = {
				mode:"handled",
				id:id
			}

			$.ajax({
				type: 'post',
				url: './panel/ajax/report.php',
				data: {query: bilgi},
				success: function(result) {
					//$("#report_mes_"+id).html("<font color='gray'>"+result+"</font>");
					$("#report_mes_"+id).remove();

					max--;
					$('r_count').html(max);
					
					if(max<=0){
						$('#r_'+id2).remove();
						$('.tooltip-si span').remove();
					}else if(max<=1){
						$('#r_cmenu').remove();
					}
				}
			});
		}
		</script>
	 <?php
			}
	 ?>
 <?php
 include("footer.php");
 ?>