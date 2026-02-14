<?php
include("config.php");
 
 $f = $_GET['f'];
 $tr = $_GET['tr'];
 $s = $_GET['s'];
 
 $sc = $db->query("SELECT tribe FROM section where id = '".$s."'")->fetch(PDO::FETCH_ASSOC);

	if(!empty($sc['tribe'])){
		
		 $trib = $db->query("SELECT * FROM tribe where Code = '".$tr."'")->fetch(PDO::FETCH_ASSOC);
		
		if($sc['tribe']==$uye['TribeCode'] && !empty($t_rank['10'])){
			$tribe_yetkili = 1;
		}
		
		if(!empty($f)){
			popupn(tfmdil('texte.resultat.droitsInsuffisants'),1,null,$site."/forums");
			_exit();
		}
		
	}

  if(($yetkim>=8|| $op>=1) || $tribe_yetkili==1){
	$pinned = $_GET['pinned'];
	$locked = $_GET['locked'];
	$delete = $_GET['delete'];

	if($yetkim>=11 || $tribe_yetkili==1){
		
	if(empty($sc['tribe'])){
		 if($_POST){
			 $topictasi = $_POST['topictasi'];
			 $sectionsec =  $_POST['sectionsec'];
			 
			 if((!empty($topictasi) && !empty($sectionsec))){
				 if(empty($sc['tribe'])){
					topic_tasi($topictasi,$sectionsec);
				 }else{
					 popupn(tfmdil('texte.resultat.interdit'));
				 }
			 }	 
		}
	}
			
	if(!empty($delete)){
		$upd = $db->exec("DELETE FROM topic where id = '".$delete."'");

		$upd = $db->exec("DELETE FROM topicm where topic = '".$delete."'");

		if($upd>0){
			geri();
			exit();
		}
	}

}
if(($yetkim>=11 || $tribe_yetkili==1)){
	if(!empty($pinned)){
		$id = $pinned;
		$durum = "pinned";
		$islemonay = 1;

	}elseif(!empty($locked)){
		$id = $locked;
		
		$durum = "locked";

		$islemonay = 1;
	}
}
	if(!empty($durum) && $islemonay==1){
		popupn($plang['loading']);

		$tropic = $db->query("SELECT locked,pinned FROM topic where id = '".$id."'")->fetch(PDO::FETCH_ASSOC);
		
		if($tropic[$durum]==1){
			$veri = 0;
		}else{
			$veri = 1;
		}


		$upd = $db->exec("UPDATE topic set ".$durum." = '".$veri."' where id = '".$id."'");
		if($upd>0){
			geri();
			exit();
		}
	}
	
	
}
 
 
 if(!empty($s)){
	$sectest = $db->query("SELECT id,forum,lang,title,tribe FROM section where id = '".$s."'")->fetch(PDO::FETCH_ASSOC);
 
 
	if($yetkim>=9){
		
	}else{
		if(!empty($sectest['tribe'])){
			if($sectest['tribe']!=$uye['TribeCode']){
				popupn(tfmdil('texte.resultat.droitsInsuffisants'),1,null,$site."/forums");
				_exit();
			}
		}
	}
 
	$forum = $db->query("SELECT * FROM forums where id = '".$sectest['forum']."'")->fetch(PDO::FETCH_ASSOC);
 
 //echo $forum['priv']." - ".$yetkim;
 //echo forum_yetki_kontrol($forum['priv']);
 if(forum_yetki_kontrol($forum['priv'])!=1 || ($forum['id']!=$f && empty($tr))){
		popupn(tfmdil('texte.resultat.interdit'),1,null,$site."/forums");
		_exit();
 }
 
	
	
	
	 if(!empty($sectest['id'])){
		$onaysec=1;	 
	 }else{
		$onaysec=0;
	 }
 
 }
 
 if((!empty($f) || (!empty($tr) && $trib['Code']==$uye['TribeCode'])) && !empty($s) && $onaysec == 1){
	 
 }else{
	 popupn("Geçersiz parametre istendi",1,null,$site."/forums");
	 _exit();
 }
 
$sql = "SELECT * FROM topic WHERE section = '".$s."' order by etkilesim DESC";

$Sayfa   = @ceil($_GET['p']); //5,2 girilirse eğer get o zaman onu tam sayı yapar yanı 5 yapıyoruz bu kod ile
$Say   = $db->query($sql); //makale sayısını çekiyoruz
$troplamVeri   = $Say->rowCount(); //makale sayısını saydırıyoruz
$Limit	= $ayarlar['section_limit']; //bir sayfada kaç içerik çıkacağını belirtiyoruz. 
$Sayfa_Sayisi	= ceil($troplamVeri/$Limit); //toplam veri ile limiti bölerek her toplam sayfa sayısını buluyoruz

