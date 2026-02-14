<?php
include("config.php");
yetkisinir(12);
?>
        
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">

                   <div class="container">
				   
				   <?php
				   $komut = $_GET['command'];
				   if(!empty($komut)){
					   socket("komut|".$komut);
					   yenile(0,1);
				   }
					?>				   
				   
				   <div class="statbox widget box box-shadow">
                                <div class="widget-header  p-5">
                                    <div class="row">
                                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                            <h4>COMMAND</h4>
                                        </div>
                                    </div>
                                <form method="GET">
                                    <div class="input-group mb-4">
                                      <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">/</span>
                                      </div>
                                      <input type="text" class="form-control" name="command" placeholder="command" aria-label="Username">
                                    </div>

                                    
<button class="mr-2 btn btn-primary" type="submit">SEND</button>
</form>

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
