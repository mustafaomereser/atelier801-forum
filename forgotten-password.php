<?php
include("config.php");
	
$hashe=$_GET['hash'];
if($_POST && empty($hashe)){
$kadi = $_POST['kadi'];
$email = $_POST['email'];
$user = $db->query("SELECT * FROM users where Username = '".$kadi."' and Email = '".$email."'")->fetch(PDO::FETCH_ASSOC);
if(!empty($user['PlayerID'])){
	if($_SESSION['emailsure']<=time()){
		
	$hash = createHash(20);
	//echo $hash;
	$pt = $db->query("SELECT * FROM profilesuser where player = '".$user['PlayerID']."'")->fetch(PDO::FETCH_ASSOC);
	if(empty($pt['id'])){
		$pt = $db->exec("INSERT INTO profilesuser (player,hash) values('".$user['PlayerID']."','".$hash."')");
	}else{
		$db->exec("UPDATE profilesuser set hash = '".$hash."' where player = '".$user['PlayerID']."'");
	}
	
	$deg = array("%1","%2","%s");
	$degg = array($user['Username'],"<a href='".$site."/forgotten-password?hash=".$hash."'>".tfmdil('ViensIci')."</a>",$plang['sifre']);
	$mailtemp = str_replace($deg,$degg,$plang['mailtemp']);	
	
		
		
		$s = mailgonder($user['Email'], trkkr($plang['sifre']), $mailtemp);
		if($s==1){
			
			$text = "Başarılı. Lütfen mail adresinizi kontrol ediniz.";
			
		}else{
			
			$text = "Mail gönderilemedi lütfen tekrar deneyin.";
			
		}
	}else{
		$text = "Lütfen Mail kutunuzu kontrol ediniz. ".($_SESSION['emailsure']-time());
	}
	
}


}


?>
<div id="corps" class="corps clear container">

 <div class="row">
 <div class="span12">
 <p align="center">
 <a href="#" rel="noopener" class="cliquable">
<img src="<?=$site?>/img/logo-atelier801.png" id="b" onclick="takla(this);" width="300" height="300"/>
</a>
 </p>
 </div>
 </div>
 <div class="row">

 <div class="offset3 span6">
 <div id="cadre_mdp_oublie" class="cadre cadre-defaut"><br>
 <form class="form-horizontal" method="POST" id="submit">
 
 
 <?php
 if(empty($hashe)){
 ?>
 
 <div class="control-group">
 <label class="control-label " for="login">
<?=tfmdil('Pseudo')?></label>
 <div class="controls ">
 <input type="text" id="login" name="kadi" value="">
 </div>
 </div>
 
 <div class="control-group">
 <label class="control-label " for="mail">
<?=tfmdil('text.email')?></label>
 <div class="controls ">
 <input type="email" id="mail" name="email" value="">
 </div>
 </div>
 
  <div class="control-group">
 <div class="controls ">
 <button class="btn btn-primary" onclick="formsubmit('submit');">
<?=$plang['reset_password']?>
</button>


 </div>

 </div>
 <br>
  <center> <?=$text?></center>
 <br>

 <?php
 }else{
	 
	 
	$pt = $db->query("SELECT * FROM profilesuser where hash = '".$hashe."'")->fetch(PDO::FETCH_ASSOC);
	$onay = 0;
	if(!empty($pt['id'])){
		$onay=1;
	}
	
	if($_POST){
		$sifre = strip_tags(trim($_POST['pass']));
		$repass = strip_tags(trim($_POST['repass']));
		$deco = $_POST['deco'];
	$sifdegis = 0;
	if((strlen($sifre)>=8 && strlen($sifre)<=16)){
		$sifdegis++;
	}else{
		popupn($plang['account_shortlongpw']);
	}
		
		if($sifdegis==1){
			
			if($sifre == $repass){
				$sifdegis++;
			}else{
					popupn($plang['account_pwsnotmatch']);
			}

		}
			
	if($sifdegis==2){
		$sonc = $db->query("UPDATE users set Password = '".sifrele($sifre)."' WHERE PlayerID = '".$pt['player']."'");
		$hsh = $db->exec("update profilesuser set hash = '".createHash(20)."' where player = '".$pt['player']."'");
		if($sonc>0){
			
			//
			
			
		if($deco=="true"){
			if(user_check($uye['PlayerID'])==1){
				socket("komut|kick ".$user['Username']."");							
			}
		}
			
			
			popupn($plang['account_pwchanged']);
			yonlendir($site."/login",1);

		}
		
		

	}
	}
	
 if($onay==1){
 ?>
 
  <div class="control-group">
 <label class="control-label " for="login">
<?=tfmdil('Mot_De_Passe')?></label>
 <div class="controls ">
 <input type="password" id="pass" name="pass" value="">
 </div>
 </div>
 
 <div class="control-group">
 <label class="control-label " for="mail">
<?=$plang['tekrar']?> <?=tfmdil('Mot_De_Passe')?></label>
 <div class="controls ">
 <input type="password" id="repass" name="repass" value="">
 </div>
 </div>
 
<div class="control-group ltr"> 
 <label class="control-label" for="deco"><?=$plang['verification_exitall']?></label>
 <div class="controls">
 <input type="checkbox" name="deco" id="deco">
 </div> 
 </div>  
 
  <div class="control-group">
 <div class="controls ">
 <button class="btn btn-primary" onclick="formsubmit('submit');">
<?=tfmdil('bouton.valider')?></button>
 </div>
 </div>
 
 <?php
 }else{
popupn(tfmdil('Code_Email_Invalide'),1,null,$site."/forgotten-password");
 }
 
 }
 ?>
 

 </form>
 </div>

 </div>
 </div>
 </div>
   </div>
<?php
include("footer.php");
?>
 