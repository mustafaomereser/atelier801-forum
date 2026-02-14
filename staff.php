<?php
include("config.php");
$admins = $db->query("SELECT * FROM users WHERE PrivLevel LIKE '%11%' or '%10%' or '%9%'")->fetchAll(PDO::FETCH_ASSOC);
$moderators = $db->query("SELECT * FROM users WHERE PrivLevel LIKE '%8%'")->fetchAll(PDO::FETCH_ASSOC);
$sentinels = $db->query("SELECT * FROM users WHERE PrivLevel LIKE '%2%'")->fetchAll(PDO::FETCH_ASSOC);
$mapcrews = $db->query("SELECT * FROM users WHERE PrivLevel LIKE '%7%'")->fetchAll(PDO::FETCH_ASSOC);



function _list($row){
$y = max(explode(",",$row['PrivLevel']));
//print_r($row);
	if($y<=11){
?>
		<tr>

		<td class="text-center" style="width:0.1em !important;"> 
		<img src="<?=$site?>/img/avatars/<?=getavatar($row)?>" class="element-composant-auteur img50" alt=""> 
		</td>

		<td style="width:0.1em !important;" data-search="<?=strtolower($row['Langue'])?>">
		<img src="<?=$site?>/img/pays/<?=strtolower($row['Langue'])?>.png" class="img16 espace-2-2">
		</td>

		<td>
		<b><?=isim($row['Username'].$row['Tag'],'o')?></b>
		</td>

		</tr>

<?php
	}
}
?>

<div id="corps" class="corps clear container">  

 <div class="row">
 <div class="span12"> 
 <p align="center"> 
	  <a href="#" rel="noopener" class="cliquable">
	  <img src="<?=$site?>/img/logo-atelier801.png" id="b" onclick="takla(this);" width="150" height="150"/>
	  </a>  	
 </p> <h2 class="lien-blanc"><p align="center"><?=$plang['team']?></p></h2>
 </div> 
 </div> 
 
 <div class="row contenant-cadres-staff"> 
 
 <div class="span4">                           
 <div class="cadre cadre-defaut accordion accordeon-admins ltr">  
 <div class="accordion-group">
 <div class="accordion-header en-tete-cadre-staff-accordeon">   
 <a id="lien-deroulement-accordeon-admins" class="accordion-toggle lien-blanc lien-en-tete-cadre-staff-accordeon collapsed" onclick="plus(0);" data-toggle="collapse" data-parent="#accordeon-admins" data-target="#deroulant-accordeon-admins">
 <div class="colonne-en-tete-cadre-staff-accordeon colonne-gauche-en-tete-cadre-staff-accordeon"></div> 
 <p class="font-xl colonne-en-tete-cadre-staff-accordeon colonne-centre-en-tete-cadre-staff-accordeon"> <?=$plang['admins']?> </p> 
 <div class="colonne-en-tete-cadre-staff-accordeon colonne-droite-en-tete-cadre-staff-accordeon"><img id="c_0" src="<?=$site?>/img/icones/plus24-2.png"></div> 
 </a>     
 </div> 
 <div id="deroulant-accordeon-admins" class="accordion-body collapse" style="height: 0px;">    

 <table id="admins" class="table-datatable table-cadre table-cadre-centree table-striped"> 

        <thead>
            <tr>
			<th></th>
                <th></th>
				<th><?=$plang['name']?></th>
            </tr>
<tbody>

<?php
foreach($admins as $row){
_list($row);
}
?>

</tbody>

        </thead>

    </table>

</div>
</div>
 </div>     
</div>
		
		
 <div class="span4">     
 
 <div class="cadre cadre-defaut accordion accordeon-moderators ltr">  
 <div class="accordion-group"> <div class="accordion-header en-tete-cadre-staff-accordeon">   
 <a id="lien-deroulement-accordeon-moderators" class="accordion-toggle lien-blanc lien-en-tete-cadre-staff-accordeon collapsed" onclick="plus(1);" data-toggle="collapse" data-parent="#accordeon-moderators" data-target="#deroulant-accordeon-moderators">
 <div class="colonne-en-tete-cadre-staff-accordeon colonne-gauche-en-tete-cadre-staff-accordeon"></div> 
 <p class="font-xl colonne-en-tete-cadre-staff-accordeon colonne-centre-en-tete-cadre-staff-accordeon"> <?=$plang['mods']?> </p> 
 <div class="colonne-en-tete-cadre-staff-accordeon colonne-droite-en-tete-cadre-staff-accordeon"><img id="c_1" src="<?=$site?>/img/icones/plus24-2.png"></div> 
 </a>     
 </div> 
 <div id="deroulant-accordeon-moderators" class="accordion-body collapse" style="height: 0px;">    
 
 <table id="moderators" class="table-datatable table-cadre table-cadre-centree table-striped"> 
        <thead>
            <tr>
			<th></th>
                <th></th>
				<th><?=$plang['name']?></th>
            </tr>
