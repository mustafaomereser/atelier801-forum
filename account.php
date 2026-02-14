<?php
include("config.php");
if(empty($uye['id'])){
	yonlendir($site."/404");
	exit();
}
?>
	<link rel="stylesheet" type="text/css" href="<?=$site?>/css/rulet.css"> 


<div id="corps" class="corps clear container">
   <div class="row"> 
   <div class="span12">
   <div class="cadre cadre-defaut ltr">
   <div class="tabbable"> 
   <ul id="onglets_compte" class="nav nav-tabs">
   <li class="active">
   <a id="lien_tab_compte" href="#tab_compte" data-toggle="tab"><?=$plang['my_account']?></a></li>
   <li><a id="lien_tab_mail" href="#tab_mail" data-toggle="tab"><?=$plang['email_change']?></a></li>
   <li><a id="lien_tab_mdp" href="#tab_mdp" data-toggle="tab"><?=$plang['pw_change']?></a></li>
   <li><a id="lien_tab_changement_nom" href="#tab_changement_nom" data-toggle="tab"><?=$plang['nick_change']?></a></li>
   <li><a id="lien_tab_achat_fraises" href="#tab_achat_fraises" data-toggle="tab"><?=$plang['buy_hazelnut']?></a></li>
   <li><a id="lien_tab_achat_fraises" href="#tab_reward" data-toggle="tab"><?=$plang['reward']?></a></li>

   </ul>



<?php
$_email = hide_email($uye['Email']);
?>
   <div class="tab-content">
   
   <div class="tab-pane active ltr" id="tab_compte">
   <span><?=$plang['atelier801_account']?> : </span>
   <span class="lien-blanc-gras" id="show_username"><?=$uye['Username'].$uye['Tag']?></span>
   <br> <span><?=tfmdil('text.email')?> : </span>
   <span class="lien-blanc-gras" id="show_mail"><?=$_email['email']?></span>
   <br> <span><?=tfmdil('texte.dateInscription')?> : </span>
   <span class="texte-date">
   <span class="" data-afficher-secondes="false"><?php echo date("d/m/Y h:i",$uye['RegDate']);?></span>
   </span>
   </div> 
   <div class="tab-pane" id="tab_mail">  
   
   
     <div id="email">

 <form class="form-horizontal form-get-certification "  method="POST" autocomplete="off">   
<?php
if($_email['durum']==1){
?>

 <p><?=$plang['verification_required']?></p> 
 <div class="control-group">
 <div class="controls "> 
 <button class="btn btn-primary" onclick="accountupdate('email',1);definirMail(this);return false;"><?=$plang['verification_request']?></button> 
 </div> 
 </div>   
 
  <?php
}else{
	?>
 
							
							<div class="control-group ltr"> 
							<label class="control-label" for="mail2"> <?=$plang['account_newemail']?></label> 
							<div class="controls "> 
							<input type="email" name="mail" id="mail2"> 
							</div> 
							</div> 
							<div class="control-group ltr"> 
							<div class="controls">  
							<button class="btn btn-primary" type="button" onclick="accountupdate('email');definirMail(this);return false;"><?=tfmdil('bouton.valider')?></button>
							</div> 
							</div> 
 
	<?php
}
 ?>
 
 </form>   


  </div>
   
  


 
 </div> 
 <div class="tab-pane" id="tab_mdp">

 <div id="sifre">

 <div class="form-horizontal form-get-certification" autocomplete="off">   
 <?php
if($_email['durum']==1){
?>
 <p><?=$plang['verification_required']?></p> 
 <div class="control-group">
 <div class="controls "> 
 <button class="btn btn-primary" onclick="accountupdate('sifre',1);definirMail(this);return false;"><?=$plang['verification_request']?></button> 
 </div> 
 </div>  
  <?php
}else{
	?>
	<?=tfmdil('EmailNecessaire')?>
	<?php
}
 ?> 
 </div>   
 

  </div>
  
  
 </div>  
 
 <div class="tab-pane" id="tab_changement_nom"> 

 <div id="isim">

 <form class="form-horizontal form-get-certification "  method="POST" autocomplete="off">   
  <?php
if($_email['durum']==1){
?>
 <p><?=$plang['verification_required']?></p> 
 <div class="control-group">
 <div class="controls"> 
 <button class="btn btn-primary" onclick="accountupdate('isim',1);definirMail(this);return false;"><?=$plang['verification_request']?></button> 
 </div> 
 </div>   
   <?php
}else{
	?>
	<?=tfmdil('EmailNecessaire')?>
	<?php
}
 ?> 
 </form>   
 

  </div>
   
 </div>    
 
 
 
 
 <div class="tab-pane" id="tab_achat_fraises">     
 <form id="form_achat_fraises" class="form-horizontal formulaire-compte" action="initiate-fraise-purchase" method="POST" autocomplete="off">  
 <p class="message-nombre-fraises-compte" style="text-align:center;"><?=sprintf($plang['have_hazelnut'],$uye['Hazelnut'])?></p> 
 <div class="contenant-boutons-achat-fraises">          
 
 
 
 <div class="contenant-bouton-achat-fraises"> 
 <a class="bouton-achat-fraises bouton-achat-fraises1" onclick="openMarketPopup(1);">
 <div class="contenant-quantite-fraises-sans-gratuites"> 
 <div class="quantite-fraises empeche-selection-texte ltr"> 
 <img src="<?=$site?>/img/fraises/hazelnut.png" class="icone-quantite-fraises"/> 
 <div class="libelle-quantite-fraises nombre-hazelnut"> 10 </div> 
 </div>
 </div>  
 <div class="contenant-prix-achat-fraises">
