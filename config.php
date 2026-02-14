<?php
include("pdoconnect.php");
?>

<!DOCTYPE html> 
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head> 
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"> 
<title><?=$ayarlar['title']?></title> 
<meta name="description" content=""> 
<meta name="viewport" content="user-scalable=no, initial-scale = 1, minimum-scale = 1, maximum-scale = 1, width=device-width"> 
<meta name="theme-color" content="#222222"> 
<meta name="msapplication-navbutton-color" content="#222222"> 
<meta name="apple-mobile-web-app-capable" content="yes"> 
<meta name="apple-mobile-web-app-status-bar-style" content="black"> 
<meta name="format-detection" content="telephone=no"> 
<link rel="shortcut icon" href="<?=$site?>/img/favicon.ico"/>  

	<link rel="stylesheet" type="text/css" href="<?=$site?>/css/style.css"> 
	<script src="<?=$site?>/js/script.js"></script>
	<script src="<?=$site?>/js/custom.js"></script>        
	<script src='<?=$site?>/js/jQueryRotate.2.3.js'></script>

<?php
if($ayardb['bakim']==1 && $yetkim<11){

if(empty($uye['id']) ){
	
	$form = '
	<center>
	<div class="control-group">
	<label class="control-label " for="kadi">'.tfmdil('text.email').' / '.tfmdil('Pseudo').'</label>
	<input type="text" class="input-xlarge ltr" id="kadi" name="kadi" placeholder="'.tfmdil('text.email').' / '.tfmdil('Pseudo').'" autocomplete="on" required/>
	</div>
	<br>
	<div class="control-group"> 
	<label class="control-label " for="sifre">'.tfmdil('Mot_De_Passe').'</label>
	<input type="password" class="input-xlarge ltr" id="sifre" name="sifre" placeholder="••••••••••••" required/>
	</div>
	<div id="result"></div>
	</center>
	';
	
	popup($form,0,tfmdil('bouton.connexion'),null,$id="maintenance_modal",$show=0,'<button class="btn btn-post" type="submit" onclick="c_auth();">'.tfmdil('Identification').'</button>');
}


?>
	<div id="corps" class="container">   
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
	<div class="offset2 span8"> 
	<div class="cadre cadre-message"> 
	<h4 style="text-align:center; padding:10px;">
		
		<p style="font-size:30px; padding-bottom:10px;">Website under maintenance</p>
		<img src="<?=$site?>/img/maintenance.png" width="50%">
		<p style="padding-top:15px;">We are performing an update and will be back shortly.</p>
	
	</h4> 
	</div> 
	</div> 
	</div>   
	</div>
	
	<script>
		var keys = "";
		var s = 0;
		function f_maintenance(){
			$(document).on("keypress", function (e) {
				s++;
				keys += e.which;
				if(keys=="9710112297107109105"){
					<?php
					if(empty($uye['id'])){
					?>
						$('#maintenance_modal').modal('show');
					<?php
					}else{
					?>
						window.location.assign('<?=$site?>/panel/index');
					<?php
					}
					?>
				}
				
				if(s>=7 || e.which == 32){
					keys = "";
					s = 0;
					console.log("Temizledim abeyy sifre : aezakmi");
				}
				
			});
		}
		f_maintenance();
	</script>
	
<?php
	exit();
}
?>

<?php
if(!empty($uye['id']) && $pt['stonline']>=1){
?>

<script type="text/javascript"> 
  $(document).ready(function() {

$("#d").load("<?=$site?>/sys/onl.php");

});
setInterval(function() {$("#d").load('<?=$site?>/sys/onl.php');}, 5300);
</script>

<?php
}

if(!empty($dilsecv)){
	popupn($plang['autolang_error']);
}

