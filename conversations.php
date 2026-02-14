<?php
include("config.php");

if(empty($uye['id'])){
	yonlendir($site."/404",0);
	exit();
}


	$sil=$_GET['sil'];
	if(!empty($sil)){
	$sorgu = "UPDATE conversations set trash='1' where player='".$uye['id']."' and id='".$sil."'";
	$yap = $db->query($sorgu);
	}


	$restore=$_GET['restore'];
	if(!empty($restore)){
	$sorgu = "UPDATE conversations set trash='0' where player='".$uye['id']."' and id='".$restore."'";
	$yap = $db->query($sorgu);
	geri();
	}

$location = $_GET['location'];
if(($location!=1 && $location!=2)){
	yenile(0,1,"?location=1");
	exit();
}

if($location==2){
	$where = "and trash='1'";
}else{
	$where = "and trash='0'";

}

$islem = $_POST['islem'];
if(!empty($islem)){
	

	foreach($_POST['select'] as $select){
		
	if($islem==1){
	$sorgu = "UPDATE conversations set trash='1' where player='".$uye['id']."' and id='".$select."'";
	}
	
	if($islem==3){
	$sorgu = "UPDATE conversations set trash='0' where player='".$uye['id']."' and id='".$select."'";
	}
	
	if($islem==4){
	$sorgu = "DELETE FROM conversations where player='".$uye['id']."' and id='".$select."'";
	}	
	
	$yap = $db->query($sorgu);
	}
		if($islem==2){
	$sorgu = "DELETE FROM conversations where player='".$uye['id']."' and trash='1'";
		$yap = $db->query($sorgu);
	}
	
}

$sql = "SELECT * FROM conversations WHERE player = '".$uye['id']."' ".$where." order by etkilesim DESC";

$Sayfa   = @ceil($_GET['p']); //5,2 girilirse eğer get o zaman onu tam sayı yapar yanı 5 yapıyoruz bu kod ile
$Say   = $db->query($sql); //makale sayısını çekiyoruz
$ToplamVeri   = $Say->rowCount(); //makale sayısını saydırıyoruz
$Limit	= 30; //bir sayfada kaç içerik çıkacağını belirtiyoruz. 
$Sayfa_Sayisi	= ceil($ToplamVeri/$Limit); //toplam veri ile limiti bölerek her toplam sayfa sayısını buluyoruz

if($Sayfa < 1){
	$Sayfa = 1;
}

if ($Sayfa > $Sayfa_Sayisi && $Sayfa_Sayisi>0) { 
yonlendir($site."/404");
exit();
} 

if($Sayfa > $Sayfa_Sayisi){$Sayfa = $Sayfa_Sayisi;} //eğer yazılan sayı büyükse eğer toplam sayfa sayısından en son sayfaya atıyoruz kullanıcıyı
$Goster   = $Sayfa * $Limit - $Limit; // sayfa= 2 olsun limit=3 olsun 2*3=6 6-3=3 buranın değeri 2. sayfada 3'dür 3-4-5-6... sayfalarda da aynı işlem yapılıp değer bulunur
$GorunenSayfa   = 5; //altta kaç tane sayfa sayısı görüneceğini belirtiyoruz.
try{
$Makale	= $db->query($sql." limit $Goster,$Limit"); //yukarda göstere attıgımız değer diyelim ki 3 o zaman 3.'id den başlayarak limit kadar veri ceker.
$cek = $Makale->fetchAll(PDO::FETCH_ASSOC);
}catch(exception $e){
$cek = null;
echo "<br><span style='color:white;'><center>(".tfmdil('texte.vide').")</center></span><br><br>";
}
?>
<script>title("<?=$plang['Inbox']?>");</script>

<input type="hidden" id="maxpage" value="<?=$Sayfa_Sayisi?>">

<script>
maxpage("section");
</script>



  <div id="corps" class="corps clear container">   