if($Sayfa < 1){
	$Sayfa = 1;
}

if ($Sayfa > $Sayfa_Sayisi && $Sayfa_Sayisi>1) { 
	yonlendir($site."/404");
	exit();
} 


//eğer get değeri yerine girilen sayi 1 den küçükse sayfa değerini 1 yapıyoruz yani 1. sayfaya atıyoruz


if($Sayfa > $Sayfa_Sayisi){$Sayfa = $Sayfa_Sayisi;} //eğer yazılan sayı büyükse eğer toplam sayfa sayısından en son sayfaya atıyoruz kullanıcıyı
$Goster   = $Sayfa * $Limit - $Limit; // sayfa= 2 olsun limit=3 olsun 2*3=6 6-3=3 buranın değeri 2. sayfada 3'dür 3-4-5-6... sayfalarda da aynı işlem yapılıp değer bulunur
$GorunenSayfa   = 5; //altta kaç tane sayfa sayısı görüneceğini belirtiyoruz.
?>
 <div id="topic_tasi"></div>

<script>title("<?=$sectest['title']?>");</script>

<?php
function topic($row){
global $uye,$db,$yetkim,$plang,$f,$site,$sc,$tribe_yetkili,$s;

if(!empty($sc['tribe'])){
	$frm_lnks = "tr=".$sc['tribe'];
}else{
	$frm_lnks = "f=".$f;
}

$acan = $db->query("SELECT Username,Tag from users WHERE PlayerID = '".$row['player']."' ")->fetch(PDO::FETCH_ASSOC);
$trpmsg = $db->query("SELECT id FROM topicm where topic = '".$row['id']."'");
$trc = $trpmsg->rowCount();

$trlast = $db->query("SELECT * FROM topicm where topic = '".$row['id']."' order by id DESC limit 1")->fetch(PDO::FETCH_ASSOC);
$plast = $db->query("SELECT Username,Tag FROM users WHERE PlayerID = '".$trlast['player']."'")->fetch(PDO::FETCH_ASSOC);	

$favor = $db->query("SELECT * FROM favorites WHERE player = '".$uye['id']."' and data = '".$row['id']."' and mode = '1' ")->fetch(PDO::FETCH_ASSOC);

?>

<div class="row">
 <div class="span12">
<div class="cadre cadre-relief cadre-sujet ltr  <?php if($row['pinned']==1){ echo "cadre-sujet-postit";} ?>">
 <table class="table-cadre table-cadre-centree">
 <tbody>
 <tr>

 <td rowspan="2" style="padding-right:7px">
 
 <?php
 if(($yetkim>=8 || $op>=1) || $tribe_yetkili==1){
 ?>
 <div class="btn-group cadre-sujet-actions">
 <a class="dropdown-toggle btn btn-inverse bouton-action" data-toggle="dropdown" href="#">
 <img src="<?=$site?>/img/icones/roue-dentee.png" class="img20">
 </a>
 <ul class="dropdown-menu menu-contextuel pull-left">

 <li class="nav-header">
Section
</li>


<li>
<a class="element-menu-contextuel" href='?locked=<?=$row['id']?>&s=<?=$s?>'>
<img src="<?=$site?>/img/icones/cadenas.png" class="espace-2-2 img16">
<?php
if($row['locked']==0){
?>
<?=$plang['lockf']?>
<?php
}else{
?>
<?=$plang['unlock']?>
<?php
}
?>

</a>
</li>



<?php
if(($yetkim>=11 || $op>=1) || $tribe_yetkili==1){
?>
<li>
<a class="element-menu-contextuel" href='?pinned=<?=$row['id']?>&s=<?=$s?>'>
<img src="<?=$site?>/img/icones/postit.png" class="espace-2-2 img16">
<?php
if($row['pinned']==0){
?>
<?=$plang['pin']?>
<?php
}else{
?>
<?=$plang['unpin']?>
<?php
}
?>
</a>
</li>


<li>
<a class="element-menu-contextuel" onclick="confirmDel();" href='?delete=<?=$row['id']?>&s=<?=$s?>'>
	<?=tfmdil('bouton.supprimer')?>
</a>
</li>

<?php
if(empty($sc['tribe'])){
?>
<li>
<a class="element-menu-contextuel" onclick="topic_tasi('<?=$row['id']?>',1);">
	<?=$plang['move']?>
</a>
</li>
<?php
}
?>


  </ul>
 </div>
 
 <?php
 }
}
 ?>
 
 </td>
 
 <td class="table-cadre-cellule-principale">
  <a class="cadre-sujet-titre lien-blanc" href="<?=$site?>/topic?<?=$frm_lnks?>&t=<?=$row['id']?>">
	  
<?php

$row['forum']=$f;

topicicon($row,0,$favor);
titlesystem($row,1, $_GET['tr']);
?>


  </a>
  
  
  </td>
 <td rowspan="2">
         <span class="espace-2-2 pull-right">
   <a class="nombre-messages <?=goruldu_modu($row['id'], $trc)?>" href="<?=$site?>/topic?<?=$frm_lnks?>&t=<?=$row['id']?>">
<?=$trc?>
</a>
      </span>
   </td>
  </tr>
 <tr>
 <td class="table-cadre-cellule-principale">
 <div class="element-sujet">
 <a class="cadre-sujet-date" href="<?=$site?>/topic?<?=$frm_lnks?>&t=<?=$row['id']?>">
<span class="">

<?=toptarih($trlast['date'])?>
</span>
, </a>
<?=isim($plast['Username'].$plast['Tag'],"o")?>

 </div>
  <a class="cadre-sujet-infos element-sujet lien-blanc" id="infos_sujet_<?=$row['id']?>" href="<?=$site?>/topic?<?=$frm_lnks?>&t=<?=$row['id']?>">

<?=$plang['topic_createdby1']?>
<?=isim($acan['Username'].$acan['Tag'],"o")?>
<?=$plang['topic_createdby2']?>
<?=toptarih($row['date'])?>
<?=$plang['topic_createdby3']?>

</a>
 </td>
 </tr>
 </tbody></table>
  </div>
 </div>
 </div>
 
 <?php
}