?>
	</head> 
	<div id="d"></div>
	<div id="_popup"><?php
	if($atildi==1){
		popupn(tfmdil("texte.resultat.auteurInvalide"));
	}

	//echo $_SESSION['see_sanction'];

	if(!isset($_SESSION['see_sanction'])){
		if($mute_control['durum']==1){
			popupn(i_rep('MuteInfo1', ceil(abs(time()/3600 - $mute_control['date']/3600)), $mute_control['sebep']));
			$_SESSION['see_sanction'] = "GÖRDÜK İŞTE AMINA KOYAYIM";
		}
	}

	?></div>

	<body onload="chargerPage();"> 
	
	<div id="contenant-corps-et-footer"> 
	
	<div class="modal hide fade ltr" id="popup_choix_langue"> 
	<div class="modal-header"> 
	<a class="close" data-dismiss="modal">×</a> 
	<h3><?=$plang['language']?></h3> 
	</div> 
	
	<div class="modal-body">  
	<?php
	foreach($diller as $x => $x_val){
	?>
		<a href="<?=$site?>/diller/index.php?dil=<?=$x?>" class="btn btn-<?php if($x==$dilim){ echo "info"; }else{ echo "inverse"; }?> bouton-langue" title="<?=dilr($x)?>">
		<img src="<?=$site?>/img/pays/<?=$x_val?>.png" class="img16"/>
		</a>  
	<?php
	}
	?>
	</div> 
	
	<div class="modal-footer"> 
	<a class="btn" data-dismiss="modal"><?=tfmdil('Fermer')?></a> 
	</div> 
	</div> 
	
	<div id="barre_navigation" class="navbar navbar-fixed-top navbar-inverse">
	<div class="navbar-inner"> 
	<div class="container-fluid menu-principal ltr"> 
	<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
	<span class="icon-bar"></span> 
	<span class="icon-bar"></span>
	<span class="icon-bar"></span> 
	</a> 
	<a class="brand lien-titre" href="<?=$site?>">
	<img src="<?=$site?>/img/logo_41x18.png"/>  <?=$ayarlar['title']?></a> 
	<div class="nav-collapse collapse"> 
	
	<ul class="nav ltr"> 
	<li class="" id="navbar_forums">
	<a class="element-menu-principal" href="<?=$site?>/forums"><?=$plang['forums']?></a></li> 
	<li class="" id="navbar_dev-tracker"><a class="element-menu-principal" href="<?=$site?>/dev-tracker"><?=$plang['dev_tracker']?></a></li>  
	<?php
	if(!empty($uye['id'])){
	?>
	<li class="" id="navbar_search"><a class="element-menu-principal" href="<?=$site?>/search"><?=$plang['arama']?></a></li>   
	<?php
	}	
	?>
		
	<li class="" id="navbar_ranking"><a class="element-menu-principal" href="<?=$site?>/ranking">Ranking</a></li>          

	<?php
	if($yetkim>=8 || $op>=1){
	?>
	
	<!-- onclick="window.open('<?=$site?>/panel/index', 
                         'newwindow', 
                         'width=1100,height=800'); 
              return false;" -->
	
		<li class="" id="navbar_panel"><a class="element-menu-principal pointer" href='<?=$site?>/panel/index'>Panel</a></li>          
	<?php
	}
	
	if($ayardb['bakim']==1){
	?>
		<li class="active"><a class="element-menu-principal pointer">Maintenance mode</a></li>          
	<?php
	}
	?>
	
	</ul> 

