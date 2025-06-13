<?php
include_once 'header.php';
include_once 'includes/session.php';
require_once 'includes/db.php';
include 'includes/initialization.php';

$asset = getasset('komputer', 'k_id', $id, $connection, $row);
?>

<head>
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
  <script>
    function checkDelete() {
      if (confirm('Aset akan dipadam. Adakah ingin teruskan ?')) {
        window.location.href = "asset_komputer_delete.php?id=<?php echo $_GET['id'] ?>"
      }
    }
  </script>
</head>
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
            <h2>Paparan Maklumat Desktop</h2>
            <div margin class="col-md-1 col-sm-12  float-right">
              <a href='asset_view.php' class='btn btn-warning'>Kembali</a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form role="form" action="asset_komputer_edit.php?id=<?php echo $id ?>" method="post" id="registration-form"
              autocomplete="off">
              <input type="text" hidden name="k_id" value="<?= $asset['k_id'] ?>">

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Penggunaan
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <select id="usetype" name="usetype" class="form-control" required onchange="checkusetype()" disabled>
                    <?php
                    select_options($usetype_options, $asset['penggunaan']);
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Nama Pengguna
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <select id="staff_id" name="staff_id" class="form-control" onchange="getvalue()" disabled>
                    <?php
                    stafflist($asset['staff_id'], $connection, $row);
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="ic">Aset ID
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <input type="text" name="asset_id" id="asset_id" required="required" class="form-control"
                    value="<?php echo $asset['asset_id'] ?>" disabled>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="model">Model
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <input type="text" name="model" id="model" required="required" class="form-control"
                    value="<?php echo $asset['model'] ?>" disabled>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="tahun">Tahun Diperoleh
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <input type="text" name="tahun" id="tahun" required="required" class="form-control"
                    value="<?php echo $asset['tahun'] ?>" disabled>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="serial">No. Siri
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <input type="text" name="serial" id="serial" required="required" class="form-control"
                    value="<?php echo $asset['serial'] ?>" disabled>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="kewpa">No. KewPA
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <input type="text" name="kewpa" id="kewpa" required="required" class="form-control"
                    value="<?php echo $asset['kewpa'] ?>" disabled>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Status
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <select id="status" name="status" class="form-control" required disabled>
                    <?php
                    select_options($status_options, $asset['status']);
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Jenis Perolehan
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <select id="jen_perolehan" name="jen_perolehan" class="form-control" required disabled>
                    <?php
                    select_options($jen_options, $asset['jen_perolehan']);
                    ?>
                  </select>
                </div>
              </div>

              <div class='form-group row'>
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="sumber">Sumber Penerimaan</label>
                <div class="col-md-4 col-sm-6 ">
                  <input id="sumber" name="sumber" type="text" class="form-control"
                    value="<?php echo $asset['sumber'] ?>" disabled>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="jawatan">Sistem Operasi
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <select id="os" name="os" class="form-control" required disabled>
                    <?php
                    select_options($os_options, $asset['os']);
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="jawatan">Aplikasi Kerja
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <input type="text" name="app_kerja" id="app_kerja" required="required" class="form-control"
                    value="<?php echo $asset['app_kerja'] ?>" disabled>
                </div>
              </div>


              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="antiv">Anti Virus
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <input type="text" name="anti_v" id="anti_v" required="required" class="form-control"
                    value="<?php echo $asset['anti_v'] ?>" disabled>
                </div>
              </div>



              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="processor">Processor
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <input type="text" name="processor" id="processor" required="required" class="form-control "
                    value="<?php echo $asset['processor'] ?>" disabled>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Ram (GB)
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <select id="ram_gb" name="ram_gb" class="form-control" required disabled>
                    <?php
                    select_options($ram_options, $asset['ram_gb']);
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="kapasiti">Kapasiti Harddisk (GB)
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <input type="text" name="kapasiti_hd_gb" id="kapasiti_hd_gb" required="required" class="form-control "
                    value="<?php echo $asset['kapasiti_hd_gb'] ?>" disabled>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Kad Grafik
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <select id="kad_grafik" name="kad_grafik" class="form-control" required disabled>
                    <?php
                    select_options($yesno_options, $asset['kad_grafik']);
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Network
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <select id="network_lan" name="network_lan" class="form-control" required disabled>
                    <?php
                    select_options($lan_options, $asset['network_lan']);
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Modem
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <select id="modem" name="modem" class="form-control" required disabled>
                    <?php
                    select_options($yesno_options, $asset['modem']);
                    ?>
                  </select>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="ipv4">IP Address
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <input type="text" name="ipv4" id="ipv4" required="required" class="form-control"
                    value="<?php echo $asset['ip_address'] ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="subnet">Subnet Mask
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <input type="text" name="subnet" id="subnet" required="required" class="form-control"
                    value="<?php echo $asset['subnet_mask'] ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="defaultgateway">Default Gateway
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <input type="text" name="defaultgateway" id="defaultgateway" required="required" class="form-control"
                    value="<?php echo $asset['def_gateway'] ?>" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="dnsserver">DNS Server
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <input type="text" name="dnsserver" id="dnsserver" required="required" class="form-control"
                    value="<?php echo $asset['dns_server'] ?>" disabled>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                <div class="col-md-4 col-sm-3 ">
                  <button type="button" name="delete" class="btn btn-danger" onclick="return checkDelete();"
                    href="asset_komputer_delete.php?id=<?php echo $id ?>">Padam</button>
                  <button type="submit" name="edit" class="btn btn-success">Kemaskini</button>
                  <button type="button" id="GenerateQR" name="GenerateQR" class="btn btn-warning">
                    <i class="fa fa-qrcode"></i> &nbsp;QR Code
                  </button>
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

