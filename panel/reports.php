<?php
include("config.php");
?>

	<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_custom.css">
	<link rel="stylesheet" type="text/css" href="assets/css/scrollg.css">


   <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                 				
			
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

                        <div class="widget-content widget-content-area br-6">
											<div class="mt-2 text-center" style="font-size:20px;">Reports</div>
                            <div class="table-responsive mb-4 mt-4">
							
							
							<div class="row" bis_skin_checked="1">
							<div class="col-sm-12 col-md-6" bis_skin_checked="1">
							<div class="dataTables_length" id="multi-column-ordering_length" bis_skin_checked="1">
							<label>Report type : 
							<form method="GET" id="form">
							<select class="form-control" onchange="formsubmit('form');" name="reporttype" style="width:97% !important;">
							<option>Select...</option>
							<option value="topic">Topic</option>
							<option value="profil">Profile</option>
							<option value="tribe">Tribe</option>
							</select>
							</form>
							</label>
							</div>
							</div>
							</div>
							
<?php
$type = $_GET['reporttype'];
$reportlist = $db->query("SELECT * FROM reports WHERE mode = '".$type."'")->fetchAll(PDO::FETCH_ASSOC);

?>							
                                <table id="multi-column-ordering" class="table" style="width:100%!important;">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nick</th>
                                            <th>Reason</th>
                                            <th>Link</th>
                                            <th>Date</th>
											<th>[--]</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										
<?php
foreach($reportlist as $report){
$reportedby = $db->query("SELECT Username,Tag FROM users WHERE PlayerID = '".$report['byid']."'")->fetch(PDO::FETCH_ASSOC);
?>												
                                                 <tr>
												 
                                            <td><?=$report['id']?></td>											
                                            <td><?=isim($reportedby['Username'].$reportedby['Tag'],"o")?></td>
											<td><?=kisalt($report['reason'],50)?></td>
											<td>											
											<a href="<?=$report['link']?>" class="btn btn-outline-primary" target="_blank">
											Go
											</a>
											</td>
                                            <td><?=$report['date']?></td>
											
											<td>
<?php
if($report['handled'] == 0){
?>												
											<a id="handle_<?=$report['id']?>" class="btn btn-outline-success" onclick="report(this,'handled',<?=$report['id']?>);">
											Handle
											</a>
 <?php
}else{
?>	
                                             <button class="btn btn-warning">Handled</button>
 <?php
}
?>												
											<a id="delete_<?=$report['id']?>" class="btn btn-outline-danger" onclick="report(this,'deleted',<?=$report['id']?>);">
											Delete
											</a>
											</td>
											
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