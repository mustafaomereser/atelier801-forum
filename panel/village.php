<?php
include("config.php");
yetkisinir(11);


$text = file_get_contents($botdic."village.lua");

function r(){
socket("komut|reload village");
}

function update($text){
	global $botdic;
	
	$fp = fopen($botdic."village.lua","wb");
	fwrite($fp,$text);
	fclose($fp);
	r();
		yenile(0,1);

	
}

if($_POST){
	
$content = $_POST['luacode'];

if(!empty($content)){

	update($content);
	
	
}
	
	
}
?>
    
	<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_custom.css">
	<link rel="stylesheet" type="text/css" href="plugins/select2/select2.min.css">
	
	
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">

                   <div class="container">

				   
				   <div class="statbox widget box box-shadow">
                                <div class="widget-header  p-5">

<form method="post">
<div class="mt-2">
    <div class="form-row">
	
	
	  <div class="col-md-12 mb-12">
      <label for="item">Village</label>		
	  <button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#createbot">Create Bot</button>
      <div class="form-group mb-4" id="list">
		
	    <link rel="stylesheet" href="plugins/editors/markdown/simplemde.min.css">



<div class="col-12">
<textarea name="luacode" id="luacode"><?=$text?></textarea>
</div>			
								
    <script src="plugins/editors/markdown/simplemde.min.js"></script>
    <script src="plugins/editors/markdown/custom-markdown.js"></script>
			


<div class="col-12">
	<button type="submit" class="btn btn-primary">Update</button>

</div>
</form>
			
<script>
new SimpleMDE({
    element: document.getElementById("luacode"),
    spellChecker: false,
	toolbar: false,
});
</script>


      </div>
	  
	  
      </div>
       
	 <div class="col-12" id="result_m"></div>

									<?php
									$botc = substr_count($text,"system.addBot(");
									
									$bot = $_POST['bot'];
									if(!empty($bot)){
									$shop = $_POST['shop'];
									
									if(empty($bot[5])){
										$bot[5] = "''";
									}
									
									$bot = "system.addBot(".$bot[0].",'".$bot[1]."',".$bot[2].",'".$bot[3]."',".$bot[4].",".$bot[5].",'".$shop."')";
									
									$ss = str_replace("--botadd--","\n".$bot."\n\n--botadd--",$text);
										update($ss);
									

									}
									
									?>

    </div>
  

</div>
</div>
</div>
</div>				   
</div>
</div>
</div>

                                    <!-- Modal -->
                                    <div class="modal fade" id="createbot" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Bot</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
												    <div class="form-group mb-4">
													<form method="POST">
													<label>Bot ID </label>
													<input type="text" class="form-control" value="-<?=($botc+1)?>" name="bot[]" id="botid" required readonly>
													<label>Bot Name </label>
													<input type="text" class="form-control" name="bot[]" id="botname" required>
													<label>Bot Title </label>
													<input type="text" class="form-control" name="bot[]" id="bottitle" required>
													<label>Bot Look </label>
													<input type="text" class="form-control" name="bot[]" id="botlook" required>
													<label>Bot X,Y </label>
													<input type="text" class="form-control" name="bot[]" id="botxy" required>
													<label>Bot Target </label>
													<input type="text" class="form-control" name="bot[]" id="bottarget" placeholder="if public a bot, blank this input.">
													<label>Bot Shop </label>
													<input type="text" class="form-control" name="shop" id="botshop" required>
											   </div>
											  </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Create</button>
                                                </div>
												</form>

                                            </div>
                                        </div>
                                    </div>
<?php
include("footer.php");
?>

