<?php
include_once 'header.php';
include_once 'includes/adminonly.php'
?>

<?php
require_once 'includes/db.php';
$query_drop = "
                            SELECT unit FROM lokasi 
                            ORDER BY unit ASC
                        ";
$result_drop = $connection->query($query_drop);

$query_drop1 = "
                              SELECT daerah FROM daerah 
                              ORDER BY daerah ASC
                          ";
  $result_drop1 = $connection->query($query_drop1);

?>

</head>
<!-- Confirm Buttion-->
<script language="JavaScript" type="text/javascript">
function checkUpdate(){
    return confirm('Maklumat Pendaftar akan dikemaskini. Adakah ingin teruskan ?');
}
</script>
</head>

      <!-- page content -->
      <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Pendaftar</h3>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Kemaskini Maklumat Pendaftar</h2> 
                    <div margin class="col-md-1 col-sm-12  float-right">
									<a href='user_view.php' class='btn btn-warning'>Kembali</a>
								</div> 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <?php
                        if(isset($_GET['id']))
                        {
                            $user_id = mysqli_real_escape_string($connection, $_GET['id']);
                            $query = "SELECT * FROM staff WHERE id='$user_id' ";
                            $query_run = mysqli_query($connection, $query);

                            if(mysqli_num_rows($query_run) > 0)
                            {
                                $user = mysqli_fetch_array($query_run);
                                ?>


                    <form role="form" action="includes/updateuser.php" method="post" id="registration-form" autocomplete="off">
                      <input type="text" hidden name="id" value="<?=$user["id"] ?>">

                    <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name" >Nama Penuh <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                        <input type="text" name="name" id="Name" class="form-control" value="<?php echo $user['name']?>" placeholder="Username digunakan untuk log masuk">
                        </div>
                        </div>


                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="ic">No Kad Pengenalan <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="ic" id="ic" required="required" class="form-control" value="<?php echo $user['ic']?>" placeholder="No Kad Pengenalan (tanpa -)" maxlength="12"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="jawatan">Jawatan <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="jawatan" id="jawatan" required="required" class="form-control" value="<?php echo $user['jawatan']?>" placeholder="Jawatan"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="lokasi">Daerah <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                        <select id="select_box" name="lokasi" class="form-control" required="">
                          <option value="" id="myInput" onkeyup="filterFunction()" onclick="myFunction()">-- Sila Pilih --</option>
                          <?php
  foreach ($result_drop1 as $row) {
    if($user['lokasi']==$row['daerah']){
      echo '<option selected="selected" value="' . $row["daerah"] .'">' . $row["daerah"] . '</option>';
    }
    else{
      echo '<option value="' . $row["daerah"] .'">' . $row["daerah"] . '</option>';
    }
      
  }
  ?>  
                      </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="unit">Bahagian/Seksyen/Unit <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-3 ">
                        <select id="select_box" name="unit" class="form-control" required="">
                        <option id="myInput" onkeyup="filterFunction()" onclick="myFunction()">-- Sila Pilih --</option>
                        <?php
foreach ($result_drop as $row) {
   if($user['unit']==$row['unit']){
    echo '<option selected="selected" value="' . $row["unit"] .'">' . $row["unit"] . '</option>';
   }
   else{
    echo '<option value="' . $row["unit"] .'">' . $row["unit"] . '</option>';
   }
    
}
?>  
                    </select>
                    </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Emel <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="email" name="email" id="email" required="required" class="form-control" value="<?php echo $user['email']?>" placeholder="Email Rasmi"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">No. Telefon <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="tel" required="required" class="form-control" value="<?php echo $user['tel']?>" placeholder="0123456789"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="role">Peranan <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-3 ">
                          <select id="role" name="role" class="form-control" required="">
                            <option value="" <?php if($user['role']=="") echo "selected=\"selected\""; ?>>-- Sila Pilih --</option>
                            <option value="Admin" <?php if($user['role']=="Admin") echo "selected=\"selected\""; ?>>Admin</option>
                            <option value="Pendaftar" <?php if($user['role']=="Pendaftar") echo "selected=\"selected\""; ?>>Pendaftar</option>
                            <option value="Juruteknik" <?php if($user['role']=="Juruteknik") echo "selected=\"selected\""; ?>>Juruteknik</option>
                          </select>
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                        <div class="col-md-4 col-sm-3 ">
                        
                          <button class="btn btn-primary" type="reset">Set Semula</button>
                          <button type="submit" name="submit" class="btn btn-success" onclick="return checkUpdate()" action="">Kemaskini</button>
                        </div>
                      </div>
                      </form>
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