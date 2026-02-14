<?php
include("config.php");

if(empty($uye['id'])){
	popupn(tfmdil('texte.resultat.droitsInsuffisants'));
	_exit();
	
}

$se = $_GET['se'];
$te = $_GET['te'];

if(!empty($se) && !empty($te)){


	if($te==1){
		$sec = $db->query("SELECT * FROM users where Username LIKE '%".$se."%' ");
	}

	if($te==2){
		$sec = $db->query("SELECT * FROM tribe where Name LIKE '%".$se."%' ");	
	}
	if($te != 3){
		$secrow = $sec->rowCount();
		$search = $sec->fetchAll(PDO::FETCH_ASSOC);
	}
if($secrow>=1 || $te == 3){
	$onay=1;
}else{

//yenile(0,1);

}
	
}else{
	$onay=0;
}


?>
<script>title("<?=$plang['arama']?>");</script>

<div id="corps" class="corps clear container">
<?php
if($onay==1){
?>

<div id="corps" class="corps clear container"> 
  
<?php  
if($te==3){
	
	$where = "";
	$comment = $_GET['comment'];
	$subject_name = $_GET['subject_name'];
	$pr = $_GET['pr'];
	$f = $_GET['f'];
	$c = $_GET['c'];
	
/* 	if(!empty($comment)){
		$where .= "&& ";
	} */
	
	if(!empty($f)){
		$_forum = $db->query("SELECT id FROM forums WHERE id='".$f."'")->fetch(PDO::FETCH_ASSOC);
		if(!empty($_forum['id'])){
			$f = $_forum['id'];
		}else{
			$f = "";
		}
	}
	
	if(!empty($pr)){
		$usr = $db->query("SELECT PlayerID FROM users where Username LIKE '%".$pr."%'")->fetch(PDO::FETCH_ASSOC);
		if(!empty($usr['PlayerID'])){
			$where .= "&& player = '".$usr['PlayerID']."' ";
		}
	}
	
	if(!empty($subject_name)){
		$where .= "&& title LIKE '%".$se."%'";
	}	

	if(!empty($where)){
		$where = "where ".ltrim($where,"&&");
	}else{
		
	}
	
$dev = $db->query("SELECT * FROM topic ".$where."")->fetchAll(PDO::FETCH_ASSOC);
foreach($dev as $row){

	$topic = $db->query("SELECT * FROM topic WHERE id='".$row['id']."'")->fetch(PDO::FETCH_ASSOC);
	$section = $db->query("SELECT * FROM section WHERE id='".$topic['section']."'")->fetch(PDO::FETCH_ASSOC);
	$forum = $db->query("SELECT * FROM forums WHERE id='".$section['forum']."'")->fetch(PDO::FETCH_ASSOC);
	$kisi = $db->query("SELECT * FROM users WHERE PlayerID='".$row['player']."'")->fetch(PDO::FETCH_ASSOC);
		
	if((!empty($f) && $forum['id']==$f) or empty($f)){

	if((!empty($c) && !empty($dilrs[$c])) || empty($c)){
?>

 <div class="row"> <div class="span12">        
 <div class="cadre cadre-resultat-recherche ltr"> 
 <table class="table-cadre"> 
 
 <tr> 
 <td class="table-cadre-cellule-principale"> 
 <div class="navigation-resultat-recherche"> 
 <ul class="barre-navigation  ltr navigation-resultat-recherche"> 
 <li>
 <a href="<?=$site?>/forums#f_<?=$forum['id']?>"><img src="<?=$site?>/img/sections/<?=$forum['icon']?>.png" alt="" class="espace-2-2 img16"><?=$forum['title']?></a>
 </li> 
 </li>
 
 <li>
 <span class="divider"> / </span>
 </li> 
 
 <li>
 <a href="<?=$site?>/section?f=<?=$forum['id']?>&s=<?=$section['id']?>"><img src="<?=$site?>/img/sections/<?=$section['icon']?>.png" alt="" class="espace-2-2 img16"><img src="<?=$site?>/img/pays/<?=$section['lang']?>.png" class="img16 espace-2-2" /> <?=$section['title']?></a>
 </li> 
 </li>
 
 <li>
 <span class="divider"> / </span>
 </li>   
 
 <li>
 <a href="<?=$site?>/topic?f=<?=$forum['id']?>&t=<?=$topic['id']?>">
 <?php
 if($topic['pinned']==1){
 ?>
 <img src="<?=$site?>/img/icones/postit.png" class="img16 espace-2-2" /> 
 <?php
}
if($topic['locked']==1){
 ?>
 
 <img src="<?=$site?>/img/icones/cadenas.png" class="img16 espace-2-2" />

 <?php
 }
 $topic['forum'] = $forum['id'];
 ?>
<?=titlesystem($topic)?>
   
 </a>
 
 </li>     
 

<?php
if($comment=="true"){
		$topm = $db->query("SELECT * FROM topicm where topic = '".$topic['id']."' && text LIKE '%".$se."%'")->fetch(PDO::FETCH_ASSOC);
		$pg = sirabul($topm['id'],1);
		$sira = sirabul($topm['id']);
	
?>

 <li>
 <span class="divider"> / </span>
 </li> 
 
 <li>
 <a class="numero-message" href="<?=$site?>/topic?f=<?=$forum['id']?>&t=<?=$topic['id']?>&p=<?=$pg?>#m<?=$sira?>">#<?=$sira?></a>
 </li>  
 
 </ul> 
 </div> 
 </td> 
 </tr>  
 
 <tr> 
 <td> 
 <div class="cadre message-resultat-recherche cadre-message-recherche"  style="padding:10px;"> 
 <span class="element-resultat-recherche">
 <a class="lien-blanc" href="<?=$site?>/topic?f=<?=$forum['id']?>&t=<?=$topic['id']?>&p=<?=$pg?>#m<?=$topm['id']?>"><?=tfmdil('Message')?></a>
 </span> :   
 <br> <br>

 <div class="tab-content">
	<?=bbcode($topm['text'])?>
 </div>   

<?=poll($topm['id'])?>
 
 </div>
 
 <?php
	}
 ?>


 
 </td> 
 </tr>  
 
 <tr> 
 <td>
 <div class="date-resultat-recherche">
 <span class="texte-date"><span><?=toptarih($row['date'])?></span></span>  , <?=isim($kisi['Username'].$kisi['Tag'],"o")?>
 </div> 
 </td> 
 </tr> 
 </table> 
 </div> 
 </div> 
 </div>  
 
<?php
}
}
}
?>



<?php
}else{

?>
<div class="row"> 
 <div class="span12"> 
 <div class="cadre cadre-defaut ltr">
 <table class="table-datatable table-cadre table-cadre-centree table-striped"> 
 <thead> 
 <tr> 
 <th>
 </th>
 <th>
 </th>
 <th><?=tfmdil('texte.nom')?></th> 
 </tr> 
 </thead>
 <tbody>   
<?php
foreach($search as $row){

if($te==1){
	$isim = $row['Username'].$row['Tag'];
	$lang = $row['Langue'];
	$avatar = getavatar($row);
	$type="s";
	$ide = null;
	$typs="avatars";

}

if($te==2){
	$ide = $row['Code'];

	$tt = $db->query("SELECT * FROM profilestribe where tribe = '".$ide."'")->fetch(PDO::FETCH_ASSOC);

	$isim = $row['Name'];
	$lang = $tt['lang'];
	$avatar = $tt['avatar'];
	$type="tribe";
	$typs="tribes";
}

?>

  <tr role="row" class="odd"> 
  
 <td class="sorting_1">
  <?php
 if(!empty($avatar)){
 ?>
 <img src="<?=$site?>/img/<?=$typs?>/<?=$avatar?>" class="element-composant-auteur img50" alt="">
   <?php
}
 ?>
 </td>

 <td data-search="<?=strtolower($lang)?>"><img src="<?=$site?>/img/pays/<?=$lang?>.png" class="img16 espace-2-2"></td> 

 
 <td class="table-cadre-cellule-principale">
<!--<span class="cadre-type-auteur-joueur pointer" onclick='window.location.assign("<?=$site?>/tribe?tr=<?=$ide?>")'> <?=$isim?></span> -->
<?=isim($isim,$type,$ide)?>

 </td> 
  </tr> 
  
 <?php
 }
 ?>
 
   </tbody>
 </table>
 </div>   
 </div> 
 </div> 
 
 <?php
}
 ?>
 

 </div>  


<?php
}
?>

