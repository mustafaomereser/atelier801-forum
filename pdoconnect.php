<?php
error_reporting(0);

include('sys/db.php');
include('sys/decryption.php');

$ayarlar = array("title"=>"MiceForum","discord"=>"https://discord.gg/9gxvw3", "avatar_hep_olsun"=>1,"section_limit"=>30,"topic_limit"=>20,"hit_like"=>10,"version"=>"1.27","dil"=>"tr","sockethost"=>"127.0.0.1","socketport"=>"11801","apikey"=>"wJaDlu9BkXm53pG2SxtE8cgfZUOez6");
$ninc = "C:\Users\Mustafa\Desktop\Z564\include\\";
$luadic=$ninc."lua/minigames/";
$comlogdic=$ninc."CommandLog/";
$logdic=$ninc."ChatLog/";
$botdic=$ninc."files/";

$privlist = array("1"=>"player","2"=>"sentinel","3"=>"arbitre","4"=>"artist","5"=>"funcorp","6"=>"fashion","7"=>"mapcrew","8"=>"moderator","9"=>"coadmin","10"=>"admin","11"=>"founder","12"=>"kurucu");

$mailemail = 'denemekimail@gmail.com';
$mailsifre = 'kocaeli4141';
$mailhost = 'smtp.gmail.com'; 
$mailport = 587;
$mailsmtpsecure = 'tls';

$selectmode=1; // 0 ise manuel olur 1 ise otomatik kendisi url seçer.

if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ){
        $hpt = "https://";
    }else{
        $hpt = "http://";
	}

if($selectmode==0){
	$site = "http://localhost"; // sonu / sız yazın ör : http://localhost.com
}else{
	$site = $hpt.$_SERVER['SERVER_NAME'];
}

	$db = class_db::_mysql($servername, $dbname, $username, $password);

	$ayardb = $db->query("SELECT * FROM forum_settings order by id ASC LIMIT 1")->fetch(PDO::FETCH_ASSOC);


  function cpr($string){  
  $search = array("#","+");
  $replace = array("%23","%2B");
    
  $string = str_replace($search,$replace,$string);

 return $string;  
}  
function rpc($string){  
	$search = array("#","+");
  $replace = array("%23","%2B");
    
  $string = str_replace($replace,$search,$string);

 return $string;  
} 

	function file_ex($d){
		
		$lim = 5;

		for($x=0;$x<=$lim;$x++){

			if(!file_exists($d)){

				$d = "../".$d;
				//echo " | ".$d." | ";

			}else{
			//	echo "buldum";
				return $d;

				break;
			}
			
				if($x==$lim){

					echo $d." Bulamadım :(";
				
				}
			}
	}

	$fil = "sys/linkaccess.php";

	include(file_ex($fil));




  function tfmdil($text,$dr=0){
	  global $tfmdil;
	  
	  $len = strlen("$"); 
	  $len = (substr($text, 0, $len) === "$"); 
	  
	  if($len==true){
		$text = substr($text,1);
	  }		 

	if($dr=0){
		echo $tfmdil[$text] ?? $text;
	}else{
		return $tfmdil[$text] ?? $text;
	}
	
  }
  

	function i_rep($string) {
		$string = tfmdil($string);
		$argumanlar = func_get_args();
		
		for ($i=1;$i<count($argumanlar);$i++){
			$string = str_replace('%'.$i ,$argumanlar[$i],$string);
		}
			
		return $string;
		
	}

  
  function socket($veri=null,$read=0){
	  global $ayarlar;
	  
	  $socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
	  socket_connect($socket, $ayarlar['sockethost'], $ayarlar['socketport']);

	  if(!empty($veri)){
/* 		$data = $ayarlar['apikey']."|".$veri;
		$res = socket_send($socket, $data, strlen($data), MSG_DONTROUTE); */
		
		$_veri = $ayarlar['apikey']."|".Decryption::encrypt($veri,'YORMOM48');
		$res = socket_write($socket, $_veri);

		if ($res === null){
			echo "+ başaramadık abi<br>- Neyi başaramadınız AMMINA KOYUM";
		}
	  } 
	  
	  if($read==1){
		$line = socket_read($socket, 2048);
		
	  if($line===null){
		  echo "<div class='col-12'><font color='red'>Server Closed</font></div>";
	  }
	  
		
	  }
	  
	  if($read==1){
		  socket_close($socket);
		return $line;
	  }elseif($read==2){
		  return $socket;
	  }
	  
	  	  	 // socket_close($socket);

	  
  }
  
  
  function user_check($user){
	  global $socket;
	  
	  $line = socket("usercheck|".$user,1);
	  
	  if($line!=null){
	  	  return $line;

	  }
	  
  }

   function ipadres(){
	   if(getenv("HTTP_CLIENT_IP")) {
	   $ip = getenv("HTTP_CLIENT_IP");
	   } elseif(getenv("HTTP_X_FORWARDED_FOR")) {
		   $ip = getenv("HTTP_X_FORWARDED_FOR");
		   if (strstr($ip, ',')) {
			   $tmp = explode (',', $ip);
			   $ip = trim($tmp[0]);
		   }
	   } else {
		$ip = getenv("REMOTE_ADDR");
	   }
	   return $ip;
  }
  
  
$fil = "diller/";

$dosya = glob(file_ex($fil)."*");
$dosyac = count($dosya);
$diller = array();

