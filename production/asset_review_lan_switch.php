<?php
include_once 'header.php';
include_once 'includes/session.php';
?>

<?php
require_once 'includes/db.php';
$query_drop = "
                            SELECT unit FROM lokasi 
                            ORDER BY unit ASC
                        ";
$result_drop = $connection->query($query_drop);
?>
    <?php $var_value = $_GET['varname'];?>
              </div>
    <?php 
    
    $connection = mysqli_connect("localhost", "sabah_wuser", "70be8036125732e724d96024de2339d15a3194f3d2f6c462","inventory");
    $query_drop = "SELECT * FROM lan_swithch where lan_swithch.ls_id = '$var_value' ";
    $result_drop = $connection->query($query_drop);
      if ($result === false) {
          die(mysqli_error($connection));
      }
      $i = 0;
      while ($row = mysqli_fetch_assoc($result_drop)) {

          $i = $i + 1;
          $ls_id 		= $row["ls_id"];
          $penggunaan 		= $row["penggunaan"];
          $nama_pengguna 	= $row["nama_pengguna"];
          $asset_id 		= $row["asset_id"];
          $model 		    = $row["model"];
          $serial 		    = $row["serial"];
          $kewpa 		    = $row["kewpa"];
          $status 		    = $row["status"];
          $bil_port 		= $row["bil_port"];
	  

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
                    <h2>Paparan  Maklumat LAN</h2>
                    <div margin class="col-md-1 col-sm-12  float-right">
									<a href='asset_view.php' class='btn btn-warning'>Kembali</a>
								</div> 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                                
                                
                              


                    <form role="form" action="./asset_lan_edit.php?varname=$ln_id" method="post" id="registration-form" autocomplete="off">

                    <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name" >Penggunaan<span class="required">*</span>
                        </label>
                        
                        <div class="col-md-4 col-sm-6 ">
                        <input type="text" name="name" id="Name" class="form-control" disabled="disabled" value="<?php echo $penggunaan?>" placeholder="Username digunakan untuk log masuk">
                        </div>
                        </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Nama Pengguna<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="username" id="username" required="required" class="form-control" value="<?php echo $nama_pengguna?>" placeholder="Username digunakan untuk log masuk" disabled="disabled">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="ic">Asset ID<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="ic" id="ic" required="required" class="form-control" disabled="disabled" value="<?php echo $asset_id?>" placeholder="No Kad Pengenalan (tanpa -)" maxlength="12"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="model">Model<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="model" id="model" required="required" class="form-control" disabled="disabled" value="<?php echo $model?>" placeholder="0123456789"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="serial">Serial No.<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="serial" id="serial" required="required" class="form-control" disabled="disabled" value="<?php echo $serial?>" placeholder="0123456789"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="kewpa">KewPA No.<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="kewpa" required="kewpa" class="form-control" disabled="disabled" value="<?php echo $kewpa?>" placeholder="0123456789"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="status">Status <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="status" id="status" required="required" class="form-control" disabled="disabled" value="<?php echo $status?>" placeholder="0123456789"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="bil_port">Bilangan Port<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="bil_port" id="bil_port" required="required" class="form-control" disabled="disabled" value="<?php echo $bil_port?>" placeholder="0123456789"
                          >
                        </div>
                      </div>

                             
                      
                      </form>
                      <form role="form" action="includes/resetpassword.php" method="post" class=" pure-form form-horizontal form-label-left ">
                    <input type="text" hidden name="id"  value="<?php echo $_GET["id"] ?>">
                    <input type="text" hidden name="ic"  value="<?php echo $user['ic']?>">
                    

                        <?php if (isset($_GET['error'])) { ?>
     		<p class="error" style="text-align:center" ><?php echo $_GET['error']; ?></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success" style="text-align:center"><?php echo $_GET['success']; ?></p>
        <?php } ?>
                        </form>
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