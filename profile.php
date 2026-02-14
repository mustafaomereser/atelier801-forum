<?php
include("config.php");

$kadi = explode("#",$kadi);
if(!empty($kadi[1])){
$kadi[1] = "#".$kadi[1];
}

$pr = $db->query("SELECT * FROM users where Username = '".$kadi[0]."' and Tag = '".$kadi[1]."'")->fetch(PDO::FETCH_ASSOC);
$id = $pr['PlayerID'];

if(empty($id)){
	popupn(tfmdil('Joueur_Existe_Pas'),1,null,$site."/forums");
	_exit();
}

$pt = $db->query("SELECT * FROM profilesuser where player = '".$id."'")->fetch(PDO::FETCH_ASSOC);

$likes = $db->query("SELECT id FROM topicm WHERE player = '".$id."' order by date DESC");
$tco = $likes->rowCount();

$likes = $likes->fetch(PDO::FETCH_ASSOC);
$likes = $db->query("SELECT id FROM likes where data='".$likes['id']."'")->rowCount();

if($id==$uye['id'] || ($yetkim>=8)){
	$erisim=1;
}else{
	$erisim=0;
}

?>
<script>title("<?=$pr['Username']?>");</script>


  <div id="corps" class="corps clear container">   
  <div id="result"></div>

  <div class="row"> 
  <div class="span12">
  <div class="cadre cadre-relief cadre-utilisateur ltr "> 
  <table class="table-cadre"> 
  <tr> 
    
  <?=isim($pr['Username'].$pr['Tag'],"p")?>

  <br>  
  <br> 
  <span>
  <span class="libelle-entree-profil"><?=tfmdil('texte.dateInscription')?></span> : <?=date("d/m/Y",$pr['RegDate'])?></span> 
  <br> 
  <br> 
  <?php
  if(!empty($pt['lang'])){
  ?>
  <span class="libelle-entree-profil"><?=tfmdil('texte.communaute')?> :</span> <img src="<?=$site?>/img/pays/<?=strtolower($pt['lang'])?>.png" class="img16 espace-2-2" /> <?=dilr($pt['lang'])?>
  <br> 
  <?php
  }
  ?>
  <span class="libelle-entree-profil"><?=$plang['messages']?> : </span><?=$tco?>
  <br> 
  <br> 
  <span class="libelle-entree-profil"><?=$plang['prestige']?> : </span><?=$likes?></span> 
  <br>
  <br>  
  
  
  <?php
  if($pt['stonline']>=1){
	  
    if($pt['online']>=time() || $pr['PlayerID']==$uye['id']){
     $imgonl = "on-offbis2.png";
 	 $textonl = $plang['online'];
    }else{
     $imgonl = "on-offbis1.png";
	 $textonl = $plang['offline'];
    }

?>

  <span class="libelle-entree-profil"><img src="<?=$site?>/img/icones/16/<?=$imgonl?>" alt=""> <?=$textonl?></span>
  <br>  
  <br> 
  
  <?php
  }	
  ?> 
  
  <?php
  if($pr['Gender']>0 && $pt['stgender']==1){
	  
	  if($pr['Gender']==2){
		$imng = "garcon.png";
		$cins = tfmdil('texte.garcon');
	  }elseif($pr['Gender']==1){
		$imng = "fille.png";
		$cins = tfmdil('texte.fille');
	  }
	  
    ?>
  <span class="libelle-entree-profil"><?=tfmdil('texte.genre')?> :</span>   <img src="<?=$site?>/img/icones/<?=$imng?> " class="img16"> <?=$cins?>    
  <br>
  <?php
  }
  ?> 
  
  <?php
    
  if(!empty($pt['birthday']) && $pt['stbirthday']==1){
	?>
  <span class="libelle-entree-profil"><?=tfmdil('texte.anniversaire')?> :</span>
	<?=$pt['birthday']?>
  <br>
  <?php
  }
  ?> 
  
    <?php
  if(!empty($pt['konum']) && $pt['stkonum']==1){
	?>
  <span class="libelle-entree-profil"><?=tfmdil('texte.localisation')?> :</span>
  <?=$pt['konum']?>
  <br>
  <?php
  }
  ?> 
  
  
  <br> 
  
