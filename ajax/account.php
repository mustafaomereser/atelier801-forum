<?php
include("../pdoconnect.php");

$veri = $_POST['query'];
if(empty($veri)){
yonlendir($site."/404",0);
exit();
}else{
	
$mode = $veri['mode'];
$id = $veri['id'];
$deco = $veri['deco'];

$codesifre = $veri['codesifre'];	
$codeemail = $veri['codeemail'];
$codeisim = $veri['codeisim'];

if(!empty($codesifre)){
	$code = $codesifre;
}elseif($codeemail){
	$code = $codeemail;
}elseif($codeisim){
	$code = $codeisim;
}

$newmail = strip_tags($veri['newmail']);

$newname = ucwords(strtolower(strip_tags(trim($veri['newname']))));

$mdp = strip_tags($veri['mdp']);
$mdp2 = $veri['mdp2'];


$_email = hide_email($uye['Email']);


?>


<?php
function codeverif(){
	global $uye;
	global $db;
	global $pt;
	global $id;
	global $plang;
	$hs = createHash(6);
	$deg = array("%1","%2","%s");
	$degg = array($uye['Username'],$hs,$plang[$id]);
	$mailtemp = str_replace($deg,$degg,$plang['mailtemp']);	
	$snc = $db->query("UPDATE profilesuser set hash = '".$hs."' where player = '".$uye['id']."' ");
	if($snc>0){
	  mailgonder($uye['Email'],trkkr($plang[$id]),$mailtemp);
	}
?>

<form class="form-horizontal form-set-certification" method="POST" autocomplete="off"> 
 <p><?=$plang['verification_entercode']?></p> 
 <div class="control-group">
 <label class="control-label" for="codesifre"><?=$plang['verification_code']?></label> 
 <div class="controls"> 
 <input type="text" name="code<?=$id?>" id="code<?=$id?>" value = "<?=$hs?>" class="input-medium"> 
 </div> 
 </div> 
 <div class="control-group"> 
 <div class="controls"> 
 <button class="btn btn-primary" onclick="accountupdate('<?=$id?>',2);return false;"><?=tfmdil('bouton.valider')?></button> 
 </div>
 </div> 
</form>
<?php
}
?>

<?php
function emailform(){
		global $plang,$_email;

?>
 
 <form id="form_changer_mail" class="form-horizontal formulaire-compte" method="POST" autocomplete="off">
 <?php
 if($_email['durum']!=0){
 ?>
 <p><?=$plang['account_code_verifed']?></p>  
 <?php
 }
 ?>
 <div class="control-group ltr"> 
 <label class="control-label" for="mail2"><?=$plang['account_newemail']?></label>
 <div class="controls"> 
 <input type="email" name="mail" id="mail2"> 
 </div> 
 </div> 
 <div class="control-group ltr"> 
 <div class="controls">
 <button class="btn btn-primary" type="button" onclick="accountupdate('email',3);return false;"><?=tfmdil('bouton.valider')?></button> 
 </div> 
 </div>
 </form>  

<?php
}
?>


<?php
function isimform(){
		global $plang;

?>
 
<div id="form_changement_nom" class="form-horizontal formulaire-compte">    
 <p><?=$plang['account_code_verifed']?></p>  
 <p><?=sprintf($plang['namechange_fraises'],'<span class="nombre-fraises">1500</span>')?></p> 
 <div class="control-group ltr">
 <label class="control-label" for="newname"><?=$plang['namechange_newname']?></label> 
 <div class="controls"> 
 <input type="text" name="newname" id="newname" maxlength="15" required/>  
 </div> 
 </div> 
 <div class="controls"> 
 <div id="resultat_disponibilite_nom"></div> 
 </div> 
 <div class="control-group ltr"> 
 <div class="controls">     
 <a class="btn btn-primary" onclick="accountupdate('isim',3);"><?=tfmdil('bouton.valider')?></a>   
 </div>
 </div>  
 </div>   

<?php
}
?>


<?php
function sifreform(){
	global $plang;
?>
<form id="form_changer_mdp" class="form-horizontal formulaire-compte custom-post" method="POST" autocomplete="off"> 
 <p><?=$plang['account_code_verifed']?></p>  
 <div class="control-group ltr">
 <label class="control-label " for="mdp"><?=$plang['verification_newpassword']?></label> 
 <div class="controls">
 <input type="password" name="mdp" id="mdp" onchange="jQuery('.message-erreur-mdp').addClass('hidden');"> 
 </div>
 </div> 
 <div class="control-group ltr"> 
 <label class="control-label" for="mdp2"><?=$plang['verification_passwordvf']?></label> 
 <div class="controls">
 <input type="password" name="mdp2" id="mdp2" onchange="jQuery('.message-erreur-mdp').addClass('hidden');"> 
 </div> 
 </div> 

 <div class="control-group ltr"> 
 <label class="control-label" for="deco"><?=$plang['verification_exitall']?></label>
 <div class="controls">
 <input type="checkbox" name="deco" id="deco">
 </div> 
 </div>  
 <div class="control-group ltr">
 <div class="controls"> 
 <button class="btn btn-primary" type="button" onclick="accountupdate('sifre',3);return false;"><?=tfmdil('bouton.valider')?></button>
 </div> 
 </div> 
 </form> 
<?php
}
?>

<?php
function setname(){
	global $plang;

	global $newname;
	if(!empty($newname)){

	global $uye;
	global $db;
	global $pt;
	global $id;
	
	$onay = 0;

if($onay==0){
	if(strlen($newname)<3 || strlen($newname)>15){
	popup($plang['account_shortlongname']);
	isimform();
	}else{
		$onay++;
	}
}


if($onay==1){
	if($uye['ShopFraises']>=1500){
			$onay++;
	}else{
			popup($plang['account_fraisesnotenough']);
	}
}


if($onay==2){
$control = $db->query("SELECT * FROM users where (Username != '".$uye['Username']."' and Username = '".$newname."') or (Username != '".$uye['Username']."' and OldNames LIKE '%".str_replace(","," ",$newname)."%') ")->fetch(PDO::FETCH_ASSOC);
	if(empty($control['PlayerID'])){
			$onay++;
	}else{
			popup($plang['account_nameinusage']);
			isimform();
	}
}

if($onay==3){
	if($newname!=$uye['Username']){
			$onay++;
	}else{
			popup($plang['account_nameinusagebyyou']);
				isimform();

	}
}

if($onay==4){
	
		$allow = str_split("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ");
		$keysd = str_split($newname);
		$hata = 0;
		
		foreach($keysd as $k => $v){
			$a = $v;
			if(empty(array_search($a, $allow))){
				$hata = 1;
			}
		}
		
			if($hata == 1){
				popup(tfmdil('Pseudo_Invalide'));
				isimform();
			}else{
				$onay++;
			}
}


if($onay==5){
	if(empty(strstr($uye['OldNames'], $uye['Username']))){
		$oldnames = ltrim($uye['OldNames'].",".$uye['Username'],",");
	}else{
		$oldnames = $uye['OldNames'];
	}
	$snc = $db->exec("UPDATE users set Username = '".$newname."', ShopFraises='".($uye['ShopFraises']-1500)."', OldNames='".$oldnames."'  where Username = '".$uye['Username']."'");
	if($snc>0){
		popup(tfmdil('texte.resultat.succes'));
		echo tfmdil('texte.resultat.succes');
		//geri();
		
		if(!empty($uye['Tag'])){
			$tg = $uye['Tag'];
		}
		
		$gncname=$newname.$tg;
		
		echo '<script> document.getElementById("show_username").innerHTML = "'.$gncname.'"; </script>';

	}


}


}else{
echo tfmdil('text.error');
}
}

?>

<?php
function setpass(){
	global $plang;
	global $mdp;
	
	if(!empty($mdp)){
	global $deco;
	global $uye;
	global $db;
	global $pt;
	global $id;
	global $mdp2;
	
	$onay = 0;


if($onay==0){
	if((strlen($mdp)>=8 && strlen($mdp)<=16)){
		$onay++;
	}else{
		popup($plang['account_shortlongpw']);
		sifreform();
	}
}

if($onay==1){

	if($mdp==$mdp2){
	$onay++;	
	}else{
	popup($plang['account_pwsnotmatch']);
	sifreform();
	}
}

	if($onay==2){
	$sonc = $db->query("UPDATE users set Password = '".sifrele($mdp)."' WHERE PlayerID = '".$uye['id']."'");
	if($sonc>0){
		
		if($deco=="true"){
			if(user_check($uye['PlayerID'])==1){
				socket("komut|kick ".$uye['Username']."");
			}else{
				
				//popup(tfmdil('erreur.tribulle.2'));
				
			}
		}
		
		echo $plang['account_pwchanged'];
		//yonlendir($site."/account");

	}
	
	
	}


}else{
echo tfmdil('text.error');
}
}

?>

<?php
function setmail(){
	global $plang;
	global $newmail;
	global $uye;
	global $db;
	global $pt;
	global $id;
	global $newmail;
	
	$onay = 0;

if($onay==0){
	
	if(!empty($newmail)){
		$onay++;
	}else{
	echo $plang['account_blankemail']."<br><br>";
	emailform();
	}
}

if($onay==1){
	
	if(strstr($newmail,"@")){
		$onay++;
	}else{
	echo $plang['account_fakeemail']."<br><br>";
	emailform();
	}
}

	if($onay==2){
	$sonc = $db->query("UPDATE users set Email = '".$newmail."' WHERE PlayerID = '".$uye['id']."'");
	if($sonc>0){
		echo $plang['account_emailchanged'];
		echo '<script> document.getElementById("show_mail").innerHTML = "'.hide_email($newmail)['email'].'"; </script>';
		//yonlendir($site."/account");
	}
	
	
	}


}

?>



<?php
if($mode==1){	
codeverif();
}


if(($mode==3 && $id=="email") || ($id=="email" && $_email['durum']==0)){
	if(!empty($newmail)){
		setmail();
	}else{
		echo tfmdil('text.error');
	}
}


if($mode==3 && $id=="isim"){	
if(!empty($newname)){
setname();
}else{
echo tfmdil('text.error');
}
}


if($mode==3 && $id=="sifre"){	
if(!empty($mdp)){
setpass();
}else{
echo tfmdil('text.error');
}
}

if($mode==2){
	
if($code==$pt['hash']){

if($mode==2 && $id=="sifre"){
sifreform();
}


if($mode==2 && $id=="email"){
emailform();
}

if($mode==2 && $id=="isim"){
isimform();
}


}else{
echo $plang['verification_unsuccessful'];
}

}
?>


<?php
}
?>
