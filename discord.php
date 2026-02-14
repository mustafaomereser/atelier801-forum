<?php
include("config.php");
if(empty($ayarlar['discord'])){
	popupn(tfmdil('chat.message.canalInvalide'));
	_exit();
}
?>
    <link rel="stylesheet" href="<?=$site?>/css/discord/main.css">
    <link rel="stylesheet" href="<?=$site?>/css/discord/loader.css">

<div class="fadeIn" id="community_list">
	<center>
    <div class="flag-list">
				
			<?php
			foreach($dilrs as $key => $val){
				if($key!="xx"){
			?>
			   <div class="community" id="_<?=$key?>">
					<a class="pointer" onclick="dil_sec('<?=$key?>')">
						<img onerror="refresh_icone('<?=$key?>')" style="width: 64px !important; height: 49px !important;" id="<?=$key?>" src="<?=$site?>/img/pays-big/<?=$key?>.png">
						<span><?=dilr($key)?></span>
					</a>
				</div>
				
			<?php
				}
			}
			?>
			
	</div>
    </center>
</div>	

            <div class="gears" style="display: none;">
                <img src="<?=$site?>/img/gear_big.png" alt="gear" class="big">
                <img src="<?=$site?>/img/gear_small.png" alt="gear" class="small">
            </div>

</body>


<script>
title("Discord");
function refresh_icone(id){
	$('#'+id).attr("src", "<?=$site?>/img/pays-big/vk.png");
}

function del(id){
	$('#'+id).remove();
}

var _dil = "";
function dil_sec(dil){
	del("_" + dil);

	if(_dil == ""){
		$('#community_list').attr("style", "display: none;");
		$('.gears').attr("style", "");
		window.history.pushState('Object', 'Title', '/discord/validation='+dil);
		_dil = dil;
		yonlendir(2000, '<?=$ayarlar["discord"]?>?validation_lang='+dil);
	}else{
		console.log("İşlem zaten seçilmiş.");
	}
}
</script>

</html>