<?php
include("config.php");

$dev=$db->query("SELECT * FROM topicm WHERE devtracker='1'")->fetchAll(PDO::FETCH_ASSOC);



?>
<script>title("<?=$plang['dev_tracker']?>");</script>

<div id="corps" class="corps clear container">

<?php
foreach($dev as $row){
	
		$pg = sirabul($row['id'],1);
		$sira = sirabul($row['id']);
	
	$topic = $db->query("SELECT * FROM topic WHERE id='".$row['topic']."'")->fetch(PDO::FETCH_ASSOC);
	$section = $db->query("SELECT * FROM section WHERE id='".$topic['section']."'")->fetch(PDO::FETCH_ASSOC);
	$forum = $db->query("SELECT * FROM forums WHERE id='".$section['forum']."'")->fetch(PDO::FETCH_ASSOC);
	$kisi = $db->query("SELECT * FROM users WHERE PlayerID='".$row['player']."'")->fetch(PDO::FETCH_ASSOC);

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
 <div class="cadre message-resultat-recherche  cadre-message-recherche"  style="padding:10px;"> 
 <span class="element-resultat-recherche">
 <a class="lien-blanc" href="<?=$site?>/topic?f=<?=$forum['id']?>&t=<?=$topic['id']?>&p=<?=$pg?>#m<?=$row['id']?>"><?=tfmdil('Message')?></a>
 </span> :   
 <br> <br>

 <div class="tab-content">
	<?=bbcode($row['text'])?>
	
 </div>   

<?=poll($row['id'])?>
 
 </div> 
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
?>
	  
	  
 </div>
 <?php
include("footer.php");
?>