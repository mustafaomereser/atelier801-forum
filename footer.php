<?php
include("sys/linkaccess.php");
?>

<script type="text/javascript">
	jQuery(document).ready(function() {
		bindAjax();
	});
</script> 


<footer id="footer" class="footer"> 
<div class="navbar barre-navigation-bas hidden-desktop">    
 </div> 
 <div class="container-fluid"> 
 <div class="row-fluid"> 
 <div class="span2"> 
 <a href="#" rel="noopener" class="lien-blanc pull-left">&copy; <?=$ayarlar['title']?> <?=date('Y')?></a> 
 </div> 
 
 <div class="span8"> 
	 <p align="center"> 
		 <span class="element-footer">
			<a href="<?=$site?>/staff" class="lien-blanc"><?=$plang['team']?></a>
		 </span> 
		 <span class="element-footer">
			<a href="<?=$site?>/termsofuse" class="lien-blanc"><?=tfmdil('terms.conditions.use')?> </a>
		 </span> 
		 <?php
		 if(!empty($ayarlar['discord'])){
		 ?>
		 <span class="element-footer">
			<a href="<?=$site?>/discord" style="font-size: 12px;" class="lien-blanc">Discord</a>
		 </span> 
		 <?php
		 }
		 ?>
		 <span class="element-footer">
			<a href="<?=$site?>/privacy" class="lien-blanc"><?=$plang['privacy']?></a>
		 </span> 
		 <span class="element-footer">
			<a href="<?=$site?>/contact" class="lien-blanc"><?=$plang['contact']?></a>
		 </span> 
	 </p> 
 </div> 
 <div class="span2">  
 <div class="pull-right"> 
 <span style="color:#AAAAAA;"><?=$plang['version']?>
 </span> 
 </div>  
 </div> 
 </div> 
 </div> 
 </footer> 
 
 </div> 
 
 <script type="text/javascript">
	parserDates();
	majCadresMessage();
	verifieOrdreUl();

//	var language = window.navigator.userLanguage || window.navigator.language;

	jQuery.cookieBar({
		fixed: true,
		bottom: true,
		policyButton: true,
		message: '<?=$plang["terms_cookie"]?>',
		acceptText: '<?=$plang["accept_text"]?>',
		policyText: '<?=$plang["terms_polit"]?>',
		policyURL: 'privacy'
	});
	
	
						try {
							initialiseDropdown_communaute();
							jQuery('.datepicker').datepicker({
								format:'dd/mm/yyyy'
							});

							if (window.location.hash && window.location.hash.length > 1) {
								jQuery('#lien_' + window.location.hash.substring(1)).tab('show');
							}

							var rfc = parseBoolean('false');

							if (rfc) {
								initRFC();
							}
                    }catch(err){
						//alert(err);
					}
		
	
</script>  

  </body> 
</html>

<?php
save_json_data($json_data);
?>