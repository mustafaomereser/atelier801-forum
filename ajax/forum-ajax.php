<?php
include("../pdoconnect.php");
$veri = $_GET['forum'];
$altbolum = $_GET['alt_bolum'];

$tribe = $_GET['tribe'];

$clist = "";

foreach($_GET['lang'] as $cla){
	$clist .=" || lang='".$cla."'";
}

if(empty($veri) || empty($clist)){
	popup(tfmdil('texte.resultat.inactivite'),1);
	exit();
}else{

function sections($veri="",$sua=0){
	global $clist, $altbolum, $db, $site, $tribe, $json_data;
	$hash = $veri;
	$forum = $db->query("SELECT sub_section FROM forums where id = '".$veri."'")->fetch(PDO::FETCH_ASSOC);
	
	if(empty($tribe)){
		$where_s = "forum = '".$veri."' and tribe = '' and (".ltrim($clist," || ").")";
	}else{
		$where_s = "tribe = '".$tribe."'";
	}
	
	$sections = $db->query("SELECT * FROM section where ".$where_s."")->fetchAll(PDO::FETCH_ASSOC);

 //class="line-striped"
 ${"linestc".$hash}=1;
 $query=0;

 foreach($sections as $rw){
	 $sub_forum = $db->query("SELECT id,sub_section FROM forums where sub_section = '".$rw['id']."'")->fetch(PDO::FETCH_ASSOC);
	 if(empty($rw['tribe'])){
		 $frm_lnks = "f=".$rw['forum'];
	 }else{
		 $frm_lnks = "tr=".$rw['tribe'];
	 }
	 $query++;
	 
	 $last=null;
	 
	 ${"linestc".$hash}++;
		
/* 		
	if($sua>=24){
		${"linestc".$hash}=2;
	} */
 	
	${"linest".$hash} = '';

 if(${"linestc".$hash}>=2	){
	 ${"linestc".$hash}=${"linestc".$hash}-${"linestc".$hash};
	 ${"linest".$hash} = 'class="line-striped"';
 }
	 //echo ${"linestc".$hash}." - ".$sua." - ".${"linest".$hash};

 ?>
  
<table class="table-section">
 <tbody>
<tr <?=${"linest".$hash}?>>
 <td class="table-section-cellule table-cellule-gauche_haut" rowspan="2" colspan="1">

  <div class="" style="margin-left:<?=$sua?>px">
  <a class="cadre-section-titre-mini lien-blanc" href="<?=$site?>/section?<?=$frm_lnks?>&s=<?=$rw['id']?>" title="">
  <?=topicicon($rw)?>
 <img src="<?=$site?>/img/sections/<?=$rw['icon']?>.png" class="img24 espace-2-2">
 <?php
 if(empty($tribe)){
?>
<img src="<?=$site?>/img/pays/<?=$rw['lang']?>.png" class="img16 espace-2-2">
<?php
 }
?>
 <?=$rw['title']?> </a>
 </div>
 </td>
 <td class="table-cadre-cellule-vide">
</td>
 </tr>
 <tr <?=${"linest".$hash}?>>
 <td class="table-section-cellule-bouton-afficher-masquer">
 <?php
 	if(!empty($altbolum) && !empty($sub_forum['id'])){
 ?>
  <script>sub_section('<?=$veri?>_<?=$rw["id"]?>')</script>

 		 <a onclick="sub_section('<?=$veri?>_<?=$rw['id']?>')"> 
			<img src="" alt="" class="espace-2-2 pull-right image-accordeon-section" id="bouton-sous-sections_<?=$veri?>_<?=$rw['id']?>"> 
		 </a> 

	<?php
	}
	?>
  </td>

<?php
$topicl = $db->query("SELECT * FROM topic where section='".$rw['id']."' and locked='0' order by etkilesim DESC")->fetchAll(PDO::FETCH_ASSOC);
foreach($topicl as $tpc){
	if(empty($last['Username'])){
		$topicms =  $db->query("SELECT * FROM topicm where topic='".$tpc['id']."' order by date DESC");
		$topicc = $topicms->rowCount();
		$topicms = $topicms->fetch(PDO::FETCH_ASSOC);
		$topc = $db->query("SELECT * FROM topic where id='".$topicms['topic']."'")->fetch(PDO::FETCH_ASSOC);
		$last = $db->query("SELECT Username,Tag FROM users where PlayerID = '".$topicms['player']."'")->fetch(PDO::FETCH_ASSOC);
	if(!empty($last['Username'])){
		$firstdil = cokludil($topc);
	?>
	
 <td class="table-section-cellule table-cellule-droite_bas ltr" rowspan="2" colspan="1">
  
   <div class="element-sujet pull-left">
   <a class="element-sujet lien-blanc" href="<?=$site?>/topic?<?=$frm_lnks?>&t=<?=$topc['id']?>">
	<span class="cadre-sujet-titre-mini cadre-sujet-titre-sombre">
 <?=topicicon($topc,1)?>
 <?=$firstdil?></span>
</a>
 </div>
 <div class="element-sujet">
 <a class="cadre-sujet-date" href="<?=$site?>/topic?<?=$frm_lnks?>&t=<?=$topc['id']?>"><span class=""><?=toptarih($topicms['date'])?></span>, </a>
	<?=isim($last['Username'].$last['Tag'],"o")?>
 </div>
 </td>	
 
  <td>
    <span class="espace-2-2 pull-right">
	
	   <a class="nombre-messages <?=goruldu_modu($topc['id'], $topicc);?>" href="<?=$site?>/topic?<?=$frm_lnks?>&t=<?=$topc['id']?>">
			<?=$topicc?>
		</a>
	</span>

    </td>

<?php		
}	
}
}

?>

<?php
if(empty($last['Username'])){
?>
 <td class="table-section-cellule table-cellule-droite_bas ltr">
&nbsp;
 </td>
 <td>
 &nbsp;
 </td>
<?php
}
?>
 </tr>
 
 </tbody>
</table>


<?php
if(!empty($altbolum) && !empty($sub_forum['id'])){
?>
<div class="table-sous-sections" id="sous_sections_<?=$veri?>_<?=$rw['id']?>" style="display: none;"> 
<?php
sections($sub_forum['id'],30);
?>

</div> 

<?php
 }
?>

<?php
 }
 ?>
 
 <?php
 //echo $_GET['f'];
 if($query==0 && $forum['sub_section']!='' && empty($_GET['alt_bolum'])){
	echo "<span><center>(".tfmdil('texte.vide').")</center></span>";
 ?>
 
 <?php
 }
 
?>
 
 <?php
 }

sections($veri);


}
?>
