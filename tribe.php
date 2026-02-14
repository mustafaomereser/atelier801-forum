<?php
include("config.php");
$ilker = $_GET['tr'];

$tr = $db->query("SELECT * FROM tribe where Code = '".$ilker."'")->fetch(PDO::FETCH_ASSOC);
$tt = $db->query("SELECT * FROM profilestribe where tribe = '".$ilker."'")->fetch(PDO::FETCH_ASSOC);
$id = $tr['Code'];

$members = explode(",",$tr['Members']);

if($uye['TribeCode']==$id){
	$erisim=1;
}else{
	$erisim=0;
}


if($erisim==1){

if(!empty($t_rank['10'])) {
	$erisim=1;
}else{
	$erisim=0;
}

}

$rr = (count($ranks)-1);
$reis = $db->query("SELECT Username,Tag FROM users where TribeCode = '".$ilker."' and TribeRank = '".$rr."'")->fetch(PDO::FETCH_ASSOC);

if(empty($id)){
	popupn(tfmdil('popup.tribu.erreurInformationsTribu.titre'),1,null,$site."/forums");
	_exit();
}



?>
<script>title("<?=$tr['Name']?>");</script>

  <div id="result"></div>
  <div id="corps" class="corps clear container"> 
  <div class="row"> 
  <div class="span12">  
  <div class="cadre cadre-relief cadre-tribu ltr ">
  <table class="table-cadre"> 
  <tr>
  <td>
  <div class="avatar-profil"> 
  <?php
  if(!empty($tt['avatar'])){
  ?>
  <img src="<?=$site?>/img/tribes/<?=$tt['avatar']?>" class="img100" alt="" />
  
  <?php
  }
  ?>
  </div>
  </td> 
  <td class="table-cadre-cellule-principale"> 
  <div class="cadre-tribu-principal"> 
  
  <div class="btn-group bouton-nom-profil">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#"> 
  <span class="cadre-tribu-titre cadre-tribu-nom">
  <img src="<?=$site?>/img/icones/roue-dentee.png" class="img20 espace-2-2"/><?=$tr['Name']?>
  </span> 
  </a> 
  <ul class="dropdown-menu menu-contextuel pull-left"> 
  <table> 
  <tr> 
  <td class="cellule-menu-contextuel"> 
  <ul class="liste-menu-contextuel"> 
  <li class="nav-header"><?=tfmdil('texte.tribu')?></li>
  <li>
  <a class="element-menu-contextuel" href="new-discussion?tr=<?=$id?>">
  <img src="<?=$site?>/img/icones/16/enveloppe.png" class="espace-2-2" alt=""><?=tfmdil('bouton.envoyerMessage')?></a>
  </li>  
  <li>
  <a class="element-menu-contextuel" onclick="ouvrirFormulaireCadre('cadre_signaler_element_<?=$id?>');">
  <?=tfmdil('bouton.signaler')?>
  </a>
  </li>
  <?php
  if($erisim==1){
  ?>
  <li>
  <a class="element-menu-contextuel" onclick="ouvrirFormulaireCadre('cadre_changer_logo_<?=$id?>');">
  <?=$plang['change_logo']?>
  </a>
  </li>
  <li>
  <a class="element-menu-contextuel" onclick="jQuery('#popup_confirmation_retrait_avatar_<?=$id?>').modal('show');">
  <?=$plang['remove_logo']?>
  </a>
  </li>
  <li>
  <a class="element-menu-contextuel" onclick="ouvrirFormulaireCadre('cadre_editer_element_<?=$id?>');">
  <?=$plang['edit_profile']?>
  </a>
  </li>
  <li>
  <a class="element-menu-contextuel" onclick="ouvrirFormulaireCadre('cadre_parametres_<?=$id?>');">
  <?=$plang['parameters']?>
  </a>
  </li>
  <?php
  }
  ?>
  </ul>
  </td>  
  </tr> 
  </table>
  </ul>
  </div> 
  
  <br> 
  <span class="cadre-tribu-date-creation">
  <?=tfmdil('texte.dateCreationTribu')?> : <?=date("d/m/Y",($tr['CreateTime']*60))?>
  </span>
<?php
if(!empty($tt['lang'])){
?>  
  <br>
  <span><?=tfmdil('texte.communaute')?> : <img src="<?=$site?>/img/pays/<?=$tt['lang']?>.png" class="img16 espace-2-2" /><?=dilr($tt['lang'])?></span> 
<?php
}
?>
  <br> 

  <br> 
  
  <?php
  if($tr['alimlar']==1){
	  $alim = $plang['tribe_open'];
  }elseif($tr['alimlar']==0){
	  $alim = $plang['tribe_closed'];
  }
  ?>
  
  <span class="cadre-tribu-recrutement"><?=tfmdil('texte.recrutement')?> : <?=$alim?></span>  
  <?php
  if($tt['reisg']>=1){
  ?>
  <br>
  
    <span class="cadre-tribu-recrutement"><?=tfmdil('tribu.chef')?> :  <?=isim($reis['Username'].$reis['Tag'],"s")?></span>  
  
  <?php
  }
  ?>
  <br> 
  </div>
  </td> 
  </tr> 
  </table> 
  
 
  <br> 

