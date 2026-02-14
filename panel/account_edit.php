<?php
include("config.php");
yetkisinir(9);
?>

<link rel="stylesheet" type="text/css" href="plugins/table/datatable/datatables.css">
<link rel="stylesheet" type="text/css" href="assets/css/forms/theme-checkbox-radio.css">
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/dt-global_style.css">
<link rel="stylesheet" type="text/css" href="plugins/table/datatable/custom_dt_custom.css">
<link rel="stylesheet" type="text/css" href="plugins/select2/select2.min.css">

<link rel="stylesheet" type="text/css" href="plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css">
<link href="assets/css/components/tabs-accordian/custom-accordions.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="plugins/animate/animate.css">
<link href="assets/css/components/custom-modal.css" rel="stylesheet" type="text/css">



<div id="content" class="main-content">
    <div class="layout-px-spacing">

        <div class="row layout-top-spacing">

            <div class="container">
                <?php
                $user = $_GET['user'];
                if (!empty($user)) {
                    $usr = $db->query("SELECT * FROM users WHERE Username = '" . $user . "'")->fetch(PDO::FETCH_ASSOC);

                    if (!empty($usr['PlayerID'])) {
                        $id = $usr['PlayerID'];
                    }
                }
                ?>

                <div class="statbox widget box box-shadow" id="p">
                    <div class="widget-header  p-5">


                        <?php
                        if (empty($id)) {
                        ?>
                            <div class="row">
                                <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                    <h4 class="text-light">Edit account</h4>
                                </div>
                            </div>
                            <form method="GET">
                                <div class="input-group mb-4">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon5">@</span>
                                    </div>
                                    <input type="text" class="form-control" name="user" placeholder="Username" aria-label="Username">
                                </div>
                                <button class="mr-2 btn btn-primary" type="submit">Edit</button>
                            </form>
                            <?php
                        } else {

                            if (empty($id)) {
                                yenile(1, 1);
                            } else {


                                $prvl = array();
                                foreach (explode(",", $usr['PrivLevel']) as $v) {
                                    $prvl[($v - 1)] = $v;
                                }


                                $yetkisi = max($prvl)
                            ?>
                                <div class="mt-2 text-center" style="font-size:20px;">

                                    <?php
                                    if ($yetkisi < $yetkim || $usr['PlayerID'] == $uye['id']) {
                                    ?>
                                        Edit (<span id="usrnm"><?= isim($usr['Username'] . $usr['Tag'], "o") ?></span>)



                                        <input type="hidden" id="id" value="<?= $usr['PlayerID'] ?>">


                                        <form class="form-row" autocomplete="off">
                                            <div class="col-md-8 mb-8">
                                                <label for="kadi">Username</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    </div>
                                                    <input type="text" class="form-control" id="kadi" placeholder="Username" value="<?= $usr['Username'] ?>" aria-describedby="inputGroupPrepend" required <?= $yetkim >= 11 ? "" : "readonly" ?>>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-4">
                                                <label for="tag">Tag</label>
                                                <input type="text" class="form-control" id="tag" placeholder="Tag (ex : #0000)" value="<?= $usr['Tag'] ?>" required>
                                                <small style="font-size:11px;">If you want null tag only write hashtag(#)</small>
                                            </div>

                                            <div class="col-md-12 mb-12">
                                                <label for="email">E-mail</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                    </div>
                                                    <input type="email" class="form-control" id="email" placeholder="Email" value="<?= $usr['Email'] ?>" aria-describedby="inputGroupPrepend" required>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-12">
                                                <label for="sifre">Password</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend"><a class="pointer" onclick="s('sifre');">$</a></span>
                                                    </div>
                                                    <input type="password" class="form-control" id="sifre" placeholder="Password" aria-describedby="inputGroupPrepend" autocomplete="off" required>
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text" id="inputGroupPrepend"><a class="pointer" onclick="createpass();">Random</a></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mb-12 mt-5">
                                                <div class="input-group">

                                                    <!-- onChange="account_edit(this);" -->

                                                    <select class="form-control" id="privpool" multiple="multiple">
                                                        <?php

                                                        foreach ($privlist as $x => $x_val) {
                                                            if ($x != 1 && $x < $yetkim) {

                                                        ?>
                                                                <option value="<?= $x ?>" <?php if (!empty($prvl[($x - 1)])) {
                                                                                            echo "selected";
                                                                                        } ?>><?= ucwords($x_val) ?></option>
                                                        <?php
                                                            }
                                                        }

                                                        ?>


                                                    </select>

                                                </div>
                                            </div>


                                            <?php
                                            if (user_check($usr['PlayerID']) == 1) {
                                                $cheese_c = socket("getdata|" . $usr['PlayerID'] . "|cheeseCount", 1);
                                                $first_c = socket("getdata|" . $usr['PlayerID'] . "|firstCount", 1);
                                                $b_c = socket("getdata|" . $usr['PlayerID'] . "|bootcampCount", 1);
                                                $l_c = socket("getdata|" . $usr['PlayerID'] . "|bootcampCount", 1);
                                            } else {
                                                $cheese_c = $usr['CheeseCount'];
                                                $first_c = $usr['FirstCount'];
                                                $b_c = $usr['BootcampCount'];
                                                $l_c = $usr['ShamanLevel'];
                                            }

                                            ?>

                                            <div id="toggleAccordion" style="width:100% !important;">
                                                <div class="card">
                                                    <div class="card-header" id="cheese">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionOne" aria-expanded="true" aria-controls="defaultAccordionOne">
                                                                Cheese
                                                            </div>
                                                        </section>
                                                    </div>

                                                    <div id="defaultAccordionOne" class="collapse" aria-labelledby="cheese" data-parent="#toggleAccordion">
                                                        <div class="card-body">

                                                            <div class="col-md-12 mb-4">
                                                                <input type="text" class="form-control das" id="cheese_c" value="<?= $cheese_c ?>" required>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-header" id="first">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionTwo" aria-expanded="false" aria-controls="defaultAccordionTwo">
                                                                First
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="defaultAccordionTwo" class="collapse" aria-labelledby="first" data-parent="#toggleAccordion">
                                                        <div class="card-body">

                                                            <div class="col-md-12 mb-4">
                                                                <input type="text" class="form-control das" id="first_c" value="<?= $first_c ?>" required>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-header" id="bootcamp">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionThree" aria-expanded="false" aria-controls="defaultAccordionThree">
                                                                Bootcamp
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="defaultAccordionThree" class="collapse" aria-labelledby="bootcamp" data-parent="#toggleAccordion">
                                                        <div class="card-body">

                                                            <div class="col-md-12 mb-4">
                                                                <input type="text" class="form-control das" id="bootcamp_c" value="<?= $b_c ?>" required>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-header" id="level">
                                                        <section class="mb-0 mt-0">
                                                            <div role="menu" class="collapsed" data-toggle="collapse" data-target="#defaultAccordionFour" aria-expanded="false" aria-controls="defaultAccordionFour">
                                                                Level
                                                            </div>
                                                        </section>
                                                    </div>
                                                    <div id="defaultAccordionFour" class="collapse" aria-labelledby="level" data-parent="#toggleAccordion">
                                                        <div class="card-body">

                                                            <div class="col-md-12 mb-4">
                                                                <input type="text" class="form-control das" min="1" id="level_c" value="<?= $l_c ?>" required>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        </form>

                                        <button class="btn btn-primary mt-3" type="button" id="update" onclick="account_edit();">Update</button>
                                        <br><br>
                                        <div id="result_m"></div>


                                    <?php
                                    } else {
                                        echo tfmdil('Erreur_Droit');
                                    }
                                    ?>
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
<script src="assets/js/components/ui-accordions.js"></script>

<script src="plugins/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
<script src="plugins/bootstrap-touchspin/custom-bootstrap-touchspin.js"></script>
<script src="plugins/select2/select2.min.js"></script>
<script src="plugins/select2/custom-select2.js"></script>
<script src="plugins/table/datatable/datatables.js"></script>
<script src="plugins/blockui/jquery.blockUI.min.js"></script>

<script src="plugins/blockui/custom-blockui.js"></script>
<script>
    function s(id) {
        var e = $('#' + id).attr('type');
        if (e != "password") {
            $('#' + id).attr('type', "password");
        } else {
            $('#' + id).attr('type', "text");
        }
    }

    function createpass() {

        var result = '';
        var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        var charactersLength = characters.length;
        for (var i = 0; i < Math.floor(Math.random() * (16 - 8)) + 8; i++) {
            result += characters.charAt(Math.floor(Math.random() * charactersLength));
        }


        $("#sifre").val(result).change;

    }

    $("#privpool").select2({
        tags: false
    });



    $('#update').on('click', function() {
        var block = $('#p');
        $(block).block({
            message: '<span class="text-semibold">Please wait...</span>',
            timeout: 999999,
            overlayCSS: {
                backgroundColor: '#000',
                opacity: 0.8,
                cursor: 'wait'
            },
            css: {
                border: 0,
                padding: 0,
                color: '#e7515a',
                backgroundColor: 'transparent'
            }
        });
    });




    $(".das").TouchSpin({
        min: 0,
        max: 999999999999
    });

    $('#multi-column-ordering').DataTable({
        "oLanguage": {
            "oPaginate": {
                "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
            },

            "sInfo": "Showing page _PAGE_ of _PAGES_",
            "sSearchPlaceholder": "Search...",
            "sLengthMenu": "Results :  _MENU_",
        },
        "lengthMenu": [10, 20, 50, 10000000],

    });
</script>