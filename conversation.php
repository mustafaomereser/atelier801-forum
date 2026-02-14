<?php
include("config.php");

if(empty($uye['id'])){
	yonlendir($site."/404",0);
	exit();
}

$co = $_GET['co'];


$conv = $db->query("SELECT * FROM conversations where hash = '".$co."'")->fetchAll(PDO::FETCH_ASSOC);
$querytimes=0;
foreach($conv as $row){
	$querytimes++;
	
	if($uye['id']!=$row['player']){
		$karsi = $db->query("SELECT Username,Tag,PlayerID FROM users where PlayerID = '".$row['player']."'")->fetch(PDO::FETCH_ASSOC);
	}else{
		$ben = $db->query("SELECT Username,Tag,PlayerID FROM users where PlayerID = '".$row['player']."'")->fetch(PDO::FETCH_ASSOC);
	}


}

	if($ben['PlayerID']!=$uye['PlayerID']){
		yonlendir($site."/404");
		exit();
	} 
	
	
	
	
	$sil=$_GET['sil'];
	if(!empty($sil)){
	$sorgu = "UPDATE conversations set trash='1' where player='".$uye['id']."' and hash='".$co."'";
	$yap = $db->query($sorgu);
	}
	
	
	$restore=$_GET['restore'];
	if(!empty($restore)){
		$sorgu = "UPDATE conversations set trash='0' where player='".$uye['id']."' and hash='".$co."'";
		$yap = $db->query($sorgu);
	}
	
	
?>
<script>title("<?=$row['title']?>");</script>


<div id="corps" class="corps clear container">
<div id="result_msg"></div>
 
 <div class="row">
 <div class="span12">
      <div class="cadre cadre-relief cadre-conversation ltr ">
 <table class="table-cadre table-cadre-centree">
 <tr>
 <td>
 <div class="btn-group cadre-sujet-actions">
 <a class="dropdown-toggle btn btn-inverse bouton-action" data-toggle="dropdown" href="#">
 <img src="<?=$site?>/img/icones/roue-dentee.png" class="img20"/>
 </a>
 <ul class="dropdown-menu menu-contextuel pull-left">
 <li class="nav-header">
<?=$plang['chat']?></li>

<li>

<?php
if($ben['PlayerID']==$uye['id']){
if($row['trash']==0){
?>
<a class="element-menu-contextuel" data-toggle="modal" href='?co=<?=$co?>&sil=Sil_Gitsin'>
<?=tfmdil('bouton.supprimer')?>
</a>
<?php
}else{
?>

<a class="element-menu-contextuel" data-toggle="modal" href='?co=<?=$co?>&restore=Geri_Getir'>
<?=tfmdil('bouton.restaurer')?>
</a>

<?php
}
}
?>
</li>

  </ul>
 </div>
 <span class="cadre-sujet-titre">
<?php
if(!empty($karsi['Username'])){
isim($karsi['Username'].$karsi['Tag'],"o");
}
?>
<img src="<?=$site?>/img/icones/enveloppe.png" class="img24 espace-2-2" />
 <?=$row['title']?></span>
 </td>
  </tr>
 </table>
 </div>
 </div>
 </div>


<?php
$sql = "SELECT * FROM conversation WHERE hash = '".$co."' order by id ASC";

$Sayfa   = @ceil($_GET['p']); //5,2 girilirse eğer get o zaman onu tam sayı yapar yanı 5 yapıyoruz bu kod ile
$Say   = $db->query($sql); //makale sayısını çekiyoruz
$ToplamVeri   = $Say->rowCount(); //makale sayısını saydırıyoruz
$Limit	= 20; //bir sayfada kaç içerik çıkacağını belirtiyoruz. 
$Sayfa_Sayisi	= ceil($ToplamVeri/$Limit); //toplam veri ile limiti bölerek her toplam sayfa sayısını buluyoruz

if ($Sayfa <= 0) { 
yonlendir(explode("&p=",links())[0]."&p=".$Sayfa_Sayisi,0);
exit();
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
 
//pagecreate("topic",$Sayfa_Sayisi);

}catch(exception $e){
$cek = null;
echo "<br><span style='color:white;'><center>(".tfmdil('texte.vide').")</center></span><br><br>";
}