<?php
if(strlen($tr['Message'])>=1 && $tt['msgg']>=1){
?>
<div class="cadre cadre-presentation">
<pre style="background:none;color:#C2C2DA;font-size:14px;border:none;">
<?=htmlspecialchars(ltrim($tr['Message']))?>
</pre>
</div>
<?php
}
?>

<?php
if(strlen($tt['aciklama'])>=1 && $tt['msgaciklama']>=1){
?>
<br>
<div class="cadre cadre-presentation">
<?=bbcode(htmlspecialchars($tt['aciklama']))?>
</div>
<?php
}
?>


<form id="cadre_signaler_element_<?=$id?>" class="hidden cadre form-horizontal cadre-formulaire" method="POST" autocomplete="off"> 
  <fieldset> 
  <legend><?=tfmdil('bouton.signaler')?></legend> 

  <input type="hidden" name="ie" id="ie" value="<?=$id?>">

    <div class="control-group"> 
    <label class="control-label " for="raison"><?=tfmdil('texte.raison')?></label> 
      <div class="controls "> <textarea name="raison" id="raison" rows="5" class="input-xxlarge" maxlength="10000"></textarea> 
      </div> </div> <div class="control-group"> 
    <div class="controls">  
      <button type="button" class="btn btn-post" onclick="report();submitEtDesactive(this);return false;"><?=tfmdil('bouton.valider')?></button> 
      <button type="button" class="btn" onclick="jQuery('#cadre_signaler_element_<?=$id?>').addClass('hidden');jQuery('#bouton_signaler_element_<?=$id?>').removeClass('active');"><?=tfmdil('Annuler')?></button> 
<br><br>

        <div id="report_result"></div>

	</div> 
    </div> 
    </fieldset>  
 </form>   
 <form id="cadre_parametres_<?=$id?>" class="hidden cadre form-horizontal cadre-formulaire cadre-formulaire-profil-tribu" method="POST" autocomplete="off"> <fieldset>
 <legend><?=$plang['parameters']?></legend>
 <div class="control-group"> <label class="control-label "><?=tfmdil('type_service.13.nom')?></label>
 
 <div class="controls"> 
 <input type="checkbox" name="chefs_publics" id="chefs_publics" <?php if($tt['reisg']>=1){ echo 'checked'; } ?>> <?=tfmdil('tribu.chef')?> 
 </div>
 
  <div class="controls"> 
 <input type="checkbox" name="msg_publics" id="msg_publics" <?php if($tt['msgg']>=1){ echo 'checked'; } ?>> <?=$plang['show_tribemessage']?>
 </div>
 
   <div class="controls"> 
 <input type="checkbox" name="desc_publics" id="desc_publics" <?php if($tt['msgaciklama']>=1){ echo 'checked'; } ?>> <?=$plang['show_tribedescription']?>
 </div>
 
 </div> 
 
 
 <div class="control-group">
 <div class="controls "> 
 <button type="button" class="btn btn-post" onclick="tribeupdate();submitEtDesactive(this);return false;"><?=tfmdil('bouton.valider')?></button> 
 <button type="button" class="btn" onclick="jQuery('#cadre_parametres_<?=$id?>').addClass('hidden');jQuery('#bouton_parametres_<?=$id?>').removeClass('active');"><?=tfmdil('Annuler')?></button>
 </div> 
 </div> 
 </fieldset> 
 </form>    
 <form id="cadre_changer_logo_<?=$id?>" class="hidden cadre form-horizontal cadre-formulaire cadre-formulaire-profil-tribu" method="post" enctype="multipart/form-data" autocomplete="off">
 <fieldset>
 <legend><?=$plang['change_logo']?></legend> 
 <div class="control-group"> 
 <label class="control-label" for="fichier"><?=tfmdil('texte.source')?></label>
 <div class="controls">
     <input type="hidden" name="prp" id="prp" value="<?=$id?>">
	    <input type="hidden" name="link" id="link" value="<?=links()?>">
 <input id="fichier" name="fichier" type="file" accept="image/*"> </div> 
 </div>
 <div class="control-group"> 
 <div class="controls">  
 <button type="button" class="btn btn-post" onclick="submitEtDesactive(this);return false;"><?=tfmdil('bouton.valider')?></button> 
 <button type="button" class="btn" onclick="jQuery('#cadre_changer_logo_<?=$id?>').addClass('hidden');jQuery('#bouton_changer_logo_<?=$id?>').removeClass('active');"><?=tfmdil('Annuler')?></button>
 </div> 
 </div> 
 </fieldset> 
 </form> 
 <form id="cadre_editer_element_<?=$id?>" class="hidden cadre form-horizontal cadre-formulaire cadre-formulaire-profil-tribu" method="POST" autocomplete="off">
 <fieldset>
 <legend><?=tfmdil('bouton.editer')?></legend>


