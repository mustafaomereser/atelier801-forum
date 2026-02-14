<?php
include("config.php");
yetkisinir(11);

$file = $_GET['file'];
$mode = $_GET['mode'] ?? 0;

function r(){
socket("komut|reload minigames");
}

$sil = $_GET['sil'];
if(!empty($sil)){
unlink($luadic.$sil);
r();
geri();	
}


if($_POST){
$luacode = $_POST['luacode'];
$luaname = $_POST['luaname'];

if($_GET['mode']==1){
if((strlen($luacode)>=3 && strlen($luaname)>=3)){
	$msg = "Creating...";
	$content = $luacode;
	$fp = fopen($luadic.$luaname.".lua","wb");
	fwrite($fp,$content);
	fclose($fp);
	r();
	yonlendir("?mode=2&lua=".$luaname.".lua");
	exit();
}else{
	$msg = "Please, minimum 3 chracter all input.";
}
}

if($_GET['mode']==2){
if((strlen($luacode)>=3)){
	
	$msg = "Saving...";
	$luaname = strtok($_GET['lua'],".");
	$content = $luacode;
	$fp = fopen($luadic.$luaname.".lua","wb");
	fwrite($fp,$content);
	fclose($fp);
	
	r();
	
	yenile(0,1);
	exit();
	
}else{
	$msg = "Please, minimum 3 chracter all input.";
}
}


}
if(!empty($file) && $mode==2){

$myfile = file_get_contents($luadic.$file);

}elseif($mode==0){
$modules = str_replace($luadic,"",glob($luadic."*.lua"));
}elseif($mode==1){
	
}

?>

        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">

                   <div class="container">

						<div class="statbox widget box box-shadow">
                                <div class="widget-header  p-5">
								<?=$msg?>
								<?php
							if($mode==0){
							?>
			
	<a href="?mode=1" class="btn btn-primary">New Module</a>
	<br><br>
	<?php
	foreach($modules as $row){
	?>
	<div class="col-12 text-center border p-4">
	<div class="float-left"><a class="btn btn-light" onclick="return confirmDel();" href='?sil=<?=$row?>'>Delete</a></div> 
	<?=$row?>
	<div class="float-right"><a href="?mode=2&lua=<?=$row?>" class="btn btn-primary">Edit</a></div> 
	</div>
	<?php
	}
	?>
		
							<?php
							}else{
								
								if($mode==1){
								$btntext = "Create";
								}else{
								$btntext = "Save";
								$luafile = $luadic.$_GET['lua'];
								
								if(file_exists($luafile)){
								$accept="button";
								$text = file_get_contents($luafile);
								$name = $_GET['lua'];
								}
								
								}
								
								
								?>
								
	    <link rel="stylesheet" href="plugins/editors/markdown/simplemde.min.css">
<form method="post">

<div class="input-group mb-4">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Module Name</span>
  </div>
  <input type="<?=$accept ?? "text"?>" value="<?=$name?>" name="luaname" class="form-control" aria-label="Default" aria-describedby="inputGroup-sizing-default" <?php if(!empty($accept)){ echo "readonly"; }?>>
</div>

<div class="col-12">
<textarea name="luacode" id="luaeditor"><?=$text?></textarea>
</div>			
								
    <script src="plugins/editors/markdown/simplemde.min.js"></script>
    <script src="plugins/editors/markdown/custom-markdown.js"></script>
			


<div class="col-12">
	<button type="submit" class="btn btn-primary"><?=$btntext?></button>

</div>

</form>
			
<script>
new SimpleMDE({
    element: document.getElementById("luaeditor"),
    spellChecker: false,
	toolbar: false,
});
</script>								
								<?php
							}

								?>
								
								</div>
						</div>								
						
						
						
						   </div>
                        </div>
                    </div>
                </div>
						
<?php
include("footer.php");
?>						