<div id="popup_recherche" class="modal hide fade ltr popup-recherche in" aria-hidden="false" style="display: none;">
 <form action="search" class="form-horizontal" method="GET" id="search" autocomplete="off">
 <div class="modal-header">
 <a class="close" data-dismiss="modal">&times;</a>
 <h3>
<?=tfmdil('texte.recherche')?></h3>
 </div>
 <div class="modal-body">
 <div class="control-group">
 <label class="control-label ">
<?=tfmdil('Rechercher')?></label>
 <div class="controls ">
 
 <label class="radio "> 
 <input type="radio" name="te" id="op_3" value="3" checked="" onclick="control_option();">Mesaj veya konu </label>
 
  <label class="radio ">
 <input type="radio" name="te" id="op_1" onclick="control_option();" value="1">
<?=tfmdil('texte.joueur')?> </label>
 <label class="radio ">
 <input type="radio" name="te" id="op_2" onclick="control_option();" value="2">
<?=tfmdil('menu.contextuel.joueur.tribu')?> </label>
  </div>
 </div>
 <div class="control-group">
 <label class="control-label " for="se">
<?=tfmdil('texte.recherche')?></label>
 <div class="controls ">
 <input type="text" id="se" name="se" class="input-large" value="" autocomplete="on">
 </div>
 </div>



