<?php
include("../pdoconnect.php");
yetkisinir(8);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Panel</title>
    <link rel="icon" type="image/x-icon" href="<?=$site?>/img/favicon.ico"/>
    <link href="assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/loader.js"></script>

    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert2.min.css" rel="stylesheet" type="text/css" />
    <link href="plugins/sweetalerts/sweetalert.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components/custom-sweetalert.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">

	 <link href="assets/css/tables/table-basic.css" rel="stylesheet" type="text/css" /

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>
<body>
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader" style="background:#060818;"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    <div class="header-container fixed-top">
        <header class="header navbar navbar-expand-sm">

            <ul class="navbar-item theme-brand flex-row  text-center">
                <li class="nav-item theme-logo">
                    <a href="index">
                        <img src="assets/img/logo.png" class="navbar-logo" alt="logo">
                    </a>
                </li>
                <li class="nav-item theme-text">
                    <a href="index" class="nav-link"> Panel </a>
                </li>
            </ul>

            <ul class="navbar-item flex-row ml-md-auto">
			
			<li class="nav-item dropdown user-profile-dropdown">
                    <a href="<?=$site?>" target="_blank" class="nav-link user">
                    Go Forum
					</a>
                    
                </li>
             

                <li class="nav-item dropdown user-profile-dropdown">
                    <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                        <img src="<?=$site?>/img/avatars/<?=getavatar($uye)?>" id="img_<?=$uye?>" onerror='imgError(this);' >
						<?=$uye['Username']?>
					</a>
                    <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                        <div class="">
                            <div class="dropdown-item">
                                <a href="<?=$site?>/profile?pr=<?=cpr($uye['Username'])."%23".end(explode("#",$uye['Tag']))?>"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg> My Profile</a>
                            </div>

                        </div>
                    </div>
                </li>

            </ul>
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>
			<?php
			if($yetkim>=11){
			?>
				<a class="pointer noselect" onclick="maintenance(2);"><b>Maintenance mode : <Depwesso_Vangoth><?=$ayardb['bakim']==1 ? "<font color='green'>ON</font>" : "<font color='red'>OFF</font>"?></Depwesso_Vangoth></b></a>
			<?php
			}
			?>
		</header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        <div class="sidebar-wrapper sidebar-theme">
            
            <nav id="sidebar">
                <div class="shadow-bottom"></div>
                <ul class="list-unstyled menu-categories" id="accordionExample">
                    <li class="menu">
                        <a href="#dashboard" data-active="true" data-toggle="collapse" aria-expanded="true" class="dropdown-toggle">
                            <div class="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                                <span>Control</span>
                            </div>
                            <div>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </div>
                        </a>
                        <ul class="collapse submenu list-unstyled show" id="dashboard" data-parent="#accordionExample">
                            <li>
                                <a href="index"> Dashboard </a>
                            </li>
                            <li>
                                <a href="stafflist"> Staff list </a>
                            </li>
						
							
							<li>
							<a href="memberlist">Memberlist </a>
							</li>
							
							<?php
							if($yetkim>=9 || $op>=1){
							?>
							<li>
							<a href="account_edit"> Edit account </a>
							</li>
							<li>
							<a href="give_consumables"> Give item </a>
							</li>
							<?php
							}
							?>
							
							
							<?php
							if($yetkim>=11 || $op>=1){
							?>
							<li>
                                <a href="getip"> GET IP </a>
                            </li>
							
							<li>
							<a href="module"> Lua modules </a>
							</li>
							
							<li>
                                <a href="village"> Village </a>
                            </li>
							
							<?php
							}
							?>
							<li>
							<a href="chat_log"> Chat LOG </a>
							</li>
							<li>
							<a href="getlogins"> Login LOG </a>
							</li>
							<?php
							if($yetkim>=10 || $op>=1){
							?>
							
							<li>
							<a href="titlelist"> Title list </a>
							</li>
							
							<li>
							<a href="command_log"> Command LOG </a>
							</li>
							
							<li>
							<a href="moderate_log"> Moderate LOG </a>
							</li>
							
							<li>
							<a href="add_image"> Add Image </a>
							</li>
							
							<?php
							}
							?>
						
						
							<?php
							if($yetkim>=12 || $op>=1){
							?>
							<li>
                                <a href="command"> Command to game </a>
                            </li>
							<?php
							}
							?>
							
							<li>
                                <a href="reports"> Reports </a>
                            </li>
							
							<li>
                                <a href="contact"> Contact </a>
                            </li>
						
                        </ul>
                    </li>
				 
                    
                </ul>
                <!-- <div class="shadow-bottom"></div> -->
                
            </nav>

        </div>
        <!--  END SIDEBAR  -->