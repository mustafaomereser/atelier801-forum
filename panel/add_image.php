<?php
include("config.php");
yetkisinir(10);
?>
    <link href="plugins/file-upload/file-upload-with-preview.min.css" rel="stylesheet" type="text/css" />

        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">

                   <div class="container">

				   
				   <div class="statbox widget box box-shadow">
                                <div class="widget-header  p-5">

<?php
if($_SESSION['imageupload']<time()){
$uzanti= array('image/jpeg','image/jpg','image/png','image/x-png','image/gif');
$dizin= "uploads/";
$file = $_POST['reas']."_".time()."_".rand(0,10000)."_".$uye['Username'].".".end(explode(".",$_FILES['resim']['name']));
if(in_array(strtolower($_FILES['resim']['type']),$uzanti)){
move_uploaded_file($_FILES['resim']['tmp_name'],"./$dizin/".$file);


echo '

Uploaded image :
<a href="'.$dizin.$file.'">'.$file.'</a>


';

$_SESSION['imageupload']=time()+20;
}
}else{
	echo "Please wait ".($_SESSION['imageupload']-time())." second(s).";
}
?>
<br>


<form method="post" enctype="multipart/form-data">

<select class="form-control" name="reas">
<option value="Lua">Lua</option>
<option value="Normal">Normal</option>
</select>
<br>

<div class="custom-file-container" data-upload-id="mySecondImage">
    <label>Upload <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">x</a></label>
    <label class="custom-file-container__custom-file" >
        <input type="file" name="resim" class="custom-file-container__custom-file__custom-file-input">
        <span class="custom-file-container__custom-file__custom-file-control"></span>
    </label>
    <div class="custom-file-container__image-preview"></div>
</div>
<button class="btn btn-primary">Upload</button>

</div>


</form>


					</div>
				</div>
			</div>				   
		</div>
	</div>
</div>
			
<?php
include("footer.php");
?>
<script src="plugins/file-upload/file-upload-with-preview.min.js"></script>
        
 <script>
 var secondUpload = new FileUploadWithPreview('mySecondImage')
</script>