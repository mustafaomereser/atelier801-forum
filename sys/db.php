<?php
date_default_timezone_set('Europe/Istanbul');
session_start();
ob_start();

include("linkaccess.php");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "tfm";


class class_db{
	function _mysql($servername="localhost", $dbname="",$username="root",$password=""){
		try {
			$db = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
			$db->exec("SET CHARACTER SET utf8");
			$db->query("SET NAMES utf8");
			$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			return $db;
			
		}catch(PDOException $e){
			exit();
		}	
	}
}

?>