<div class="control-group"> 
 <label class="control-label "> 

<?=tfmdil('Communaute')?>

</label> 
 <div class="controls"> 
 
 
<div id="dropdown_communaute" class="dd-container" style="width: 200px;"></div> 
<?php
$l_js = "";

foreach($dilrs as $key => $rw){
if($key == strtolower($tt['lang'])){
	$select = "true";
}else{
	$select = "false";
}

$l_js .= '{text:\'<span><img src="'.$site.'/img/pays/'.$key.'.png" class="img16 espace-2-2" /> '.dilr($key,1).'</span>\', value:\''.$key.'\', selected:'.$select.'},';

}
?>


<script type="text/javascript">
var ddData_communaute = [<?=rtrim($l_js,",")?>];
function initialiseDropdown_communaute() {
	jQuery('#dropdown_communaute').ddslick({data:ddData_communaute,width:200,onSelected: function(data){
	jQuery('#communaute').attr('value', data.selectedData.value);
	jQuery('.dd-selected-value').attr('id', 'lang_val');

	$(document).ready(function() {
		$("#dropdown_communaute ul").addClass("scroll-y");
    });

}});
};
</script> 
</div> 
</div>



 <div class="control-group"> 
 <label class="control-label "><?=tfmdil('texte.recrutement')?></label> 
 <div class="controls"> 
 <select id="recrutement" name="recrutement"> 
 <option value="1" <?php if($tr['alimlar']==1){ echo 'selected'; } ?>><?=$plang['tribe_open']?></option> 
 <option value="0" <?php if($tr['alimlar']==0){ echo 'selected'; } ?>><?=$plang['tribe_closed']?></option> 
 </select>
 </div> 
 </div>   
 
 
<input type="hidden" id="tr" value="<?=$tr['Code']?>">
 <input type="hidden" id="ie" value="<?=$tr['Code']?>">

 <div class="control-group">
 <label class="control-label" for="presentation"><?=$plang['tribe_message']?></label> 

 <div class="controls ltr"> 

<?=txed("Message","Message",$tr['Message'],0)?>

 </div>
 
 
<?php
if(empty($t_rank['2'])){
?>
	<script>
		activerElementsSuivantEtatCheckbox(this, '#Message');
	</script>
<?php
}
?>
 
 </div> 
 
	<div class="control-group">
		<label class="control-label" for="presentation"><?=tfmdil('texte.description')?></label> 
		<div class="controls ltr"> 
			<?=txed("description","description",$tt['aciklama'])?>
		</div>
	</div>
 
 <div class="control-group"> 
 <div class="controls"> 
 <button type="button" class="btn btn-post" onclick="tribeupdate();submitEtDesactive(this);return false;"><?=tfmdil('bouton.valider')?></button>
 <button type="button" class="btn" onclick="jQuery('#cadre_editer_element_<?=$id?>').addClass('hidden');jQuery('#bouton_editer_element_<?=$id?>').removeClass('active');"><?=tfmdil('Annuler')?></button>
 </div>
 </div> 
 </fieldset> 
 </form>   
 </div>  
  <?php
  if($erisim==1){
	  if(!empty($_POST['avatarg'])){
		  $db->query("UPDATE profilestribe set avatar = '' where tribe = '".$id."'");
	  }
  ?>
  <form method="post">
  <div id="popup_confirmation_retrait_avatar_<?=$id?>" class="modal hide fade"> <div class="modal-header"> 
  <h3><?=tfmdil('texte.confirmation')?></h3>
  </div> 
  <div class="modal-body"> 
  <p class="message-confirmation">    <?=tfmdil('texte.messageConfirmation')?>   </p> 
  </div>
  <div class="modal-footer"> 
  <input type="hidden" name="avatarg" value="1">
    <input type="submit" class="btn btn-post" value="<?=tfmdil('bouton.valider')?>" onclick="confirm_refresh(200);"> 
  <a class="btn" data-dismiss="modal"><?=tfmdil('Annuler')?></a>
  </div>
  </div> 
</form>
  <?php
  }
  ?>
  </div> 
  </div>   



<script type="text/javascript">
					function init() {
						if (window.location.hash && window.location.hash.length > 1) {
							jQuery('#lien_' + window.location.hash.substring(1)).tab('show');
						}
					}
				</script>   

</div> 

<?php
include("footer.php");  
?>

