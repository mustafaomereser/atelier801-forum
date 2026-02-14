<?php
include("config.php");


$edit = $_GET['editsection'];

if(!empty($edit)){
	
	$section = $db->query("SELECT * FROM section where id = '".$edit."'")->fetch(PDO::FETCH_ASSOC);

	if(empty($section['id'])){
		
		popupn(tfmdil('erreur.tribulle.10'));
		_exit();		
	}
		$b = $plang['edit_section'];

}else{	
	$b = $plang['new_section'];
}

$sectionedit = $db->query("SELECT * FROM section where id = '".$edit."'")->fetch(PDO::FETCH_ASSOC);
$t=$_GET['t'];
$f=$_GET['f'];

if(empty($f) && empty($t)){
	yonlendir($site."/forums");
	exit();
}

if(empty($t)){
	yetkisinir(10);
	$forum = $db->query("SELECT * FROM forums where id = '".$f."'")->fetch(PDO::FETCH_ASSOC);
}else{
	
	$tribe = $db->query("SELECT * FROM tribe where Code = '".$t."'")->fetch(PDO::FETCH_ASSOC);
	
	if($tribe['Code']!=$uye['TribeCode']){
		popupn(tfmdil('erreur.tribulle.17'));
		_exit();
	}else{

	}
	
}

if(forum_yetki_kontrol($forum['priv'])!=1 && empty($t)){
	popupn(tfmdil('erreur.tribulle.14'));
	_exit();
}



$nom = temizle(strip_tags($_POST['nom']));
$icone = strtok($_POST['icone'],".");

if(!empty($forum['id']) || !empty($tribe['Code'])){

if($_POST){
if(strlen($nom)>=3){

if($_SESSION['sectionac']<=time()){

if(empty($_POST['xx'])){
	$lf = strtolower($dilim);
}else{
	$lf = "xx";
}

if(!empty($tribe['Code'])){
	$lf = "xx";	
}

if(empty($edit)){
	$fas = $forum['id'];

if(empty($fas) || $fas==0){
	$fas = 1;
}
	$fm = $db->exec("INSERT INTO section (title,icon,forum,lang,tribe) values ('".$nom."','".$icone."','".$fas."','".$lf."','".$t."')");
}else{
		$etat = $_POST['etat'];
		
		if($yetkim>=10){
			$secforum = $_POST['secforum'];
		}else{
			$secforum = 1;
		}
		
		if(!empty($f) && empty($t)){
			$forum = $db->query("SELECT id FROM forums where id = '".$secforum."'")->fetch(PDO::FETCH_ASSOC);
			if(empty($forum['id'])){
				popupn(tfmdil('EchecPaiement'));
				_exit();		
			}
		}
		$fm = $db->exec("UPDATE section set title = '".$nom."', icon = '".$icone."', lang = '".$lf."', locked='".$etat."', forum = '".$secforum."' where id='".$edit."'");
}

	if($fm>0){
		$_SESSION['sectionac']=time()+5;
	}
}else{
		popupn(tfmdil('texte.resultat.delaiAttenteDepasse'));

}

}else{
	popupn(str_replace("%1","3",tfmdil('texte.resultat.titreTropCourt')),1);
	exit();
}

		yenile(0,1);
exit();
}

}else{
	popupn(tfmdil('EchecPaiement'));
	exit();
}

?>

<div id="corps" class="corps clear container">
   <div class="row">
 <div class="span12 cadre cadre-formulaire ltr">
 <form id="formsc" class="form-horizontal" method="POST" autocomplete="off">
 <fieldset>
 <legend>
<?=$b?>
</legend>
<?php
if(!empty($f)){ 
 ?>
<div class="control-group">
 <label class="control-label " for="nom">
<?=tfmdil('texte.communaute')?></label>
 <div class="controls ">
 <label class="form-control" for="nom">
<img src="<?=$site?>/img/pays/<?=$dilim?>.png" class="img16 espace-2-2"> <?=dilr($dilim)?>
</label>
 </div>
 </div>
 
 <div class="control-group">
 <label class="control-label " for="nom">
<?=tfmdil('communaute.1.nom')?></label>
 <div class="controls ">
 <label class="form-control" for="xx">
 <input type='checkbox' id="xx" name="xx" value='international' <?php if($sectionedit['lang']=="xx" && empty($_POST)){ echo "checked"; }?>>
<img src="<?=$site?>/img/pays/xx.png" class="img16 espace-2-2"> <?=dilr('xx')?>
</label>
 </div>
 </div>
  <?php
}
 ?>
 <div class="control-group">
 <label class="control-label " for="nom">
