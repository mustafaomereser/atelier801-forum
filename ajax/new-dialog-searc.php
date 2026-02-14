<?php
include("../pdoconnect.php");

$veri = $_POST['query'];
if(empty($veri)){
yonlendir($site."/404",0);
exit();
}else{
$users = explode("#",$veri['users']);

if($users[1]){
	$where = "Tag LIKE '%".$users[1]."%' and";
}


if(strlen($users[0])>=3){
$userdb = $db->query("SELECT PlayerID,Username,Tag,Avatar,Langue FROM users WHERE ".$where." Username LIKE '%".$users[0]."%'");
$usc = $userdb->rowCount();
$user = $userdb->fetchAll(PDO::FETCH_ASSOC);
if($usc>0){

$class="removeClass";

foreach($user as $usr){
?>

<tr onclick="degistir('destinataire','<?=$usr['Username'].$usr['Tag']?>');typechange('destinataire','button');gid();" class="ligne-utilisateur-auto-completion ligne-utilisateur-auto-completion-hover" data-nom="<?=$usr['Username']?>" data-communaute="<?=$usr['Langue']?>" data-type="joueur" data-connecte="false">
<td>

<img src="<?=$site?>/img/avatars/<?=getavatar($usr)?>" class="element-composant-auteur img50 default-avatar-50" alt=""> 

</td>

<td>
<img src="<?=$site?>/img/pays/<?=$usr['Langue']?>.png" class="img16 espace-2-2">
</td>
<td>

<?php 
isim($usr['Username'].$usr['Tag'],"nm");
?>

</td>
</tr>


<script>
$('#selected').load("ajax/user.php?v=<?=$usr['PlayerID']?>");
</script>

<?php
}
}else{
?>

<tr class="ligne-utilisateur-auto-completion ligne-utilisateur-auto-completion-hover">
<td>
</td>
<td>
<?=$plang["not_found"]?>
</td>

</tr>

<?php
}


}else{
	$class="addClass";
}


}
?>
<script>
$('#destinataires_trouves').<?=$class?>("hidden");

function gid(){
$('#bouton_edition_destinataire').removeClass("hidden");
$('#selected').removeClass("hidden");
$('#destinataires_trouves').addClass("hidden");
$('#destinataire').addClass("hidden");

}

</script>