<?php 
  if($pr['Marriage']>0){
  $married = $db->query("SELECT * FROM users where PlayerID = '".$pr['Marriage']."'")->fetch(PDO::FETCH_ASSOC);
?>
    <span class="libelle-entree-profil"><?=tfmdil('E_Ame')?> :</span> <?=isim($married['Username'].$married['Tag'],"s")?>
  <br>
  
<?php
} 
?>
  <?php
  $tribe = $db->query("SELECT * FROM tribe where Code = '".$pr['TribeCode']."'")->fetch(PDO::FETCH_ASSOC);
  if(!empty($tribe['Code'])){
  ?>
  
  <span class="libelle-entree-profil"><?=tfmdil('texte.tribu')?> : </span>  
  <div class="cadre-auteur-message cadre-auteur-message-court element-composant-auteur display-inline-block">  
  <div class="btn-group bouton-nom"> 
  <a class="dropdown-toggle highlightit" data-toggle="dropdown" href="#">   
  <span class="element-bouton-profil bouton-profil-nom cadre-tribu-nom"><?=$tribe['Name']?></span>     
  </a> 
  <ul class="dropdown-menu menu-contextuel pull-left"> 
  <table> 
  <tr>     
  <td class="cellule-menu-contextuel"> 
  <ul class="liste-menu-contextuel"> 
  <li class="nav-header"><?=$tribe['Name']?></li> 
  <li>
  <a class="element-menu-contextuel" href="<?=$site?>/tribe?tr=<?=$tribe['Code']?>">
  <img src="<?=$site?>/img/icones/16/1tribu.png" class="espace-2-2" alt=""><?=tfmdil('texte.profil')?></a></li> 
  <li><a class="element-menu-contextuel" href="<?=$site?>/tribe-forum?tr=<?=$tribe['Code']?>"><img src="/img/icones/16/topic.png" class="espace-2-2" alt=""><?=tfmdil('Forum')?></a></li>
  <li><a class="element-menu-contextuel" href="<?=$site?>/tribe-members?tr=<?=$tribe['Code']?>"><img src="/img/icones/16/1tribu-membres.png" class="espace-2-2" alt=""><?=tfmdil('interface.tribu.titre.membres')?></a></li>  
  <?php
  if($erisim==1){
	  ?>
  <li><a class="element-menu-contextuel" href="<?=$site?>/tribe-history?tr=<?=$tribe['Code']?>"><img src="/img/icones/16/1tribu-activite.png" class="espace-2-2" alt=""><?=tfmdil('interface.tribu.bouton.historique')?></a></li> 
	  
 <?php
  }
  ?>
  
  </ul> 
  </td>       
  </tr> 
  </table> 
  </ul>
 
  
  </div>  
  </div>

 <?php
  }
  ?>
  
  
  </div>

  </td> 
  </tr> 
  </table>


  <input type="hidden" id="pr" name="pr" value="<?=$id?>"> 
  
  <form id="cadre_parametres_<?=$id?>" class="hidden cadre form-horizontal cadre-formulaire cadre-formulaire-profil-utilisateur" action="update-user-parameters" method="POST" autocomplete="off"> 
  <fieldset> 
  <legend><?=$plang['parameters']?></legend> 
  <div class="control-group"> <label class="control-label "><?=$plang['show_ifonline']?></label> 
  <div class="controls "> <input type="checkbox" name="afficher_en_ligne" id="onl" <?php if($pt['stonline']>=1){ echo "checked"; }?>> 
  </div> </div> <div class="control-group"> 
  <div class="controls">  
  <button type="button" class="btn btn-post" onclick="editprofile();submitEtDesactive(this);return false;"><?=tfmdil('bouton.valider')?></button> 
  <button type="button" class="btn" onclick="jQuery('#cadre_parametres_<?=$id?>').addClass('hidden');jQuery('#bouton_parametres_<?=$id?>').removeClass('active');"><?=tfmdil('Annuler')?></button> 
  </div>
  </div>
  </fieldset> 
  </form>       
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