<?=tfmdil('texte.nom')?></label>
 <div class="controls ">
 <input type="text" id="nom" name="nom" value="<?=$sectionedit['title']?>" autocomplete="on">
 </div>
 </div>
 <div class="control-group">
 <label class="control-label ">
<?=tfmdil('texte.icone')?></label>
 <div class="controls ">
   <div class="boutons-icone-section" data-toggle="buttons-radio">
   
<?php
$icones_list = glob("img/sections/*.png");
$iconsay=0;
foreach($icones_list as $key => $row){
	$iconval = strtok(end(explode("/",$row)),".");
	?>
<button type="button" class="btn btn-info bouton-icone-section <?php echo ($sectionedit['icon']==$iconval) ? "active" : ""?>" id="bouton_<?=$iconsay?>" value="<?=$iconval?>">
 <img src="<?=$site?>/<?=$row?>" class="img32">
 </button>
	
	<?php
	$iconsay++;
}
?>


   </div>
 <input type="hidden" id="icone" name="icone" value="<?=$sectionedit['icon'] ?? "transformice"?>">
 </div>
 </div>


<?php
if(!empty($edit)){
$lck = $section['locked'];

$sil = $_GET['sil'];

if(!empty($sil)){
$sils = $db->exec("DELETE FROM section where id = '".$sil."'");

$cekt = $db->query("SELECT id FROM topic where section = '".$sil."'")->fetchAll(PDO::FETCH_ASSOC);

foreach($cekt as $sr){
	$siltm = $db->exec("DELETE FROM topicm where topic = '".$sr['id']."'");
}

$silt = $db->exec("DELETE FROM topic where section = '".$sil."'");

if($sils>0){
	yonlendir($site."/forums");
}

}


?>

<div class="control-group"> 
 <label class="control-label " for="etat"> 
<?=tfmdil('texte.etat')?>
 </label> 
 <div class="controls "> 
   <input type="hidden" id="etat" name="etat" value="0"> 
 <div class="btn-group" data-toggle="buttons-radio" data-toggle-name="etat"> 
 
 <button type="button" id="bouton_etat_0" data-toggle="button" class="bouton-etat btn btn-success" onclick="setEtat(0);"> 
<?=$plang['ban_active']?>
 </button> 
 
 <button type="button" id="bouton_etat_1" data-toggle="button" class="bouton-etat btn btn-inverse" onclick="setEtat(1);"> 
<?=$plang['lockf']?>
 </button> 
 <a data-toggle="button" href="<?=links()?>&sil=<?=$edit?>" class="bouton-etat btn btn-danger" onclick="return confirmDel();"> 
<?=tfmdil('Supprimer')?>
 </a> 
 </div> 
 
 </div> 
 
 </div> 
 
 <script id="ae">
 active('bouton_etat_<?=$lck?>');
 </script>
 
<?php
if(!empty($f)){
?>
<div class="control-group"> 
 <label class="control-label " for="etat"> 
<?=tfmdil('Forum')?>
 </label> 
 
 <div class="controls"> 

<select name="secforum">
<option value="<?=$forum['id']?>" selected>[•] <?=$forum['title']?></option>
<?php
$forums = $db->query("SELECT * FROM forums where id != '".$f."'")->fetchAll(PDO::FETCH_ASSOC);
foreach($forums as $row){
?>

<option value="<?=$row['id']?>"><?=$row['title']?></option>

<?php
}
?>

</select>

 </div> 
 
</div> 
  
 <?php
}
 ?>
 
<?php
}
?>


 <div class="control-group">
 <div class="controls ">
  <button type="button" class="btn btn-post" onclick="formsubmit('formsc');submitEtDesactive(this);return false;">
<?=tfmdil('bouton.valider')?>
</button>
 </div>
 </div>
 </fieldset>
 </form>
 </div>
 </div>

<script type="text/javascript">


			function setEtat(idEtat) {
				jQuery('.bouton-etat').removeClass('active');
				jQuery('#bouton_etat_' + idEtat).addClass('active');
				jQuery('#etat').val(idEtat);
			}

			function init() {
				<?php
				if(empty($edit)){
					?>
				jQuery('#bouton_0').addClass('active');
				jQuery("#icone").val(jQuery('#bouton_0').attr('value'));
				<?php
				}
				?>
				
				jQuery(".boutons-icone-section button").click(function () {
					jQuery("#icone").val(jQuery(this).attr('value'));
					jQuery('.bouton-icone-section').removeClass('active');
					jQuery(this).addClass('active');
				});
			}
		</script>   
		</div>
		
<?php
include("footer.php");
?>
		