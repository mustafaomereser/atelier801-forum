<?php
include("config.php");
yetkisinir(10);
?>
    
	<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_custom.css">
	
	
	
	
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">

                   <div class="container">
<?php
$user = $_GET['user'];
if(!empty($user)){
	$usr = $db->query("SELECT * FROM users WHERE Username = '".$user."'")->fetch(PDO::FETCH_ASSOC);

if(!empty($usr['PlayerID'])){
$id = $usr['PlayerID'];
	
}

}
?>
				   
				   <div class="statbox widget box box-shadow">
                                <div class="widget-header  p-5">


<?php
if(empty($id)){
?>
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>GET COMMANDLLOG</h4>
                                        </div>
                                    </div>
                                <form method="GET">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">@</span>
                                      </div>
                                      <input type="text" class="form-control" name="user" placeholder="Username" aria-label="Username">
                                    </div>         
						<button class="mr-2 btn btn-primary" type="submit">GET</button>
						</form>
<?php
}else{
	
if(empty($id)){
yenile(1,1);
}else{
	
?>

<div class="mt-2 text-center" style="font-size:20px;">
COMMANDLOG (<?=isim($usr['Username'].$usr['Tag'],"o")?>)
</div>


                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="multi-column-ordering" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Command</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
<?php
$jsonobj = file_get_contents($comlogdic.$id.".json");

$arr = json_decode($jsonobj, true);

foreach($arr as $x){
?>			
									
                                        <tr class="text-center">

											<td>
												<?=$x['cmd']?>
											</td>
											
                                            <td><?=date("d/m/Y H:i:s",($x['timestamp']))?></td>
                                        </tr>
 <?php
}
?>	                                      
                                    </tbody>

                                </table>
                            </div>
                        </div>
                    </div>
                </div>


<?php
}
}

?>
</div>
</div>
</div>				   
</div>
</div>
</div>
</div>
			
<?php
include("footer.php");
?>
                                   
                                



    <script src="plugins/table/datatable/datatables.js"></script>
    <script>
        $('#multi-column-ordering').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },

                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "lengthMenu": [10, 20, 50,10000000],

	    });
    </script>	
