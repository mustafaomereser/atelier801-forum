<?php
include("config.php");
yetkisinir(10);

$duzenle = $_GET['editforum'];

if(!empty($duzenle)){
	
	$forum = $db->query("SELECT * FROM forums where id = '".$duzenle."'")->fetch(PDO::FETCH_ASSOC);
	
	if(forum_yetki_kontrol($forum['priv'])!=1){
		popupn(tfmdil('erreur.tribulle.14'));
		_exit();
	}
	
	if(empty($forum['id'])){
		
		popupn(tfmdil('erreur.tribulle.10'));
		exit();
		
	}
		$b = $plang['edit_forum'];

}else{
	
	$b = $plang['new_forum'];
}


function sub_kontrol($id){
	global $db,$duzenle;
	
	if(!empty($duzenle)){
		$dznle = $db->query("SELECT sub_section FROM forums where id = '".$duzenle."'")->fetch(PDO::FETCH_ASSOC);
	}
	
	if($id==$dznle['sub_section']){
	return $dznle['sub_section'];
	}else{
	$section = $db->query("select id,forum from section where id = '".$id."'")->fetch(PDO::FETCH_ASSOC);
	$forum   = $db->query("SELECT sub_section from forums where id = '".$section['forum']."'")->fetch(PDO::FETCH_ASSOC);
	if(!empty($section['id'])){
		$forum2 = $db->query("SELECT id from forums where sub_section = '".$section['id']."' ")->fetch(PDO::FETCH_ASSOC);
	}
	if(empty($forum['sub_section']) && empty($forum2['id'])){
		return $id;
	}else{
		$arr = array();
		if(!empty($forum['sub_section'])){
			array_push($arr,tfmdil('texte.resultat.interdit'));
		}		
		if(!empty($forum2['id'])){
			array_push($arr,tfmdil('texte.resultat.interdit'));
		}
		return $arr;
		
	}
}
}



$nom = temizle(strip_tags($_POST['nom']));
$icone = strtok($_POST['icone'],".");

function r(){
	global $forum,$site,$db;
	
	
	$yon = $site."/forums";
	if(!empty($forum['sub_section'])){
		$sec = $db->query("SELECT * FROM section where id = '".$forum['sub_section']."'")->fetch(PDO::FETCH_ASSOC);
		$yon = $site."/section?f=".$sec['forum']."&s=".$sec['id'];
	}
	//echo $yon;
			yonlendir($yon,0);
	
}

