<?php
include("config.php");

$pr = $_GET['pr'];

if(!empty($pr)){
	$pr = "where Username LIKE '%".$pr."%' && BanHours = '0' ";
}else{
	$pr = "Where BanHours = 0";
}

$sql = "SELECT * from users ".$pr." ORDER BY FirstCount DESC";

$p = $_GET['p'];
$maxveri = 50;
$maxpage = ceil($db->query($sql)->rowCount()/$maxveri);


if(empty($p) || $p<=0){
	$p=1;
}elseif($p > $maxpage){
	yonlendir($site."/404");
	exit();
}


$cek1 = $maxveri*($p-1);

$query = $db->query($sql." LIMIT ".$cek1.",".$maxveri." ")->fetchAll(PDO::FETCH_ASSOC);

?>
<script>title("Ranking");</script>

<input type="hidden" id="maxpage" value="<?=$maxpage?>">

<script>
maxpage("ranking");
</script>

<style type="text/css">
table#alter td {background:#111;}
table#alter tr.dif td {background:#333;}
</style>

 <div id="corps" class="corps clear container">
 
<div class="row">
<div class="span12" style="color: #fff;">

 <div class="cadre cadre-defaut ltr"> 
 
<h2><font color="#f9f9f9">Ranking</font></h2>
 
 <table class="table-datatable table-cadre table-cadre-centree table-striped"> 
    <thead>
      <tr style="color: #30BA76; height: 15px;">
      	<th style="text-align: right;">Rank</th>
        <th style="padding-left: 50px;">Username</th>
        <th>Firsts</th>
        <th>Cheese</th>
        <th>Bootcamps</th>
        <th>Normal Saves</th>
        <th>HardMode Saves</th>
        <th>DivineMode Saves</th>
      </tr>
    </thead>
    <tbody>

  
<style type="text/css">
table#alter td {background:#243b4d; border-top: #111; padding: 15px 15px 15px 15px;}
table#alter tr.dif td {background:#192a38; border-top: #111; padding: 15px 15px 15px 15px;}
</style>



<?php

	function sira($id){
	global $maxveri,$p,$db;
			
	$tsay = $db->query("SELECT * from users where BanHours = 0 ORDER BY FirstCount DESC");

	$tsc  = $tsay->rowCount();
	$tsay = $tsay->fetchAll(PDO::FETCH_ASSOC);
	
	$devam=0;
	$sira=0;
	
	foreach($tsay as $row){
		if($devam==0){
			$sira++;
			if($row['PlayerID']==$id){
				$devam = 1;
				break;
			}			
		}
	}
		return $sira;
		
	}
	
	foreach($query as $xd) {
        echo '<tr class="dif">';
        $sira = sira($xd['PlayerID']);
		?>
        <td style='text-align: right;'><span style='<?php if($sira == 1){ echo "background: url($site/img/king.gif);text-shadow:2px 0px 11px #192a38;";} ?>'><?=$sira?></span></td>
        <td style='padding-left: 50px;'><span style='<?php if($sira == 1){ echo "background: url($site/img/king.gif);text-shadow:2px 0px 11px #192a38;";} ?>'><font color='#009d9d'><b> <?=isim($xd['Username'].$xd['Tag'],"s")?></font></b></span></td>
		<?php       
		echo "<td>"; echo $xd['FirstCount']; echo "</td>";
        echo "<td>"; echo $xd['CheeseCount']; echo "</td>";
        echo "<td>"; echo $xd['BootcampCount']; echo "</td>";
        echo "<td>"; echo $xd['ShamanSaves']; echo "</td>";
        echo "<td>"; echo $xd['HardModeSaves']; echo "</td>";
        echo "<td>"; echo $xd['DivineModeSaves']; echo "</td>";
        echo '</tr>';
       
	}
?>
    </tbody>
  </table>
  </div>
  <br>
  <br>
  </div>
 </div>
</div>
<?php
include("footer.php");
?>