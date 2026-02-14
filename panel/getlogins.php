<?php
include("config.php");
yetkisinir(8);
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
$usrlogins = $db->query("SELECT * FROM loginlog WHERE Username = '".$user."'")->fetch(PDO::FETCH_ASSOC);	
$usrlogins = $db->query("SELECT * FROM loginlog WHERE ip = '".$usrlogins['ip']."' order by Timestamp DESC")->fetchAll(PDO::FETCH_ASSOC);	

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
                                            <h4>Get Login Log</h4>
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
Login Log (<?=isim($usr['Username'].$usr['Tag'],"o")?>)
</div>


                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="multi-column-ordering" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
											<th>Ip</th>
											<th>Text</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
<?php

foreach($usrlogins as $usrlogin){
	
	if($yetkim>=10){
		$ipadres = $usrlogin['ip'];
	}else{
				$ipadres = "Hidden";

	}
	
?>			
									
                                        <tr class="text-center">
										
										
											<td><?=date("d/m/Y H:i:s",($usrlogin['Timestamp']))?></td>
											
											<td><?=$ipadres?></td>
											
											<td <?php if($usrlogin['username']!=$usr['Username']){ echo "class='bg-danger text-light'"; } ?> ><?=strtok($usrlogin['yazi'],"-")?></td>
                                            
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

 <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Read All</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 class="modal-heading mb-4 mt-2"><?=isim($usr['Username'].$usr['Tag'],"o")?></h4>
                                                <p class="modal-text" id="message_text">
												{{TEXT}}								
												</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn" data-dismiss="modal"><i class="flaticon-cancel-12"></i> Exit</button>
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
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "lengthMenu": [10, 20, 50,10000000],

	    });
    </script>	
