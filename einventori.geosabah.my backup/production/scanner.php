<?php 
include_once 'header.php';
include_once 'includes/session.php'

?>

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>SCANNER TEST</h3>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>FOR TESTING PURPOSE ONLY</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <img src="images/testcode.gif" alt="K1017" class="center">
                  <br>
                  <br>
                  <br>
                  <span>paparan terbaik di browser telefon </span>
                  <br>
                  <br>
                  <br>

                    <div class="form-group row">
                  <div id="reader" style="width:30px display: flex"></div>
                        </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- /page content -->
    <!-- jQuery -->
    <script src="../vendors/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap -->
   <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- FastClick -->
    <script src="../vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="../vendors/nprogress/nprogress.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="../build/js/custom.min.js"></script>
    <!--scanner-->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script type="text/javascript">
function onScanSuccess(decodedText, decodedResult) {
  // Handle the scanned code as you like, for example:
    if (confirm(`Asset ID = ${decodedText}`, decodedResult) == true) {
      window.open('./asset_review_Komputer.php?varname='+decodedText, decodedResult, '_blank');
} else {
    userPreference = "Save Cancelled!";
}
  
  
    //return confirm(`Asset ID = ${decodedText}`, decodedResult);
  //window.location.href='/index.php';
}
  //confirm(`Asset ID = ${decodedText}`, decodedResult);
    //window.location.href='/asset_review_Komputer.php?varname= '.${decodedText}.', decodedResult'




const formatsToSupport = [
  Html5QrcodeSupportedFormats.QR_CODE,
  Html5QrcodeSupportedFormats.CODE_39,
  Html5QrcodeSupportedFormats.UPC_E,
  Html5QrcodeSupportedFormats.UPC_EAN_EXTENSION,
];
const html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  {
    fps: 10,
    qrbox: { width: 250, height: 250 },
    formatsToSupport: formatsToSupport
  },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess);

html5QrCodeScanner.stop().then((ignore) => {
  // QR Code scanning is stopped.
}).catch((err) => {
  // Stop failed, handle it.
});
</script>
    

<?php 
include_once 'footer.php';

?>

</body>
</html>