<?php
include("db.php");
$db = class_db::_mysql($servername, $dbname,$username,$password);

$veri = $_GET['v'];

$ver = $db->query("SELECT * FROM ".$veri."")->fetchAll(PDO::FETCH_ASSOC);

	?>

<?php
foreach($ver as $row){
?>

<pre>

<?=print_r($row)?>

</pre>	
<?php
}

?>