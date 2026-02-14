<?php
include("config.php"); 
?>
  <div id="corps" class="corps clear container">   
  <div class="row"> 
  <div class="span12"> 
  <p align="center">
  <a href="#" rel="noopener" class="cliquable">
  <img src="<?=$site?>/img/logo-atelier801.png" id="b" onclick="takla(this);" width="300" height="300"/>
  </a> 
  </p> 
  </div> 
  </div>     
  
  <div class="row"> 
  <?php
  $oyunlist = $db->query("SELECT * FROM oyunlist")->fetchAll(PDO::FETCH_ASSOC);
  foreach($oyunlist as $row){
	
  ?>
  <div class="span4 span-etire-hauteur">     
  <div class="cadre cadre-relief cadre-jeu ltr"> 
  
  <table> 
  <tr> 
  <td> 
  <p align="center"> 
  <a class="image-jeu" href="<?=$row['link']?>" target="_blank" rel="noopener">
  <img src="<?=$row['img']?>" alt=""/>
  </a> 
  </p> 
  </td> 
  </tr> 
  <tr> 
  <td style="height: 100%;"> 
  	<?=eval($row['text'])?>

 <p class="texte-jeu">
<?php echo $b[$dilim] ?? "<font color='red'>Error</font>"; ?>
  </p> 
  
  </td> 
  </tr> 
  <tr> 
  <td>
  <p class="boutons-jeu" align="center"> 
  <a class="btn btn-primary" href="<?=$row['link']?>" target="_blank" rel="noopener"><?=tfmdil('Jouer')?></a>     
  <a class="btn" href="<?=$site?>/forums"><?=tfmdil('Forum')?></a> 
  </p> 
  </td> 
  </tr> 
  </table> 
  </div> 
  </div>
 
 <?php
 }
 ?>
 
 
 </div> 
 </div> 


<?php
include("footer.php");
?>
	
