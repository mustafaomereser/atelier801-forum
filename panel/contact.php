<?php
include("config.php");
$contact = $db->query("SELECT * FROM iletisim order by date DESC")->fetchAll(PDO::FETCH_ASSOC);

if($yetkim>=10){
$sil = $_GET['sil'];
if(!empty($sil)){
	$del = $db->exec("DELETE FROM iletisim where id = '".$sil."'");
	if($del>0){
		geri();
	}
}
}

?>

	<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_custom.css">
	
	

   <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <div class="table-responsive mb-4 mt-4">
                                <table id="multi-column-ordering" class="table table-hover" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username</th>
                                            <th>E-mail</th>
                                            <th>Category</th>
                                            <th>Subject</th>
											<th>Message</th>
											<th>Date</th>
											<th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										
<?php
foreach($contact as $row){
?>												
                                                 <tr>
                                                <td class="checkbox-column"> <?=$row['id']?> </td>
												
                                            <td>
                                              <?=$row['kadi']?>
                                            </td>
											
											<td>
                                              <a href='mailto:<?=$row['email']?>'><?=$row['email']?></a>
											</td>
											
											<td><?=$row['kategori']?></td>
                                            <td><?=$row['konu']?></td>
											
											<td>
<button class="badge outline-badge-arbitre pointer" onclick="degistirhtml('message_name','<?=$row['email']?>');degistirload('message_text','ajax/contact?v=<?=$row['id']?>');" data-toggle="modal" data-target="#fullmessage"> <?=kisalt($row['mesaj'])?></button>
											</td>                      
												
											       <td class="text-center">
												   <?=toptarih($row['date'])?>
                                                </td>	


											       <td style="width:15%;">
												   <?php
												   if($yetkim>=10){
												   ?>
												   <a href="?sil=<?=$row['id']?>" onclick="confirmDel();">
											<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 table-cancel"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
												   </a>
                                                <?php
													}else{
														echo "-";
													}
												?>
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
            
			
			
			
			
		
					<div class="modal fade" id="fullmessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
                                            <div class="modal-content modal-xl">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Contact</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <h4 class="modal-heading mb-4 mt-2" id="message_name">{{Name}}</h4>
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