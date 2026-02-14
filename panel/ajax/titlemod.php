<?php
include("../../pdoconnect.php");
yetkisinir(10);
$v = $_GET['v'];

$d = htmlspecialchars(tfmdil("T_".$v));

?>
<input type="text" class="form-control" name="edittitle" id="edittitle" title="<?=$v?>=" tam="<?="T_".$v?>=<?=$d?>" value="<?=$d?>" required>