<div id="composant_recherche_forum" class=""> 
 <div class="control-group"> 
 <label class="control-label "> 
Neyde?</label> 
 <div class="controls" id="control_gege" onchange="control_option(2);"> 
 
 <label class="checkbox"> 
 <input type="checkbox" name="comment" id="_comment" value="true" checked=""> 
Yorumlarda 
</label> 

<label class="checkbox"> 
 <input type="checkbox" name="subject_name" id="_subject_name" value="true"> 
Konu adlarında 
</label>

 </div> 
 </div> 
 <div class="control-group"> 
 <label class="control-label " for="pr"> 
<?=tfmdil('Pseudo')?>
</label> 
 <div class="controls "> 
 <input type="text" id="pr" name="pr" class="input-large" value="" autocomplete="on"> 
 </div> 
 </div> 
 
 <div class="control-group"> 
 <label class="control-label " for="f"> 
<?=tfmdil('Forum')?></label> 
 <div class="controls "> 
 
 <?php
 $forums = $db->query("SELECT * FROM forums where sub_section = '' ")->fetchAll(PDO::FETCH_ASSOC);
 $sad = 0;
 
 foreach($forums as $row){
	 $sad++;
	 ?>
<label class="radio"> 
<input type="radio" name="f" value="<?=$row['id']?>" <?php echo $sad==1 ? "checked" : "" ?>> 
<img src="<?=$site?>/img/sections/<?=$row['icon']?>.png" class="img16 espace-2-2"> 
  <?=$row['title']?>
</label> 
	 <?php
 }
 ?>


 </div> 
 </div> 
 
 <div class="control-group"> 
 <label class="control-label " for="c"> 
	<?=tfmdil('texte.communaute')?>
 </label> 
 
 <div class="controls "> 
 <label class="radio"> 
<input type="radio" name="c" value="" checked=""> 
<?=tfmdil('Communaute')?>
</label> 

<?php
foreach($dilrs as $key => $val){
?>
	<label class="radio"> 
<input type="radio" name="c" value="<?=$key?>"> 
<img src="<?=$site?>/img/pays/<?=$key?>.png" class="img16 espace-2-2"> 
  <?=dilr($key)?>
</label> 
<?php	
}
?>


 </div> 
 </div> 
    
   </div> 

 </div>
 <div class="modal-footer">
 <input type="submit" class="btn btn-post" value="<?=tfmdil('bouton.valider')?>">

 </div>
  </form>
</div>

<?php
if($onay==0){
?>

<script type="text/javascript">
	function init() {
		jQuery('#popup_recherche').modal('show');		
	}
</script> 


<?php
}
?>
 </div>

	<script>
		var te = "<?=$te?>";
		if(te==""){
			te = 3;
		}
		$("#op_"+te).attr("checked","");
		
		function control_option(mode=1){
			if(mode==1){
				var op = $('#op_3').is(':checked');
				//alert(op);

				if(op == false){
					$('#composant_recherche_forum').addClass("hidden");
				}else{
					$('#composant_recherche_forum').removeClass("hidden");
				}
			}else if(mode==2){
				
				var kontrol = $('#control_gege [checked=""]').is(':checked');
				//alert(kontrol);
				if(kontrol == false){
					
					$('#_comment').prop("checked");					
				}
			
				
			}
			
			
			
		}
		
		
		control_option();
	</script>
<?php
include("footer.php");
?>