<form method="POST" id="conv_select">
<input type="hidden" name="islem" id="islem" value="1">
<?php
foreach($cek as $row){
	$karsimsg = $db->query("SELECT * FROM conversations WHERE player != '".$uye['id']."' and hash = '".$row['hash']."'")->fetch(PDO::FETCH_ASSOC);
	
	$karsi = $db->query("SELECT * FROM users WHERE PlayerID = '".$karsimsg['player']."'")->fetch(PDO::FETCH_ASSOC);
	$acan = $db->query("SELECT * FROM users WHERE PlayerID = '".$row['started']."'")->fetch(PDO::FETCH_ASSOC);	
	$sonmsg = $db->query("SELECT * FROM conversation WHERE hash = '".$row['hash']."' order by date DESC Limit 0,1")->fetch(PDO::FETCH_ASSOC);
	$msj = $db->query("SELECT * FROM conversation WHERE hash = '".$row['hash']."'")->rowCount();


	$unread=$_GET['unread'];
	if(!empty($unread)){
		$sorgu = "UPDATE conversation set readed='0' where id='".$sonmsg['id']."'";
		$yap = $db->query($sorgu);
		geri();
	}

?>

 <div class="row">
 <div class="span12">
      <div class="cadre cadre-relief cadre-conversation ltr ">
 <table class="table-cadre table-cadre-centree">
 <tbody>
<tr>

 <td rowspan="2" style="padding-right:7px">
 <div class="btn-group cadre-sujet-actions">
 <a class="dropdown-toggle btn btn-inverse bouton-action" data-toggle="dropdown" href="#">
 <img src="<?=$site?>/img/icones/roue-dentee.png" class="img20">
 </a>
 <ul class="dropdown-menu menu-contextuel pull-left">

 <li class="nav-header">
<?=$plang['chat']?></li>

<?php
if($sonmsg['player']!=$uye['id'] && $sonmsg['readed']==1){
?>
  <li>
<a class="element-menu-contextuel" data-toggle="modal" href='?location=<?=$location?>&unread=<?=$row['id']?>'>
<?=$plang['mark_not_seen']?></a>
</li>

  <?php
}
?>

<?php
if($location==1){
?>
<li>
<a class="element-menu-contextuel" data-toggle="modal" href='?location=2&sil=<?=$row['id']?>'>
<?=tfmdil('bouton.supprimer')?>
</a>
</li>
<?php
}else{
?>
<li>
<a class="element-menu-contextuel" data-toggle="modal" href='?restore=<?=$row['id']?>'>
<?=tfmdil('bouton.restaurer')?>
</a>
</li>
<?php
}
?>
  </ul>
 </div>
 </td>

 <td class="table-cadre-cellule-principale">
 <div class="ltr">
 
<?php
if(!empty($karsi['Username'])){
isim($karsi['Username'].$karsi['Tag'],"o");
}
?>

     <a class="cadre-sujet-titre lien-blanc" href="<?=$site?>/conversation?co=<?=$row['hash']?>">
   <img src="<?=$site?>/img/icones/enveloppe.png" class="img18 espace-2-2">
  <?=$row['title']?>
  </a>
  </div>
 </td>
 <td rowspan="2"><!--nombre-messages-nouveau-->
         <span class="espace-2-2 pull-right">
   <a class="nombre-messages <?=goruldu_modu($row['hash'], $msj, "convs")?>" href="<?=$site?>/conversation?co=<?=$row['hash']?>">
<?=$msj?></a>
      </span>
 </td>
 <td rowspan="2">
 <div class="bloc-checkbox-selection">
 <input name="select[]" value="<?=$row['id']?>" class="checkbox-selection" type="checkbox" onclick="selectionElement(<?=$row['id']?>;_x;);">
 </div>
 </td>
 </tr>
 <tr>
 <td class="table-cadre-cellule-principale">
  <div class="element-sujet">
 <a class="cadre-sujet-date" href="<?=$site?>/conversation?co=<?=$row['hash']?>">
<span class="">

<?=toptarih($sonmsg['date'])?>

</span>

, </a>
<?=isim($acan['Username'].$acan['Tag'],"o")?>

 </div>

  <a class="cadre-sujet-infos element-sujet lien-blanc" href="<?=$site?>/conversation?co=<?=$row['hash']?>">
  

 <?=$plang['started_at_date1']?>

  <?=toptarih($row['date'])?>
  <?=$plang['started_at_date2']?>    


 </a>
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
</form>

 </div> 
<?php
include("footer.php");
?>
