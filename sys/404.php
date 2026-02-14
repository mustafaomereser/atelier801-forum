<?php
include("../config.php");
$d404 = 1;
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
	<div class="offset2 span8"> 
	<div class="cadre cadre-message"> 
	<h4><?=$plang['404_page']?></h4> 
	</div> 
	</div> 
	</div>   
	</div>
	
	<script>
	$(document).ready(function(){
		var tits = $('div h4').html();
		title(tits);
	});
	</script>
	<?php
include("../footer.php");
?>
