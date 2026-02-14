<?php
include("config.php");

$kadi = explode("#",$kadi);
if(!empty($kadi[1])){
$kadi[1] = "#".$kadi[1];
}
$pr = $db->query("SELECT * FROM users where Username = '".$kadi[0]."' and Tag = '".$kadi[1]."'")->fetch(PDO::FETCH_ASSOC);
$id = $pr['PlayerID'];

if(empty($id)){
	popupn(tfmdil('Joueur_Existe_Pas'),1,null,$site."/forums");
	_exit();
}


$page = $_GET['p'];
if(empty($page)){
$page = 1 ; 
}

 
/*$limpost = 5;
$limstart = ($page - 1) * $limpost;
$posts = $db->query("SELECT * FROM topicm where player = '".$id."' order by date DESC limit $limstart,$limpost")->fetch(PDO::FETCH_ASSOC);*/

try{
$posts = $db->query("SELECT * FROM topicm where player = '".$id."' order by date DESC limit 0,16")->fetchAll(PDO::FETCH_ASSOC);
}catch(exception $e){
	echo "<br><span style='color:white;'><center>(".tfmdil('texte.vide').")</center></span><br><br>";

}

?>
 <div id="corps" class="corps clear container" bis_skin_checked="1">
 <?php
 foreach($posts as $post){
$post_topic = $db->query("SELECT * FROM topic where id = '".$post['topic']."'")->fetch(PDO::FETCH_ASSOC);
$post_section = $db->query("SELECT * FROM section where id = '".$post_topic['section']."'")->fetch(PDO::FETCH_ASSOC);
$post_forum =$db->query("SELECT * FROM forums where id = '".$post_section['forum']."'")->fetch(PDO::FETCH_ASSOC);
 ?>
 
 
 <div class="row" bis_skin_checked="1">
 <div class="span12" bis_skin_checked="1">
 <div class="cadre cadre-resultat-recherche ltr" bis_skin_checked="1">
 <table class="table-cadre">
 <tbody>
 
 
<tr>
 <td class="table-cadre-cellule-principale">
 <div class="navigation-resultat-recherche" bis_skin_checked="1">
 <ul class="barre-navigation  ltr navigation-resultat-recherche">
 <li>
<a href="<?=$site?>/forums#f_<?=$post_forum['id']?>">
<img src="<?=$site?>/img/sections/<?=$post_forum['icon']?>.png" alt="" class="espace-2-2 img16">
<?=$post_forum['title']?></a>
</li>
 <li>
<span class="divider">
 / </span>
</li>
 <li>
<a href="<?=$site?>/section?f=<?=$post_forum['id']?>&s=<?=$post_section['id']?>">
<img src="<?=$site?>/img/sections/<?=$post_section['icon']?>.png" alt="" class="espace-2-2 img16">
<img src="<?=$site?>/img/pays/<?=$post_section['lang']?>.png" class="img16 espace-2-2">
 <?=$post_section['title']?></a>
</li>
 <li>
<span class="divider">
 / </span>
</li>
   <li>
   
<?php
      if($post_topic['pinned']==1){
   ?>
   <img src="<?=$site?>/img/icones/postit.png" alt="" class="espace-2-2 img16">
   <?php
   }
   ?>
   
      <?php
   $favor = $db->query("SELECT * FROM favorites WHERE player = '".$id."' and data = '".$post_topic['id']."' and mode = '1' ")->fetch(PDO::FETCH_ASSOC);  
  if(!empty($favor['id'])){
   ?>
   
<img src="<?=$site?>/img/icones/16/favori.png" class="img16 espace-2-2">   

   <?php
   }
   ?>
   
<a href="<?=$site?>/topic?f=<?=$post_forum['id']?>&t=<?=$post_topic['id']?>">

   <?php
   $post_topic['forum'] = $post_forum['id'];
   titlesystem($post_topic,1);
   ?>
   </a>
</li>
<li>
<span class="divider">
 /  </span>
</li>
 <li>
 
 <?php
 $no = sirabul($post['id']);
 ?>
 <!--&p=16#m307-->
<a class="numero-message" href="<?=$site?>/topic?f=<?=$post_forum['id']?>&t=<?=$post_topic['id']?>&p=<?=sirabul($post['id'],1)?>#<?=$no?>">
#<?=$no?>
</a>
</li>
  </ul>
 </div>
 </td>
 </tr>
 
 
  <tr>
 <td>
 <div class="cadre message-resultat-recherche  cadre-message-recherche" style="padding:10px;" bis_skin_checked="1">
 <span class="element-resultat-recherche">
<a class="lien-blanc" href="<?=$site?>/topic?f=<?=$post_forum['id']?>&t=<?=$post_topic['id']?>&p=<?=sirabul($post['id'],1)?>#<?=$no?>">
<?=tfmdil('Message')?></a>
</span>
 :   <br> <br>

 <div class="tab-content">
	<?=bbcode($post['text'])?>
	
 </div>
 
 
<?=poll($post['id'])?>

 </div>
 
 
 </td>
 </tr>
  <tr>
 <td>
 <div class="date-resultat-recherche" bis_skin_checked="1">
<span class="texte-date">
<span class="">
<?=toptarih($post['date'])?></span>
</span>
  , <?=isim($kadi[0].$kadi[1],"o")?>
  </div>
 </td>
 </tr>
 
 
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

include("footer.php");
?>	  
 