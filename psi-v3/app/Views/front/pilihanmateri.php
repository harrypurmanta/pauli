<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Pauli Bintang Timur Prestasi</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/skins/_all-skins.min.css">
    <link rel="icon" href="../../../../../images/bg/favicon.ico" type="image/gif">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <?= $this->include('front/navbar') ?>
        </header>

        <div class="content-wrapper">
            <div class="container">
                <section class="content">
                    <div class="row">
                    <div class="col-md-12" style="display: flex;justify-content: center;margin-bottom:20px;">
                                <h2><b>MATERI</b></h2>
                    </div>
                    <div class="col-md-12">
                            <?php
                                foreach ($group as $key) {
                            ?>
                            <div class="col-lg-6">
                                <div class="small-box bg-gray" style="border-radius:10px;">
                                    <div class="inner text-center">
                                        <h3><?= $key->group_nm ?></h3>
                                    </div>
                                       
                                        <a onclick='showtoken(<?= $key->group_soal_id ?>, <?= $materi_id ?>)' href="#" class="btn small-box-footer bg-blue" style="color:black;font-size:16px;">
                                        Mulai <i class="fa fa-arrow-circle-right"></i>
                                        </a>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </section>
                
            </div>
        </div>

        <?= $this->include('front/footer') ?>
    </div>
    <script src="<?= base_url() ?>/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url() ?>/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="<?= base_url() ?>/dist/js/adminlte.min.js"></script>
    <script>
        function showtoken(group_id, materi_id) {
            window.location.href = "<?= base_url() ?>/pauli/petunjukpauli/"+materi_id+"/"+group_id;
        }

        function checktoken() {
            var token = $("#token").val();
            var group_id = $("#group_idx").val();
            var materi_id = $("#materi_id").val();
            $.ajax({
                url: "<?= base_url('token/checktoken') ?>",
                type: "post",
                dataType: "json",
                data: {
                    "token": token,
                    "group_id": group_id,
                    "materi_id": materi_id
                },
                beforeSend: function() {
                    $("#loader-wrapper").removeClass("d-none");
                },
                success: function(data) {
                    if (data == "sukses") {
                        $("#modal-token").modal("hide");
                        $("#modal-noTest").modal("show");
                        $("#group_id_notest").val(group_id);
                        $("#materi_id_notest").val(materi_id);
                        console.log(group_id, materi_id);
                        
                    } else {
                        alert("Token salah/tidak ada, hubungi administrator");
                    }
                    $("#loader-wrapper").addClass("d-none");
                },
                error: function() {
                    alert("Error");
                    $("#loader-wrapper").addClass("d-none");
                }
            });
        }

        function InsertNoTest() {
            var notest = $("#notest").val();
            var group_id = $("#group_id_notest").val();
            var materi_id = $("#materi_id_notest").val();
            $.ajax({
                url: "<?= base_url('token/InsertNoTest') ?>",
                type: "post",
                dataType: "json",
                data: {
                    "notest": notest,
                    "group_id": group_id,
                    "materi_id": materi_id
                },
                beforeSend: function() {
                    $("#loader-wrapper").removeClass("d-none");
                },
                success: function(data) {
                    if (data == "sukses") {
                        alert("No Test berhasil di simpan");
                        window.location.href = "<?= base_url() ?>/pauli/petunjukpauli/"+materi_id+"/"+group_id;
                    } 
                    $("#loader-wrapper").addClass("d-none");
                },
                error: function() {
                    alert("Error");
                    $("#loader-wrapper").addClass("d-none");
                }
            });

            
        }
    </script>
</body>

</html>