if($_POST){
$yetkls = $_POST['yetkiler'];
	$yets = explode(",",$yetkls);

	$yetkiler = "";
	foreach($yets as $ros){
		
		if($ros>=1 && !empty($privlist[$ros]) && (!empty($ylistid[$ros]) || $yetkim>=11) && is_numeric($ros)){
			if(!strstr($yetkiler, ",".$ros) || !strstr($yetkiler, $ros.",")){
				$yetkiler .= ",".$ros;
			}
		}
		
	}
	//echo $yetkiler = rtrim(ltrim($yetkiler,","),",");
	if(empty($yetkiler)){
		$yetkiler = "1";
	}

if(strlen($nom)>=3){
	if($_SESSION['forumsac']<=time()){
		$sub = sub_kontrol($_POST['main_val']);

		if(!empty($sub)){
			if(!is_numeric($sub)){
				
				foreach($sub as $k => $cz){
					popupn($cz,1,null,$site."/forums");
				}
				_exit();
			}
		}
		
	if(empty($duzenle)){	
	$fm = $db->exec("INSERT INTO forums (title,icon,priv,sub_section) values ('".$nom."','".$icone."','".$yetkiler."','".$sub."')");
	}else{
	$fm = $db->exec("UPDATE forums set title = '".$nom."', icon = '".$icone."', sub_section = '".$sub."', priv = '".$yetkiler."' where id = '".$duzenle."'");
	}
	
	if($fm>0 && $fm <=1){
		$_SESSION['forumsac']=time()+4;
		r();
		exit();
	}
}
}else{
	popupn(str_replace("%1","3",tfmdil('texte.resultat.titreTropCourt')),1,null,$site."/new-forums");
	//r();
	_exit();
}

r();

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
 
 <div class="control-group">
 <label class="control-label " for="nom">
<?=tfmdil('texte.nom')?></label>
 <div class="controls ">
 <input type="text" id="nom" name="nom" value="<?=$forum['title']?>" autocomplete="on">
 </div>
 </div>
 
 
<div class="control-group"> 
 <label class="control-label "> 

<?=tfmdil('interface.tribu.bouton.accueil')?>

</label> 
 <div class="controls"> 
 
 
<div id="main" class="dd-container" style="width: 200px;"></div> 
<?php
$l_js = '{text:"'.tfmdil('Utiliser').'", selected:true},';
$forum_list = $db->query("SELECT * FROM forums where sub_section = ''")->fetchAll(PDO::FETCH_ASSOC);
foreach($forum_list as $key => $rw){
if($duzenle!=$rw['id']){
$section_list = $db->query("SELECT * FROM section where forum = '".$rw['id']."' && (lang = 'xx' or lang='".strtolower($dilim)."' )")->fetchAll(PDO::FETCH_ASSOC); 
$forumkoy = 0;

foreach($section_list as $s => $r){
	$subkont = $db->query("SELECT id FROM forums where sub_section = '".$r['id']."'")->fetch(PDO::FETCH_ASSOC);
	if(empty($subkont['id']) or $forum['sub_section']==$r['id']){
		
		if($forumkoy == 0){
			$l_js .= '{text:\'• <span disabled><img src="'.$site.'/img/sections/'.$rw['icon'].'.png" class="img16 espace-2-2" /> '.kisalt($rw['title'],15).'</span>\', selected:false},';
			$forumkoy = 1;
		}

			if((empty($duzenle) || $forum['sub_section']!=$r['id'])){
				$l_js .= '{text:\'<span style="margin-left:40px;"> <img src="'.$site.'/img/pays/'.$r['lang'].'.png" class="img16 espace-2-2" /> '.kisalt($r['title'],20).'</span>\', value:'.$r['id'].', selected:false},';
			}else{
				$l_js .= '{text:\'<span style="margin-left:40px;">(•) <img src="'.$site.'/img/pays/'.$r['lang'].'.png" class="img16 espace-2-2" /> '.kisalt($r['title'],18).'</span>\', value:'.$r['id'].', selected:true},';
			}
		}
	
		
}

}

}
?>


<script type="text/javascript">
var ddData_communaute = [<?=rtrim($l_js,",")?>];
function initialiseDropdown_communaute() {
	jQuery('#main').ddslick({data:ddData_communaute,width:200,onSelected: function(data){
	jQuery('#main_id').attr('value', data.selectedData.value);
	jQuery('.dd-selected-value').attr('name', 'main_val');
	$(document).ready(function() {
		$("#main ul").addClass("scroll-y");
    });
}});
};
</script> 
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
<button type="button" class="btn btn-info bouton-icone-section <?php echo ($forum['icon']==$iconval) ? "active" : ""?>" id="bouton_<?=$iconsay?>" value="<?=$iconval?>">
 <img src="<?=$site?>/<?=$row?>" class="img32">
 </button>
	
	<?php
	$iconsay++;
}
?>



 
   </div>
 <input type="hidden" id="icone" name="icone" value="<?=$forum['icon'] ?? "transformice"?>" required>
 </div>
 </div>


 <div class="control-group">
<label class="control-label ">
<?=tfmdil('bouton.afficher')?>
</label>


<?php
$isaretle = $forum['priv'] ?? "1";

$s = explode(",",$isaretle);
$d = array();
foreach($s as $v){
	$d[$v] = $v;
}
?>
 <input type="hidden" id="yetkiler" name="yetkiler" value=",<?=$isaretle?>,">


 <div class="controls noselect" id="L_priv">
<?php
foreach($privlist as $key => $row){
	if(!empty($ylistid[$key]) || $yetkim>=11){
	?>
	<div class="badge outline-badge-<?=$row?> <?php echo !empty($d[$key]) ? "" : "badgedisable"; ?> pointer" id="<?=$key?>" onclick="badge_disable(this,1);" onmouseover="badge_disable(this);"><?=ucwords($row)?></div>
	<?php
	}
}
?>

</button>
 </div>
 </div>


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



			function init() {
				
				<?php
				if(empty($duzenle)){
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

	