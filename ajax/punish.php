<?php
include("../pdoconnect.php");
//sleep(1);

if(($yetkim>=8 || !empty($yetkimlist['sentinel'])) && isset($_SESSION['id'])){

}else{
	echo("<center style='padding:10px;'>".tfmdil('erreur.tribulle.17')."</center>");
	exit();	
}


$veri = $_POST['query'];

if(empty($veri)){
echo "hata";	
}else{

$id = $veri['id'];
$mode = $veri['mode'];

$user_c = $db->query("select * from users where PlayerID = '".$id."'")->fetch(PDO::FETCH_ASSOC);

$yetkisi = max(explode(",",$user_c['PrivLevel']));
$devamqe = 0;

if($yetkisi>=$yetkim){
	if($mode=="menu"){
		echo("<center style='padding:10px;'>".tfmdil('erreur.tribulle.17')."</center>");
	}
	exit();
}else{
	$devamqe = 1;
}


if($devamqe==1){
if($mode=="menu"){
?>

 <div class="modal-body"> 
  <div class="control-group"> 
 <label class="control-label"> 
	<label class="p_label"><?=tfmdil('texte.raison')?> :</label>
	<input type="text" id="p_reason" name="p_reason" class="input-large" value="" style="width:80% !important;">
	</label> 
 </div>
 
   <div class="control-group"> 
	<label class="control-label"> 
	<label class="p_label">Time :</label>
 
 	<input type="number" min="1" name="p_time" id="p_time" value="1" style="width:55% !important; float:left !important;">
	<select name="p_time_type" id="p_time_type" style="width:25% !important;">
	<option value="1"><?=$plang['dakika']?></option>
	<option value="2" selected><?=$plang['saat']?></option>
	<option value="3"><?=$plang['gun']?></option>
	</select>
 
 </label>

 </div>
 
 <div class="control-group"> 
 <label class="control-label"> 
	<label class="p_label"><?=str_replace(":","",tfmdil('Type'))?> :</label> 
 </label>

	<div class="controls" style="width:85% !important; float:left !important;">
		<input type="radio" name="p_type" id="p_type_mute" checked> <font size='2px'>Mute</font>
		<input type="radio" name="p_type" id="p_type_ban"> <font size='2px'>Ban</font>		
	</div>
 </div>

			
 <div class="control-group"> 
 <label class="control-label"> 
	<label class="p_label"></label> 
 </label>

<br><br>	

			<script>
			
				s2t=function (t, id){
					if(t>=1){
						return parseInt(t/86400)+' <?=$plang["gun"]?> '+(new Date(t%86400*1000)).toUTCString().replace(/.*(\d{2}):(\d{2}):(\d{2}).*/, "$1 <?=$plang['saat']?> $2 <?=$plang['dakika']?> $3 <?=$plang['saniye']?>");
					}else{
						$('#tm_'+id).html("<center>Time ended</center>");
					}
				}
			
			function get_time(id){
				var time = $('#p_time_'+id).attr('value');
				var timestamp = new Date().getTime();
				timestamp = parseInt(timestamp/1000);				
				$('#p_time_'+id).html(s2t((time-timestamp), id));
			}
			
				function time_set(id){
					get_time(id);
					setInterval(function(){
						get_time(id);
					},1000);

				}
			</script>		
		
		<div class="sanctionlist" style="padding:10px;">
		<?php
		$p_s = $db->query("SELECT * FROM sanctions where time >= '".time()."' && user = '".$id."'")->fetchAll(PDO::FETCH_ASSOC);
		foreach($p_s as $row){
		?>
			<div class="sanctionlist-item" style="border-top: 1px solid gray; padding:10px; margin-bottom:5%;" id="tm_<?=$row['id']?>">
				<label class="control-label"> 
					<label class="p_label" style="width: auto !important;"><?=tfmdil('texte.utilisateur')?> :</label>
					<p_givenby><script>$('p_givenby').load("./ajax/user.php?v=<?=$row['given_by']?>");</script></p_givenby>
				</label> 

				<label class="control-label"> 
					<label class="p_label"><?=tfmdil('texte.raison')?> :</label>
					<?=$row['reason']?>
				</label>

				<label class="control-label"> 
					<label class="p_label">Time :</label>
					<span id="p_time_<?=$row['id']?>" value="<?=$row['time']?>"></span>
					<script>time_set("<?=$row['id']?>");</script>
				</label> 
				
				<label class="control-label"> 
					<label class="p_label"><?=str_replace(":","",tfmdil('Type'))?> :</label> 
					<?php echo $row['type']==1 ? "Mute" : "Ban";?>
				</label>
				
				<label class="control-label"> 
					<label class="p_label"><?=tfmdil('texte.etat')?> :</label> 
					<?php $row['status']==1 ? $chck = "checked" : $chck = "";?>
 					<div class="onoffswitch">
						<input type="checkbox" class="onoffswitch-checkbox" name="p_status_<?=$row['id']?>" id="p_status_<?=$row['id']?>" onclick="punish('<?=$id?>','u_status',<?=$row['id']?>); submitEtDesactive(this);" <?=$chck?>>
						<label class="onoffswitch-label" for="p_status_<?=$row['id']?>">
							<span class="onoffswitch-inner"></span>
							<span class="onoffswitch-switch"></span>
						</label>
					</div>
					
				</label> 

			</div>
			
			<?php
		}
			?>

		</div>
	
	</div>

 </div>


</div> 


<script>
	$('punish_isim').load("ajax/user.php?v=<?=$id?>");
</script>

<?php
}elseif($mode=="punish"){

$sebep = htmlspecialchars(trim($veri['reason']));
$time = $veri['time'];
$time_type = $veri['time_type'];
$type = $veri['type'];

$p_onay = 0;

if($p_onay==0){
	if(!empty($user_c['PlayerID'])){
		$p_onay++;
	}else{
		popup(tfmdil('Joueur_Existe_Pas'));
	}
}

if($p_onay==1){
	
	if(strlen(str_replace(" ","",$sebep))>=5){
		$p_onay++;
	}else{
		popup(str_replace("%1","5",tfmdil('texte.resultat.titreTropCourt')));
	}

}


if($p_onay==2){
	
	if(is_numeric($time_type) && ($time_type>=1 && $time_type<=3 )){
		$p_onay++;
	}else{
		popup(tfmdil('erreur.tribulle.20'));
	}

}

if($p_onay==3){
	
	if(is_numeric($time)){
		$p_onay++;

	}else{
		popup(tfmdil('erreur.tribulle.20'));
	}

}


if($p_onay==4){
	
	if(is_numeric($type) && ($type>=1 && $type<=2 )){
		$p_onay++;
	}else{
		popup(tfmdil('erreur.tribulle.20'));
	}

}

if($p_onay==5){

$dakika = 60;
$saat = ($dakika*60);
$gun = ($saat*24);

$s_time = time();

if($time_type==1){
	$s_time += ($time*$dakika);
}elseif($time_type==2){
	$s_time += ($time*$saat);
}elseif($time_type==3){
	$s_time += ($time*$gun);
}
	
$_p = $db->exec("INSERT INTO sanctions(user, reason, type, time, date, given_by) values('".$id."', '".$sebep."', '".$type."', '".$s_time."', '".time()."', '".$uye['id']."')");

if($_p>0){
	popup(tfmdil('texte.resultat.succes'));
	echo '<script>$("#p_menu").modal("hide");</script>';
	
}else{
	popup("+ Başaramadık abi.");
}

	
}


}elseif($mode=="u_status"){
	$u_status = $veri['u_status'];
	$id = $veri['u_status_id'];
	
	if($u_status == "true"){
		$u_status = "1";
	}else{
		$u_status = "0";	
	}
	$db->exec("UPDATE sanctions set status = '".$u_status."' where id = '".$id."'");
}
?>



<?php
}
}
?>
