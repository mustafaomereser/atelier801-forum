<?php
include("config.php");
$staff = $db->query("SELECT * FROM users WHERE PrivLevel LIKE '%11%' or PrivLevel LIKE '%10%' or PrivLevel LIKE '%9%' or PrivLevel LIKE  '%8%' or PrivLevel LIKE  '%7%' or PrivLevel LIKE  '%6%' or PrivLevel LIKE  '%5%' or PrivLevel LIKE  '%4%' or PrivLevel LIKE  '%3%' or PrivLevel LIKE  '%2%'")->fetchAll(PDO::FETCH_ASSOC);
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
                            <div class="table-responsive mb-4 mt-4">
                                <table id="multi-column-ordering" class="table scrollbarg" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Avatar</th>
                                            <th>Privileges</th>
                                            <th>NickName</th>
                                            <th>RegisterDate</th>
											<th>[--]</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
						<?php
							foreach($staff as $staffmember){
								if(!strstr($staffmember['PrivLevel'],"12")){
						?>
									
                                        <tr>
                                            <td>
                                                <div class="d-flex">                                                        
                                                    <div class="usr-img-frame mr-2 rounded-circle">

                                                        <img id="img_<?=$staffmember['PlayerID']?>" onerror='imgError(this);'   class="img-fluid rounded-circle" src="<?=$site?>/img/avatars/<?=getavatar($staffmember)?>">
												   
												   </div>
                                                </div>
                                            </td>
                                            <td>
						<?php
						$t  = explode(",",$staffmember['PrivLevel']);
						$inassa=0;
						foreach($t as $x){
							$inassa++;
							if($inassa==4){
								$inassa=0;
								echo "<br>";
							}
						?>						
						<span class="badge outline-badge-<?=$privlist[$x]?>" style="margin:2px;"> <?=ucwords($privlist[$x])?> </span>
								<?php
							}
								?>															
											</td>
                                            <td><?=isim(str_replace("+","%2B",$staffmember['Username']).$staffmember['Tag'],"o")?></td>
                                            <td><?=date("d/m/Y",($staffmember['RegDate']))?></td>
											
											
											       <td class="text-center">
												   	<?php
														if($yetkim>=10 || $op>=1){
														?>
                                                    <div class="dropdown custom-dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
														      <a class="dropdown-item" href="getip?user=<?=str_replace("+","%2B",str_replace("+","%2B",$staffmember['Username']))?>">Get IP</a>
                                                             <a class="dropdown-item" href="chat_log?user=<?=str_replace("+","%2B",$staffmember['Username'])?>">Chat LOG</a>
															  <a class="dropdown-item" href="getlogins?user=<?=str_replace("+","%2B",$staffmember['Username'])?>">Login LOG</a>
                                                            <a class="dropdown-item" href="command_log?user=<?=str_replace("+","%2B",$staffmember['Username'])?>">Commands LOG</a>
                                                     		 <a class="dropdown-item" href="moderate_log?user=<?=str_replace("+","%2B",$staffmember['Username'])?>">Moderate LOG</a>

													  </div>
                                                    </div>
														<?php
														}
														?> 
                                                </td>
											
                                        </tr>
								 <?php
									}
								}
								?>	                                      
                                    </tbody>
<!--									
                                    <tfoot>
                                        <tr>
                                            <th>Avatar</th>
                                            <th>Privileges</th>
                                            <th>NickName</th>
                                            <th>RegisterDate</th>
                                        </tr>
                                    </tfoot>-->
                                </table>
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