<form id="cadre_changer_avatar_<?=$id?>" class="hidden cadre form-horizontal cadre-formulaire cadre-formulaire-profil-utilisateur" enctype="multipart/form-data" autocomplete="off"> 
  <fieldset> <legend><?=tfmdil('bouton.changerAvatar')?></legend> 
    <input type="hidden" name="prp" id="prp" value="<?=$id?>">
	    <input type="hidden" name="link" id="link" value="<?=links()?>">
    <div class="control-group"> 
      <label class="control-label" for="fichier"><?=tfmdil('texte.source')?></label> 
      <div class="controls"> 
        <input id="fichier" name="fichier" type="file" accept="image/*"> 
      </div> 
    </div> 
    <div class="control-group"> 
      <div class="controls">  
        <button type="submit" class="btn btn-post" onclick="submitEtDesactive(this);return false;"><?=tfmdil('bouton.valider')?></button> 
        <button type="button" class="btn" onclick="jQuery('#cadre_changer_avatar_<?=$id?>').addClass('hidden');jQuery('#bouton_changer_avatar_<?=$id?>').removeClass('active');"><?=tfmdil('Annuler')?></button> 
      </div> 
    </div> 
  </fieldset> 
    </form> 
    <form id="cadre_editer_element_<?=$id?>" class="hidden cadre form-horizontal cadre-formulaire cadre-formulaire-profil-utilisateur" method="POST" autocomplete="off"> 
      <fieldset> 
	  <legend><?=tfmdil('bouton.editer')?></legend> 
        <input type="hidden" name="pr" value="<?=$id?>">  


<div class="control-group"> 
 <label class="control-label "> 

<?=tfmdil('Communaute')?>

</label> 
 <div class="controls"> 
 
 
<div id="dropdown_communaute" class="dd-container" style="width: 200px;"></div> 
<?php
$l_js = "";