<tbody>

<?php
foreach($moderators as $rows){
_list($rows);
}
?>

</tbody>

        </thead>

    </table>

</div>
</div>
 </div>     


		</div>
		
		
		
 <div class="span4">     
 
 <div class="cadre cadre-defaut accordion accordeon-sentinels ltr">  
 <div class="accordion-group"> <div class="accordion-header en-tete-cadre-staff-accordeon">   
 <a id="lien-deroulement-accordeon-sentinels" class="accordion-toggle lien-blanc lien-en-tete-cadre-staff-accordeon collapsed" onclick="plus(2);" data-toggle="collapse" data-parent="#accordeon-sentinels" data-target="#deroulant-accordeon-sentinels">
 <div class="colonne-en-tete-cadre-staff-accordeon colonne-gauche-en-tete-cadre-staff-accordeon"></div> 
 <p class="font-xl colonne-en-tete-cadre-staff-accordeon colonne-centre-en-tete-cadre-staff-accordeon"> <?=$plang['sentinels']?> </p> 
 <div class="colonne-en-tete-cadre-staff-accordeon colonne-droite-en-tete-cadre-staff-accordeon"><img id="c_2" src="<?=$site?>/img/icones/plus24-2.png"></div> 
 </a>     
 </div> 
 <div id="deroulant-accordeon-sentinels" class="accordion-body collapse" style="height: 0px;">    

<table id="sentinels" class="table-datatable table-cadre table-cadre-centree table-striped">
        <thead>
            <tr>
			<th></th>
                <th></th>
				<th><?=$plang['name']?></th>
            </tr>
<tbody>

<?php
foreach($sentinels as $rows){
_list($rows);
}
?>

</tbody>

        </thead>

    </table>

</div>
</div>
 </div>     


		</div>
		
 <div class="span4">     
 
 <div class="cadre cadre-defaut accordion accordeon-mapcrews ltr">  
 <div class="accordion-group"> <div class="accordion-header en-tete-cadre-staff-accordeon">   
 <a id="lien-deroulement-accordeon-mapcrews" class="accordion-toggle lien-blanc lien-en-tete-cadre-staff-accordeon collapsed" onclick="plus(3);" data-toggle="collapse" data-parent="#accordeon-mapcrews" data-target="#deroulant-accordeon-mapcrews">
 <div class="colonne-en-tete-cadre-staff-accordeon colonne-gauche-en-tete-cadre-staff-accordeon"></div> 
 <p class="font-xl colonne-en-tete-cadre-staff-accordeon colonne-centre-en-tete-cadre-staff-accordeon"> <?=$plang['mappers']?> </p> 
 <div class="colonne-en-tete-cadre-staff-accordeon colonne-droite-en-tete-cadre-staff-accordeon"><img id="c_3" src="<?=$site?>/img/icones/plus24-2.png"></div> 
 </a>     
 </div> 
 <div id="deroulant-accordeon-mapcrews" class="accordion-body collapse" style="height: 0px;">    

<table id="mapcrews" class="table-datatable table-cadre table-cadre-centree table-striped">
        <thead>
            <tr>
			<th></th>
                <th></th>
				<th><?=$plang['name']?></th>
            </tr>
<tbody>

<?php
foreach($mapcrews as $rows){
_list($rows);
}
?>

</tbody>

        </thead>

    </table>

</div>
</div>
 </div>     


		</div>
		
		</div>  
		
		
		</div> 

		<script>
		
		$(document).ready(function() {
    $('#admins').DataTable( {
		"bPaginate": false,
		  "lengthChange": false
    } );
} );
			//initAccordeonCadreAjax('accordeon-admins');

		$(document).ready(function() {
    $('#moderators').DataTable( {
		"bPaginate": false,
		  "lengthChange": false
    } );
} );
		$(document).ready(function() {
    $('#sentinels').DataTable( {
		"bPaginate": false,
		  "lengthChange": false
    } );
} );
		$(document).ready(function() {
    $('#mapcrews').DataTable( {
		"bPaginate": false,
		  "lengthChange": false
    } );
} );
</script>
		
<?php
include("footer.php");
?>
