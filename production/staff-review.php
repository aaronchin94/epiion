<?php
include_once 'header.php';
include_once 'includes/session.php';
include_once 'includes/adminonly.php';
include_once 'includes/secure_function.php';

?>

<?php
require_once 'includes/db.php';
$query_drop = "
                            SELECT unit FROM lokasi 
                            ORDER BY unit ASC
                        ";
$result_drop = $connection->query($query_drop);
?>
      <!-- page content -->
      <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Kakitangan</h3>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Paparan  Maklumat Kakitangan</h2>
                    <div margin class="col-md-1 col-sm-12  float-right">
									<a href='staff_view.php' class='btn btn-warning'>Kembali</a>
								</div> 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <?php
                        if(isset($_GET['id']))
                        {
                            $user_id = mysqli_real_escape_string($connection, $_GET['id']);
                            $query = "SELECT * FROM staff WHERE id = ?";
                            $stmt = $connection->prepare($query);
                            $stmt->bind_param("i", $user_id);
                            $stmt->execute();
                            $result = $stmt->get_result();
                            // $query_run = mysqli_query($connection, $query);

                            if($result->num_rows > 0)
                            {
                                $user = $result->fetch_assoc();
                                ?>

                            

                    <form role="form" action="./staff-edit.php?id=<?php echo sanitizeText($user['id']) ?>" method="post" id="registration-form" autocomplete="off">

                    <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name" >Nama Penuh <span class="required">*</span>
                        </label>
                        
                        <div class="col-md-4 col-sm-6 ">
                        <input type="text" name="name" id="Name" class="form-control" disabled="disabled" value="<?php echo sanitizeText($user['name'])?>" placeholder="Username digunakan untuk log masuk">
                        </div>
                        </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="ic">No Kad Pengenalan <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="ic" id="ic" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($user['ic'])?>" placeholder="No Kad Pengenalan (tanpa -)" maxlength="12"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="jawatan">Jawatan <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="jawatan" id="jawatan" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($user['jawatan'])?>" placeholder="Jawatan"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="gred">Gred <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="gred" id="gred" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($user['gred'])?>" placeholder="Gred"
                          >
                        </div>
                      </div>


                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="lokasi">Daerah <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="lokasi" id="lokasi" required="required" class="form-control " disabled="disabled" value="<?php echo sanitizeText($user['lokasi'])?>" placeholder="Lokasi Pejabat"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="unit">Bahagian/Seksyen/Unit<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-3 ">
                        <select id="select_box" name="unit" class="form-control" disabled="disabled" required="">
                        <option id="myInput" onkeyup="filterFunction()" onclick="myFunction()">-- Sila Pilih --</option>
                        <?php
foreach ($result_drop as $row) {
   if($user['unit']==$row['unit']){
    echo '<option selected="selected" value="' . sanitizeText($row["unit"]) .'">' . sanitizeText($row["unit"]) . '</option>';
   }
   else{
    echo '<option value="' . sanitizeText($row["unit"]) .'">' . sanitizeText($row["unit"]) . '</option>';
   }
    
}
?>  
                    </select>
                    </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="email" name="email" id="email" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeEmail($user['email'])?>" placeholder="Email Rasmi"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">No. Telefon <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="tel" required="required" class="form-control" disabled="disabled" value="<?php echo sanitizeText($user['tel'])?>" placeholder="0123456789"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                        <div class="col-md-4 col-sm-3 "> 
                        <button type="submit" name="submit" class="btn btn-success" action="">Kemaskini Maklumat</button>
                        
                      </form>
                        </div>
                        </div>
                      

                      <?php
                            }
                            else
                            {
                                echo "<h4>No Such Id Found</h4>";
                                
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