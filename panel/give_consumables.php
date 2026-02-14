<?php
include("config.php");
yetkisinir(9);
?>

        <link rel="stylesheet" type="text/css" href="plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">

	<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_custom.css">
	<link rel="stylesheet" type="text/css" href="plugins/select2/select2.min.css">
	<script src="../js/script.js"></script>
<style>
.scroll{
	overflow-y: scroll; height: 350px;
}
</style>
	
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="row layout-top-spacing">

                   <div class="container">

				   
				   <div class="statbox widget box box-shadow">
                                <div class="widget-header  p-5">

<div class="mt-2 text-center" style="font-size:20px;">


    <div class="form-row">	
        <div class="col-md-12 mb-8">
            <label for="kadi">Username</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                </div>
                <input type="text" class="form-control" name="kadi" id="kadi" placeholder="Username" value="" aria-describedby="inputGroupPrepend" required>
            </div>
        </div>


        <div class="col-md-12 mb-12">
            <label for="item">Item</label>
			
<div class="form-group mb-4">
  <?php
  $jsonobj = file_get_contents("consumables/items.json");
  $arr = json_decode($jsonobj, true);
  ?>
  
  <center> <div id="dropdown_communaute"></div> </center>
<?php
$l_js = '{text:\'<span style="font-size:14px;">Select your mind\', selected:true},';

foreach($arr as $key => $rw){

$l_js .= '{text:\'<span><img src="http://transformice.com/images/x_transformice/x_inventaire/'.$rw['id'].'.jpg" class="img16 espace-2-2" /></span>\', value:'.$rw['id'].', selected:false},';

}
?>

<script type="text/javascript">
var ddData_communaute = [<?=rtrim($l_js,",")?>];
function initialiseDropdown_communaute() {
	jQuery('#dropdown_communaute').ddslick({data:ddData_communaute,width:200,onSelected: function(data){
	jQuery('#communaute').attr('value', data.selectedData.value);
	jQuery('.dd-selected-value').attr('id', 'item');
	
	$(document).ready(function() {
	$("#dropdown_communaute ul").addClass("scroll");
	//$("#dropdown_communaute ul").css("background-color", "#1B2E4B");
    });

}});
};

						try {
							initialiseDropdown_communaute();
							jQuery('.datepicker').datepicker({
								format:'dd/mm/yyyy'
							});

							if (window.location.hash && window.location.hash.length > 1) {
								jQuery('#lien_' + window.location.hash.substring(1)).tab('show');
							}

							var rfc = parseBoolean('false');

							if (rfc) {
								initRFC();
							}
                    }catch(err){
						//alert(err);
					}

</script> 
  
  
 </div>
    </div>

        <div class="col-md-12 mb-12 mb-3">
            <label for="amount">Amount</label>
                <input type="text" max="200" min="1" class="form-control" name="amount" id="amount" placeholder="Amount (max:200 / min:1)" aria-describedby="inputGroupPrepend" required>
        </div>


    <button class="btn btn-primary mt-3" type="button" onclick="giveconsumables();">Give</button>
</div>

<div id="result_msg"></div>



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

   <script src="plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="plugins/bootstrap-touchspin/custom-bootstrap-touchspin.js"></script>
    <script src="plugins/select2/select2.min.js"></script>
    <script src="plugins/select2/custom-select2.js"></script>
    <script src="plugins/table/datatable/datatables.js"></script>

    <script>
	
	$("#privpool").select2({
    tags: false
});
	
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
<script>
$("input[name='amount']").TouchSpin({
    initval: 1,
	min:1,
	max:200
});
</script>