?>

<input type="hidden" id="maxpage" value="<?=$Sayfa_Sayisi?>">
<script>
maxpage("section");
</script>


<div id="corps" class="corps clear container">



<?php
$subforums = $db->query("SELECT * FROM forums where sub_section = '".$s."'")->fetchAll(PDO::FETCH_ASSOC);

foreach($subforums as $sub){
	if(forum_yetki_kontrol($sub['priv'])==1){
?>
		<div class="row"> 
		 <div class="span12"> 

		<?=forumscarki($sub)?>

		 <div class="cadre cadre-relief cadre-forum ltr"> 
		 <div id="forumload_<?=$sub['id']?>" class="cadre-sections-actu"> 
		 <center><?=$plang['loading']?></center>


		</div> 
		<script>
		$("#forumload_<?=$sub['id']?>").load("ajax/forum-ajax?forum=<?=$sub['id']?>&lang%5B%5D=<?=strtolower($dilim)?>&lang%5B%5D=xx");
		</script>
		 </div> 
		 </div> 
		 </div> 
<?php
	}
}

try{
	$Makale	= $db->query($sql." limit $Goster,$Limit"); //yukarda göstere attıgımız değer diyelim ki 3 o zaman 3.'id den başlayarak limit kadar veri ceker.
	$cek = $Makale->fetchAll(PDO::FETCH_ASSOC);
}catch(exception $e){
	$cek = null;
	echo "<br><span style='color:white;'><center>(".tfmdil('texte.vide').")</center></span><br><br>";
}

?>


<?php
foreach($cek as $row){
	if($row['pinned']==1){
		topic($row);
	}
}
?>
 
 
<?php
foreach($cek as $row){
	if($row['pinned']==0){
		topic($row);
	}
}
?>


 <div class="modal hide fade ltr" class="popup-filtrage-affichage" id="popup_filtrage_affichage">
 <form action="section" class="form-horizontal" method="GET" autocomplete="off">
 <div class="modal-header">
 <a class="close" data-dismiss="modal">
×
</a>
 <h3>
<?=$plang['filter_view']?></h3>
 </div>
 <div class="modal-body">
  <input type="hidden" name="f" value="6"/>
 <input type="hidden" name="s" value="41"/>
  <div class="control-group">
 <label class="control-label " for="t_d">
<?=$plang['deleted_topics']?></label>
 <div class="controls ">
 <input type="checkbox" name="t_d" id="t_d" >
 </div>
 </div>
  </div>
 <div class="modal-footer">
  <button type="button" class="btn btn-post" onclick="submitEtDesactive(this);return false;">
<?=tfmdil('bouton.valider')?></button>
 <a class="btn" data-dismiss="modal">
<?=tfmdil('Annuler')?></a>
 </div>
  </form>
 </div>
 <?php
 include("footer.php");
 ?>