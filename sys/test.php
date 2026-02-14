<html>

<head>
<title>Proje</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

<style>
#editor{
	resize: none;
	
}

</style>

</head>

<body>

<div class="container-fluid" style="padding-top:10px;">
<div class="row">

<div class="col-6">
<textarea id="editor" rows="36%" cols="83%" onkeyup="live(this);"></textarea>
</div>

<div class="col-6">
<div id="s" height="100%" style=""></div>
</div>


</div>
</div>

</body>


<script>
function live(t){
	var htmdl = $('#'+t.id).val();
	$('#s').html(htmdl);
}
</script>


</html>