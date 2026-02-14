<?php
include("config.php");
$redirect = $_GET['redirect'];

if($_SESSION['id']){
	yonlendir($site,0);
	exit();
}
?> 
	<input id="redirect" type="hidden" name="redirect" value="<?=$redirect?>">

	<div id="corps" class="corps clear container">    

	<div id="popup_erreur_auth_google" class="modal hide fade" data-backdrop="static" data-keyboard="false" data-show="true">,
	<fieldset> <div class="modal-header">
	<h3><?=$plang['verification_unsuccessful']?></h3>
	</div> <div class="modal-body">
	</div> <div class="modal-footer">
	<a class="btn btn-info" data-dismiss="modal" onclick="if(jQuery(this).data('reload'))window.location.reload();">Ok</a>
	</div> 
	</fieldset>
	</div>  
	<div class="row"> <div class="span12">
	<p align="center"> 
	<a href="#" rel="noopener" class="cliquable">
	<img src="<?=$site?>/img/logo-atelier801.png" id="b" onclick="takla(this);" width="225" height="225"/>
	</a>
	</p> 
	</div>
	</div> 
	<div class="row"> 
	<div class="cadre cadre-relief cadre-connexion"> 
	<div class="text-align-center"> 
	<h1><?=tfmdil('SeConnecterAvecTFM')?></h1> 
	</div>
	
	<form class="form-connexion" method="POST" autocomplete="off">
	<fieldset> <div class="control-group">
	<label class="control-label " for="kadi"><?=tfmdil('text.email')?> / <?=tfmdil('Pseudo')?></label>
	<input type="text" class="input-xlarge ltr" id="kadi" name="kadi" placeholder="<?=tfmdil('text.email')?> / <?=tfmdil('Pseudo')?>" autocomplete="on" required/>
	</div>
	<div class="control-group"> <label class="control-label " for="sifre"><?=tfmdil('Mot_De_Passe')?></label>
	<input type="password" class="input-xlarge ltr" id="sifre" name="sifre" placeholder="••••••••••••" required/>
	</div> 
	<div class="control-group contenant-rester-connecte"> 
	<label class="label-menu-principal lien-blanc ltr" for="rester_connecte_1">
	<input type="checkbox" name="rester_connecte_1" id="rester_connecte_1" class="checkbox-rester-connecte">
	<?=$plang['login_keeplogged']?> 
	</label> 
	</div> 
	<div class="control-group text-align-center contenant-bouton-connexion"> 
	<button class="btn btn-post" type="submit" onclick="c_auth();"><?=tfmdil('Identification')?></button>
	</div> 
	</fieldset>
	</form>  
	<div class="ou"><?=$plang['login_or']?></div>
	<div class="contenant-boutons-connexion">     
<!-- 	<form action="<?=$site?>/google-identification" method="POST">
	<fieldset>
	<button class="bouton-connexion-externe bouton-connexion-google bouton-connexion-avec-separation" type="button" id="bouton_auth_google" onclick="authGoogle(this);" disabled>
	<div class="contenant">
    
	<div class="cellule-contenant">
	<img class="icone" src="<?=$site?>/img/auth/google.png">
	</div> 
	
	<div class="cellule-contenant">
	<span class="libelle"><?=tfmdil('SeConnecterAvecGoogle')?></span>
	</div> 
   </div> 
	</button>
	</fieldset> 
	</form>  --> 
	
	
    <form action="<?=$site?>/facebook-identification" method="POST">
	<fieldset>
	<button class="bouton-connexion-externe bouton-connexion-facebook" type="button" id="bouton_auth_facebook" onclick="authFacebook(this);" disabled> 
	<div class="contenant"> 
	<div class="cellule-contenant">
	<img class="icone" src="<?=$site?>/img/auth/facebook.png">
	</div> 
	<div class="cellule-contenant">
	<span class="libelle"><?=tfmdil('SeConnecterAvecFacebook')?></span>
	</div>   
	</div> 
	</button> 

	</fieldset> 
	</form> 
	</div>   
	<div class="mdp-oublie">
	<a href="<?=$site?>/forgotten-password" class="lien-blanc"><?=tfmdil('Recup_MDP')?></a>
	</div>  
	

	<!--
	<form class="hidden" method="POST" id="identification" action="<?=$site?>/identification" autocomplete="off"> 
	</form>
	-->	
	
	</div> 
	</div>     	
	
	<div id="result"></div>
	
 

		</div> 
			
			
<?php
include("footer.php");
?>