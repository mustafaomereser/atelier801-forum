<?php
include("config.php");

$sujet = temizle(htmlspecialchars($_POST['sujet']));
$message = temizle(htmlspecialchars($_POST['message']));
$categorie = temizle(htmlspecialchars($_POST['categorie']));
$pseudo = temizle(htmlspecialchars($_POST['pseudo']));
$email = temizle(htmlspecialchars($_POST['email']));
if(!empty($sujet) && !empty($message) && !empty($categorie)  && !empty($pseudo)  && !empty($email)){

if(time()>=$_SESSION['contact']){
$snc = $db->exec("INSERT INTO iletisim (kadi,email,kategori,konu,mesaj,date) values ('".$pseudo."','".$email."','".$categorie."','".$sujet."','".$message."','".time()."')");


$_SESSION['contact']=time()+30;
}


if($snc>0){
	popupn(tfmdil('texte.resultat.succes'));
	yenile(0.9,1);
}else{
	popupn(str_replace("%1",($_SESSION['contact']-time()),tfmdil('AttendreNouveauMessage')));

}

}

?>

<div id="corps" class="corps clear container">
<div id="formulaire_contact" class="cadre cadre-relief cadre-contact">

<div class="text-align-center">
<h1><?=$plang['contact']?></h1>
<h2><?=$plang['contact_text']?></h2>
</div>

<form class="form-horizontal" method="POST"  id="form" autocomplete="off">
<fieldset> <div class="control-group">
<label class="control-label " for="pseudo"><?=$plang['required_nick']?></label>

<div class="controls  ltr">
<input type="text" class="input-xlarge" id="pseudo" name="pseudo" <?php if(!empty($uye['id'])){ echo 'value="'.$uye['Username'].'" readonly'; } ?> required/>
</div>

</div>

<div class="control-group">
<label class="control-label " for="email"><?=$plang['required_email']?></label>
<div class="controls  ltr">
<input type="email" class="input-xlarge" id="email" name="email" <?php if(!empty($uye['id'])){ echo 'value="'.$uye['Email'].'" readonly'; } ?> required/>
</div>
</div>

<div class="control-group">
<label class="control-label " for="categorie"><?=$plang['category']?></label>
<div class="controls  ltr">
<select class="input-xlarge" id="categorie" name="categorie" required>
<option value="0"></option>
<option value="1"><?=$plang['contact_1']?></option>
<option value="2"><?=$plang['contact_2']?></option>
<option value="4"><?=$plang['contact_4']?></option>
<option value="6"><?=$plang['contact_6']?></option>
<option value="7"><?=$plang['contact_7']?></option>
<option value="8"><?=$plang['contact_8']?></option>
</select>
</div>
</div>

<div class="control-group">
<label class="control-label " for="sujet"><?=$plang['subject']?></label>
<div class="controls  ltr">
<input class="input-xlarge" type="text" id="sujet" name="sujet" required/>
</div>
</div>

<div class="control-group">
<label class="control-label " for="message"><?=$plang['topic_message']?></label>
<div class="controls  ltr">
<textarea class="input-message input-xxlarge" id="message" name="message" rows="10" required></textarea>
</div>
</div>
 <div class="control-group text-align-center">
 <a class="btn btn-post" href="<?=$site?>"><?=tfmdil('Aide')?></a>
 <button class="btn btn-post" type="submit" onclick='formsubmit("form");'><?=tfmdil('bouton.valider')?></button>
 </div>
 </fieldset>
 </form>
 </div>

</div>




<?php
include("footer.php");
?>