for($x=0;$x<$dosyac;$x++) {
	
if($dosya[$x]!=$fil."index.php"){
    $reps = str_replace($fil,"",$dosya[$x]); 
    $dosyae = strtoupper(str_replace(".php","",$reps));
	$diller[$dosyae] = strtolower($dosyae); 
}
}
   function dilbul($ip=""){
	  
/* 	  if(empty($ip)){
		  $ip = ipadres();
	  }
	  
 $jsonobj = 'https://freegeoip.app/json/'.$ip;

    $ch = curl_init(); // Curl yi aktif eder yada tanımlar.
    curl_setopt($ch, CURLOPT_URL, $jsonobj); //Ziyaretr edilecek Url
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); //Aktarımı direk yazmak yerine bir değişken olarak diziyle curl_exec() ten döndermek için kullanılır. TRUE ve FALSE değeri alır.
    $cikti = curl_exec($ch); //İstek sonucu alıyoruz
    curl_close($ch); //Servisi durdurun
    
	$arr = json_decode($cikti, true);

	return $arr['country_code']; */
	  $ret = strtoupper(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'],0,2));
	  //echo $ret;
	  return $ret;
  }
  


if(empty($_SESSION['dil'])){
	
$d = $diller[dilbul()];
//echo dilbul();
if(empty($d)){
 $d = $ayarlar['dil'];
 $dilsecv="B";
}


  $_SESSION['dil'] = "diller/".$d.".php";
}

if (file_ex($_SESSION['dil'])) {
	
}else{
  $_SESSION['dil'] = "diller/".$d.".php";
}


$dilim = $_SESSION['dil'];
$dilimm = str_replace("diller/","",$dilim); 
$dilim = strtoupper(str_replace(".php","",$dilimm));

$dilbfile = "sys/dilb.php";


include($_SESSION['dil']);
include(file_ex($dilbfile));



 $dilrs = array(
	 "xx"=>"communaute.1.nom",
	 "tr"=>"langue.turc",
	 "en"=>"langue.anglais",
	 "fr"=>"langue.francais",
	 "pt"=>"langue.portugais",
	 "es"=>"langue.espagnol",
	 "pl"=>"langue.polonais",
	 "no"=>"langue.norvegien",
	 "ch"=>"langue.chinois",
	 "ru"=>"langue.russe",
	 "ar"=>"langue.arabe",
	 "id"=>"langue.indonesien",
	 "ro"=>"langue.roumain",
	 "de"=>"langue.allemand",
	 "nl"=>"langue.neerlandais",
	 "hu"=>"langue.hongrois",
	 "br"=>"langue.bresilien",
	 "gd"=>"langue.scandinave",
	 "sv"=>"langue.suedois",
	 "dk"=>"langue.danois",
	 "ph"=>"langue.philippin",
	 "fi"=>"langue.finnois",
	 "jp"=>"langue.japonais",
	 "lt"=>"langue.lituanien",
	 "it"=>"langue.italien",
	 "il"=>"langue.hebreu",
	 "lv"=>"langue.letton",
	 "bg"=>"langue.bulgare",
	 "hr"=>"langue.croate",
	 "sk"=>"langue.slovaque",
	 "cs"=>"langue.tcheque",
	 "az"=>"langue.azeri",
	 "et"=>"langue.estonien",
	 "cn"=>"langue.chinois"
	 );

  
  function dilr($text,$mode=0){
	  global $dilrs;
	 $text = strtolower($text);
	 $snc = tfmdil($dilrs[$text]);
	 if($mode==0){
		 echo $snc;
	 }else{
		 return $snc;
	 }
  }
  
  
  
 function topicicon($topic,$mode=0,$favor=null){
 global $db,$site;
 
$tpms = $db->query("SELECT id FROM topicm where topic = '".$topic['id']."'")->fetchAll(PDO::FETCH_ASSOC);
$polvar=0;
foreach($tpms as $findpoll){
$pol = $db->query("SELECT mid FROM polls where mid='".$findpoll['id']."'")->fetch(PDO::FETCH_ASSOC);

if(!empty($pol['mid'])){
$polvar = 1;
}

}
if($mode==0){
  if($topic['pinned']==1){
  ?>
<img src="<?=$site?>/img/icones/postit.png" style="width:16px !important;" class="img24 espace-2-2" />
 <?php
 }
 ?>
 
   <?php
  if($topic['locked']==1){
  ?>
<img src="<?=$site?>/img/icones/cadenas.png" style="width:16px !important;" class="img24 espace-2-2" />
 <?php
 }
}
 ?>
 
 
 <?php
if($polvar==1 && !empty($topic['section'])){
?>
<img src="<?=$site?>/img/icones/sondage.png" style="width:16px !important;" class="img18 espace-2-2">
 <?php
}

if(!empty($favor['id'])){
?>
    <img src="<?=$site?>/img/icones/16/favori.png" style="width:16px !important;" class="img18 espace-2-2">
<?php
}
	
}
  
  
  function sirabul($topic=0,$mode=0){
	global $db,$ayarlar;
	$t	= $db->query("SELECT id,topic FROM topicm WHERE id = '".$topic."'")->fetch(PDO::FETCH_ASSOC); 	
	
	$tsay = $db->query("SELECT id FROM topicm WHERE topic ='".$t['topic']."' order by id ASC");

	$tsc = $tsay->rowCount();
	$tsay=$tsay->fetchAll(PDO::FETCH_ASSOC);
	
	$devam=0;
	$sira=0;
	
	foreach($tsay as $row){
		
		if($devam==0){
			
			$sira++;
			
			if($row['id']==$t['id']){
			$page=ceil($tsc / $ayarlar['topic_limit']);
			$devam=1;
			break;
			}
			//echo "BREAK NOT WORK";
			
		}
	}
		if($mode==0){
	  		return $sira;
		}elseif($mode==1){
			return $page;
		}
		
		
		
  }
  
  
  
  
  function _exit(){
	global $plang,$ayarlar;
	echo "<script>$('#seconder_menu').attr('style','display: none;');</script>";
	include("footer.php");
	exit();
  }
  
 //_exit();
 
function convertSecToStr($secs){
	  global $plang;
    $output = '';
    if($secs >= 86400) {
        $days = floor($secs/86400);
        $secs = $secs%86400;
        $output = $days.' '.$plang['gun'];
        if($days != 1) $output .= '';
        if($secs > 0) $output .= ', ';
        }
    if($secs>=3600){
        $hours = floor($secs/3600);
        $secs = $secs%3600;
        $output .= $hours.' '.$plang['saat'];
        if($hours != 1) $output .= '';
        if($secs > 0) $output .= ', ';
        }
    if($secs>=60){
        $minutes = floor($secs/60);
        $secs = $secs%60;
        $output .= $minutes.' '.$plang['dakika'];
        if($minutes != 1) $output .= '';
        if($secs > 0) $output .= ', ';
        }
    $output .= $secs.' '.$plang['saniye'];
    if($secs != 1) $output .= '';
    return $output;
}
  
  
function txed($name="Null",$id="Null",$val="",$bbcode=1){
	global $site, $plang;
?>


 <div class="" id="outils_message_reponse"> 
 <?php
 if($bbcode==1){
 ?>
 <div class="btn-group groupe-boutons-barre-outils"> 
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[b]', '[/b]', 3);" title="<?=$plang['bold']?>">
 <img src="<?=$site?>/img/icones/16/edit-bold.png" style="display: block;"></button> <button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[i]', '[/i]', 3);" title="<?=$plang['italic']?>">
 <img src="<?=$site?>/img/icones/16/edit-italic.png" style="display: block;">
 </button> <button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[u]', '[/u]', 3);" title="<?=$plang['underlined']?>">
 <img src="<?=$site?>/img/icones/16/edit-underline.png" style="display: block;">
 </button> 
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[s]', '[/s]', 3);" title="<?=$plang['strikethrough']?>">
 <img src="<?=$site?>/img/icones/16/edit-strike.png" style="display: block;">
 </button> 
 </div> 

 <div class="btn-group groupe-boutons-barre-outils"> 
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[color=#]', '[/color]', 8);" title="<?=$plang['colorhex']?>">
 <img src="<?=$site?>/img/icones/16/edit-color.png" style="display: block;">
 </button> 
 <button class="btn dropdown-toggle btn-sm" style="height:22px;" data-toggle="dropdown"> 
 <span style="margin-top:2.8px;" class="caret"></span>
 </button> 
 <ul class="dropdown-menu pull-right label-message"> 
 <table> 
 <tbody>
 <tr>
 <td class="cellule-dropdown">
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#009D9D]', '[/color]', 15);">
 <span style="color:#009D9D;">#009D9D</span>
 </a>
 </li>
 </td> 
 <td class="cellule-dropdown">
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#2E72CB]', '[/color]', 15);">
 <span style="color:#2E72CB;">#2E72CB</span>
 </a>
 </li>
 </td>
 <td class="cellule-dropdown">
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#30BA76]', '[/color]', 15);">
 <span style="color:#30BA76;">#30BA76</span>
 </a>
 </li>
 </td>
 </tr>
 <tr> 
 <td class="cellule-dropdown">
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#606090]', '[/color]', 15);">
 <span style="color:#606090;">#606090</span>
 </a>
 </li>
 </td> 
 <td class="cellule-dropdown"><li><a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#6C77C1]', '[/color]', 15);">
 <span style="color:#6C77C1;">#6C77C1</span>
 </a>
 </li>
 </td>
 <td class="cellule-dropdown">
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#92CF91]', '[/color]', 15);">
 <span style="color:#92CF91;">#92CF91</span>
 </a>
 </li>
 </td> 
 </tr> 
 <tr> 
 <td class="cellule-dropdown">
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#98E2EB]', '[/color]', 15);">
 <span style="color:#98E2EB;">#98E2EB</span>
 </a>
 </li>
 </td> <td class="cellule-dropdown">
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#BABD2F]', '[/color]', 15);">
 <span style="color:#BABD2F;">#BABD2F</span>
 </a>
 </li>
 </td> 
 <td class="cellule-dropdown">
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#C2C2DA]', '[/color]', 15);">
 <span style="color:#C2C2DA;">#C2C2DA</span>
 </a>
 </li>
 </td> 
 </tr> 
 <tr> 
 <td class="cellule-dropdown"><li><a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#CB546B]', '[/color]', 15);">
 <span style="color:#CB546B;">#CB546B</span>
 </a>
 </li>
 </td> 
 <td class="cellule-dropdown">
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#EB1D51]', '[/color]', 15);">
 <span style="color:#EB1D51;">#EB1D51</span>
 </a>
 </li>
 </td>
 <td class="cellule-dropdown">
 <li><a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#ED67EA]', '[/color]', 15);">
 <span style="color:#ED67EA;">#ED67EA</span>
 </a>
 </li>
 </td>
 </tr> 
 <tr>
 <td class="cellule-dropdown">
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#EDCC8D]', '[/color]', 15);">
 <span style="color:#EDCC8D;">#EDCC8D</span>
 </a>
 </li>
 </td>
 <td class="cellule-dropdown">
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#E68D43]', '[/color]', 15);">
 <span style="color:#E68D43;">#E68D43</span>
 </a>
 </li>
 </td>
 <td class="cellule-dropdown">
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#F0A78E]', '[/color]', 15);">
 <span style="color:#F0A78E;">#F0A78E</span>
 </a>
 </li>
 </td>
 </tr>
 <tr> 
 <td class="cellule-dropdown">
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[color=#FEB1FC]', '[/color]', 15);">
 <span style="color:#FEB1FC;">#FEB1FC</span>
 </a>
 </li>
 </td>
 </tr>
 </tbody>
 </table> 
 </ul> 
 
 </div> 
 <div class="btn-group groupe-boutons-barre-outils"> 
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[size=]', '[/size]', 6);" title="<?=$plang['size']?>">
 <img src="<?=$site?>/img/icones/16/edit-size.png" style="display: block;"></button> 
 <button class="btn dropdown-toggle btn-sm" style="height:22px;" data-toggle="dropdown"> 
 <span style="margin-top:2.8px;" class="caret"></span>
 </button> 
 <ul class="dropdown-menu"> 
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[size=10]', '[/size]', 9);">
 <span style="font-size:10px"><?=$plang['small']?></span>
 </a>
 </li> 
 <li><a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[size=16]', '[/size]', 9);">
 <span style="font-size:16px"><?=$plang['large']?></span>
 </a>
 </li> 
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[size=20]', '[/size]', 9);">
 <span style="font-size:20px"><?=$plang['huge']?></span>
 </a>
 </li> 
 </ul>
 </div> 
 <div class="btn-group groupe-boutons-barre-outils"> 
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[font=]', '[/font]', 6);" title="<?=$plang['font']?>">
 <img src="<?=$site?>/img/icones/16/edit-font.png" style="display: block;"></button> 
 <button class="btn dropdown-toggle btn-sm" style="height:22px;" data-toggle="dropdown"> 
 <span style="margin-top:2.8px;" class="caret"></span>
 </button> 
 <ul class="dropdown-menu"> 
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[font=Arial]', '[/font]', 12);">
 <span style="font-family:Arial;">Arial</span>
 </a>
 </li> 
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[font=Comic Sans MS]', '[/font]', 20);">
 <span style="font-family:Comic Sans MS;">Comic Sans MS</span></a>
 </li>
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[font=Impact]', '[/font]', 13);">
 <span style="font-family:Impact;">Impact</span>
 </a>
 </li> 
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[font=Lucida Console]', '[/font]', 21);">
 <span style="font-family:Lucida Console;">Lucida Console</span>
 </a>
 </li>
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[font=Tahoma]', '[/font]', 13);">
 <span style="font-family:Tahoma;">Tahoma</span>
 </a>
 </li> 
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[font=Verdana]', '[/font]', 14);">
 <span style="font-family:Verdana;">Verdana</span>
 </a>
 </li> 
 </ul> 
 </div>  
 
 <div class="btn-group groupe-boutons-barre-outils"> 
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[p=]', '[/p]', 3);" title="<?=$plang['alignment']?>">
 <img src="<?=$site?>/img/icones/16/edit-alignment.png" style="display: block;"></button> 
 <button class="btn dropdown-toggle btn-sm" style="height:22px;" data-toggle="dropdown"> 
 <span style="margin-top:2.8px;" class="caret"></span>
 </button> 
 <ul class="dropdown-menu"> 
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[p=left]', '[/p]', 8);">
 <img src="<?=$site?>/img/icones/16/edit-alignment.png" style="display: block; float:left; padding-right:3px;"> <?=$plang['left']?></a>
 </li> <li><a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[p=right]', '[/p]', 9);">
 <img src="<?=$site?>/img/icones/16/edit-alignment-right.png" style="display: block; float:left; padding-right:3px;"> <?=$plang['right']?></a>
 </li> 
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[p=center]', '[/p]', 10);">
 <img src="<?=$site?>/img/icones/16/edit-alignment-center.png" style="display: block; float:left; padding-right:3px;"> <?=$plang['center']?></a>
 </li> 
 <li>
 <a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[p=justify]', '[/p]', 11);">
 <img src="<?=$site?>/img/icones/16/edit-alignment-justify.png" style="display: block; float:left; padding-right:3px;"> <?=$plang['justify']?></a>
 </li> 
 </ul> 
 </div> 
 <div class="btn-group groupe-boutons-barre-outils"> 
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[hr]\n', '', 5);" title="<?=$plang['seperation']?>">
 <img src="<?=$site?>/img/icones/16/separation.png" style="display: block;">
 </button> 
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[#]', '[/#]\n[#][/#]', 2);" title="<?=$plang['uitab']?>">
 <img src="<?=$site?>/img/icones/16/ui-tab.png" style="display: block;"></button>  
 <button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[table]\n[row][cel]', '[/cel][cel][/cel][/row]\n[/table]', 18);" title="<?=$plang['table']?>">
 <img src="<?=$site?>/img/icones/16/table.png" style="display: block;"></button> 
</div>  
<div class="btn-group groupe-boutons-barre-outils"> 
<button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[img]', '[/img]', 5);" title="<?=$plang['image']?>">
<img src="<?=$site?>/img/icones/16/image.png" style="display: block;"></button>
<button class="btn dropdown-toggle btn-sm" style="height:22px;" data-toggle="dropdown"> 
 <span style="margin-top:2.8px;" class="caret"></span>
 </button> 
<ul class="dropdown-menu"> 
<li>
<a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[img align=left]', '[/img]', 16);">
<img src="<?=$site?>/img/icones/16/edit-image.png" style="display: block;float:left; padding-right:3px;"> <?=$plang['leftalign']?></a>
</li> 
<li>
<a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[img align=right]', '[/img]', 17);">
<img src="<?=$site?>/img/icones/16/edit-image-right.png" style="display: block;float:left; padding-right:3px;"> <?=$plang['rightalign']?></a>
</li> 
<li>
<a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[p=center][img]', '[/img][/p]', 15);">
<img src="<?=$site?>/img/icones/16/edit-image-center.png" style="display: block;float:left; padding-right:3px;"> <?=$plang['centeralign']?></a>
</li> 
</ul> 
</div> 
<div class="btn-group groupe-boutons-barre-outils"> 
<button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[video]', '[/video]', 7);" title="Video">
<img src="<?=$site?>/img/icones/16/film.png" style="display: block;"></button> 
<button class="btn dropdown-toggle btn-sm" style="height:22px;" data-toggle="dropdown"> 
 <span style="margin-top:2.8px;" class="caret"></span>
 </button> 
  <ul class="dropdown-menu"> 
<li>
<a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[video]https://www.youtube.com/embed/', '[/video]', 37);">YouTube</a>
</li> 

<li>
<a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[video]https://www.dailymotion.com/embed/video/', '[/video]', 46);">Dailymotion</a>
</li>
<li>
<a class="element-menu-outils" onclick="ajouterBBCode('<?=$id?>', '[video]https://player.vimeo.com/video/', '[/video]', 37);">Vimeo</a>
</li> 

</ul> 
</div> 
<div class="btn-group groupe-boutons-barre-outils"> 
<button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[url=]', '[/url]', 5);" title="<?=$plang['link']?>">
<img src="<?=$site?>/img/icones/16/ui-label-link.png" style="display: block;"></button>
<button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[list]\n[*][/*]\n[*][/*]\n', '[/list]', 10);" title="<?=$plang['list']?>">
<img src="<?=$site?>/img/icones/16/edit-list.png" style="display: block;"></button> 
<button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[quote=]', '[/quote]', 8);" title="<?=$plang['quote']?>">
<img src="<?=$site?>/img/icones/16/edit-quotation.png" style="display: block;"></button> 
<button type="button" class="btn btn-reduit" onclick="ajouterBBCode('<?=$id?>', '[spoiler]', '[/spoiler]', 9);" title="<?=$plang['lock']?>">
<img src="<?=$site?>/img/icones/16/lock.png" style="display: block;"></button>
 </div>  
 
 <div class="btn-group groupe-boutons-barre-outils">   
 <button type="button" class="btn btn-reduit btn-info" onclick="onizle('<?=$id?>', 'previsualisation_<?=$id?>');"><?=$plang['previsualisation']?></button>
 <button type="button" class="btn btn-reduit btn-inverse" onclick="jQuery('#previsualisation_<?=$id?>').html('');"><?=$plang['previsualisation_hide']?></button>
 </div> 
<?php
}
?>
 
 <textarea id="<?=$id?>" name="<?=$id?>" rows="5" class="input-message input-xxlarge ltr" maxlength="60000" onkeydown="traiterAppuiToucheMessage(this, event);"><?=$val?></textarea> 
 <div id="previsualisation_<?=$id?>">

 </div>
 
 </div> 

 </form>    




<script type="text/javascript">


	function afficherFormulaireReponse() {
//		jQuery('#cadre_nouveau_message').removeClass('hidden');jQuery('#bouton_nouveau_message').addClass('hidden');

		jQuery("#<?=$id?>").caret(0, 0);
	}

//	function masquerFormulaireReponse() {
//		jQuery('#cadre_nouveau_message').addClass('hidden');jQuery('#bouton_nouveau_message').removeClass('hidden');
//	}

	function citer(nom, texte) {

		if (estVideOuNull(texte)) {
			return;
		}

		afficherFormulaireReponse();

		var area = jQuery("#<?=$id?>");

		var val = area.val();

		if (val.length > 0) {
			val += '\n[quote=' + nom + ']' + texte + '[/quote]\n';
		}
		else {
			val += '[quote=' + nom + ']' + texte + '[/quote]\n';
		}

		area.val(val);
		area.atCaret('setCaretPosition', val.length);

//		jQuery("#message_reponse").append('[quote=' + nom + ']' + texte + '[/quote]\n');
//		jQuery("#message_reponse").caret(jQuery("#message_reponse").html().length, 0);

		window.location.href = "#<?=$id?>";
	}
</script>

<?php  
}

function topic_tasi($id,$nereye){
	global $db,$site;
	$section = $db->query("SELECT id,forum FROM section where id = '".$nereye."'")->fetch(PDO::FETCH_ASSOC);
	$topic = $db->query("SELECT id,section FROM topic where id = '".$id."'")->fetch(PDO::FETCH_ASSOC);
	
	if(!empty($topic['id']) && !empty($section['id'])){
	
	if($nereye!=$topic['section']){
	$tc = $db->exec("UPDATE topic set section = '".$nereye."' where id = '".$id."'");
	yonlendir($site."/section?f=".$section['forum']."&s=".$nereye,0);
	}else{
		popupn(tfmdil('text.error'));
	}
	
		}else{
		
		popupn(tfmdil('EchecPaiement'));
		
	}
	
}

function getavatar($id){
	global $ayarlar;
	if(!empty($id['Avatar'])){
		$d = $id['PlayerID'] % 10000 ."/".$id['Avatar'];
	}elseif($ayarlar['avatar_hep_olsun']==1){
		$d = "0/0.jpg";
	}
	//echo $d;
	return $d;
	
}


function pagecreate($id="null",$page_count=0){
$page = $_GET['p'] ?? 1;

if(strstr(links(),"?")){
	$gets = "&";
}else{
	$gets = "?";
}


$link = explode($gets."p=",links())[0];
?>

<div class="cadre-pagination btn-group ltr" id="pagination_control" bis_skin_checked="1">
<?php
if(!($page == 1)){
?>
<a class="btn btn-inverse " href="<?=$link.$gets?>p=1">
«</a>
 <a class="btn btn-inverse " href="<?=$link.$gets?>p=<?=($page - 1)?>">
‹</a>
<?php
}
?>
<script>
function gopage(){
var val = $("#<?=$id?>").val();
var max = $('#<?=$id?>').attr("max");

if((!(val>max)) && val>=1){
window.location.assign('<?=$link.$gets?>p='+val);
}

}
</script>

<a class="btn btn-inverse" href="#" active="" disabled="">
<?=$page?> / <maxpagecount><?=$page_count?></maxpagecount>
</a>

<input class="input-pagination" type="number" id="<?=$id?>" name="p" min="1" max="<?=$page_count?>" value="<?=$page?>" onkeypress="if (event.keyCode == 13) { gopage(); };">
<button class="btn btn-inverse" type="button" onclick="gopage();">
GO
</button>

<?php
if($page_count==0){
?>
<script>
retrun maxpage("<?=$id?>");
</script>
<?php
}


if(!($page == $page_count)){
?>
<a class="btn btn-inverse" id='sonraki' href="<?=$link.$gets?>p=<?=($page + 1)?>">
›
</a>
<a class="btn btn-inverse" id='son' href="<?$link.$gets?>p=<?=$page_count?>">
»
</a>
<?php
}
?>
</div>
<?php	
}




function toptarih($date,$ret=0){
	if(date("d")!=date("d",$date)){
	$tar = "d/m/Y ";
}else{
	$tar = "";
}
if($ret=0){
		echo date("".$tar." h:i",$date);
}else{
	return date("".$tar." h:i",$date);
}

}


function imgresize($sourcePath,$path,$h = 100){
	$file = "sys/pjImage.component.php";
	
		$file = file_ex($file);
	
		include_once $file;

		if(file_exists($sourcePath)){
		$Image = new pjImage();
		
		$size = @getimagesize($sourcePath);
		$src_width = $size[0];
		$src_height = $size[1];
				


				$Image->loadImage($sourcePath);
				$resp = $Image->isConvertPossible();
				if ($resp['status'] === true)
				{
					$Image->resize($h, $h);
				}
			
		

		$quality = 100;
		$Image->output($quality,$path);		
	
	}
	
}


function isim($isim,$mode="s",$uyeid="",$date="",$msg="",$topic=""){
	global $db,$erisim,$site,$uye,$plang,$ylist,$yetkim,$op,$yetkimlist;
	
	$ia = explode("#",$isim);
	if(!empty($ia[1])){
	$ia[1] = "#".$ia[1];
	}
	$ib = $db->query("SELECT * FROM users where Username = '".$ia[0]."' and Tag = '".$ia[1]."'")->fetch(PDO::FETCH_ASSOC);

	if(!empty($ib['PlayerID']) || $mode=="tribe"){
		
	$pt = $db->query("SELECT * FROM profilesuser where player = '".$ib['PlayerID']."'")->fetch(PDO::FETCH_ASSOC);
		
		
	$ib['Username'] = cpr($ib['Username']);
		
	$yetki = $ib['PrivLevel'];	
	$yetkilist = explode(",",$yetki);
	$yetki = max(explode(",",$ib['PrivLevel']));

	if($yetki>=9 && $yetki<=11){
		$cadre = "cadre-type-auteur-admin";
	}elseif($yetki==8){
		$cadre = "cadre-type-auteur-moderateur";
	}elseif($yetki==7){
		$cadre = "cadre-type-auteur-mapcrew";	
	}elseif($yetki==6){
		$cadre = "cadre-type-auteur-fashion";	
	}elseif($yetki==5){
		$cadre = "cadre-type-auteur-funcorp";	
	}elseif($yetki==4){
		$cadre = "cadre-type-auteur-artist";	
	}elseif($yetki==2){
		$cadre = "cadre-type-auteur-sentinelle";	
	}else{
		$cadre = "cadre-type-auteur-joueur";
	}	

		
	
	if($ib['Gender']==2){
	$imng = "garcon.png";
 	$cins = tfmdil('texte.garcon');
  }elseif($ib['Gender']==1){
  $imng = "fille.png";
	$cins = tfmdil('texte.fille');
  }
    
    if($pt['online']>=time() || ($ib['PlayerID']==$uye['id'] && $pt['stonline']==1)){
     $imgonl = "on-offbis2.png";
 	 $textonl = $plang['online'];
    }else{
     $imgonl = "on-offbis1.png";
	 $textonl = $plang['offline'];
    }

	$titlef = tfmdil('T_'.$ib['TitleNumber'],1);
if($mode=="o"){
	?>
<span class="<?=$cadre?> pointer" onclick='window.location.assign("<?=$site?>/profile?pr=<?=$ib['Username'].cpr($ib['Tag'])?>")'>
 <img src="<?=$site?>/img/icones/16/<?=$imgonl?>" alt=""> <?=$ia[0]?><span class="font-s couleur-hashtag-pseudo"> <?=$ia[1]?></span>
 </span> 
 
	<?php
}


if($mode=="nm"){
	?>
<span class="<?=$cadre?> pointer"><img src="<?=$site?>/img/icones/16/<?=$imgonl?>" alt="">  <?=$ia[0]?><span class="font-s couleur-hashtag-pseudo"> <?=$ia[1]?></span></span>
	<?php
}


if($mode=="tribe"){
	?>
<span class="<?=$cadre?> pointer" onclick='window.location.assign("<?=$site?>/tribe?tr=<?=$uyeid?>")'> <?=$ia[0]?></span> 
 
	<?php
}


if($mode=="pm"){

	?>
	 <td class="table-cellule-gauche_haut">
                 <div class="cadre-auteur-message cadre-auteur-message-court element-composant-auteur ">
  <div class="btn-group bouton-nom max-width">
 <a class="dropdown-toggle highlightit" data-toggle="dropdown" href="#">
  
  <span class="element-bouton-profil bouton-profil-nom <?=$cadre?> nom-utilisateur-scindable pointer">
 <img src="<?=$site?>/img/icones/16/<?=$imgonl?>" alt="">  <?=$ia[0]?>
 </span> 
  
  
</span>
     
	 <?php
	 if(!empty(getavatar($ib))){
	 ?>
		<img src="<?=$site?>/img/avatars/<?=getavatar($ib)?>" class="element-composant-auteur bouton-profil-avatar" alt="" />
	 <?php
	 }
	 ?>
	 
 <div class="rang-prestige">
	&laquo; <?=$titlef?> &raquo; 
 </div>
 
 <?php
 
  $t_c = $db->query("SELECT tribe FROM section where id = '".$topic['section']."'")->fetch(PDO::FETCH_ASSOC);
if(!empty($t_c['tribe']) && $ib['TribeCode']==$t_c['tribe']){
	$trb = $db->query("SELECT Code,Ranks FROM tribe where Code='".$t_c['tribe']."'")->fetch(PDO::FETCH_ASSOC);
	if(!empty($trb['Code'])){
		$ranks = explode(";",$trb['Ranks']);
	
 ?>
	<div class="rang-tribu">
			<?php $sl = $ranks[$ib['TribeRank']]; $sl = explode("|",$sl); echo tfmdil($sl[1]);?>

	</div>
  <?php
	}
}
 
 ?>
 
    <div class="element-composant-auteur cadre-auteur-message-date">
<span>
<?=toptarih($date)?>
</span>
</div>
  </a>
 <ul class="dropdown-menu menu-contextuel pull-left">
 <table>
 <tr>
    <td class="cellule-menu-contextuel"> 
    <ul class="liste-menu-contextuel"> 
    <li class="nav-header">
    <img src="<?=$site?>/img/pays/<?=strtolower($ib['Langue'])?>.png" class="img16 espace-2-2" /> 
	<?php
	if(!empty($imng)){
	?>
   <img src="<?=$site?>/img/icones/<?=$imng?>" class="img16 espace-2-2" /> 
   	<?php
  }
	?>
   
   
   <?=$ia[0]?><span class="nav-header-hashtag"><?=$ia[1]?></span>
    </li>
     <li>
     <a class="element-menu-contextuel" href="<?=$site?>/profile?pr=<?=$ib['Username'].cpr($ib['Tag'])?>">
     <img src="<?=$site?>/img/icones/16/1profil.png" class="espace-2-2" alt=""><?=tfmdil('texte.profil')?></a>
     </li>
      <li>
      <a class="element-menu-contextuel" href="<?=$site?>/posts?pr=<?=$ib['Username'].cpr($ib['Tag'])?>">
      <img src="<?=$site?>/img/icones/16/1historique-posts2.png" class="espace-2-2" alt=""><?=$plang['last_posts']?> </a>
      </li> 
	  <?php
	  if($uye['PlayerID']!=$ib['PlayerID']){
	  ?>
       <li>
       <a class="element-menu-contextuel" href="<?=$site?>/new-dialog?ad=<?=$ib['Username'].cpr($ib['Tag'])?>">
      <img src="<?=$site?>/img/icones/16/enveloppe.png" class="espace-2-2" alt=""><?=$plang['send_message']?></a>
	  </li>
	  <?php
		}
	  ?>	

	  
        <li>
		<a href="<?=$site?>/tribe?tr=<?=$ib['TribeCode']?>" class="element-menu-principal"><img src="<?=$site?>/img/icones/16/1tribu.png" class="espace-2-2" alt="">
        <?=tfmdil('texte.tribu')?>
        </a>
        </li> 
<?php
if(($yetkim>=8 || !empty($yetkimlist['sentinel'])) && isset($_SESSION['id'])){
?>
      <li>
		<a class="element-menu-contextuel" onclick="punish(<?=$ib['PlayerID']?>);" data-toggle="modal" data-target="#p_menu">
		<img src="<?=$site?>/img/icones/16/trash-pleine.png" class="espace-2-2" alt="">Sanction</a>
      </li>
<?php
}
?>
        </ul> 
        </td> 
<?php
if($msg['handled']==0 && $topic['locked']==0 && !empty($uye['id']) || ($yetkim>=8 || $op>=1)){
?>		
<td class="cellule-menu-contextuel">
<ul class="liste-menu-contextuel">

<li class="nav-header">
<?=tfmdil('texte.message')?>
</li>
<?php
if(!empty($uye['id'])){
?>
<li>
<a class="element-menu-contextuel" onclick="citer('<?=str_replace("%2B","+",$ib['Username'])?>', jQuery('#edit_message_<?=$msg['id']?>').text());">
<?=tfmdil('Citer')?></a>
</li>

<li>
<a class="element-menu-contextuel" onclick="ouvrirFormulaireCadre('cadre_signaler_element_<?=$msg['id']?>');">
<?=tfmdil('bouton.signaler')?></a>
</li>
<?php
}
?>


<?php

if(!empty($msg['id'])){
?>


<?php
if($uyeid==$uye['PlayerID'] && $msg['handled']==0  && $topic['locked']==0 || ($yetkim>=8 || $op>=1) ){
?>
<li>
 <a class="element-menu-contextuel" onclick="ouvrirFormulaireCadre('cadre_editer_message_<?=$msg['id']?>');">
<?=tfmdil('bouton.editer')?>
</a>
</li>
<?php
}
?>

<?php
 if(!empty($ylist['sentinel']) || $yetkim>=8 || $op>=1 ){
?>
<li><a class="element-menu-contextuel" onclick="ouvrirFormulaireCadre('cadre_moderer_message_<?=$msg['id']?>');"><?=$plang['mudahale_text']?></a></li>
<?php
}
?>

<?php
 if(($yetkim>=11 || $op>=1)){
	 
 $td = $db->query("SELECT * FROM topicm where id = '".$msg['id']."'")->fetch(PDO::FETCH_ASSOC); 
	if($td['devtracker']==1){
		$devtr = "(REMOVE)";

	}else{
		$devtr = "(ADD)";

	}

$del_msg = $_GET['del-msg'];

if(!empty($del_msg)){
$del = $db->exec("DELETE FROM topicm where id = '".$del_msg."'");	
$d = $db->exec("DELETE FROM likes where data = '".$del_msg."' and topic = '".$_GET['t']."'");

if($del>0){
geri();	
}
exit();
}
	 
?>
<li><a class="element-menu-contextuel" href='<?=links()?>&dev-tracker=<?=$msg['id']?>'>Dev-tracker <?=$devtr?></a></li>
<li><a class="element-menu-contextuel" href='<?=links()?>&del-msg=<?=$msg['id']?>'><?=tfmdil('Supprimer')?></a></li>
<?php
}
}
?>


     </ul>
 </td>
 <?php
 }
 ?>
              </tr>
 </table>
 </ul>
 </div>
   </div>
 </td>
 <?php


}


  if($mode=="s" || $mode=="tm"){
?>

<div class="longueur-defaut element-composant-auteur display-inline-block"> 
<div class="btn-group bouton-nom max-width">
 <a class="dropdown-toggle highlightit" data-toggle="dropdown" href="#">   
 <?php
 if($mode=="s"){
?> 
<span class="element-bouton-profil bouton-profil-nom <?=$cadre?> nom-utilisateur-scindable"> 
  <?php
 }elseif($mode=="tm"){
?> 
<span class="cadre-ami-nom <?=$cadre?>">
  <?php
  }
  ?> 
 <img src="<?=$site?>/img/icones/16/<?=$imgonl?>" alt="">  <?=$ia[0]?><span class="font-s couleur-hashtag-pseudo"> <?=$ia[1]?></span></span>       
 </a> 
 <ul class="dropdown-menu menu-contextuel pull-left">
  <table>
   <tbody>
   <tr>    
    <td class="cellule-menu-contextuel"> 
    <ul class="liste-menu-contextuel"> 
    <li class="nav-header">
    <img src="<?=$site?>/img/pays/<?=strtolower($ib['Langue'])?>.png" class="img16 espace-2-2" /> 
	<?php
	if(!empty($imng)){
	?>
   <img src="<?=$site?>/img/icones/<?=$imng?>" class="img16 espace-2-2" /> 
   	<?php
  }
	?>
   <?=$ia[0]?><span class="nav-header-hashtag"><?=$ia[1]?></span>
    </li>
     <li>
     <a class="element-menu-contextuel" href="<?=$site?>/profile?pr=<?=$ib['Username'].cpr($ib['Tag'])?>">
     <img src="<?=$site?>/img/icones/16/1profil.png" class="espace-2-2" alt=""><?=tfmdil('texte.profil')?></a>
     </li>
      <li>
      <a class="element-menu-contextuel" href="<?=$site?>/posts?pr=<?=$ib['Username'].cpr($ib['Tag'])?>">
      <img src="<?=$site?>/img/icones/16/1historique-posts2.png" class="espace-2-2" alt=""><?=$plang['last_posts']?></a>
      </li> 
	  <?php
	  if($uye['PlayerID']!=$ib['PlayerID']){
	  ?>
       <li>
       <a class="element-menu-contextuel" href="<?=$site?>/new-dialog?ad=<?=$ib['Username'].cpr($ib['Tag'])?>">
      <img src="<?=$site?>/img/icones/16/enveloppe.png" class="espace-2-2" alt=""><?=$plang['send_message']?></a>
	  </li>
	  <?php
		}
	  ?>
        <li>
		<a href="<?=$site?>/tribe?tr=<?=$ib['TribeCode']?>" class="element-menu-principal"><img src="<?=$site?>/img/icones/16/1tribu.png" class="espace-2-2" alt="">
        <?=tfmdil('texte.tribu')?>
        </a>
        </li>

<?php
if(($yetkim>=8 || !empty($yetkimlist['sentinel'])) && isset($_SESSION['id'])){
?>
      <li>
		<a class="element-menu-contextuel" onclick="punish(<?=$ib['PlayerID']?>);" data-toggle="modal" data-target="#p_menu">
		<img src="<?=$site?>/img/icones/16/trash-pleine.png" class="espace-2-2" alt="">Sanction</a>
      </li>
<?php
}
?>
		
        </ul> 
        </td>       
       </tr>
        </tbody>
        </table>
         </ul>
          </div>
             </div>

<?php
  }
  
 
  if($mode=="m"){

  }

	if($mode=="p"){

	echo '
	<td> 
  <div class="avatar-profil">
  
  ';
  ?>
  
   <?php
	 if(!empty(getavatar($ib))){
	 ?>
		<img src="<?=$site?>/img/avatars/<?=getavatar($ib)?>" class="img100" alt="" />
	 <?php
	 }
	 ?>  
  
  <?php
  echo '
  </div> 
  </td> 
  <td class="table-cadre-cellule-principale"> 
  <div class="cadre-utilisateur-principal"> 
  <div class="btn-group bouton-nom-profil"> 
  <a class="dropdown-toggle" data-toggle="dropdown" href="#"> 
  <span class="font-xxl '.$cadre.'">
  <img src="'.$site.'/img/icones/roue-dentee.png" class="img20 espace-2-2"/> '.$ia[0].' <span class="couleur-hashtag-pseudo font-l"> '.$ia[1].'</span>
  </span> 
  </a> 
  <ul class="dropdown-menu menu-contextuel pull-left"> 
  <table> 
  <tr>     
  <td class="cellule-menu-contextuel"> 
  <ul class="liste-menu-contextuel"> 
  <li class="nav-header">
  <img src="'.$site.'/img/pays/'.strtolower($ib['Langue']).'.png" class="img16 espace-2-2" /> 
  ';
  if(!empty($imng)){
  ?>
  
  <img src="<?=$site?>/img/icones/<?=$imng?>" class="img16 espace-2-2" />
  
  <?php
  }
  echo '
  '.$ia[0].' <span class="couleur-hashtag-pseudo"> '.$ia[1].'</span>
  </li> 
  
  <li>
  <a class="element-menu-contextuel" href="'.$site.'/profile?pr='.$ib['Username'].cpr($ib['Tag']).'">
  <img src="'.$site.'/img/icones/16/1profil.png" class="espace-2-2" alt="">'.tfmdil('texte.profil').'</a>
  </li> 
  
  <li>
  <a class="element-menu-contextuel" href="posts?pr='.$ib['Username'].cpr($ib['Tag']).'">
  <img src="'.$site.'/img/icones/16/1historique-posts2.png" class="espace-2-2" alt="">'.$plang['last_posts'].' </a>
  </li> 
  
  
  <li>
  <a href="'.$site.'/tribe?tr='.$ib['TribeCode'].'" class="element-menu-principal">
  <img src="'.$site.'/img/icones/16/1tribu.png" class="espace-2-2" alt="">'.tfmdil('texte.tribu').'</a>
  </li> 
  ';
  
 

  
  if($uye['id']!=$ib['PlayerID']){
  echo '
   <li>
  <a href="'.$site.'/new-dialog?ad='.$ib['Username'].'" class="element-menu-principal">
  <img src="'.$site.'/img/icones/16/enveloppe.png" class="espace-2-2" alt="">'.$plang['send_message'].'</a>
  </li> 
  ';
  }
  
    
if(($yetkim>=8 || !empty($yetkimlist['sentinel'])) && isset($_SESSION['id'])){
?>
      <li>
		<a class="element-menu-contextuel" onclick="punish(<?=$ib['PlayerID']?>);" data-toggle="modal" data-target="#p_menu">
		<img src="<?=$site?>/img/icones/16/trash-pleine.png" class="espace-2-2" alt="">Sanction</a>
      </li>
<?php
}
  
  echo '
  </ul> 
  </td>  
  <td class="cellule-menu-contextuel"> 
  <ul class="liste-menu-contextuel"> 
  <li class="nav-header">Profil</li> 
  <li>
  <a class="element-menu-contextuel" onclick="ouvrirFormulaireCadre(\'cadre_signaler_element_'.$ib['PlayerID'].'\');">'.tfmdil('bouton.signaler').'</a>
  </li>   
  ';
  
  
  if($uye['id']==$ib['PlayerID']){
  echo '
  <li>
  <a class="element-menu-contextuel" onclick="ouvrirFormulaireCadre(\'cadre_changer_avatar_'.$ib['PlayerID'].'\');">'.$plang['change_avatar'].'
  </a>
  </li>  
  <li>
  <a class="element-menu-contextuel" onclick="jQuery(\'#popup_confirmation\').modal(\'show\');">'.$plang['remove_avatar'].'
  </a>
  </li>    
  <li>
  <a class="element-menu-contextuel" onclick="ouvrirFormulaireCadre(\'cadre_editer_element_'.$ib['PlayerID'].'\');">'.$plang['edit_profile'].'
  </a>
  </li>   <li><a class="element-menu-contextuel" onclick="ouvrirFormulaireCadre(\'cadre_parametres_'.$ib['PlayerID'].'\');">'.$plang['parameters'].'</a>
  </li> 
';
  	}
	echo '
  </ul> 
  </td>
  </tr> 
  </table> 
  </ul> 
  </div> 
  <span class="rang-prestige">&laquo '.$titlef.' &raquo</span> 
	';
	}
	
}else{
	return "<s>".$isim."</s>";
}


}


function rtl($mode=0){
	global $dilim;
	
	if($mode == 0){
	
	if($dilim == "AR"){
		
		$float = "rtl";
		
	}else{
		
		$float = "ltr";
		
	}
	
	return $float;
	}else{
		
		if($dilim == "AR"){
		
		$lool = "right";
		
		
		
	}else{
		
		$lool = "left";
		
	}
		return $lool;
	}
	
}

function yetkisinir($yetki=0){
  global $yetkim;
  global $site;
  global $uye;
  
      if(($yetkim >= $yetki || $op>=1)){
  
      }else{
      yonlendir($site."/404",0);
      exit();
      }
  
  }


function forum_ban($user){
	global $db;
	$ban_control = $db->query("SELECT * FROM sanctions where user = '".$user."' and status = '1' and type = '2' and time >= '".time()."' order by time DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
	if(!empty($ban_control['id'])){
		return array('durum'=>1,'date'=>$ban_control['time'],'sebep'=>$ban_control['reason']);
	}
}

function forum_mute($user){
	global $db;
	$mute_control = $db->query("SELECT * FROM sanctions where user = '".$user['id']."' and status = '1' and type = '1' and time >= '".time()."' order by time DESC LIMIT 1")->fetch(PDO::FETCH_ASSOC);
	$m = floor($user['Time']/3600);
	if($m >= 2){
	
	}else{
		$new_member = 1;
		$new_member_wait_time = $m;
		$new_member_reason = i_rep("<br><br>".tfmdil('chat.message.compteTropRecentPourChat'), 2);
	}

	
	if(!empty($mute_control['id']) || $new_member==1){
		return array('durum'=>1,'date'=>$mute_control['time'] ?? (time()-(($new_member_wait_time * 3600)-2)),'sebep'=>$mute_control['reason'] ?? $new_member_reason);
	}
}

function yonlendir($yer,$zaman=0){
  ?>
<meta http-equiv="refresh" content="<?=$zaman?>;URL=<?=$yer?>">
  <?php
}


   function cikis(){
	   unset($_SESSION['id']);
	   unset($_SESSION['sifre']);
	   unset($_SESSION['see_sanction']);
   }


if(isset($_SESSION['id'])){
	$uye = $db->query("SELECT * FROM users where PlayerID = '".$_SESSION['id']."' ")->fetch(PDO::FETCH_ASSOC);
	$uye['id'] = $uye['PlayerID'];
	$json_userData = "js/userData/".$uye['id'].".json";	
	if(!file_exists($json_userData)){
		$c_userData = fopen($json_userData, "w");
		fwrite($c_userData, json_encode(array("forum" => array(), "convs"=> array())));
		fclose($c_userData);
	}
	$json_userData = file_ex($json_userData);
	
	$json_data = json_decode(file_get_contents($json_userData), true);
	$json_data_cache = $json_data;
//	print_r($json_data);
	
	if(!empty($uye['TribeCode'])){
		
		$tri = $db->query("SELECT * FROM tribe where Code = '".$uye['TribeCode']."'")->fetch(PDO::FETCH_ASSOC);
		$ranks = explode(";",$tri['Ranks']);
		$rutbems = explode("|", $ranks[$uye['TribeRank']]);
		$rutbems = explode(",", end($rutbems));
		$t_rank = array();
		
		foreach($rutbems as $k => $v){
			$t_rank[$v] = $v;
		}
		//print_r($ranks);
	}
	
	
	$yasakli = forum_ban($uye['id'])['durum'];
	$mute_control = forum_mute($uye);
		
	if(empty($uye['id']) || $_SESSION['sifre']!=$uye['Password'] || $yasakli == 1){
		cikis();
		$uye = null;
		$atildi = 1;
	}

	$ylistrow = explode(",",$uye['PrivLevel']);
	$yetkimlist = array();
	 
	$ylist = array();
	foreach($ylistrow as $row){
		$ylist[$privlist[$row]]=$row;
	}
	$yetkimlist = $ylist;
	
	
	$ylistid = array();
	foreach($ylistrow as $row){
	
		$ylistid[$row]=$privlist[$row];

	}


	$yetkim = max($ylistrow);
	
	if(!empty($ylist['kurucu']) /* && !empty($ylist['founder']) */){
		$op=1;
	}else{
		$op=0;
	}
	
	
	$tt = $db->query("SELECT * FROM profilestribe where tribe = '".$uye['TribeCode']."'")->fetch(PDO::FETCH_ASSOC);
	if(empty($tt['id'])){
		$t = $db->exec("INSERT INTO profilestribe (tribe,lang) values('".$uye['TribeCode']."','xx')");
	}
	
	$pt = $db->query("SELECT * FROM profilesuser where player = '".$uye['id']."'")->fetch(PDO::FETCH_ASSOC);
	if(empty($pt['id'])){
		$pt = $db->exec("INSERT INTO profilesuser (player) values('".$uye['id']."')");
	}
	
}else{
	
	$yetkim=1;
}

function goruldu_modu($s, $c, $f="forum"){
	global $json_data, $uye;
	$r = "nombre-messages-lu";
	if(isset($uye['id'])){
		if(isset($json_data[$f][$s])){
			if($json_data[$f][$s]!=$c){
				$r = "nombre-messages-reponses";
			}
		}else{
			$r = "nombre-messages-nouveau";
		}
	}
	return $r;
}

function save_json_data($data){
	global $json_userData, $json_data_cache, $uye;
	if(isset($uye['id'])){
		if($json_data_cache != $data){
			$c_userData = fopen($json_userData, "w");
			fwrite($c_userData, json_encode($data, JSON_UNESCAPED_UNICODE));
			fclose($c_userData);
			//echo "Kaydedildi.";
		}else{
			//echo "Kaydedilmedi.";
		}
	}
}

  function forum_yetki_kontrol($yetkiler){
	global $uye,$privlist,$yetkim;
		if(!empty($yetkiler) || $yetkiler!=0){
			$yetkiler = explode(",",$yetkiler);
			if(!empty($uye['id'])){
			$onay_yetki = explode(",",$uye['PrivLevel']);

			if(max($onay_yetki)>=max(array_keys($privlist,end($privlist)))){
				return 1;
			}
			
			
/* 				foreach($onay_yetki as $key => $val){
					foreach($yetkiler as $ke => $vale){						
						if($vale == $val){
							return 1;
						}	
					}
				}
				 */
				
				foreach($yetkiler as $ke => $vale){				
					if(in_array($vale, $onay_yetki)){
						return 1;
					}
				}
				
			}else{
					foreach($yetkiler as $ke => $vale){
						if($vale == "1"){
							return 1;
						}	
					}
			}
		}else{
			return 1;
		}
	}

	
function mailgonder($email="YOK",$a="YOK",$b="YOK",$uzanti=""){
  global $mailemail;
  global $mailsifre;
  global $mailhost;
  global $mailport;
  global $mailsmtpsecure;
  global $dbname;
  global $site,$ayarlar;
  
  include $uzanti.'sys/class.phpmailer.php';
    include $uzanti.'sys/class.smtp.php';

    $title = '['.$ayarlar['title'].'] '.$a;
    $mail = new PHPMailer(); 
    $mail->IsSMTP();
    $mail->SMTPAuth = true; 
    $mail->Host = $mailhost;
    $mail->Port = $mailport; 
    $mail->SMTPSecure = $mailsmtpsecure; 
    $mail->Username = $mailemail; 
    $mail->Password = $mailsifre; 
    $mail->SetFrom($mail->Username, $title);
    $mail->AddAddress($email, ''); 
    $mail->CharSet = 'UTF-8'; 
    $mail->Subject = $title;
    // eğer sıkıntı çıkarsa https://www.google.com/settings/security/lesssecureapps
    //email içeriğimiz
    $icerik = $b;
     
    $mail->MsgHTML($icerik);
    
    if(!$mail->Send()){
     
	 return 0;
	 
    } else {
  
      $_SESSION['emailsure']=time()+30;
  
	return 1;
    }
  
  
  }
   
  
  function sifrele($sifre=""){
    
    return base64_encode(hash("sha256", hash("sha256", urldecode(strip_tags($sifre))).hex2bin("f71aa6de8f1776a8039d32b8a156b2a93edd439dc5ddce56d3b7a4054a0d08b0"), true));
  
  }

  
  function hide_email($a){
	if (strstr($a, "@")){
		$durum = 1;
		$eposta_bol = explode("@", $a);
		$eposta_bol_0_say = strlen($eposta_bol[0])-2;
		$eposta_bol_1_say = strlen(explode(".", $eposta_bol[1])[0])-1;
		$eposta_sansur_0 = "";
		$eposta_sansur_1 = "";
		for ($i = 0; $i < $eposta_bol_0_say; $i++){$eposta_sansur_0 .= "*";}
		for ($i = 0; $i < $eposta_bol_1_say; $i++){$eposta_sansur_1 .= "*";}
		$eposta_bol_0_degistir = substr_replace($eposta_bol[0], $eposta_sansur_0, 1, $eposta_bol_0_say);
		$eposta_bol_1_degistir = substr_replace($eposta_bol[1], $eposta_sansur_1, 1, $eposta_bol_1_say);
		$eposta_filtrele = $eposta_bol_0_degistir."@".$eposta_bol_1_degistir;
	}else{
		$eposta_filtrele = tfmdil('texte.vide');
		$durum = 0;
	}
	
	return array("email"=>$eposta_filtrele,"durum"=>$durum);
}
 
 
/*  function hide_email($em){
	if(!empty($em)){
		
		$mail = explode("@",$em);
		$ex = end(explode(".",$mail[1]));

		$e_1 = strlen($mail[0]);
		$e_2 = strlen(strtok($mail[1],"."));
		

	}

	
 }
  */
  
  
  function tarih($tarih){
    $aylar_DEG = array(ucwords(tfmdil('Mois_0')),ucwords(tfmdil('Mois_1')),ucwords(tfmdil('Mois_2')),ucwords(tfmdil('Mois_4')),ucwords(tfmdil('Mois_3')),ucwords(tfmdil('Mois_5')),ucwords(tfmdil('Mois_6')),ucwords(tfmdil('Mois_7')),ucwords(tfmdil('Mois_8')),ucwords(tfmdil('Mois_9')),ucwords(tfmdil('Mois_10')),ucwords(tfmdil('Mois_11')));
    $aylar_EN = array("January","February","March","May","April","June","July","August","September","October","November","December");
	return str_replace($aylar_EN,$aylar_DEG,$tarih);
  }
 //echo tarih(date("F"));



  function seo($s) {
    $tr = array('ş','Ş','ı','I','İ','ğ','Ğ','ü','Ü','ö','Ö','Ç','ç','(',')','/',':',',','!','<','>',"'");
    $eng = array('s','s','i','i','i','g','g','u','u','o','o','c','c','','','-','-','','','','','');
    $s = str_replace($tr,$eng,$s);
    $s = strtolower($s);
    $s = preg_replace('/&amp;amp;amp;amp;amp;amp;amp;amp;amp;.+?;/', '', $s);
    $s = preg_replace('/\s+/', '-', $s);
    $s = preg_replace('|-+|', '-', $s);
    $s = preg_replace('/#/', '', $s);
    $s = str_replace('.', '', $s);
    $s = trim($s, '-');
    return $s;
   }
   
   
   
   function temizle($string){  

  $text = trim($string);
  $search = array("'");
  $replace = array("\'");
    
  foreach($search as $row){
	  array_push($replace,"");
  }
  
  $string = str_replace($search,$replace,$text);

  return $string;  
}  
   
 
   function bbcode($par){
	   global $site,$dilrs;
	   
	$bul = array(
		'#\[b\]#','#\[/b\]#',
		'#\[i\]#','#\[/i\]#',
		'#\[u\]#','#\[/u\]#',
		'#\[s\]#','#\[/s\]#',
		'#\[color=\#([a-zA-Z0-9]{6})\]#','#\[/color\]#',
		'#\[size=([0-9]{2})\]#','#\[/size\]#',
		'#\[font=(.*?)\]#','#\[/font\]#',
		'#\[p=([a-z]{4,7})\]#','#\[/p\]#',
		'#\[hr\]#',
		'#\[img\](.*?)\[/img\]#',
		'#\[img align=(.*?)\](.*?)\[/img\]#',
		'#\[video\]https://www.youtube.com/embed/(.*?)\[/video\]#',
		'#\[video\]https://www.dailymotion.com/embed/video/(.*?)\[/video\]#',
		'#\[video\]https://player.vimeo.com/video/(.*?)\[/video\]#',
		'#\[url=(.*?)\](.*?)\[/url\]#',
		'#\[list\]#','#\[/list\]#','#\[\*\]#','#\[/\*\]#',
		
		"#\[table\](.*)\[/table\]#Usi",
        "#\[row\](.*)\[/row\]#Usi",
         "#\[cel\](.*)\[/cel\]#Usi",
		
		'#\[quote=(.*?)\]#','#\[/quote\]#'
	);


	$degistir = array(
		'<span style="font-weight:bold;">','</span>',
		'<span style="font-style:italic;">','</span>',
		'<span style="text-decoration:underline;">','</span>',
		'<span style="text-decoration:line-through;">','</span>',
		'<span style="color:#$1;">','</span>',
		'<span style="font-size:$1px;">','</span>',
		'<span style="font-family:$1;">','</span>',
		'<p style="text-align:$1;">','</p>',
		'<hr />',
		'<img src="$1" alt="$1" class="inline-block img-ext" style="float:;" />',
		'<img src="$2" alt="$2" class="inline-block img-ext" style="float:$1;" />',
		'<iframe class="vid-ext" style="border-radius:6px" src="https://www.youtube.com/embed/$1"></iframe>',
		'<iframe class="vid-ext" style="border-radius:6px" src="https://www.dailymotion.com/embed/video/$1"></iframe>',
		'<iframe class="vid-ext" style="border-radius:6px" src="https://player.vimeo.com/video/$1"></iframe>',
		'<a href="$1" target="_blank">$2</a>',
		'<ul>','</ul>','<li>','</li>',

		"<table>$1</table>",
		"<tr>$1</tr>",
		"<td>$1</td>",
		
		'<blockquote class="cadre cadre-quote"><small>'.tfmdil('Citer').' $1:</small><div>','</div></blockquote>'
	);
	
	//if (preg_match_all("#\[quote=(.*?)\](.*?)\[quote=(.*?)\](.*?)\[/quote\](.*?)\[/quote\]#s", $par, $alinti_icinde_alinti_bulunanlar)){
		
	//}
	
	$yeni_yazi = htmlspecialchars(stripslashes(trim($par)));
	$yeni_yazi = preg_replace($bul, $degistir, nl2br($yeni_yazi));
	$yeni_yazi = preg_replace(array("/(<[hr,ul,li=\"\/\ ]+>)<br\ \/>/"), array("$1"), $yeni_yazi);
	
	if (preg_match_all("#\[\#(.+?)\](.+?)\[/\#(.+?)\]#s", $yeni_yazi, $sekme_bulunanlar)){
		$sekme_sayisi = count($sekme_bulunanlar[0]);
		$sekme_adlari = "";
		$sekme_icerikleri = "";
		$bb_sekme_kontrol = false;
		for ($i = 0; $i < $sekme_sayisi; $i++){
			if ($sekme_bulunanlar[1][$i] != $sekme_bulunanlar[3][$i] || $sekme_sayisi < 2 || strstr($sekme_bulunanlar[1][$i], "<")){$bb_sekme_kontrol = true;}
			$sekme_id = mt_rand(100000,1000000);
			if ($i == 0){$class = "active";}else{$class = "";}
		if (!empty($dilrs[$sekme_bulunanlar[1][$i]])){
			if ($sekme_bulunanlar[1][$i] == "en"){
				$sekme_bulunanlar[1][$i] = "gb";
			} 
			$sekme_bulunanlar[1][$i] = '<img src="'.$site.'/img/pays/'.$sekme_bulunanlar[1][$i].'.png" class="img16" />';
			} 
			
			${"sekme_adi_".$i} = '<li id="li_tab'.$sekme_id.'" class="'.$class.'"><a href="#tab'.$sekme_id.'" data-toggle="tab">'.$sekme_bulunanlar[1][$i].'</a></li>';
			${"sekme_icerik_".$i} = '<div id="tab'.$sekme_id.'" class="tab-pane '.$class.'"><div class="<?php echo arlang(); ?>">'.$sekme_bulunanlar[2][$i].'</div></div>';
			$sekme_adlari .= ${"sekme_adi_".$i};
			$sekme_icerikleri .= ${"sekme_icerik_".$i};
		}
		
		$sekmeler_id = mt_rand(100000,1000000);
		$sekme_adlari_html = '<ul class="nav nav-tabs" id="tabs'.$sekmeler_id.'">'.$sekme_adlari.'</ul>';
		$sekme_icerikleri_html = '<div class="tab-content">'.$sekme_icerikleri.'</div>';
		$sekme_yeni_yazi = $sekme_adlari_html.$sekme_icerikleri_html.'<script type="text/javascript">jQuery("#tabs'.$sekmeler_id.' a").click(function (event) {(event.preventDefault) ? event.preventDefault() : event.returnValue = false;jQuery(this).tab("show");});</script>';
		
		if (!$bb_sekme_kontrol){$yeni_yazi = str_replace($yeni_yazi, $sekme_yeni_yazi, $yeni_yazi);}
	}
	
	if (preg_match_all("#\[spoiler\](.*?)\[/spoiler\]#s", $yeni_yazi, $spoiler_bulunanlar)){
		$spoiler_sayisi = count($spoiler_bulunanlar[0]);
		for ($i = 0; $i < $spoiler_sayisi; $i++){
			$spoiler_id = mt_rand(100000,1000000);
			${"spoiler_".$i} = '
			<div class="cadre cadre-spoil">
				<button id="bouton_spoil_'.$spoiler_id.'" class="btn btn-small btn-message" onclick="afficherSpoiler(\''.$spoiler_id.'\');return false;">'. @Spoiler .'</button>
				<div id="div_spoil_'.$spoiler_id.'" class="hidden">'.$spoiler_bulunanlar[1][$i].'</div>
			</div>';
			$yeni_yazi = preg_replace("#\[spoiler\]".preg_quote($spoiler_bulunanlar[1][$i], '#')."\[/spoiler\]#s", ${"spoiler_".$i}, $yeni_yazi, 1);
		}
	}
	
	return $yeni_yazi;
}
  


function createHash($uzunluk = 30,$karakterler='qwertyuopasdfghjklizxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890') {
    return substr(str_shuffle($karakterler), 0, $uzunluk);
}


function popupn($text="Null",$yenile=0,$head=null,$link=null){
	if(empty($head)){
		$head = tfmdil('popup.titre.information');
	}
	?>
	<div id="popup_resultat_requete" class="modal hide fade ltr" style="display: block;"> 
	<div class="modal-header mdheader"> 
	 <a class="close" data-dismiss="modal"> &times;</a> 
	<h3><?=$head?></h3> 
	</div> 
	<div class="modal-body mdbody">	
	<p><?=$text?></p> 
	</div> 
	<div class="modal-footer mdfooter">
	<button type="button" class="btn btn-info" <?php if($yenile>=1){ if(strlen($link)>=1){ echo 'onclick="window.location.assign(\''.$link.'\');"'; }else{echo 'onclick="window.location.reload();"';} }?> data-dismiss="modal"><?=tfmdil('Valider')?></button>   
	</div> 
	</div>     

	<?php
}

function popup($text="Null",$yenile=0,$head=null,$link=null,$id=null,$show=1,$buttons=null){
	
	if(empty($head)){
		$head = tfmdil('popup.titre.information');
	}
	
$hash = $id ?? createHash(30);
?>

<div id="popup_<?=$hash?>">

<div class="modal hide fade ltr in" id="<?=$hash?>" aria-hidden="false" style="z-index:9999999999999 !important;">
<div class="modal-header mdheader"> 
 <a class="close" data-dismiss="modal"> &times;</a> 
<h3><?=$head?></h3>
</div>
<div class="modal-body mdbody"><?=$text?></div>
<div class="modal-footer mdfooter">
<?=$buttons?>
<?php
if(empty($buttons)){
?>
	<button type="button" class="btn btn-info" <?php if($yenile>=1){ if(strlen($link)>=1){ echo 'onclick="window.location.assign(\''.$link.'\');"'; }else{echo 'onclick="window.location.reload();"';} }?> data-dismiss="modal"><?=tfmdil('Valider')?></button>
<?php
}
?>
</div>
</div>

</div>
<?php
	if($show==1){
?>
		<script>
		$('#<?=$hash?>').modal('show');
		</script>
<?php
	}
}

function alert($alert="info",$msg="Bilinmiyor",$kapat=0,$url=""){
  if(isset($msg)){
    ?>
    
<div class="card alert alert-dismissible bg-<?=$alert?> mb-3 mt-1 rounded">
<?php
if($kapat==1){
?>
<a href="<?=$url?>" class="close" <?php if(empty($url)){ echo ' data-dismiss="alert" aria-label="close"'; } ?>>&times;</a>
<?php
}
?>
<h6 style="color:white;"><?=$msg?></h6>
</div>
<?php 
}
}

$surl=$str = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

function yenile($zaman=0,$temizle=0,$request=""){
  $str = "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
  
  if($temizle==1){
  for($i = 0; $i < 10; $i++){
    $str = strtok($str,'?');
  }
}
if(strlen($request)>=1){
  $str .= $request;
}

    ?>
<meta http-equiv="refresh" content="<?=$zaman?>;URL=<?=$str?>">
    <?php
}


function links($temizle=0, $request="", $mode=1){
	$str = "";
	if($mode==1){
		$str.="http://".$_SERVER['SERVER_NAME'];
	}
	
	$str .= $_SERVER['REQUEST_URI'];
  
	if($temizle==1){
	  for($i = 0; $i < 10; $i++){
		$str = strtok($str,'?');
	  }
	}
	if(strlen($request)>=1){
	  $str .= $request;
	}

	return $str;
}


function kisalt($kelime, $str = 10){
		if (strlen($kelime) > $str)
		{
			if (function_exists("mb_substr")) $kelime = mb_substr($kelime, 0, $str, "UTF-8").'..';
			else $kelime = substr($kelime, 0, $str).'..';
		}
		return $kelime;
	}


function trkkr($string){  

  $text = trim($string);
  $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü');
  $replace = array('C','c','G','g','i','I','O','o','S','s','U','u');
  $string = str_replace($search,$replace,$text);

  return $string;  
}  

function geri($zaman=0){
  $url = htmlspecialchars($_SERVER['HTTP_REFERER']);
  yonlendir($url,$zaman);
}



function poll($id,$mode=0){
global $db,$uye;	

$pol = $db->query("SELECT * FROM polls where mid = '".$id."' and mode='".$mode."'")->fetchAll(PDO::FETCH_ASSOC);
foreach($pol as $poll){

$sq = explode(",",$poll['answers']);
$sc = 0;
$sorular = array();

foreach($sq as $fg){
$sc++;
	
	$sorular[$sc] = $fg;
	
}

$user_ans = explode(",",$poll['users_answers']);

$cevaplar = array();


//print_r($user_ans);

$type = "radio";
$varsin = 0;
if(!empty($uye['id'])){
foreach($user_ans as $df){

@$s = end(explode(":",$df));

$cevaplar[$df] = $s;

if(strstr($df,$uye['id'].":")){
$varsin = 1;
$type="checkbox";
$yanitkey = $s;
}
}

}else{
	
}


if($varsin==0 && !empty($uye['id'])){

if($_POST){
	
	$answ =	$_POST['reponse_poll'];

	
if(!empty($answ) && $answ != 'on'){

$ck = $db->query("SELECT users_answers FROM polls where id = '".$poll['id']."'")->fetch(PDO::FETCH_ASSOC);
if(!strstr($ck['users_answers'],$uye['id'].":".$answ)){
$up = $db->exec("UPDATE polls set users_answers = '".ltrim($ck['users_answers'].",".$uye['id'].":".$answ,",")."' where id = '".$poll['id']."'");
}

if($up>=1){
		yonlendir(links(),0);
}

}

}
}

$sonuclar = array();

foreach($cevaplar as $sonuc){
	if(@$sorular[$sonuc]){
		
		@$sonuclar[$sonuc]++;
		
	}
	
}

?>

 <form method="post" id="polls_<?=$poll['id']?>">
 
 <br>
 <table class="table-cadre">
     <tbody>
<tr>

 <td class="table-sondage-cellule">
		 
		 
		 <?php
		 foreach($sorular as $key => $ans){
			 
			 $toplam = $sonuclar[$key];
			 $hepsi = 0;
			 
			 foreach($sonuclar as $h => $w){
				 
				 $hepsi += $w;
			 }
			 $yuzde = round($toplam/$hepsi * 100);
			 
			 
		 ?>
		 
   <label class="<?=$type?>">
   
 <input type="<?=$type?>" name="reponse_poll" <?php if($type=="checkbox" || empty($uye['id'])){ echo "onclick='return false;'";  if($key==$yanitkey){ echo "checked"; }else{ echo "disabled "; }}else{ echo "value='".$key."'"; } ?>>
 <?=$ans?>
 
 </label>
 <?php
 if($type=="checkbox"){
 ?>
  <div class="bloc-reponse">
 <div class="progress progress-striped sondage-pourcentage">
 <div class="bar" style="width:<?=$yuzde?>%;">
</div>
 </div>
 
 <div class="reponse-sondage"><?=$yuzde?>% (<?=$sonuclar[$key] ?? 0?>)</div>

 </div>
 
<?php
 }
 
}
?>
 
 
  </td>
  
 </tr>
 
  </tbody>
</table>
<br>

 <?php
 if($type=="radio" && !empty($uye['id'])){
 ?>
  <button type="button" class="btn btn-post" onclick="formsubmit('polls_<?=$poll['id']?>');submitEtDesactive(this);return false;"><?=tfmdil('bouton.repondre')?></button>
<br>
<?php
 }
 ?>


 </form>
 
 <?php
}

}

function cokludil($topic){
global $dilim;

$titerere = $topic['title'];
if(strstr($titerere,"$tit = array(")){
eval($titerere);

foreach($tit as $k => $fie){
$fi = $k;

if($fi==$dilim){
	 $firstdil = $fie;
	 break;
 }else{
	 $firstdil = $fie;
 }
}

}else{
$firstdil = $titerere;
}
return $firstdil;

}

function titlesystem($topic,$mode=0,$tribecode=null){
	global $dilim,$site,$link_php;
	$hash = "_".createHash(12);
	
$titerere = $topic['title'];
if(strstr($titerere,"$tit = array(")){
eval($titerere);
$c = count($tit);
}else{

if(!empty($tribecode)){
	$frm_lnks = "tr=".$tribecode;
}else{
	$frm_lnks = "f=".$topic['forum'];
}
	
	 if($mode==1){
	?>
	<a href="<?=$site?>/topic?<?=$frm_lnks?>&t=<?=$topic['id']?>" <?php if($link_php != "topic"){ echo 'class="cadre-sujet-titre lien-blanc"'; }?>>
	<?php
	 }
	?>
	<?php 
		
	echo $titerere;
		
	if($mode==1){
	?>
	</a>
	<?php
	 }
	
}

	
if($c>=2){	
foreach($tit as $k => $fi){
$fi = $k;
if(empty($firstdil)){
if($fi==$dilim){
	 $firstdil = $dilim;
	 break;
 }else{
	 $firstdil = $k;
 }
}
}
 ?>
 
<!--titre system-->   
<span class="cadre-sujet-titre"> 
<div class="display-inline-block"> 

<div class="dropdown"> 

<a href="#" class="dropdown-toggle lien-menu-traduction-titre-sujet" data-toggle="dropdown"> 
<img id="drapeau_titre_sujet_<?=$topic['id'].$hash?>" src="<?=$site?>/img/pays/<?=$firstdil?>.png" class="img16 espace-4-4"/> 
<b class="caret caret-titre-sujet-traduit"> 
</b> 
</a> 
 
<ul class="dropdown-menu menu-contextuel pull-left"> 


<?php
foreach($tit as $key => $val){
?>

<li> 
<a class="element-menu-principal element-menu-langue option-traduction-titre-sujet" onclick="afficherTitreSujetTraduit('titre_sujet_<?=$topic['id'].$hash?>','<?=$key?>','<?=$key?>');"> 
<img src="<?=$site?>/img/pays/<?=$key?>.png" class="img16 espace-4-4"/> 
<?=dilr($key)?>
</a> 
</li> 

<?php
}
?>

 </ul> 

 </a> 

 </div> 

 </div> 
<span id="titre_sujet_<?=$topic['id'].$hash?>"> 
<?php
foreach($tit as $key => $val){
if($mode==0){
?>

<span id="titre_sujet_<?=$topic['id'].$hash?>_<?=$key?>" <?php if($key!=$firstdil){ echo 'style="display: none;"'; } ?>> 
<?=$val?>
</span> 

<?php
}elseif($mode==1){
?>

  <a class="cadre-sujet-titre lien-blanc" href="<?=$site?>/topic?<?=$frm_lnks?>&t=<?=$topic['id']?>" id="titre_sujet_<?=$topic['id'].$hash?>_<?=$key?>" <?php if($key!=$firstdil){ echo 'style="display: none;"'; } ?>>
  <?=$val?>
  </a>

<?php
}
}
?>
 </span> 

 </span> 
 <?php
 }else{
	 if($mode==1){
	?>
	<a href="<?=$site?>/topic?<?=$frm_lnks?>&t=<?=$topic['id']?>" <?php if($link_php != "topic"){ echo 'class="cadre-sujet-titre lien-blanc"'; }?>>
	<?php
	 }
	?>
	<?php 
	foreach($tit as $r){
		echo $r;
	}
	if($mode==1){
	?>
	</a>
	<?php
	 }
 }
	
}


function forumscarki($sub){
	global $yetkim,$plang,$db,$op,$site;
	
 if($yetkim>=10 || $op>=1){
 ?>
 
 <div class="btn-group cadre-sujet-actions  pull-right">
 <a class="dropdown-toggle btn btn-inverse bouton-action" data-toggle="dropdown" href="#">
 <img src="<?=$site?>/img/icones/roue-dentee.png" class="img20">
 </a>
 <ul class="dropdown-menu menu-contextuel pull-right">

 <li class="nav-header">
<?=tfmdil('Forum')?>
</li>

 <li>
 <a href='<?=$site?>/new-section?f=<?=$sub['id']?>' class="element-menu-contextuel">
 <?=$plang['new_section']?>
 </a>
 </li>

  <?php
 if($yetkim>=11 || $op>=1){
 ?>
 <li>
  <a href='<?=$site?>/new-forums?editforum=<?=$sub['id']?>' class="element-menu-contextuel">
 <?=$plang['edit_forum']?>
 </a>
 </li>
 <?php
}
 ?>
   <?php
 if($yetkim>=12 || $op>=1){
	 $deleteforum = $_GET['deleteforum'];
	 if(!empty($deleteforum)){
	 $del = $db->exec("DELETE FROM forums where id = '".$deleteforum."'");
	 if($del>0){
			yenile(0,1);
	 }
	 
	 }
 ?>
 <li>
  <a onclick='return confirmDel();' href='<?=$site?>/forums?deleteforum=<?=$sub['id']?>' class="element-menu-contextuel">
 <?=tfmdil('Supprimer')?>
 </a>
 </li>

 <?php
}
?>
  </ul>
  </div>
<?php
}
	
}
 ?>