if(!empty($json_data)){
	if($Sayfa >= $Sayfa_Sayisi){
		if($json_data['convs'][$co] != $ToplamVeri){
			$json_data['convs'][$co] = $ToplamVeri;
		}
	}elseif(empty($json_data['convs'][$co])){
		$json_data['convs'][$co] = "Son sayfayı görmedi.";
	}
}

?>
<input type="hidden" id="maxpage" value="<?=$Sayfa_Sayisi?>">
<script>
maxpage("karisik");
</script>
 
 <?php
 
 $sira=0+($Limit*$Sayfa)-$Limit;
 
 foreach($cek as $row){
	 
	 if($uye['id']!=$row['player']){
	 
	 if($row['readed']==0){
	 $db->query("UPDATE conversation set readed='1' where player = '".$row['player']."' and id='".$row['id']."'");
	 }
	 
	 }
	 
	 $sira++;
	 
	 $p = $db->query("SELECT * FROM users where PlayerID = '".$row['player']."'")->fetch(PDO::FETCH_ASSOC);

 ?>
   <div class="row">
 <div class="span12" id="cadre_message_sujet_<?=$row['id']?>">
    <div id="m<?=$row['id']?>" class="cadre cadre-relief cadre-message ltr <?php if($row['likes']>=10){echo "cadre-message-like"; }?>">
 <table class="table-cadre">
 <tr>

<?=isim($p['Username'].$p['Tag'],"pm",null,$row['date'])?>

 <td class="table-cadre-cellule-vide">
</td>
 <td class="table-cadre-cellule-numero position-relative">
 <div>
 <div>
 <a class="numero-message" href="#m<?=$row['id']?>">
#<?=$sira?>
</a>
 </div>
  </div>
  
 </td>
 </tr>
 <tr>
 <td class="table-cadre-cellule-principale table-cellule-droite_bas">
 <div class="cadre-message-contenu">
 <div class="cadre-message-message">
 
    <div id="message_<?=$row['id']?>">
<?=bbcode($row['text'])?>
</div>
   <?=poll($row['id'],1)?>



   </div>
   

   
  </div>
 </td>
 </tr>
 </table>
 

 <form id="cadre_signaler_element_<?=$row['id']?>" class="hidden cadre form-horizontal cadre-formulaire" action="report-element" method="POST" autocomplete="off">
 <fieldset>
 <legend>
<?=tfmdil('texte.signaler')?></legend>
 <input type="hidden" name="f" value="6">
 <input type="hidden" name="te" value="4">
 <input type="hidden" name="ie" value="<?=$row['id']?>">
 <div class="control-group">
 <label class="control-label " for="raison">
<?=tfmdil('texte.raison')?></label>
 <div class="controls ">
 <textarea id="message_<?=$row['id']?>" name="raison" id="raison" rows="5" class="input-xxlarge" maxlength="10000">
</textarea>
 </div>
 </div>
 <div class="control-group">
 <div class="controls ">
  <button type="button" class="btn btn-post" onclick="submitEtDesactive(this);return false;">
<?=tfmdil('bouton.valider')?></button>
 <button type="button" class="btn" onclick="jQuery('#cadre_signaler_element_<?=$row['id']?>').addClass('hidden');jQuery('#bouton_signaler_element_<?=$row['id']?>').removeClass('active');">
<?=tfmdil('Annuler')?></button>
 </div>
 </div>
 </fieldset>
 </form>
 
     </div>
 </div>
 </div>
  
  <?php
 }
  ?>




   <div class="row">
 <div class="span12">
       <div class="cadre cadre-relief cadre-repondre ltr">
    <div id="cadre_nouveau_message" class="form-horizontal">
 <fieldset class="fieldset-100">
     <?php
	if($querytimes==2){
	?>
 <legend>
<?=tfmdil('bouton.repondre')?>
</legend>
  <div class="control-group">
 <label class="control-label " for="message_reponse">
<?=tfmdil('texte.message')?></label>
 <div class="controls  ltr">
<?=txed("message_reponse","message_reponse")?>
 </div>
 <br>
 <div class="control-group">
 <div class="controls">
  <button type="button" class="btn btn-post" onclick="dialog();submitEtDesactive(this);return false;">
<?=tfmdil('bouton.valider')?></button>
  </div>
 </div>
 
 <?php
}else{
?>
<br>
<center>
<?=$plang['conversation_deleted']?>
</center>
<br>
<?php	
}
?>
 
 </fieldset>
 </div>
    </div>
</div>
</div>
</div>


 
 
 <?php
include("footer.php");
?>
