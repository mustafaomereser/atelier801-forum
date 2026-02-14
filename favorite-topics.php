 <?php
include("config.php");

if(empty($uye['id'])){
	popupn(tfmdil('texte.resultat.droitsInsuffisants'));

	_exit();
	
}

	$sil = $_GET['sil'];
	if(!empty($sil)){
		$sonuc = $db->exec("DELETE FROM favorites WHERE player = '".$uye['id']."' and data = '".$sil."' and mode = '2'");	
		if($sonuc>0){
			
		}else{
			popup(tfmdil('EchecPaiement'));
		}
	}

$favor = $db->query("SELECT * FROM favorites WHERE player = '".$uye['id']."' and mode = '1' ")->fetchAll(PDO::FETCH_ASSOC);
$blist = array();

if($_GET){
	$selectlist = $_GET['select'];
}else{
	$selectlist = $_POST['select'];
}

foreach($selectlist as $yorumid) {
      $db->exec("DELETE FROM favorites WHERE data = '".$yorumid."' and player = '".$uye['id']."' and mode = '1'");
	  yenile(0,1);
}


foreach($favor as $row){
array_push($blist,$row['data']);
}

$bcount = count($blist);

if($bcount<=0){
echo "<br><span style='color:white;'><center>(".tfmdil('texte.vide').")</center></span><br><br>";
}

if(!empty($blist[0])){
?>
<script>title("<?=$uye['Username']?>");</script>

 <div id="corps" class="corps clear container" bis_skin_checked="1">   
   <form method="POST" id='favorite_topics'>

  <?php  
  
  
  
foreach($blist as $row){
	 $topic = $db->query("SELECT * FROM topic where id = '".$row."'")->fetch(PDO::FETCH_ASSOC);   
	 	$section = $db->query("SELECT * FROM section WHERE id='".$topic['section']."'")->fetch(PDO::FETCH_ASSOC);
	$forum = $db->query("SELECT * FROM forums WHERE id='".$section['forum']."'")->fetch(PDO::FETCH_ASSOC);
	 try{
	$acan = $db->query("SELECT Username,Tag from users WHERE PlayerID = '".$topic['player']."' ")->fetch(PDO::FETCH_ASSOC);
	 }catch(exception $e){
	 }

?>


<div class="row">
 <div class="span12">
 <div class="cadre cadre-relief cadre-sujet ltr  cadre-sujet-postit">
 <table class="table-cadre table-cadre-centree">
 <tbody>
<tr>
 <td rowspan="2">
 </td>
 <td class="table-cadre-cellule-principale">

   <?php
   topicicon($topic);
   $topic['forum'] = $forum['id'];
   ?>
 
 <?=titlesystem($topic,1);?>
  </td>

 <td rowspan="2">
 <div class="btn-group cadre-sujet-actions">
 <a class="dropdown-toggle btn btn-inverse bouton-action" data-toggle="dropdown" href="#">
 <img src="<?=$site?>/img/icones/roue-dentee.png" class="img20">
 </a>
 <ul class="dropdown-menu menu-contextuel pull-right">
 <li class="nav-header">
<?=$plang['topic']?>
</li>

      <li>
   <a href="?select%5B%5D=<?=$topic['id']?>" class="element-menu-contextuel">
<img src="<?=$site?>/img/icones/16/favori2.png" class="espace-2-2 img16">
<?=$plang['delete_favoritetopic']?></a>
    </li>
       </ul>
 </div>
   </td>
  <td rowspan="2">
 <div class="bloc-checkbox-selection">
 <input name="select[]" value='<?=$topic['id']?>' class="checkbox-selection" type="checkbox">
 </div>
 </td>
  </tr>
  
 <tr>
 <td class="table-cadre-cellule-principale">

  <a class="cadre-sujet-infos element-sujet lien-blanc" id="infos_sujet_821467" href="<?=$site?>/topic?f=<?=$forum['id']?>&t=<?=$topic['id']?>">
<?=isim($acan['Username'].$acan['Tag'],"o")?>
<?php
if(date("d")!=date("d",$topic['date'])){
	$tar = "d/m/Y ";
}else{
	$tar = "";
}
?>

<?=$plang['topic_createdby2']?> <span class=""><?=date("".$tar." h:i",$topic['date'])?></span>
<?=$plang['topic_createdby3']?> </a>
 </td>
 </tr>

 </tbody></table>
  </div>
 </div>
 </div>
 </td>
 </tr>
 </tbody>
</table>

 

  
 <?php
 }
  
 ?>
 </form>
 </div>
 
 <?php
 }
include("footer.php");
?>