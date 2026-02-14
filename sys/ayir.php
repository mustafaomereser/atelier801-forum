<?php
@$v = $_POST['ayir'];
if(empty($v)){
?>
<center>
<form method="post">
<textarea name="ayir" rows="20" cols="120"></textarea>
<br><br>
<input type="submit" value="gonder">
</form>
</center>
<?php	
}else{
	
$d = array(">",";","}","{");
$b = array("> \n","; \n	","\n} \n\n","{ \n	");

$v = htmlspecialchars(str_replace($d,$b,$v));
echo "<pre>".$v."</pre>";
}
?>