<!-- Bootstrap Modal -->
<div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qrModalLabel">QR Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-center align-items-center">
        <!-- Here you can display the generated QR code -->
        <!-- For now, let's just put some text -->
        <div id="qrCodeContainer">
          <img id="qrCodeImage" src="" alt="QR Code">
        </div>
      </div>
      <div class="modal-footer">
        <button id="downloadBtn" class="btn btn-primary">Download QR Code</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  // check for form input
  // const form = document.querySelector('#registration-form');
  // form.addEventListener('submit', e => {
  //   e.preventDefault();
  //   const formData = new FormData(form);
  //   console.log(Object.fromEntries(formData.entries()));
  // });
</script>
<!-- <script>
  generateBtn.addEventListener("click", () => {
    let idValue = yourDynamicPHPFunctionToGetId(); // You need to replace this with your PHP code to get the dynamic id
    let qrValue = `http://localhost/einventori.geosabah.my/production/asset_review_komputer.php?id=${idValue}`;
    if (!idValue || preValue === qrValue) return;
    preValue = qrValue;
    generateBtn.innerText = "Generating QR Code...";
    qrImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`;
    qrImg.addEventListener("load", () => {
      wrapper.classList.add("active");
      generateBtn.innerText = "Generate QR Code";
    });
  });

</script> -->
<script>
  $(document).ready(function () {
    $('#GenerateQR').click(function () {
      let idValue = "<?php echo $asset['asset_id']; ?>"; // Get the value of $id from PHP
      let qrValue = `http://localhost/einventori.geosabah.my/production/asset_QR_view.php?asset_id=${idValue}`;
      $('#qrModal').modal('show');
      // Set the source of the QR code image
      $('#qrCodeImage').attr('src', `https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=${qrValue}`);
    });

    // Download QR code when the download button is clicked
    $('#downloadBtn').click(function () {
      // Get the source of the QR code image
      var qrCodeSrc = $('#qrCodeImage').attr('src');
      // Create a temporary anchor element
      var link = document.createElement('a');
      // Convert the image to a data URL
      var canvas = document.createElement('canvas');
      var context = canvas.getContext('2d');
      var img = new Image();
      img.crossOrigin = 'anonymous';
      img.onload = function () {
        canvas.width = img.width;
        canvas.height = img.height;
        context.drawImage(img, 0, 0);
        link.href = canvas.toDataURL('image/png');
        // Set the download attribute to force download
        link.download = 'qr_code.png';
        // Append the anchor element to the document body
        document.body.appendChild(link);
        // Trigger a click event on the anchor element
        link.click();
        // Remove the anchor element from the document body
        document.body.removeChild(link);
      };
      img.src = qrCodeSrc;
    });
  });

</script>
</body>

</html>