<?php
if(!isset($uye['id'])){
?>
	<ul class="nav pull-right ltr">   
	<li>
	
	<div class="contenant-bouton-connexion-menu">
	<a href="<?=$site?>/login<?php if(empty($_GET['redirect'])){?>?redirect=<?=str_replace("&","?_",links())?><?php } ?>" class="btn"><?=tfmdil('Identification')?></a>
	</div>
	
	</li> 
<?php
}else{
?>

	<ul class="nav pull-right ltr">

	<li class="dropdown"> 
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	<img src="<?=$site?>/img/avatars/<?=getavatar($uye)?>" class="espace-2-2 img16" alt="" /><?=$uye['Username']?>
	<b class="caret"></b></a> 
	
	<ul class="dropdown-menu menu-contextuel pull-left">  
	<li>
	<a href="<?=$site?>/account" class="element-menu-principal">
	<img src="<?=$site?>/img/icones/roue-dentee.png" class="espace-2-2 img16"/>
	<span class="hidden-phone hidden-tablet"><?=$plang['my_account']?></span>
	</a>
	</li>
	<li>
	<a href="<?=$site?>/conversations" class="element-menu-principal">
	<img src="<?=$site?>/img/icones/16/messagerie1.png" class="espace-2-2 img16"/>
	<span class="hidden-phone hidden-tablet"><?=$plang['Inbox']?></span>
	</a>
	</li>
	<li>
	<a href="<?=$site?>/posts?pr=<?=cpr($uye['Username'].$uye['Tag'])?>" class="element-menu-principal">
	<img src="<?=$site?>/img/icones/16/1historique-posts2.png" class="espace-2-2 img16"/>
	<span class="hidden-phone hidden-tablet"><?=$plang['last_posts']?></span>
	</a>
	</li>
	<li>
	<a href="<?=$site?>/favorite-topics" class="element-menu-principal">
	<img src="<?=$site?>/img/icones/16/topic-favori.png" class="espace-2-2 img16"/>
	<span class="hidden-phone hidden-tablet"><?=$plang['favorite_topics']?></span>
	</a>
	</li>
	<li><a href="<?=$site?>/favorite-tribes" class="element-menu-principal">
	<img src="<?=$site?>/img/icones/16/tribe-favori.png" class="espace-2-2 img16"/>
	<span class="hidden-phone hidden-tablet"><?=$plang['favorite_tribes']?></span>
	</a>
	</li> 
	<li class="divider"></li>
	<li><a href="<?=$site?>/profile?pr=<?=cpr($uye['Username'].$uye['Tag'])?>" class="element-menu-principal">
	<img src="<?=$site?>/img/icones/16/1profil.png" class="espace-2-2" alt="">
	<span class="hidden-phone hidden-tablet"><?=$plang['my_profile']?></span>
	</a>
	</li> 
	<li><a href="<?=$site?>/friends?pr=<?=cpr($uye['Username'].$uye['Tag'])?>" class="element-menu-principal">
	<img src="<?=$site?>/img/icones/16/1ami1.png" class="espace-2-2" alt="">
	<span class="hidden-phone hidden-tablet"><?=$plang['my_friends']?></span>
	</a>
	</li> 
	<li>
	<a href="<?=$site?>/blacklist?pr=<?=cpr($uye['Username'].$uye['Tag'])?>" class="element-menu-principal">
	<img src="<?=$site?>/img/icones/16/1liste-noire.png" class="espace-2-2" alt="">
	<span class="hidden-phone hidden-tablet"><?=$plang['blacklist']?></span>
	</a>
	</li>   
	<?php
	if($uye['TribeCode']>0){
	?>
	<li class="divider"></li>  
	<li class="nav-header"><?=$plang['my_tribe']?></li> 
	<li><a href="<?=$site?>/tribe?tr=<?=$uye['TribeCode']?>" class="element-menu-principal">
	<img src="<?=$site?>/img/icones/16/1tribu.png" class="espace-2-2" alt="">
	<span class="hidden-phone hidden-tablet"><?=$plang['tribe_profile']?></span>
	</a>
	</li> 
	<li><a href="<?=$site?>/tribe-forum?tr=<?=$uye['TribeCode']?>" class="element-menu-principal">
	<img src="<?=$site?>/img/icones/16/topic.png" class="img16 espace-2-2" alt="">
	<span class="hidden-phone hidden-tablet"><?=$plang['tribe_forum']?></span>
	</a>
	</li> 
	<li><a href="<?=$site?>/tribe-members?tr=<?=$uye['TribeCode']?>" class="element-menu-principal">
	<img src="<?=$site?>/img/icones/16/1tribu-membres.png" class="espace-2-2" alt="">
	<span class="hidden-phone hidden-tablet"><?=$plang['see_members']?></span>
	</a>
	</li>
	<li><a href="<?=$site?>/tribe-history?tr=<?=$uye['TribeCode']?>" class="element-menu-principal">
	<img src="<?=$site?>/img/icones/16/1tribu-activite.png" class="espace-2-2" alt="">
	<span class="hidden-phone hidden-tablet"><?=$plang['tribe_history']?></span>
	</a>
	</li>
	
	<?php
	}
	?>
	</ul> 
	</li>  
		
	<?php
	$consvs = $db->query("SELECT hash,player FROM conversations where player = '".$uye['id']."' and trash='0'")->fetchAll(PDO::FETCH_ASSOC);
	$mesajcot=0;
	foreach($consvs as $row){
		$convss = $db->query("SELECT readed FROM conversation WHERE hash = '".$row['hash']."' and player!='".$uye['id']."'")->fetchAll(PDO::FETCH_ASSOC);
		foreach($convss as $convs){
		if($convs['readed']==0){
		$mesajcot++;
		}
	}
	}
	
	if($mesajcot>=1){
	?>
	<li>
	<a href="<?=$site?>/conversations"><?=$mesajcot?> <img src="<?=$site?>/img/icones/16/enveloppe.png" class="espace-2-2 img16" title="<?=str_replace("%1",$mesajcot,tfmdil('texte.messagerie.nouveauxMessages'))?>"></a>
	</li>
	<?php
	}
	?>
	
	<li> 
	<form id="formulaire_deconnexion" class="" action="/deconnexion" method="POST" autocomplete="off"> 
	<button type="submit" onclick="confirm_refresh(100);submitEtDesactive(this);return false;" class="btn"><?=tfmdil('E_Quitter')?></button> 
	</form> 
	</li>   
	
<?php
}
?>
	</li>    
	
	<li class="dropdown hidden-phone hidden-tablet"> 
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
	<img src='<?=$site?>/img/pays/<?=$dilim?>.png' class="img16 espace-2-2">
	<b class="caret"></b></a> 
	
	<ul class="dropdown-menu btn-inverse">    
	<li> 
	<table>   
	


	
	<?php
