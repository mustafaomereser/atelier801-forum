<?php
include("linkaccess.php");

$d404 = @$_GET['d404'];

$urlArray = $_SERVER['REQUEST_URI'];
$link_php = explode('?',$urlArray);
$link_php = strtok(str_replace("/","",$link_php[0]),".");
$page = @$_GET['p'];
if(empty($page)){
$page = 1 ; 
}

if(($link_php == "forums" || $link_php == "favorite-topics" || $link_php == "favorite-tribes" || strstr($link_php,"tribe")  || $link_php == "profile" || $link_php == "friends" || $link_php == "blacklist" || $link_php == "posts" || $link_php == "topics-started" || $link_php == "section" || $link_php == "topic" || $link_php == "conversations" || $link_php == "conversation"  || $link_php == "new-dialog" || $link_php == "new-discussion" || $link_php == "new-private-poll" || $link_php == "dev-tracker" || $link_php == "ranking" || $link_php == "search") && $d404==0){
	$smenu=1;
}else{
	$smenu = 0;
}
if(strstr($link_php, "panel")){
	$smenu = 1;
	echo "<script>active('navbar_panel')</script>";
}

if($smenu==1){
	$kadi = $_GET['pr'];
	$kadi = rpc(urlencode($kadi));

	$kname = explode("#",$kadi);
	$klink = cpr($kname[0]).'%23'.$kname[1];
	
	if(!empty($kname[1])){
	$kname[1] = "#".$kname[1];
	}
	
	$pr = $db->query("SELECT * FROM users where Username = '".$kname[0]."' and Tag = '".$kname[1]."'")->fetch(PDO::FETCH_ASSOC);
	$kabileid = $_GET['tr'];
	$tribe = $db->query("SELECT * FROM tribe where Code = '".$kabileid."'")->fetch(PDO::FETCH_ASSOC);
	$tribet = $db->query("SELECT avatar FROM profilestribe where tribe = '".$kabileid."'")->fetch(PDO::FETCH_ASSOC);

	$third_php = explode("-",$link_php);
	if($third_php[1] == "members"){
		$members = explode(",",$tribe['Members']);
		$member_count = count($members);
		$page_count = ceil($member_count / 30);
	}elseif($third_php[1] == "history"){
		$tribe_events = explode("|",$tribe['History']);
		$event_count = count($tribe_events);
		$page_count = ceil($event_count / 100);
	}elseif($link_php == "section" || $link_php == "topic"){
		$forumid = $_GET['f'];
		$trb = $_GET['tr'];
		if(!empty($trb)){
			$forumid = 1;
		}
		$sectionid = $_GET['s'];	
		$topicid = $_GET['t'];
		$topic = $db->query("SELECT * FROM topic where id = '".$topicid."'")->fetch(PDO::FETCH_ASSOC);
		if(empty($sectionid)){
			$section = $db->query("SELECT * FROM section where id = '".$topic['section']."'")->fetch(PDO::FETCH_ASSOC);	
		}else{
			$section = $db->query("SELECT * FROM section where id = '".$sectionid."'")->fetch(PDO::FETCH_ASSOC);	
		}
		
		$forum = $db->query("SELECT * FROM forums where id = '".$forumid."'")->fetch(PDO::FETCH_ASSOC);	
	
		if(empty($section['tribe'])){
			$y_lnk = "f=".$forum['id'];
		}else{
			$y_lnk = "tr=".$section['tribe'];
		}
		
	if($link_php == "topic"){
		$section = $db->query("SELECT * FROM section where forum = '".$forumid."' and id = '".$topic['section']."'")->fetch(PDO::FETCH_ASSOC);	
	}

}elseif($link_php == "conversations"){
		$location = $_GET['location'];
	if(empty($location)){
		$location = 1 ;
	}	
}	



?>
					<script type="text/javascript">

								function ajouter(element, event) {
									if (!estNull(event) && !estNull(event.keyCode)) {
										if (event.keyCode != 13) { // ENTREE
											// Ne rien faire
											return true;
										}
									}
//									jQuery("#form_ajout_ami").submit();
									submitEtDesactive(element);
									return false;
								}
							</script>
							
			
							
							
<div class="container-fluid menu-secondaire" id="seconder_menu">
  <div class="row-fluid">
 <div class="span12">
    
		<?php
	if($link_php == "forums" || $link_php == "favorite-topics" || $link_php == "favorite-tribes"){
		if($link_php == "favorite-topics"){
			if(!empty($uye['id'])){
	?>
 <a class="btn bouton-barre-navigation" data-toggle="button" onclick="toutSelectionnerOuDeselectionner(this,'<?=$plang['tumunu_sec']?>', '<?=$plang['tumunu_sec_kaldir']?>');">
 
 <img src="<?=$site?>/img/icones/16/selection.png" class="img16 espace-2-2">
 <span class="hidden-phone hidden-tablet">
 <?=$plang['tumunu_sec']?>
 </span>
 </a>
 <button class="btn bouton-barre-navigation bouton-selection" onclick="document.getElementById('favorite_topics').submit();">
 <?=tfmdil('bouton.supprimer')?>
 </button>	
 
	<?php
	}
   }
	?>
	 <div class="groupe-boutons-barre-gauche ltr">
 <div class="btn-group">
 <?php
 	if(!empty($uye['id'])){
 ?>
  <a class="btn btn-inverse btn-serre" id="favorite-topics" href="<?=$site?>/favorite-topics" title="<?=$plang['favorite_topics']?>">
<img src="<?=$site?>/img/icones/16/topic-favori.png" class="espace-2-2 img16">
</a>
 <a class="btn btn-inverse btn-serre" id="favorite-tribes" href="<?=$site?>/favorite-tribes" title="<?=$plang['favorite_tribes']?>">
<img src="<?=$site?>/img/icones/16/tribe-favori.png" class="espace-2-2 img16">
</a>
<?php
}
?>

  <a class="btn btn-inverse btn-serre" id="forums" href="<?=$site?>/forums">
<img src="<?=$site?>/img/icones/16/1historique-posts2.png" class="img16 espace-2-2" alt="">
</a>
 </div>
 </div>
 
 <div class="groupe-boutons-barre-gauche hidden-desktop ltr ">
 <div class="btn-group">
 <a class="btn btn-serre" data-toggle="modal" data-target="#popup_choix_communaute">
<img src="<?=$site?>/img/pays/xx.png" class="espace-2-2 img16">
</a>
 </div>
 </div>
 
<?php
$fil = "diller/";

$fil = file_ex($fil);

$dosya = glob($fil."*");
$dosyac = count($dosya);
$diller = array();

for($x=0;$x<$dosyac;$x++) {
	
if($dosya[$x]!=$fil."index.php"){
    $reps = str_replace($fil,"",$dosya[$x]); 
    $dosyae = strtoupper(str_replace(".php","",$reps));
	$diller[$dosyae] = strtolower($dosyae); 
}
}

?>
 
 <div class="groupe-boutons-barre-gauche hidden-phone hidden-tablet ltr ">
 <div class="btn-group">
 <?php
 foreach($diller as $row){
 ?>
<a class="btn btn-inverse btn-serre" id="langbar_<?=$row?>" href="<?=$site?>/forums?c=<?=$row?>" title="<?=dilr($row)?>">
<img src="<?=$site?>/img/pays/<?=$row?>.png" class="img16 espace-2-2">
</a>
 <?php
 }
 ?>
 </div>
 </div>
 
 
<div class="modal hide fade ltr" id="popup_choix_communaute" aria-hidden="true" style="display: none;">

<div class="modal-header">
<a class="close" data-dismiss="modal">×</a>
<h3><?=tfmdil('Communaute')?></h3>
</div>
<div class="modal-body">


 <?php
 foreach($diller as $row){
 ?>
<a class="btn btn-inverse btn-serre bouton-langue" href="<?=$site?>/forums?c=<?=$row?>" title="<?=dilr($row)?>">
<img src="<?=$site?>/img/pays/<?=$row?>.png" class="img16 espace-2-2">
</a>
 <?php
 }
 ?>



</div>
<div class="modal-footer"> <a class="btn" data-dismiss="modal"><?=tfmdil('Fermer')?></a> </div>
</div>
 
 
 
  <?php
 if(($yetkim>=10 || $op>=1) && $link_php=='forums'){
	
 ?>
 <button onclick='window.location.assign("<?=$site?>/new-forums?f=<?=$row['id']?>");' class="btn">
	<?=$plang['new_forum']?>
 </button>
 
 <?php
}
 ?>
  <div class="groupe-boutons-barre-droite "> 
 <button type="button" class="btn" onclick="jQuery('#popup_filtrage_affichage').modal('show');"> 
 <img src="<?=$site?>/img/icones/16/filtre.png" class="espace-2-2"> 
	<span class="hidden-phone hidden-tablet"> 
		<?=$plang['filter_forum'] ?? tfmdil('text.filter')?>
	</span> 
 </button> 
 </div> 
	<?php
	}elseif($third_php[0] == "tribe"){
		
		if(!empty($tribe['Code'])){
		
		$favs = $db->query("SELECT * FROM favorites where player = '".$uye['id']."' and data = '".$kabileid."' and mode = '2'")->fetch(PDO::FETCH_ASSOC);


		if(empty($favs['id'])){
		$favtext = $plang["add_favoritetopic"];
		$favimg = "favori";
		}else{
		$favtext = $plang["delete_favoritetopic"];
		$favimg = "favori2";
		}

		$favorite = $_GET['favorite'];
		if(!empty($favorite)){
		
		if(!empty($uye['id'])){

		if(empty($favs['id'])){
		$fav = $db->exec("INSERT INTO favorites (player,data,mode) values ('".$uye['id']."','".$favorite."','2')");
		}else{
		$fav = $db->exec("DELETE from favorites where player = '".$uye['id']."' and data = '".$favorite."' and mode = '2'");
		}
				yenile(0,1,"?tr=".$kabileid);
				exit();

		}else{
				popupn(tfmdil('texte.resultat.auteurInvalide'));

		}
		
		}
		
	?>


<ul class="barre-navigation  ltr">
  <li>
	  <a href="<?=$site?>/search" class="">
			<?=$plang['tribes']?>
	  </a>
  </li>
<li>
<span class="divider">
 / </span>
  </li>
  <li>
           <a href="<?=$site?>/tribe?tr=<?=$kabileid?>" class=" active">
<?php
		if(!empty($favs['id'])){

?>		   
<img src="<?=$site?>/img/icones/16/favori.png" class="espace-2-2 img16" alt="">
<?php
		}
?>
  <?php
  if(!empty($tribet['avatar'])){
  ?>
<img src="<?=$site?>/img/tribes/<?=$tribet['avatar']?>" class="espace-2-2 img16" alt="">
  
  <?php
  }
  ?>

<?=$tribe['Name']?>                              
</a>
  </li>
  </ul>
   <div class="groupe-boutons-barre-gauche " bis_skin_checked="1">
 <form id="favori_0_<?=$kabileid?>_9" class="hidden" action="<?=$site?>/add-favourite" method="POST" autocomplete="off">
 <input type="hidden" name="f" value="0">
 <input type="hidden" name="ie" value="<?=$kabileid?>">
 <input type="hidden" name="te" value="9">
 </form>
<a class="btn" href="?tr=<?=$kabileid?>&favorite=<?=$kabileid?>">
<img src="<?=$site?>/img/icones/16/<?=$favimg?>.png" class="espace-2-2 img16">
<span class="hidden-phone hidden-tablet">
<?=$favtext?>
</span>
</a>
</div>



<?php
if($third_php[1] == "history" || $third_php[1] == "members"){
?>
 <div class="groupe-boutons-barre-droite  ltr" bis_skin_checked="1">
 <input type="hidden" name="tr" value="<?=$site?>">

<?=pagecreate("history",$page_count)?>

<?php
}else{
?>
<div class="groupe-boutons-barre-droite  ltr" bis_skin_checked="1">
<?php
}
?>
 <div class="btn-group " bis_skin_checked="1">
<a class="btn btn-inverse ltr" id="tribe" href="<?=$site?>/tribe?tr=<?=$kabileid?>">
<img src="<?=$site?>/img/icones/16/1tribu.png" class="espace-2-2" alt="">
<span class="hidden-phone hidden-tablet">
<?=tfmdil('Profil')?></span>
</a>
 <a class="btn btn-inverse ltr" id="tribe-forum" href="<?=$site?>/tribe-forum?tr=<?=$kabileid?>">
<img src="<?=$site?>/img/icones/16/topic.png" class="img16 espace-2-2" alt="">
<span class="hidden-phone hidden-tablet">
<?=tfmdil('Forum')?></span>
</a>
 <a class="btn btn-inverse  ltr" id="tribe-members" href="<?=$site?>/tribe-members?tr=<?=$kabileid?>">
<img src="<?=$site?>/img/icones/16/1tribu-membres.png" class="espace-2-2" alt="">
<span class="hidden-phone hidden-tablet">
<?=tfmdil('interface.tribu.titre.membres')?></span>
</a>
<a class="btn btn-inverse  ltr" id="tribe-history" href="<?=$site?>/tribe-history?tr=<?=$kabileid?>">
<img src="<?=$site?>/img/icones/16/1tribu-activite.png" class="espace-2-2" alt="">
<span class="hidden-phone hidden-tablet">
<?=tfmdil('interface.tribu.bouton.historique')?></span>
</a>
     </div>
   </div>
   
<?php

}else{
	
}

}elseif(($link_php == "profile" || $link_php == "friends" || $link_php == "blacklist" || $link_php == "posts" || $link_php == "topics-started") && !empty($pr['PlayerID'])){
		
?>
<ul class="barre-navigation  ltr">
  <li>
	<a href="<?=$site?>/search" class=" ">
		<?=$plang['profiles']?>
	</a>
  </li>
<li>
<span class="divider">
 / </span>
  </li>
  <li>
  <a href="<?=$site?>/profile?pr=<?=$klink?>" class=" active">
		 <?php
	 if(!empty(getavatar($pr))){
	 ?>
		<img src="<?=$site?>/img/avatars/<?=getavatar($pr)?>" class="espace-2-2 img16" alt="">
	 <?php
	 }
	 ?>
	
	<?=$kname[0]?>
  </a>
  </li>
  </ul>
  
 <?php 
 if(($link_php == "friends" || $link_php == "blacklist") && $pr['PlayerID']==$uye['id']){
 
 $isim = htmlspecialchars(trim($_GET['isim']));
 $ism = $db->query("SELECT * FROM users where Username = '".$isim."'")->fetch(PDO::FETCH_ASSOC);

 $scnek = array("FriendsList","IgnoredsList");
 if($link_php == "friends"){
	 $tablo = $scnek[0];
	 $tablo_k = $scnek[1];
	 $vas = "friendsList";
 }else{
	 $tablo = $scnek[1];
	 $tablo_k = $scnek[0];
	 	 $vas = "ignoredsList";


 }

 
if(!empty($ism['PlayerID']) && $uye['id']!=$ism['PlayerID']){
if(!strstr($uye[$tablo],$ism['PlayerID']) && !strstr($uye[$tablo_k],$ism['PlayerID'])){
	
$listeson = ltrim($uye[$tablo].",".$ism['PlayerID'],",");

$db->query("UPDATE users set ".$tablo." = '".$listeson."' where PlayerID = '".$uye['PlayerID']."'");

    socket("data|".$uye['id']."|".$vas."|".$listeson."");


}

 }else{
	 //popupn(tfmdil('Joueur_Existe_Pas'));
 }

 
 ?> 
  <div class="groupe-boutons-barre-droite ltr" bis_skin_checked="1">
    
   <div class="btn-group input-append" bis_skin_checked="1">
 <form method="GET" autocomplete="on">
     <input type="hidden" name="pr" value="<?=$kadi?>">

 <input id="nom" name="isim" class="input-medium" type="text" placeholder="<?=tfmdil('texte.nom')?>">
 <button class="btn" type="submit">
<?=tfmdil('bouton.ajouter')?>
</button>
 </form>
 
 </div> 
 <?php 
 }else{
 ?> 
  <div class="groupe-boutons-barre-droite ltr " bis_skin_checked="1">
<?php
 }
 ?> 
       <div class="btn-group" bis_skin_checked="1">
    <a class="btn btn-inverse ltr" id="profile" href="<?=$site?>/profile?pr=<?=$klink?>">
<img src="<?=$site?>/img/icones/16/1profil.png" class="espace-2-2" alt="">
<span class="hidden-phone hidden-tablet">
<?=tfmdil('Profil')?></span>
</a>
<?php
if($pr['PlayerID']==$uye['id']){
?>

  <a class="btn btn-inverse ltr" id="friends" href="<?=$site?>/friends?pr=<?=$klink?>">
<img src="<?=$site?>/img/icones/16/1ami1.png" class="espace-2-2" alt="">
<span class="hidden-phone hidden-tablet">
<?=$plang['my_friends']?></span>
</a>
 <a class="btn btn-inverse ltr" id="blacklist" href="<?=$site?>/blacklist?pr=<?=$klink?>">
<img src="<?=$site?>/img/icones/16/1liste-noire.png" class="espace-2-2" alt="">
<span class="hidden-phone hidden-tablet">
<?=$plang['blacklist']?></span>
</a>
<?php
}
?>

<a class="btn btn-inverse ltr" id="posts" href="<?=$site?>/posts?pr=<?=$klink?>">
<img src="<?=$site?>/img/icones/16/1historique-posts2.png" class="espace-2-2" alt="">
<span class="hidden-phone hidden-tablet">
<?=$plang['last_posts']?></span>
</a>
 <a class="btn btn-inverse ltr" id="topics-started" href="<?=$site?>/topics-started?pr=<?=$klink?>">
<img src="<?=$site?>/img/icones/16/topic.png" class="espace-2-2" alt="">
<span class="hidden-phone hidden-tablet">
<?=$plang['started_topics']?></span>
</a>
     </div>
   </div>
 
  
<?php
}elseif($link_php == "section" || $link_php == "topic"){	
?>


<ul class="barre-navigation  ltr">
<li>
   <a href="<?=$site?>/forums" class="">
		<?=$plang['forums']?>
   </a>
  </li>
  


  <?php 
 if($forum['sub_section']!=''){
	
	 $subsec = $db->query("SELECT * FROM section where id = '".$forum['sub_section']."'")->fetch(PDO::FETCH_ASSOC);
	 $sub_forum = $db->query("SELECT title,icon,id,sub_section FROM forums where id = '".$subsec['forum']."'")->fetch(PDO::FETCH_ASSOC);
	 
	 if(empty($sub_forum['sub_section'])){
		$asd = "forums";
	 }else{
		$asd = "section?f=".$sub_forum['id']."&s=".$subsec['id']; 
	 }
	 ?>
	 
	
	 
	 <li>
<span class="divider">
 / 
 </span>
  </li>
 
    <li>
 <a href="<?=$site?>/<?=$asd?>" class="">
 <?php
 if(!empty($sub_forum['icon'])){
 ?>
	<img src="<?=$site?>/img/sections/<?=$sub_forum['icon']?>.png" alt="" class="espace-2-2 img16">
 <?php
 }
 ?>
<?=$sub_forum['title'] ?? $plang['not_found']?>
 </a>

  </li>
	 
	 
	 	 <li>
<span class="divider">
 / 
 </span>
  </li>
  <li>

<a href="<?=$site?>/section?f=<?=$sub_forum['id']?>&s=<?=$subsec['id']?>" class=" active">
  <?php
  if(!empty($subsec['title'])){
  ?>
<img src="<?=$site?>/img/sections/<?=$subsec['icon']?>.png" class="img16 espace-2-2">
<img src="<?=$site?>/img/pays/<?=$subsec['lang']?>.png" class="img16 espace-2-2">
<?php
  }
?>
 <?=$subsec['title'] ?? $plang['not_found']?>                               
 </a>

  </li>
	 
	 <?php
	 
	 
 }
 ?>
 

  <?php
  	 if(empty($forum['sub_section'])){
		$asd = "forums";
  ?>
   <li>
<span class="divider">
 / 
 </span>
  </li>
  <li> 
 <a href="<?=$site?>/<?=$asd?>" class="">
   <?php
   
   if(empty($section['tribe'])){
	   $f_title = $forum['title'] ?? $plang['not_found'];
	   $f_avatar = "sections/".$forum['icon'].".png";
   }else{
	   $tribeforum = $db->query("SELECT * FROM tribe where Code = '".$section['tribe']."'")->fetch(PDO::FETCH_ASSOC);
	   $p_t = $db->query("SELECT * FROM profilestribe where tribe = '".$tribeforum['Code']."'")->fetch(PDO::FETCH_ASSOC);

	   $f_title = $tribeforum['Name'] ?? $plang['not_found'];
	   $f_avatar = "tribes/".$p_t['avatar'];
	}
   
   
  if(!empty($section['title'])){
  ?>
 <img src="<?=$site?>/img/<?=$f_avatar?>" alt="" class="espace-2-2 img16">
   <?php
  }
  ?>
	<?=$f_title?>
 </a>
 <?php
 	 }else{
		 
		
		 
		$asd = "section?".$y_lnk."&s=".$section['id']; 
	 }
 ?>
 
  </li>


<li>
<span class="divider">
 / </span>
  </li>
  <li>

<a href="<?=$site?>/section?<?=$y_lnk?>&s=<?=$section['id']?>" class=" active">
  <?php
  if(!empty($section['title'])){
  ?>
<img src="<?=$site?>/img/sections/<?=$section['icon']?>.png" class="img16 espace-2-2">

<?php
if(empty($section['tribe'])){
?>
	<img src="<?=$site?>/img/pays/<?=$section['lang']?>.png" class="img16 espace-2-2">
<?php
}
?>

<?php
  }
?>
 <?=$section['title'] ?? $plang['not_found']?>                               
 </a>

  </li>



 <?php 

 if($link_php == "topic"){ 
 ?>
  <li>
<span class="divider">
 / </span>
  </li>
  <li>


<?php
$favs = $db->query("SELECT * FROM favorites where player = '".$uye['id']."' and data = '".$topic['id']."' and mode = '1'")->fetch(PDO::FETCH_ASSOC);

topicicon($topic,null,$favs);
?>


<?php
if(!empty($topic['id'])){
	if(empty($forum['id'])){
		//popupn(tfmdil('texte.resultat.interdit'),1,null,$site."/forums");
		//_exit();
	}
}
$topic['forum'] = $forum['id'];
?>
<?=titlesystem($topic,1,$section['tribe'])?>                                   

</li>

<?php
 }
?>

  </ul>
  
   <?php
   if($link_php == "section" && !empty($uye['id'])){
	?>

	
<div class="groupe-boutons-barre-gauche ltr " bis_skin_checked="1">

<?php
if($section['locked']<=0 || $yetkim>=10){	
?>
<a href="<?=$site?>/new-topic?<?=$y_lnk?>&s=<?=$_GET['s']?>" class="btn bouton-barre-navigation">
<img src="<?=$site?>/img/icones/bulle-pointillets.png" class="img16 espace-2-2">
<span class="hidden-phone hidden-tablet">
<?=$plang['new_topic']?></span>
</a>
 <a href="<?=$site?>/new-forum-poll?<?=$y_lnk?>&s=<?=$_GET['s']?>" class="btn bouton-barre-navigation">
<img src="<?=$site?>/img/icones/sondage.png" class="img16 espace-2-2">
<span class="hidden-phone hidden-tablet">
<?=$plang['new_forum_poll']?></span>
</a>
<?php
}
?>

<?php
	if(!empty($section['tribe'])){
		if($section['tribe']==$uye['TribeCode'] && !empty($t_rank['10'])){
			$tribe_yetkili = 1;
		}
		$g = "t=".$section['tribe'];
	}else{
		$g = "f=".$_GET['f'];
	}

if(($yetkim>=10 || $op>=1) || $tribe_yetkili==1){
?>
<a href="<?=$site?>/new-section?editsection=<?=$_GET['s']?>&<?=$g?>" class="btn bouton-barre-navigation">
	<span class="hidden-phone hidden-tablet">
		<?=$plang['edit_section']?>
	</span>
</a>
<?php
}
?>
   </div>
   
    <div class="groupe-boutons-barre-droite ltr " bis_skin_checked="1">
           <?=pagecreate("section")?>
  </div>
   
   <?php
   }else{
	   ?>
	   
  <div class="groupe-boutons-barre-droite ltr " bis_skin_checked="1">
           <?=pagecreate("topic")?>
  </div>
	   
	   <?php
   }
   ?>
   

<?php
}elseif($link_php == "conversations" || $link_php == "conversation" || $link_php == "new-dialog" || $link_php == "new-discussion" || $link_php == "new-private-poll"){
?>

<ul class="barre-navigation  ltr">
<li>
<a href="<?=$site?>/conversations" class=" active">
<img src="<?=$site?>/img/icones/16/messagerie1.png" class="espace-2-2 img16">
<?=$plang['Inbox']?>                         </a>
</li>
 <?php
if($link_php == "conversation"){
?>	
<li>
<span class="divider">
 / </span>
</li>
<li>
<?php
$co = $_GET['co'];
?>
<a href="<?=$site?>/conversation?co=<?=$co?>" class=" active">
<img src="<?=$site?>/img/icones/16/enveloppe.png" alt="" class="espace-2-2 img16">
<?php
$d = $db->query("SELECT title FROM conversations where hash = '".$co."' order by id DESC LIMIT 0,1")->fetch(PDO::FETCH_ASSOC);
?>

<?=$d['title']?>
 </a>
  </li>
<?php
}
?>


</ul>

   
 <?php
if($link_php == "conversations"){
if($location == 1){
?>  
<div class="groupe-boutons-barre-gauche ltr " bis_skin_checked="1">
<a href="<?=$site?>/new-dialog" class="btn bouton-barre-navigation ">
<img src="<?=$site?>/img/icones/16/enveloppe.png" class="espace-2-2" alt="">
<span class="hidden-phone hidden-tablet">
<?=$plang['new_dialog']?></span>
</a>
<!--
<a href="<?=$site?>/new-discussion" class="btn bouton-barre-navigation ">
<img src="<?=$site?>/img/icones/bulle-pointillets.png" class="espace-2-2 img16" alt="">
<span class="hidden-phone hidden-tablet">
<?=$plang['new_discussion']?></span>
</a>

<a href="<?=$site?>/new-private-poll" class="btn bouton-barre-navigation ">
<img src="<?=$site?>/img/icones/sondage.png" class="espace-2-2 img16" alt="">
<span class="hidden-phone hidden-tablet">
<?=$plang['new_private_poll']?></span>
</a>
-->
<a class="btn bouton-barre-navigation" data-toggle="button" onclick="toutSelectionnerOuDeselectionner(this,'<?=$plang['tumunu_sec']?>', '<?=$plang['tumunu_sec_kaldir']?>');">
<img src="<?=$site?>/img/icones/16/selection.png" class="img16 espace-2-2">
<span class="hidden-phone hidden-tablet">
<?=$plang['tumunu_sec']?></span>
</a>
<button class="btn bouton-barre-navigation bouton-selection_x" onclick="confirmDel();degistir('islem',1);formsubmit('conv_select');">
<?=tfmdil('bouton.supprimer')?>
</button>

<?php
}else{	
?>
<div class="groupe-boutons-barre-gauche ltr " bis_skin_checked="1">
<a class="btn bouton-barre-navigation" data-toggle="button" onclick="toutSelectionnerOuDeselectionner(this,'<?=$plang['tumunu_sec']?>', '<?=$plang['tumunu_sec_kaldir']?>');">
<img src="<?=$site?>/img/icones/16/selection.png" class="img16 espace-2-2">
<span class="hidden-phone hidden-tablet">
<?=$plang['tumunu_sec']?>
</span>
</a>

<a class="btn bouton-barre-navigation" data-toggle="modal" onclick="confirmDel();degistir('islem',2);formsubmit('conv_select');">
<img src="<?=$site?>/img/icones/16/trash-vide.png" class="espace-2-2 img16" alt="">
<span class="hidden-phone hidden-tablet">
<?=$plang['empty_trash']?>
</span>
</a>

<button class="btn bouton-barre-navigation bouton-selection" onclick="degistir('islem',3);formsubmit('conv_select');deplaceConversationsSelectionnees(0);">
<?=tfmdil('bouton.restaurer')?>
</button>
 <button class="btn bouton-barre-navigation bouton-selection" onclick="confirmDel();degistir('islem',4);formsubmit('conv_select');deplaceConversationsSelectionnees(2);">
<?=$plang['delete_permanently']?></button>
<?php
}	
?>
</div>
<?php
}	
?>

<div class="groupe-boutons-barre-droite " bis_skin_checked="1">


<?php
if($link_php == "conversations" || $link_php == "conversation"){
?>
           <?=pagecreate("karisik")?>
<?php
}	
?>



<?php
if($link_php == "conversations"){
	$i = $_GET['location'];
	if($i==1){
		$loc=$link_php;
	}elseif($i==2){
		$lod=$link_php;
	}
	
?>

<div class="btn-group" bis_skin_checked="1">
<a class="btn btn-inverse ltr" id="<?=$loc?>" href="<?=$site?>/conversations?location=1">
<img src="<?=$site?>/img/icones/16/messagerie1.png" class="espace-2-2" alt="">
<span class="hidden-phone hidden-tablet">
<?=$plang['inbox']?></span>
</a>
<a class="btn btn-inverse ltr" id="<?=$lod?>" href="<?=$site?>/conversations?location=2">
<img src="<?=$site?>/img/icones/16/trash-pleine.png" class="espace-2-2" alt="">
<span class="hidden-phone hidden-tablet">
<?=$plang['trash']?></span>
</a>
</div>
</div>
<?php
}else{	
?>
</div>
<?php
}
}elseif($link_php == "ranking"){
?>


<ul class="barre-navigation  ltr">
<li>
<a href="<?=$site?>/ranking" class=" active">
Ranking                       
 </a>
</li>
</ul>


<div class="groupe-boutons-barre-droite ">   


<?=pagecreate("ranking")?>

<div class="btn-group input-prepend input-append">
<form id="form_recherche" action="ranking" class="composant-recherche" method="GET" autocomplete="off">
<input class="input-medium disabled" id="pr" name="pr" type="text" placeholder="<?=$plang['arama']?>" onkeypress="return lancerLaRecherche(event);" value="" autocomplete="on">
<a class="btn" data-toggle="modal" onclick="formsubmit('form_recherche');"><img src="<?=$site?>/img/icones/loupe.png" class="img16" title="<?=$plang['arama']?>"></a>
</form>
</div>

</div>


<?php	
}elseif($link_php == "search"){
?>

<ul class="barre-navigation  ltr">
<li>
<a href="<?=$site?>/search" class=" active">
<?=$plang['arama']?>                        
 </a>
</li>
</ul>

<div class="groupe-boutons-barre-droite ">   


<div class="btn-group input-prepend input-append"> 
 <div class="composant-recherche"> 
<a class="btn" onclick="jQuery('#popup_recherche').modal('show');">
<img src="<?=$site?>/img/icones/roue-dentee.png" class="img16" title="Arama parametreleri">
</a> 
  <input class="input-medium" id="s_se" name="s_se" type="text" placeholder="<?=$plang['arama']?>" value="<?=$_GET['se']?>" autocomplete="on"> 
 <a class="btn" data-toggle="modal" onclick="se();"> 
<img src="<?=$site?>/img/icones/loupe.png" class="img16" title="Ara"> 
</a> 
   </div> 
 </div> 


</div>

<script>
function se(){
	     degistir('se',deger('s_se'));formsubmit('search');
}

$("#s_se").keypress(function( event ) {
  if ( event.which == 13 ) {
	  se();
  }
});

</script>

<?php
}	
?>
  </div>
 </div>
  </div>
  <?php

	}
		?>
		
		

<script id="ae">
active('<?=$link_php?>');
</script>
<script id="ae">
active('navbar_<?=$link_php?>');
</script>
