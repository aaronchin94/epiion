<?php 
include_once 'header.php';
include_once 'includes/session.php';
?>
</head>
<!-- Confirm Buttion-->
<script language="JavaScript" type="text/javascript">
function checkChangePassword(){
    return confirm('Katalaluan akan ditetapkan semula. Adakah ingin teruskan ?');
}
</script>
</head>
<!-- page content -->
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Pengguna</h3>
              </div>
            </div>

            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Tetapan Semula Kata laluan</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  
                    <form role="form" action="includes/change_password.php" 	 method="POST" class=" pure-form form-horizontal form-label-left ">
                    <input type="text" hidden name="id" value="<?=$row["id"] ?>">
                   
                      <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="ic">No Kad Pengenalan <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="text" name="ic" id="ic" required="required" class="form-control" disabled="disabled" value="<?php echo $row['ic']?>" placeholder="No Kad Pengenalan (tanpa -)" maxlength="12"
                          >
                        </div>
                      </div>
                    
                    <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align">Kata laluan Asal <span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-6 ">
                          <input type="password" name="op" id="op" required class="form-control">
                        </div>
                      </div>
                    
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Kata laluan baru <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 ">
                              <input type="password" name="np" id="np" required class="form-control">
                            </div>
                          </div>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Ulang Kata laluan baru <span class="required">*</span>
                            </label>
                            <div class="col-md-4 col-sm-6 ">
                              <div><input type="password" name="c_np" id="c_np" required class="form-control">
                            </div>
                          </div>
                          </div>
                    <?php if (isset($_GET['error'])) { ?>
     		<p class="error" style="text-align:center" ><b><?php echo $_GET['error']; ?></b></p>
     	<?php } ?>

     	<?php if (isset($_GET['success'])) { ?>
            <p class="success" style="text-align:center"><b><?php echo $_GET['success']; ?></b></p>
        <?php } ?>
			<div class="item form-group">
                         <label class="col-form-label col-md-3 col-sm-3 label-align">
                            </label>
                          <div class="col-md-4 col-sm-3 ">
                            <b>Syarat bagi pemilihan Kata Laluan Pintar ialah:-</b>
				<br>Panjang kata laluan sekurang-kurangnya lapan (8) aksara;
				<!-- <br>Sekurang-kurangnya satu (1) huruf besar;
				<br>Sekurang-kurangnya satu (1) huruf kecil;
				<br>Sekurang-kurangnya satu (1) nombor; dan
				<br>Sekurang-kurangnya satu (1) simbol (! @#$^*&); -->
                          </div>
                        </div>


                         <div class="item form-group">
                         <label class="col-form-label col-md-3 col-sm-3 label-align">
                            </label>
                          <div class="col-md-4 col-sm-3 ">
                            <button type="submit" onclick="return checkChangePassword()" class="btn btn-danger">Tetap Semula</button>
                          </div>
                        </div>
                  </form>

     
              
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
        
<?php 
include_once 'footer.php';
?>

<script>
  var password = document.getElementById("np");
  var confirm_password = document.getElementById("c_np");
  var op = document.getElementById("op");
  var ic = document.getElementById("ic");

  // Function to validate password and confirm password fields
  function validatePassword() {
    var np = password.value;
    var c_np = confirm_password.value;

    if (np !== c_np) {
      confirm_password.setCustomValidity("Kata laluan baharu tidak sepadan");
    } else if (np.length < 8) {
      // np.length < 8 || !/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/i.test(np)
      // Kata laluan baharu mesti mengandungi sekurang-kurangnya 8 aksara dan menggabungkan huruf besar, huruf kecil, nombor dan simbol.
      confirm_password.setCustomValidity("Kata laluan baharu mesti mengandungi sekurang-kurangnya 8 aksara.");
    } else if (np.includes(ic.value)) {
      confirm_password.setCustomValidity("Kata laluan baharu tidak boleh mengandungi nombor kad pengenalan.");
    } else {
      confirm_password.setCustomValidity('');
    }
  }

  // Call the validatePassword function when the password and confirm password fields are changed
  password.onchange = validatePassword;
  confirm_password.onkeyup = validatePassword;
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