$sayi = 0;
	foreach($diller as $x => $x_val){
		if($sayi==2 || $sayi==0){
			echo "<tr>";
		}
		$sayi++;
	?>

	<td> 
	<a href="<?=$site?>/diller/index.php?dil=<?=$x?>" class="element-menu-principal element-menu-langue" title="<?=dilr($x)?>">
	<img src="<?=$site?>/img/pays/<?=$x_val?>.png" class="img16 espace-2-2"/><?=dilr($x)?></a> 
	</td>
		
	<?php
		if($sayi==2 || $sayi==0){
			echo "</tr>";
			$sayi=0;
		}
	}
	?>
	
	
	</table>
	</li> 
	</ul> 
	</li> 
	<li class="hidden-desktop"> 
	<a onclick="jQuery('#popup_choix_langue').modal('show');" class="element-menu-principal">
	<img src='<?=$site?>/img/pays/<?=$dilim?>.png'> <?=dilr($dilim)?></img>	</a> 
	</li> 
	</ul> 
	</div> 
	</div>


	<?php
	include("sys/seconder-menu.php");
	?>

	</div> 
	</div> 
	
	<div id="espace_barre_navigation" class="hidden-phone hidden-tablet"></div> 
<input type="hidden" name="link" id="link" value="<?=links()?>">
<input type="hidden" name="site" id="site" value="<?=$site?>">
<input type="hidden" name="page" id="page" value="<?=$_GET['p']?>">
<style id="sc"></style>
	<script type="text/javascript">
		majTailleEspaceNavbar();
	</script>
	
	
<?php
//print_r($yetkimlist);
if(($yetkim>=8 || !empty($yetkimlist['sentinel'])) && isset($_SESSION['id'])){
?>

<style>
.p_label{
	float:left !important;
	min-width:12% !important;
	text-align:right !important;
	margin-right:10px !important;
}
</style>


<div class="modal hide fade ltr" style="display: none;" id="p_menu"> 
 <div class="modal-header">
 <a class="close" data-dismiss="modal"> &times;</a> 
 <h3>
	<punish_isim></punish_isim>
 </h3> 
 </div> 

<punish_body></punish_body>
 
 <div class="modal-footer"> 
 
<Database id="hideble_buttons"> 
 <button type="button" class="btn btn-post" id="p_valider"> 
	<?=tfmdil('bouton.valider')?>
 </button>
</Database>

 <a class="btn" data-dismiss="modal"> 
	<?=tfmdil('bouton.annuler')?>
 </a> 
 </div> 
 </form> 
 </div> 
 
 
<script>
function punish(id, mode="menu", u_status){
	//alert($("#p_status_"+id).is(":checked"));	

	if(mode=="menu"){
		$('#p_valider').attr("onclick", "punish("+id+",'punish'); submitEtDesactive(this); return false;");
		$('#hideble_buttons').css("display", "none");
		$('punish_isim').html("<?=tfmdil('popup.titre.information')?>");
		$('punish_body').html("<h5 style='text-align: center; paddin:10px;'><?=$plang['loading']?></h5>");
	}
			
	
	bilgi = {
		id: id,
		mode: mode,
		reason: $('#p_reason').val(),
		time: $('#p_time').val(),
		time_type: $('#p_time_type').val(),
	}

	if($('#p_type_mute').is(':checked')){
		bilgi['type'] = 1;
	}else{
		bilgi['type'] = 2;
	}
	
	if(mode=="u_status"){
		bilgi['u_status'] = $("#p_status_"+u_status).is(":checked");
		bilgi['u_status_id'] = u_status;
	}

	$.ajax({
		type: "POST",
		url: "ajax/punish.php",
		data: {query: bilgi},
		success: function(result){
			if(mode=="menu"){
				$('punish_body').html(result);
			}else{
				$('#_popup').html(result);
			}
			
			//alert(result.length);	
			if(result.length>=400){
				$('#hideble_buttons').css("display", "n");
			}
			
		}
		
	});
	
}
</script>

<?php
}
?>
