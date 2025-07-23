<?php
include_once 'header.php';
include_once 'includes/session.php';

include_once 'includes/secure_function.php';
include_once 'includes/utils.php';
?>

<?php
require_once 'includes/db.php';
$query_drop = "
                            SELECT unit FROM lokasi 
                            ORDER BY unit ASC
                        ";
$result_drop = $connection->query($query_drop);
?>
    <script language="JavaScript" type="text/javascript">
      function checkDelete() {
        if (confirm('Aset akan dipadam. Adakah ingin teruskan ?')) {
          window.location.href="asset_komputer_delete.php?varname=<?php echo $_GET['varname']?>"
        }
      }
    </script>
    <?php $var_value = $_GET['varname'];?>
    <?php 
    
    
    //localhost, hubhasil.geosabah.my
    // $connection = mysqli_connect("localhost", "sabah_wuser", "70be8036125732e724d96024de2339d15a3194f3d2f6c462","inventory");
    $query_drop = "SELECT * FROM komputer where komputer.k_id = ? ";
    $stmt = $connection->prepare($query_drop);
    $stmt->bind_param("s", $var_value);
    $stmt->execute();

    $result_drop = $stmt->get_result();
      
      $i = 0;
      while ($row = $result_drop->fetch_assoc()) {

          $i = $i + 1;
          $k_id 		= $row["k_id"];
          $penggunaan 		= $row["penggunaan"];
          $nama_pengguna 	= $row["nama_pengguna"];
          $asset_id 		= $row["asset_id"];
	        $model 		= $row["model"];
          $tahun              =   $row['tahun'];
	        $serial 		= $row["serial"];
	        $kewpa 		= $row["kewpa"];
          $status		= $row["status"];
	        $jen_perolehan	= $row["jen_perolehan"];
          $processor		= $row["processor"];
          $ram_gb 		= $row["ram_gb"];
          $kapasiti_hd_gb	= $row["kapasiti_hd_gb"];
	        $kad_grafik		= $row["kad_grafik"];
          $network_lan 		= $row["network_lan"];
          $modem		= $row["modem"];
          $ip_address		= $row["ip_address"];
          $subnet_mask		= $row["subnet_mask"];
          $def_gateway		= $row["def_gateway"];
          $dns_server		= $row["dns_server"];
          $ic			= $row["ic"];

}

    
?>
      <!-- page content -->
      <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Asset</h3>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Paparan  Maklumat Komputer</h2>
                    <div margin class="col-md-1 col-sm-12  float-right">
									<a href='asset_view.php' class='btn btn-warning'>Kembali</a>
								</div> 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <form role="form" action="./asset_komputer_edit.php?varname=$k_id" method="post" id="registration-form" autocomplete="off">

                    <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name" >Penggunaan<span class="required">*</span>
                        </label>
                        
                        <div class="col-md-4 col-sm-6 ">
                        <input type="text" name="name" id="Name" class="form-control" disabled="disabled" value="<?php echo sanitizeText($penggunaan)?>" placeholder="Username digunakan untuk log masuk">
                        </div>
                        </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Nama Pengguna<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="username" id="username" required="required" class="form-control" value="<?php echo sanitizeText($nama_pengguna)?>" placeholder="Username digunakan untuk log masuk" disabled="disabled">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="ic">Asset ID<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="ic" id="ic" required="required" class="form-control" disabled="disabled" value="<?php echo intval($asset_id)?>" placeholder="No Kad Pengenalan (tanpa -)" maxlength="12"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="jawatan">Model <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="jawatan" id="jawatan" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($model)?>" placeholder="Jawatan"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="jawatan">Tahun Diperoleh <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="jawatan" id="jawatan" required="required" class="form-control" disabled="disabled" value="<?php echo intval($tahun)?>" placeholder="Jawatan"
                          >
                        </div>
                      </div>


                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="jawatan">No. Serial <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="jawatan" id="jawatan" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($serial)?>" placeholder="Jawatan"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="jawatan">No. KewPA <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="jawatan" id="jawatan" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($kewpa)?>" placeholder="Jawatan"
                          >
                        </div>
                      </div>



                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="lokasi">Status <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="lokasi" id="lokasi" required="required" class="form-control " disabled="disabled" value="<?php echo sanitizeText($status)?>" placeholder="Lokasi Pejabat"
                          >
                        </div>
                      </div>

                      
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Jenis Perolehan <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="email" name="email" id="email" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($jen_perolehan)?>" placeholder="Email Rasmi"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">Processor <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="tel" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($processor)?>" 
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">RAM (GB)<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="tel" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($ram_gb)?>" placeholder="0123456789"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">Kapasiti Harddisk (GB) <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="tel" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($kapasiti_hd_gb)?>" placeholder="0123456789"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">Kad Grafik <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="tel" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($kad_grafik)?>" placeholder="0123456789"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">Network LAN <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="tel" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($network_lan)?>" placeholder="0123456789"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">Modem  <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="tel" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($modem)?>" placeholder="0123456789"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">IP Address  <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="tel" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($ip_address)?>" placeholder="xxx.xxx.xxx.xxx"
                          >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">Subnet Mask  <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="tel" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($subnet_mask)?>" placeholder="255.255.255.0"
                          >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">Default Gateway  <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="tel" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($def_gateway)?>" placeholder="xxx.xxx.xxx.xxx"
                          >
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">DNS Server  <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="tel" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($dns_server)?>" placeholder="xxx.xxx.xxx.xxx"
                          >
                        </div>
                      </div>
                      
                      <form role="form" action="asset_komputer_edit.php?varname=<?php echo sanitizeText($_GET["varname"]) ?>" method="post" class=" pure-form form-horizontal form-label-left ">
                        <input type="text" hidden name="id"  value="<?php echo sanitizeText($_GET["varname"]) ?>">
                    
                        <div class="form-group row">
                          <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                          <div class="col-md-3 col-sm-4 ">
                            <button type="button" name="delete" class="btn btn-danger" onclick="return checkDelete();" href="asset_komputer_delete.php?varname=<?php echo sanitizeText($var_value)?>">Padam</button>
                            <button type="submit" name="edit" class="btn btn-success">Kemaskini</button>
                          </div>
                        </div>
                      </form>

                        <?php if (isset($_GET['error'])) { ?>
     		<p class="error" style="text-align:center" ><?php echo sanitizeText($_GET['error']); ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success" style="text-align:center"><?php echo sanitizeText($_GET['success']); ?></p>
        <?php } ?>
                        </div>
                        </div>

                      
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->


  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
  <script src="../vendors/validator/multifield.js"></script>
  <script src="../vendors/validator/validator.js"></script>

  <!-- Javascript functions	-->
  <script>
    function hideshow() {
      var password = document.getElementById("password1");
      var slash = document.getElementById("slash");
      var eye = document.getElementById("eye");

      if (password.type === 'password') {
        password.type = "text";
        slash.style.display = "block";
        eye.style.display = "none";
      } else {
        password.type = "password";
        slash.style.display = "none";
        eye.style.display = "block";
      }

    }

  </script>

  <script>
    // initialize a validator instance from the "FormValidator" constructor.
    // A "<form>" element is optionally passed as an argument, but is not a must
    var validator = new FormValidator({
      "events": ['blur', 'input', 'change']
    }, document.forms[0]);
    // on form "submit" event
    document.forms[0].onsubmit = function (e) {
      var submit = true,
        validatorResult = validator.checkAll(this);
      console.log(validatorResult);
      return !!validatorResult.valid;
    };
    // on form "reset" event
    document.forms[0].onreset = function (e) {
      validator.reset();
    };
    // stuff related ONLY for this demo page:
    $('.toggleValidationTooltips').change(function () {
      validator.settings.alerts = !this.checked;
      if (this.checked)
        $('form .alert').remove();
    }).prop('checked', false);

    // ic number only
    $('#ic').keypress(function (e) {
      var txt = String.fromCharCode(e.which);
      if (!txt.match(/[0-9]/)) {
        return false;
      }
    });
    // phone number only
    $('#tel').keypress(function (e) {
      var txt = String.fromCharCode(e.which);
      if (!txt.match(/[0-9]/)) {
        return false;
      }
    });

    $(function () {
      $('#username').on('keypress', function (e) {
        if (e.which == 32) {
          console.log('Space Detected');
          return false;
        }
      });
    });

  </script>

  <!-- jQuery -->
  <script src="../vendors/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <!-- FastClick -->
  <script src="../vendors/fastclick/lib/fastclick.js"></script>
  <!-- NProgress -->
  <script src="../vendors/nprogress/nprogress.js"></script>
  <!-- bootstrap-progressbar -->
  <script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
  <!-- iCheck -->
  <script src="../vendors/iCheck/icheck.min.js"></script>
  <!-- bootstrap-daterangepicker -->
  <script src="../vendors/moment/min/moment.min.js"></script>
  <script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
  <!-- bootstrap-wysiwyg -->
  <script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
  <script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
  <script src="../vendors/google-code-prettify/src/prettify.js"></script>
  <!-- jQuery Tags Input -->
  <script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
  <!-- Switchery -->
  <script src="../vendors/switchery/dist/switchery.min.js"></script>
  <!-- Select2 -->
  <script src="../vendors/select2/dist/js/select2.full.min.js"></script>
  <!-- Parsley -->
  <script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
  <!-- Autosize -->
  <script src="../vendors/autosize/dist/autosize.min.js"></script>
  <!-- jQuery autocomplete -->
  <script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
  <!-- starrr -->
  <script src="../vendors/starrr/dist/starrr.js"></script>
  <!-- Custom Theme Scripts -->
  <script src="../build/js/custom.min.js"></script>
</body>

</html>