<div class="prix-achat-fraises empeche-selection-texte" style="font-size: 18px"> <span class="texte-etat-sanction">10 <span class="message-erreur-mdp">(-50%)</span></span> TRY </div>
 </div> 
 </a>
 </div>   
      
 


<div class="contenant-bouton-achat-fraises">
<a class="bouton-achat-fraises bouton-achat-fraises5" onclick="openMarketPopup(2);">
<div class="contenant-quantite-fraises-sans-gratuites">
<div class="quantite-fraises empeche-selection-texte ltr">
<div class="libelle-quantite-fraises"><div class="texte-etat-sanction"> VIP </div></div>
</div>
</div>
<div class="desc-text">
<p>5 title every month</p>
<p>Add + before your name</p>
<p>Unlimited tag change right</p>
<p>Special chat command (/v)</p>
<p>Discord VIP role</p>
</div>
<div class="contenant-prix-achat-fraises">
<div class="prix-achat-fraises empeche-selection-texte" style="font-size: 18px"> <span class="texte-etat-sanction">15 <span class="message-erreur-mdp">(-50%)</span>/monthly</span> TRY </div>
</div>
</a>
</div>


 <div class="contenant-bouton-achat-fraises"> 
 <a class="bouton-achat-fraises bouton-achat-fraises3" onclick="openMarketPopup(3);">
 <div class="contenant-quantite-fraises-sans-gratuites"> 
 <div class="quantite-fraises empeche-selection-texte ltr"> 
 <img src="<?=$site?>/img/fraises/hazelnut.png" class="icone-quantite-fraises"/> 
 <div class="libelle-quantite-fraises nombre-hazelnut"> 50 </div> 
 </div>
 </div>  
 <div class="contenant-prix-achat-fraises">
<div class="prix-achat-fraises empeche-selection-texte" style="font-size: 18px"> <span class="texte-etat-sanction">35 <span class="message-erreur-mdp">(-50%)</span></span> TRY </div>
 </div> 
 </a>
 </div>   



 <div class="contenant-bouton-achat-fraises"> 
 <a class="bouton-achat-fraises bouton-achat-fraises4" onclick="openMarketPopup(4);">
 <div class="contenant-quantite-fraises-sans-gratuites"> 
 <div class="quantite-fraises empeche-selection-texte ltr"> 
 <img src="<?=$site?>/img/fraises/hazelnut.png" class="icone-quantite-fraises"/> 
 <div class="libelle-quantite-fraises nombre-hazelnut"> 100 </div> 
 </div>
 </div>  
 <div class="contenant-prix-achat-fraises">
<div class="prix-achat-fraises empeche-selection-texte" style="font-size: 18px"> <span class="texte-etat-sanction">60 <span class="message-erreur-mdp">(-50%)</span></span> TRY </div>
 </div> 
 </a>
 </div>  


 </div> 
 <div id="chargement-achat-fraises" style="display: none;"><?=$plang['loading']?></div> 
	<input type="hidden" name="token" value="<?=$token;?>" />
 <input type="hidden" id="monnaie" name="monnaie" value="TRY"> 
 </form>   
 </div>  

  
  
  
  <div class="tab-pane" id="tab_reward" style="overflow: hidden !important;"> 
<div class="control-group ltr">
<div class="controls">
<section class="r-roulette" id="mill_rotate">
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/1.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/2.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/3.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/4.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/5.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/6.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/7.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/8.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/9.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/10.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/11.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/12.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/13.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/14.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/15.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/16.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/17.jpg"></span>
</div>
<div class="area">
<div class="background"></div><span class="content"><img src="http://transformice.com/images/x_transformice/x_inventaire/18.jpg"></span>
</div>
</section>


<div class="controls" style="padding:0 0 1.6% 15% !important;">
<button class="btn btn-primary" type="button" onclick="reward(this);submitEtDesactive(this);return false;"><?=tfmdil('bouton.valider')?></button>
</div>


</div>
</div>

<div id="result_rulet"></div>



   </div>    
  
  
  
  
   </div> 
 </div>
 </div> 
 </div>   
 </div> 
  
  <script type="text/javascript">
		function init() {
			if (window.location.hash) {
				jQuery('#lien_' + window.location.hash.substring(1)).tab('show');
			}
		}
		
		
	function openMarketPopup(productId) {
		$('#xartest').modal('show');
		$('#selectedProductId').val(productId);
	}

	$(document).ready(function() {
		var payment_gw = 1;

		$('#continue_pay').click(function() {
			payment_gw = $('#payment_gw:checked').val();
			$.ajax({
				type: 'POST',
				url: 'sys/payment_create',
				data: {'payment_gw': payment_gw, 'product': $('#selectedProductId').val(), 'key': 'X1337X'},
				dataType: 'json',
				beforeSend: function() {
					$('#continue_pay').html('Redirecting..');
					$('#continue_pay').attr('disabled', true);
				},
				success: function(data) {
					setTimeout(function() {
						if(data.success) {
							if(data.data.redirect) {
								window.location.replace(data.data.redirect);
							}
						} else {
							$('#continue_pay').html('Continue pay');
							$('#continue_pay').removeAttr('disabled');
						}
						if(data.message) {
							console.log('API Response: '+data.message);
						} else {
							console.log('Cannot connect to API');
						}
					}, 1500);
				},
				error: function() {
					setTimeout(function() {
						$('#continue_pay').html('Continue pay');
						$('#continue_pay').removeAttr('disabled');
					}, 1500);
					console.log('An error occurred while send request');
				}
			});
			return false;
		});
	});
		
		
		
		
	</script>  
	</div> 
	
	
	
<?php

include("footer.php");

?>