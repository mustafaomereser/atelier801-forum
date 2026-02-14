<?php
include("config.php");
yetkisinir(10);

?>

	<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_custom.css">



   <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">

            <div class="layout-px-spacing">
	<div id="titles"></div>

                <div class="row layout-top-spacing">

                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">

                        <div class="widget-content widget-content-area br-6">
									<button class="btn btn-primary float-right" type="button" data-toggle="modal" data-target="#createbot">Create Title</button>

                            <div class="table-responsive mb-4 mt-4">

                                <table id="titleslist_a" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
											<th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
							<?php

							foreach($titlelist as $id => $tt){
								$id = substr($id,2);
							?>			
									
                                        <tr id="<?=$id?>">
											<td>
                                             <?=$id?>
                                            </td>
                                            <td  id="titlename_<?=$id?>">
                                             <?=$tt?>
                                            </td>
                                            <td class="text-center">
											<a class="btn btn-outline-warning" id="<?=$id?>=<?=$tt?>" onclick="degistir('sey_iste_burasi_title_edit_kismi','');degistirload('sey_iste_burasi_title_edit_kismi','ajax/titlemod?v=<?=$id?>');"  data-toggle="modal" data-target="#edit">
											Edit
											</a>    
											<a class="btn btn-outline-danger" id="<?=$id?>=<?=$tt?>" onclick="title_p(this,2);block('<?=$id?>');">
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
			 </div>
            
		
			
			
	                                    <div class="modal fade" id="createbot" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
												    <div class="form-group mb-4">
													<div>
													
													<label>Title</label>
													<input type="text" class="form-control" name="title" id="title" required>
													
											   </div>
											  </div>
                                                <div class="modal-footer">
                                                    <button type="submit" onclick="title_p(this,1);" class="btn btn-primary">Create</button>
                                                </div>
												</div>

                                            </div>
                                        </div>
                                    </div>
			
			
			
				                      <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Edit Title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
												    <div class="form-group mb-4">
													<div>
													
													<label>Title</label>
													
													<div id="sey_iste_burasi_title_edit_kismi">

													</div>
													
											   </div>
											  </div>
                                                <div class="modal-footer">
                                                    <button type="submit" onclick="title_p(this,3);" class="btn btn-primary" data-dismiss="modal">Edit</button>
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
        $('#titleslist_a').DataTable({
            "oLanguage": {
                "oPaginate": { "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>', "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>' },
                "sInfo": "Showing page _PAGE_ of _PAGES_",
                "sSearchPlaceholder": "Search...",
               "sLengthMenu": "Results :  _MENU_",
            },
            "lengthMenu": [10, 20, 50,10000000],

	    });


    </script>

	