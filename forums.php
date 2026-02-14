<?php
include("config.php");

	if(!isset($_SESSION['filter_forum'])){
		$_SESSION['filter_forum'] = array();
	}
	
	$c = $_GET['c'];

	if($_POST){
		$altbolumler = $_POST['alt_bolum'];

		if(!empty($altbolumler)){
			$_SESSION['filter_forum']['alt_bolum'] = $altbolumler;
		}else{
			$_SESSION['filter_forum']['alt_bolum'] = null;
		}
		
		$filt = $_POST['lang'];
		
		$_SESSION['filter_forum']['lang'] = null;
		
		foreach($filt as $ca){
			$c = null;
			if(!empty($ca)){
				$_SESSION['filter_forum']['lang'][$ca] = $ca;
			}
		}
	}

	if(!empty($c)){
		$_SESSION['filter_forum']['lang'] = null;  
	}

	if(empty($_SESSION['filter_forum']['lang'])){
		
		if(empty($c)){
			$c = strtolower($dilim);			
		}
		
		$filter .= "&lang%5B%5D=xx&lang%5B%5D=".$c;
		echo '<script id="ae">active("langbar_'.$c.'");</script>';
	}


	if(!empty($_SESSION['filter_forum']['alt_bolum'])){
		$filter .= "&alt_bolum=".$_SESSION['filter_forum']['alt_bolum'];
	}

	foreach($_SESSION['filter_forum']['lang'] as $ca){
		$filter .= "&lang%5B%5D=".$ca;
	}


$forums = $db->query("SELECT * FROM forums WHERE sub_section = ''")->fetchAll(PDO::FETCH_ASSOC);

$count = 0;


?> 
	
<div id="corps" class="corps clear container">          
  
<div class="row">

<?php
foreach($forums as $row){
if(forum_yetki_kontrol($row['priv'])==1){
$count++;
?>

 <div class="span12">
  <div id="f<?=$row['id']?>" class="cadre cadre-relief cadre-forum ltr">
 <div id="f_<?=$row['id']?>">
 <div class="accordion accordeon-forum" id="accordion<?=$row['id']?>">
 <div class="accordion-group">
 <div class="accordion-heading cadre-forum-titre">
 
 <div class="accordion-toggle">
 <a class="lien-blanc" data-toggle="collapse" data-parent="#accordion<?=$row['id']?>" id="<?=$row['id']?>" onclick="plus(this);" href="#collapse<?=$row['id']?>">
 <img src="<?=$site?>/img/sections/<?=$row['icon']?>.png" class="img32 espace-2-2">
<?=$row['title']?>
 <img src="<?=$site?>/img/icones/moins24-2.png" alt="" id="c_<?=$row['id']?>" class="espace-2-2 pull-right image-accordeon">
 </a>
 
<?=forumscarki($row)?>

 </div>
   </div>
 <div id="collapse<?=$row['id']?>" class="accordion-body collapse-forum-actu in collapse" style="height: auto;">
 <div class="accordion-inner">
 <div id="forumload_<?=$row['id']?>" class="cadre-sections-actu">
 
<script>
$("#forumload_<?=$row['id']?>").load("ajax/forum-ajax?forum=<?=$row['id']?><?=$filter?>");
</script>
 
</div>
  </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 </div>
 



<?php
}

}

if($count<=0 && empty($uye['TribeCode'])){
	
	echo "<span style='color:white;'><center>(".tfmdil('texte.vide').")</center></span>";
	
}


?>

<tribeforum><script>$('tribeforum').load("ajax/tribeforum");</script></tribeforum>

 </div>
</div>


<div class="modal hide fade ltr" id="popup_filtrage_affichage"> 
 <form class="form-horizontal" method="POST" id="con" autocomplete="off"> 
 <div class="modal-header"> 
 <a class="close" data-dismiss="modal"> &times;</a> 
 <h3>
	<?=$plang['filter_forum'] ?? tfmdil('text.filter')?>
</h3> 
 </div> 
 <div class="modal-body"> 
  <div class="control-group"> 
 <label class="control-label "> 
	<?=tfmdil('Options')?>
</label> 
 <div class="controls "> 
 <label class="checkbox "> 
 <input type="checkbox" class="option-forum" name="alt_bolum" value="on" <?php if(!empty($_SESSION['filter_forum']['alt_bolum'])){ echo "checked"; } ?>> 
	<?=$plang['alt_bolumler'] ?? tfmdil('interface.tribu.bouton.descendre');?>
 </label> 
 </div> 
 </div> 
 <div class="control-group"> 
 <label class="control-label "> 
	<?=tfmdil('Communaute')?>
</label> 
 <div class="controls "> 
 
 
 <?php
 foreach($dilrs as $k => $la){
	 
	 $da = strtolower($k);
	 $filtc = count($_SESSION['filter_forum']['lang']);
	 
	 $chec = "";
	 if($da!="xx"){
		
		if($filtc>=1){
			 foreach($_SESSION['filter_forum']['lang'] as $cas){
				 if($cas==$da){
					 $chec = "checked";
				 }
			 }
		 }else{
			 
			 if($da==$c){
				 $chec = "checked";
			 }
			 
		 }
		 
	 }else{
		$chec = "checked";
	 
	}
?>	 

	<label class="checkbox"> 
		<input type="checkbox" class="option-forum" name="lang[]" value="<?=$da?>" <?=$chec?>> 
			<img src="<?=$site?>/img/pays/<?=$da?>.png" class="img16 espace-2-2"> 
				<?=dilr($da)?>
	</label> 

	 
<?php 
 }
 ?>



	</div> 
 </div> 
 <div class="control-group"> 
 <label class="control-label "> 
	<?=tfmdil('texte.reinitialiserFiltres')?>
</label> 
 <div class="controls "> 
 <label class="checkbox "> 
 <input type="checkbox" name="reset" onclick="activerElementsSuivantEtatCheckbox(this, '.option-forum', true);"> 
 </label> 
 </div> 
 </div> 
  </div> 
 <div class="modal-footer"> 
  <button type="button" class="btn btn-post" onclick="formsubmit('con');submitEtDesactive(this);return false;"> 
	<?=tfmdil('bouton.valider')?>
</button> 
 <a class="btn" data-dismiss="modal"> 
	<?=tfmdil('bouton.annuler')?>
</a> 
 </div> 
 </form> 
 </div> 



<?php
include("footer.php");
?>
