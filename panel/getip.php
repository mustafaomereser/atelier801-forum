<?php
include("config.php");
yetkisinir(11);
?>
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">

                   <div class="container">


<?php
$user = $_GET['user'];
if(!empty($user)){
	$usr = $db->query("SELECT * FROM loginlog WHERE username = '".$user."' order by Timestamp DESC")->fetch(PDO::FETCH_ASSOC);

if(!empty($usr['ip'])){
$ip = $usr['ip'];
	
}

}
?>
				   
				   <div class="statbox widget box box-shadow">
                                <div class="widget-header  p-5">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>GET IP</h4>
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
<div class="mt-2 text-center" style="font-size:20px;">
<?=$ip?>
</div>
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
