<?php
include("config.php");

if(empty($uye['id'])){
	yonlendir($site."/404",0);
	exit();
}


?>

  <div id="corps" class="corps clear container">   

<div id="result_msg"></div>

<div class="row">
 <div class="span12">
 <div class="cadre cadre-formulaire ltr">
 <div class="form-horizontal">
 <fieldset>
 <legend>
<?=$plang['new_dialog']?></legend>
 <div class="control-group">
 <label class="control-label " for="destinataire">
<?=$plang['to_who']?>
</label>
 <div class="controls">
<h id="selected" style="float:left;position:absolute;" class="hidden">
</h>

 <input type="text" id="destinataire" oninput="dialog_search();" style="float:left;" name="destinataire" class="input-medium" value="<?=$_GET['ad']?>">
<button id="bouton_edition_destinataire" class="btn bouton-edition-destinataire-mp hidden" style="position:absolute;" onclick="typechange('destinataire','text');fclass(this,'add','hidden');fclass('destinataire','remove','hidden');fclass('selected','add','hidden');" type="button"><?=tfmdil('bouton.editer')?></button>

<div>
<br><br>
</div>

<div class="contenant-menu-deroulant-utilisateurs-trouves-mp">
<div id="destinataires_trouves" class="menu-deroulant-utilisateurs-trouves-mp hidden">
<table class="max-width">
<tbody id="result_search">



</tbody>
</table>
</div>
</div>

 </div>
 </div>
 <div class="control-group">
 <label class="control-label " for="objet">
<?=$plang['message_subject']?>
</label>
 <div class="controls">
 <input type="text" id="objet" name="objet" class="input-xxlarge" value="">
 </div>
 </div>

<div class="control-group">
<label class="control-label " for="message_conversation">
<?=tfmdil('texte.message')?>
</label>
 
 <div class="controls ltr">
 <?=txed("message_conversation","message_conversation")?>
 </div>
 
 </div>
 
  <div class="control-group">
 <div class="controls">

<button type="button" class="btn btn-post" onclick="newdialog();submitEtDesactive(this);return false;">
<?=tfmdil('bouton.valider')?>
</button>

 </div>
 </div>
 </fieldset>
 </div>
 </div>
 </div>
 </div>



 
 </div> 




<script type="text/javascript">
                    function init() {
                        // Par défaut, on demande une confirmation lorsque l'on quitte une page avec un message
                        // en cours de rédaction qui n'a pas pu être sauvegardé.
                        var demanderConfirmationSortie = true;

                        // Au départ, la saisie n'est pas encore validée. Mais une fois qu'elle est validée,
                        // il sera important de ne plus chercher à enregistrer inutilement la saisie
                        // car les données saisies auront été envoyées.
                        var reponseValidee = false;

                        lierChampTexteASauvegarde(jQuery('#destinataire')[0],'destinataire_nouveau_dialogue',function(){return reponseValidee;});
                        lierChampTexteASauvegarde(jQuery('#objet')[0],'objet_nouveau_dialogue',function(){return reponseValidee;});
                        lierChampTexteASauvegarde(jQuery('#message_conversation')[0],'message_nouveau_dialogue',function(){return reponseValidee;});

                        jQuery('#create_dialog').on('submit', function() {
                            reponseValidee = true;
                        });

                        // Lorsqu'on envoie un message ou qu'on se déconnecte, l'utilisateur indique clairement
                        // qu'il veut quitter la page, donc inutile d'ajouter une demande de confirmation lorsqu'il
                        // quitte la page de cette façon.
                        jQuery("#create_dialog,#formulaire_deconnexion").on('submit',function() {
                            demanderConfirmationSortie = false;
                        });

                        // On demande une confirmation lorsque le message en cours de rédaction n'a pas pu être
                        // sauvegardé, et que l'utilisateur quitte la page sans se déconnecter ou envoyer
                        // son message.
                        ajouterConfirmationFermeture("Sayfadan çıkmakta emin misiniz? Girilen veriler kaybedilebilir.",function() {
                            return demanderConfirmationSortie &&
                                (!verifierSauvegardeChamp (jQuery('#destinataire')[0], 'destinataire_nouveau_dialogue') ||
                                !verifierSauvegardeChamp (jQuery('#objet')[0], 'objet_nouveau_dialogue') ||
                                !verifierSauvegardeChamp (jQuery('#message_conversation')[0], 'message_nouveau_dialogue'));
                        });
                </script>



<?php
include("footer.php");
?>
