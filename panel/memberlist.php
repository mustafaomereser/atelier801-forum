<?php
include("config.php");
$memberlist = $db->query("SELECT * FROM users order by RegDate")->fetchAll(PDO::FETCH_ASSOC);
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
                                <table id="multi-column-ordering" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Avatar</th>
                                            <th>Privileges</th>
                                            <th>NickName</th>
                                            <th>RegisterDate</th>
											<th>[--]</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										
<?php
foreach($memberlist as $member){
?>												
                                                 <tr>
                                                <td class="checkbox-column"> <?=$member['PlayerID']?> </td>
												
                                            <td>
                                                <div class="d-flex">                                                        
                                                    <div class="usr-img-frame mr-2 rounded-circle">

                                                        <img class="img-fluid rounded-circle" id="img_<?=$member['PlayerID']?>" onerror='imgError(this);' src="<?=$site?>/img/avatars/<?=getavatar($member)?>">

												   </div>
                                                </div>
                                            </td>
											<td>
						<?php
						$t  = explode(",",$member['PrivLevel']);
						$inassa=0;
						$yetkilerc = 0;
						foreach($t as $x){
							if(!strstr($member['PrivLevel'],"12")){
							$inassa++;
							if($inassa==4){
								$inassa=0;
								echo "<br>";
							}
									$yetkilerc++;
						?>						
						<span class="badge outline-badge-<?=$privlist[$x]?>" style="margin:2px;"> <?=ucwords($privlist[$x])?> </span>
								<?php
						}
						}
						if($yetkilerc==0){
							?>
						<span class="badge outline-badge-player" style="margin:2px;"> Player</span>

							<?php
						}
								?>															
											</td>
											<td><?=isim($member['Username'].$member['Tag'],"o")?></td>
                                            <td><?=date("d/m/Y",($member['RegDate']))?></td>
											
											       <td class="text-center">
												   	<?php
														if($yetkim>=10 || $op>=1){
														?>
                                                    <div class="dropdown custom-dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-horizontal"><circle cx="12" cy="12" r="1"></circle><circle cx="19" cy="12" r="1"></circle><circle cx="5" cy="12" r="1"></circle></svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
															<?php
															if(max(explode(",",$member['PrivLevel']))<$yetkim && $yetkim>=9){
															?>
                                                     		 <a class="dropdown-item" href="account_edit?user=<?=$member['Username']?>">Edit user</a>
															 <?php
															}
															 ?>
														
														      <a class="dropdown-item" href="getip?user=<?=str_replace("+","%2B",$member['Username'])?>">Get IP</a>
                                                             <a class="dropdown-item" href="chat_log?user=<?=str_replace("+","%2B",$member['Username'])?>">Chat LOG</a>
															  <a class="dropdown-item" href="getlogins?user=<?=str_replace("+","%2B",$member['Username'])?>">Login LOG</a>
                                                            <a class="dropdown-item" href="command_log?user=<?=str_replace("+","%2B",$member['Username'])?>">Commands LOG</a>
															<?php
															if(max(explode(",",$member['PrivLevel']))>=8){
															?>
                                                     		 <a class="dropdown-item" href="moderate_log?user=<?=str_replace("+","%2B",$member['Username'])?>">Moderate LOG</a>
															 <?php
															}
															 ?>
													  </div>
                                                    </div>
														<?php
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