foreach($dilrs as $key => $rw){
if($key == strtolower($pt['lang'])){
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
<label class="control-label "><?=tfmdil('texte.anniversaire')?></label>
<div class="controls "> 
 <input type="checkbox" name="b_anniversaire" id="b_anniversaire" <?php if($pt['stbirthday']==1){ echo 'checked'; }?> onclick="activerElementsSuivantEtatCheckbox(this, '#anniversaire');"> 
 <input type="text" id="anniversaire" name="anniversaire" class="datepicker" value="<?=$pt['birthday']?>"> 
</div> 
</div>

<?php
if($pt['stbirthday']==0){
?>
	<script>
		activerElementsSuivantEtatCheckbox(this, '#anniversaire');
	</script>
<?php
}
?>		  


<div class="control-group">
<label class="control-label "><?=tfmdil('texte.localisation')?></label>

<div class="controls "> 
 <input type="checkbox" name="b_localisation" id="b_localisation" <?php if($pt['stkonum']==1){ echo 'checked'; }?> onclick="activerElementsSuivantEtatCheckbox(this, '#localisation');"> 
 <input type="text" id="localisation" name="localisation" value="<?=$pt['konum']?>" maxlength="256" autocomplete="on"> 
</div> 

</div>


<?php
if($pt['stkonum']==0){
?>
	<script>
		activerElementsSuivantEtatCheckbox(this, '#localisation');	
	</script>
<?php
}
?>	

	<div class="control-group"> 
	 <label class="control-label"><?=tfmdil('texte.genre')?></label> 
	 <div class="controls "> 
	 <input type="checkbox" name="b_genre" id="b_genre" <?php if($pt['stgender']==1 && $pr['Gender']>0){ echo 'checked'; }?> onclick="activerElementsSuivantEtatCheckbox(this, '#genre');"> 
	 <select id="genre" name="genre"> 
	 <option id="gender_0" value="0"><?=tfmdil('texte.genreInconnu')?></option> 
	 <option id="gender_1" value="1"><?=tfmdil('texte.fille')?></option> 
	 <option id="gender_2" value="2"><?=tfmdil('texte.garcon')?></option> 
	 </select> 
	 </div> 
	 </div> 

<?php
if($pt['stgender']==0 || $pr['Gender']<=0){
?>
	<script>
		activerElementsSuivantEtatCheckbox(this, '#genre');
	</script>
<?php
}
?>		 

<script>
	selected('gender_<?=$pr["Gender"]?>');
</script>

        <div class="control-group"> 
          <label class="control-label " for="presentation"><?=tfmdil('texte.presentation')?></label> 
          
		  <div class="controls ltr">  
		  <input type="checkbox" name="b_presentation" id="b_presentation" <?php if($pt['staciklama']==1){ echo 'checked'; }?> onclick="activerElementsSuivantEtatCheckbox(this, '#presentation'); activerElementsSuivantEtatCheckbox(this, '.groupe-boutons-barre-outils button'); activerElementsSuivantEtatCheckbox(this, '.boutons-previsualisation button');">

				<?=txed("presentation","presentation",$pt['aciklama'])?>
 					
          </div> 
		  
		  <?php
		  if($pt['staciklama']==0){
		  ?>
		  <script>
			activerElementsSuivantEtatCheckbox(this, '#presentation'); activerElementsSuivantEtatCheckbox(this, '.groupe-boutons-barre-outils button'); activerElementsSuivantEtatCheckbox(this, '.boutons-previsualisation button');		  
		  </script>
		  <?php
		  }
		  ?>
		  
        </div>
        <div class="control-group"> 
          <div class="controls"> 
            <button type="button" class="btn btn-post" onclick="editprofile();submitEtDesactive(this);return false;"><?=tfmdil('bouton.valider')?></button> 
            <button type="button" class="btn" onclick="jQuery('#cadre_editer_element_<?=$id?>').addClass('hidden');jQuery('#bouton_editer_element_<?=$id?>').removeClass('active');"><?=tfmdil('Annuler')?></button>
          </div> 
        </div> 
      </fieldset>
    </form>  

<?php
if(!empty($pt['aciklama']) && $pt['staciklama']==1){
?>
<br>
  <div class="cadre cadre-presentation">
  
  <?=bbcode($pt['aciklama'])?>
  
  </div> 
	
	
<?php
}
?>
	
</div>  
  


<?php
if($erisim==1){
		  if(!empty($_POST['avatarg'])){
		  $db->query("UPDATE users set Avatar = '' where PlayerID = '".$id."'");
	  }
?>
  <form method="post">

<div id="popup_confirmation" class="modal hide fade">
  <div class="modal-header"> <h3><?=tfmdil('texte.confirmation')?></h3> 
  </div> <div class="modal-body"> 
  <p class="message-confirmation">    <?=tfmdil('texte.messageConfirmation')?>   </p> </div> 
  <div class="modal-footer"> 
  <input type="hidden" name="avatarg" value="1">
    <input type="submit" class="btn btn-post" value="Onayla" onclick="confirm_refresh(200);"> 
    <a class="btn" data-dismiss="modal"><?=tfmdil('Annuler')?></a>
	</div> 
	</div>  
  </form>



<?php
	$yaptirim = $db->query("SELECT * FROM casierlog Where PlayerID = '".$id."' ");
	$yac = $yaptirim->rowCount();
	
	$f_yaptirim = $db->query("SELECT * FROM sanctions Where status = 1 and user = '".$id."' and time>='".time()."' order by time DESC");
	$f_yac = $f_yaptirim->rowCount();
	
	if(($yac+$f_yac)>=1){
?>

<div class="row"> 

<div class="span12"> 
<div class="cadre cadre-relief cadre-moderation ltr">     
<h2 class="display-inline-block"><?=$plang['sanctions']?></h2>            

<table id="yaptirimlar" class="table-datatable table-cadre table-cadre-centree table-striped">
        <thead>
            <tr>
<th  aria-label="<?=tfmdil('texte.utilisateur')?>: activate to sort column descending"  style="width: 160px;"><?=tfmdil('texte.utilisateur')?></th>
<th  aria-label="<?=$plang['ban_type']?>: activate to sort column ascending" style="width: 63px;"><?=$plang['ban_type']?></th>
<th  aria-label="<?=tfmdil('texte.raison')?>: activate to sort column ascending" style="width: 291px;"><?=tfmdil('texte.raison')?></th>
<th  aria-label="<?=$plang['ban_time']?>: activate to sort column ascending" style="width: 34px;"><?=$plang['ban_time']?></th>
<th  aria-label="<?=$plang['ban_created']?>: activate to sort column ascending" style="width: 89px;"><?=$plang['ban_created']?></th>
<th  aria-label="<?=$plang['ban_start']?>: activate to sort column ascending" style="width: 63px;"><?=$plang['ban_start']?></th>
<th  aria-label="<?=$plang['ban_end']?>: activate to sort column ascending" style="width: 63px;"><?=$plang['ban_end']?></th>
<th  aria-label="<?=$plang['ban_status']?>: activate to sort column ascending" style="width: 49px;"><?=$plang['ban_status']?></th>
            </tr>
<tbody>



<?php
	$f_yaptirim = $f_yaptirim->fetchAll(PDO::FETCH_ASSOC);

	foreach($f_yaptirim as $row){
		
		if($row['type']==1){
			$typ = "muteforum";
		}else{
			$typ = "banforum";
		}
		
	?>
		<tr role="row" class="even">
			<td class="sorting_1">
				<a class="lien-blanc">
					<span class="cadre-type-auteur-joueur" id="given_by_<?=$row['id']?>">
						<?php echo $yetkim>=8 || !empty($yetkimlist['sentinel']) ? "<script>$('#given_by_".$row["id"]."').load('ajax/user.php?v=".$row['given_by']."');</script>" : "Inconnu"?>
					</span>
				</a>
			</td>
			
		<td>
			<span class="texte-type-sanction"><?=$typ?></span>
		</td> 
		
		<td class="message-plus-moins" data-more="<?=$plang['message_more']?>" data-less="<?=$plang['message_less']?>" data-max-length="32"> 
			<?=$row['reason']?>
		</td> 
		
		<?php
		$bitis = ceil((($row['time']-time())/3600));
		
		?>
		
		<td data-order="<?=$row['time']?>">
			<span class="texte-duree-sanction">
				<?=$bitis?> <?=$plang['ban_hour']?>    
			</span>
		</td> 
		
		<td data-order="<?=$row['date']?>">
			<span class="texte-date">
				<span class=""><?=date("d/m/Y H:i:s",$row['date'])?></span>
			</span>
		</td> 
		
		<td data-order="<?=$row['date']?>">
			<span class="texte-date">
				<span class=""><?=date("d/m/Y H:i:s",$row['date'])?></span>
			</span>
		</td> 
		
		

		<td data-order="<?=$row['time']?>">
			<span class="texte-date">
				<span class=""><?=date("d/m/Y H:i:s",$row['time'])?></span>
			</span>
		</td>

		<?php
		if($bitis<1){
			$st = $plang['ban_ended'];
		}else{
			$st = $plang['ban_active'];
		}
		?>
		
		<td>
			<span class="texte-etat-sanction"><?=$st?></span>
		</td>  

		</tr>
	<?php
	}	
	?>


	<?php
	$yaptirim = $yaptirim->fetchAll(PDO::FETCH_ASSOC);

	foreach($yaptirim as $row){
	?>
		<tr role="row" class="even">
			<td class="sorting_1">
				<a class="lien-blanc">
					<span class="cadre-type-auteur-joueur">
						<?php echo $yetkim>=8 || !empty($yetkimlist['sentinel']) ? $row['Bannedby'] : "Inconnu"?>
					</span>
				</a>
			</td>
			
		<td>
			<span class="texte-type-sanction"><?=$row['State']?></span>
		</td> 
		
		<td class="message-plus-moins" data-more="<?=$plang['message_more']?>" data-less="<?=$plang['message_less']?>" data-max-length="32"> 
			<?=$row['Reason']?>
		</td> 
		<td data-order="<?=$row['Time']?>">
			<span class="texte-duree-sanction">
				<?=$row['Time']?> <?=$plang['ban_hour']?>    
			</span>
		</td> 
		<td data-order="<?=$row['date']?>">
			<span class="texte-date">
				<span class=""><?=date("d/m/Y H:i:s",$row['date'])?></span>
			</span>
		</td> 
		<td data-order="<?=$row['date']?>">
			<span class="texte-date">
				<span class=""><?=date("d/m/Y H:i:s",$row['date'])?></span>
			</span>
		</td> 
		<?php
		$bitis = ($row['Time']*3600)+$row['date'];
		?>
		<td data-order="<?=$bitis?>">
			<span class="texte-date">
				<span class=""><?=date("d/m/Y H:i:s",$bitis)?></span>
			</span>
		</td>

		<?php
		if(time()>=$bitis){
			$st = $plang['ban_ended'];
		}else{
			$st = $plang['ban_active'];
		}
		?>
		
		<td>
			<span class="texte-etat-sanction"><?=$st?></span>
		</td>  

		</tr>
	<?php
	}
		
	?>
	
	
</tbody>

        </thead>

    </table>


  
  		<script>
		
		$(document).ready(function() {
    $('#yaptirimlar').DataTable( {
		"bPaginate": false,
		  "lengthChange": false
    } );
} );
</script>
  <?php
  }
  }
    ?>
  
</div>     



<script type="text/javascript">
				function initRFC() {
					initAccordeonsForums(function(jqAccordeon) {
						var profil = jqAccordeon.find('.cadre-profil-rfc');

						if (profil.html().trim() == '') {
							jQuery.ajax({
								url: 'rfc-profile',
								type: "GET",
								dataType: "html",
								data: {
									"pr":'<?=$pr["Username"].$pr["Tag"]?>'
								},
								timeout:TIMEOUT_AJAX,
								success: function(data, textStatus, jqXHR) {
									if (verifieResultatRequete(data, false)) {
										profil.html(data);
										initDatatables();
									}
								}
							});
						}
					});
				}
			</script> 
			


<?php
include("footer.php");  
?>

