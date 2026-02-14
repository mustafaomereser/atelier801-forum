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


try{
$topics = $db->query("SELECT * FROM topic where player = '".$id."'")->fetchAll(PDO::FETCH_ASSOC);
}catch(exception $e){
	echo "<br><span style='color:white;'><center>(".tfmdil('texte.vide').")</center></span><br><br>";

}
?>


 <div id="corps" class="corps clear container" bis_skin_checked="1">

<?php
foreach($topics as $row){
	$sct = $db->query("SELECT forum,id,title FROM section where id = '".$row['section']."'")->fetch(PDO::FETCH_ASSOC);
	$forum = $db->query("SELECT title,id FROM forums where id = '".$sct['forum']."'")->fetch(PDO::FETCH_ASSOC);

	$tlast = $db->query("SELECT * FROM topicm where topic = '".$row['id']."' order by date DESC Limit 0,1")->fetch(PDO::FETCH_ASSOC);
	$msjc = $db->query("SELECT * FROM topicm where topic = '".$row['id']."'")->rowCount();
	$tpr = $db->query("SELECT Username,Tag FROM users where PlayerID = '".$tlast['player']."' ")->fetch(PDO::FETCH_ASSOC);
?>
 <div class="row" bis_skin_checked="1">
 <div class="span12" bis_skin_checked="1">
           <div class="cadre cadre-relief cadre-sujet ltr " bis_skin_checked="1">
 <table class="table-cadre table-cadre-centree">
 <tbody>
 
 
<tr>
 <td rowspan="2">
 </td>
 <td class="table-cadre-cellule-principale">

	<?php 
	topicicon($row);
	$row['forum']=$forum['id'];
	titlesystem($row,1);
	?>
  </td>
  
 <td rowspan="2">
         <span class="espace-2-2 pull-right">
   <a class="nombre-messages nombre-messages-lu" href="<?=$site?>/topic?f=<?=$forum['id']?>&t=<?=$row['id']?>">
<?=$msjc?>
</a>
      </span>
   </td>
  </tr>
  
  
  
 <tr>
 <td class="table-cadre-cellule-principale">
 <div class="element-sujet" bis_skin_checked="1">
 <a class="cadre-sujet-date" href="<?=$site?>/topic?f=<?=$forum['id']?>&t=<?=$row['id']?>">
<span class="">
<?=toptarih($tlast['date'])?></span>
, </a>
<?=isim($tpr['Username'].$tpr['Tag'],"o")?>

 </div>
  <a class="cadre-sujet-infos element-sujet lien-blanc" id="infos_sujet_886888" href="<?=$site?>/topic?f=<?=$forum['id']?>&t=<?=$row['id']?>">
<?=sprintf($plang['started_at_by'],isim($kadi[0].$kadi[1],"o"),'<span class="">'.toptarih($row['date']).'</span>')?>
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

 
      </div>
	  
<?php

include("footer.php");
?>
