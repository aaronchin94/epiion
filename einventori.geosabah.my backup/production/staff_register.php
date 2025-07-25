<?php
include_once 'header.php';
include_once 'includes/session.php';
include_once 'includes/adminonly.php';
include 'includes/initialization.php';
?>

<script>
  function validate() {
      var valid = true;

      const excel = document.getElementById('excel-file').value;
      if (!excel) {
        alert("Tiada file excel yang telah dimuat naikkan, sila muat naik satu excel file");
        valid = false;
      }

      return valid;
    }
  </script>

<?php
require_once 'includes/db.php';
$query_drop = "
SELECT unit 
FROM lokasi 
WHERE unit = 
  IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', unit)
ORDER BY unit ASC;

                        ";
$result_drop = $connection->query($query_drop);

$query_drop1 = "
                            SELECT daerah FROM daerah 
                            ORDER BY daerah ASC
                        ";
$result_drop1 = $connection->query($query_drop1);

$email_check = getemail($connection);
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
                    <h2>Daftar Kakitangan Baharu</h2>
                    <div margin class="col-md-2 col-sm-12  float-right">
                    <button id="add-staff-btn" class="btn btn-warning btn-sm">Muat Naik Excel</button>
								</div> 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <form role="form" action="includes/registerstaff.php" method="post" id="registration-form" autocomplete="off">

                    <div class="form-group row">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Nama Penuh <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                        <input type="text" name="name" id="Name" class="form-control" placeholder="Nama Penuh Kakitangan">
                        </div>
                        </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="ic">No Kad Pengenalan <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="ic" id="ic" required="required" class="form-control" placeholder="No Kad Pengenalan (tanpa -)" maxlength="12"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="jawatan">Jawatan <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="jawatan" id="jawatan" required="required" class="form-control" placeholder="Jawatan"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="gred">Gred <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="gred" id="gred" required="required" class="form-control" placeholder="Gred"
                          >
                        </div>
                      </div>


                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="unit">Daerah<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-3 ">
                        <select id="select_box" name="lokasi" class="form-control" required="">
                        <option value="" id="myInput" onkeyup="filterFunction()" onclick="myFunction()">-- Sila Pilih --</option>
                        <?php
foreach ($result_drop1 as $row) {
    echo '<option value="' . $row["daerah"] . '">' . $row["daerah"] . '</option>';
}
?>  
                    </select>
                    </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="unit">Bahagian/Seksyen/Unit<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-3 ">
                        <select id="select_box" name="unit" class="form-control" required="">
                        <option value="" id="myInput" onkeyup="filterFunction()" onclick="myFunction()">-- Sila Pilih --</option>
                        <?php
foreach ($result_drop as $row) {
    echo '<option value="' . $row["unit"] . '">' . $row["unit"] . '</option>';
}
?>  
                    </select>
                    </div>
                      </div>


                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="email">Emel <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="email" name="email" id="email" required="required" class="form-control" placeholder="Emel Rasmi"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="tel">No. Telefon <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="tel" id="tel" required="required" class="form-control" placeholder="0123456789"
                          >
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                        <div class="col-md-4 col-sm-3 ">
                          <button class="btn btn-primary" type="reset">Set Semula</button>
                          <button type="submit" name="submit" class="btn btn-success" action="">Simpan</button>
                        </div>
                      </div>
                      </form>
                  </div>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->

      <!--upload file modal-->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <!-- <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script> -->

      <div id="add-staff-modal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Daftar Kakitangan Baharu</h6>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="modal-body">
      <p>Sila muat turun template Excel yang disediakan untuk memudahkan proses memuat naik senarai kakitangan.</p>
        <a href="../download/Template Senarai Kakitangan.xlsx" class="btn btn-info btn-sm">Muat turun Template Excel</a>
        <br>
        <form action="add_staff.php" method="post" enctype="multipart/form-data" onsubmit="return validate();">
         <div class="form-group">
         <label for="excel-file">Muat naik senarai kakitangan (.xlsx):</label>
         <input type="file" name="excel-file" id="excel-file">
        </div>
          <button type="submit" class="btn btn-primary btn-sm">Muat naik</button>
        </form>
      </div>
    </div>
  </div>
</div>

<style>
  /* Center the modal */
  .modal {
    text-align: center;
    padding: 0!important;
  }
  .modal-title {
  text-align: left;
}
  .modal:before {
    content: '';
    display: inline-block;
    height: 100%;
    vertical-align: middle;
    margin-right: -4px; /* Adjusts for spacing */
  }
  .modal-dialog {
    display: inline-block;
    text-align: left;
    vertical-align: middle;
  }
</style>


<script>
  $(document).ready(function(){
    // Show the modal when the button is clicked
    $("#add-staff-btn").click(function(){
      $("#add-staff-modal").modal();
    });

    // Clear the file input when the modal is closed
    $('#add-staff-modal').on('hidden.bs.modal', function () {
      $(this).find('form')[0].reset();
    });
  });
</script>



<!--enduploadmodal-->




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

    $('#registration-form').submit(function (e) {
      var email_arr = <?php echo $email_check ?>;
      var email = $('#email').val();

      if (email_arr.indexOf(email) !== -1) {
        e.preventDefault();
        alert('Emel telah didaftar');
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
  <?php
  include_once 'footer.php'
  ?>
</body>

</html>