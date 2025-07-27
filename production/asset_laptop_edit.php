<?php
include_once 'header.php';
include_once 'includes/session.php';
require_once 'includes/db.php';
include 'includes/initialization.php';
include_once 'includes/secure_function.php';

$asset = getasset('laptop', 'la_id', $id, $connection, $row);
$kewpa_check = getkewpa('laptop', $connection);
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
  <!-- jquery.inputmask -->
  <script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
  <script>
    const def_kewpa = '<?php echo sanitizeText($asset['kewpa']) ?>';

    function validate() {
      var valid = true;

      const kewpa = document.getElementById('kewpa').value;
      var kewpa_arr = <?php echo sanitizeText($kewpa_check) ?>;
      if (kewpa != def_kewpa && kewpa != "" && kewpa_arr.indexOf(kewpa) !== -1) {
        alert("No. KewPA sudah didaftar");
        valid = false;
      }

      return valid;
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
            <h2>Kemaskini Maklumat Laptop</h2>
            <div margin class="col-md-1 col-sm-12  float-right">
              <a href='asset_view.php' class='btn btn-warning'>Kembali</a>
            </div>
            <div class="clearfix"></div>
          </div>
          <label><?php echo $required ?></label>
          <div class="x_content">
            <form role="form" action="includes/update_laptop.php" method="post" id="registration-form"
              autocomplete="off" onsubmit="return validate();">
              <input type="text" hidden name="la_id" value="<?= intval($asset['la_id']) ?>">

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Penggunaan <span
                    class="required">*</span> <?php echo tooltip('usetype'); ?>
                </label>
                <div class="col-md-4 col-sm-6 ">
                  <select id="usetype" name="usetype" class="form-control" required onchange="checkusetype()">
                    <?php
                    select_options($usetype_options, $asset['penggunaan']);
                    ?>
                  </select>
                </div>
              </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Nama Pengguna <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <select id="staff_id" name="staff_id" class="form-control" required="" onchange="getvalue()">
                <?php
                stafflist($asset['staff_id'], $connection, $row);
                ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="ic">Aset ID <span class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="asset_id" id="asset_id" required="required" class="form-control"
                value="<?php echo intval($asset['asset_id']) ?>" readonly>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="model">Model <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="model" id="model" required="required" class="form-control"
                value="<?php echo sanitizeText($asset['model']) ?>" placeholder="Model">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="tahun">Tahun Diperoleh <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="tahun" id="tahun" required="required" class="form-control"
                value="<?php echo intval($asset['tahun']) ?>" placeholder="Tahun Diperoleh">
            </div>
          </div>


          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="serial">No. Siri</label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="serial" id="serial" class="form-control" value="<?php echo sanitizeText($asset['serial']) ?>"
                placeholder="No. Siri">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="kewpa">No. KewPA</label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="kewpa" id="kewpa" class="form-control" value="<?php echo sanitizeText($asset['kewpa']) ?>"
                placeholder="No. KewPA">
            </div>
          </div>



          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Status <span
                class="required">*</span> <?php tooltip('status'); ?>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <select id="status" name="status" class="form-control" required>
                <?php
                select_options($status_options, $asset['status']);
                ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Jenis Perolehan <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <select id="jen_perolehan" name="jen_perolehan" class="form-control" required>
                <?php
                select_options($jen_options, $asset['jen_perolehan']);
                ?>
              </select>
            </div>
          </div>

          <div class='form-group row'>
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="sumber">Sumber Penerimaan <span
                class="required">*</span> <?php echo tooltip('sumber'); ?></label>
            <div class="col-md-4 col-sm-6 ">
              <input id="sumber" name="sumber" type="text" class="form-control" value="<?php echo sanitizeText($asset['sumber']) ?>"
                placeholder="Sumber Penerimaan" required>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="jawatan">Sistem Operasi <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <select id="os" name="os" class="form-control" required>
                <?php
                select_options($os_options, $asset['os']);
                ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="jawatan">Aplikasi Kerja <span
                class="required">*</span> <?php echo tooltip('app_kerja'); ?>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="app_kerja" id="app_kerja" required="required" class="form-control"
                value="<?php echo sanitizeText($asset['app_kerja']) ?>" placeholder="Aplikasi Kerja">
            </div>
          </div>


          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="antiv">Anti Virus <span
                class="required">*</span> <?php echo tooltip('anti_v'); ?>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="anti_v" id="anti_v" required="required" class="form-control"
                value="<?php echo sanitizeText($asset['anti_v']) ?>" placeholder="Anti Virus">
            </div>
          </div>



          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="processor">Processor <span
                class="required">*</span> <?php tooltip('processor'); ?>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="processor" id="processor" required="required" class="form-control "
                value="<?php echo sanitizeText($asset['processor']) ?>" placeholder="Processor">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Ram (GB) <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <select id="ram_gb" name="ram_gb" class="form-control" required>
                <?php
                select_options($ram_options, $asset['ram_gb']);
                ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="kapasiti">Kapasiti Harddisk (GB) <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="kapasiti_hd_gb" id="kapasiti_hd_gb" required="required" class="form-control "
                value="<?php echo sanitizeText($asset['kapasiti_hd_gb']) ?>" placeholder="Kapasiti Harddisk (GB)">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Kad Grafik <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <select id="kad_grafik" name="kad_grafik" class="form-control" required>
                <?php
                select_options($yesno_options, $asset['kad_grafik']);
                ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Network <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <select id="network_lan" name="network_lan" class="form-control" required>
                <?php
                select_options($lan_options, $asset['network_lan']);
                ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Modem <span class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <select id="modem" name="modem" class="form-control" required>
                <?php
                select_options($yesno_options, $asset['modem']);
                ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="ipv4">IP Address <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="ipv4" id="ipv4" required="required" class="form-control"
                value="<?php echo sanitizeText($asset['ip_address']) ?>" placeholder="IP Address">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="subnet">Subnet Mask <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="subnet" id="subnet" required="required" class="form-control"
                value="<?php echo sanitizeText($asset['subnet_mask']) ?>" placeholder="Subnet Mask">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="defaultgateway">Default Gateway <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="defaultgateway" id="defaultgateway" required="required" class="form-control"
                value="<?php echo sanitizeText($asset['def_gateway']) ?>" placeholder="Default Gateway">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="dnsserver">DNS Server <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="dnsserver" id="dnsserver" required="required" class="form-control"
                value="<?php echo sanitizeText($asset['dns_server']) ?>" placeholder="DNS Server">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
            <div class="col-md-4 col-sm-3 ">

              <button class="btn btn-primary" type="reset">Set Semula</button>
              <button type="submit" name="submit" class="btn btn-success" action="">Kemaskini</button>
            </div>
          </div>
          </form>
          <?php
          ?>
        </div>

      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- /page content -->

<script>
  // check for form input
  // const form = document.querySelector('#registration-form');
  // form.addEventListener('submit', e => {
  //   e.preventDefault();
  //   const formData = new FormData(form);
  //   console.log(Object.fromEntries(formData.entries()));
  // });

  // harddisk gb number only
  $('#kapasiti_hd_gb').keypress(function (e) {
    var txt = String.fromCharCode(e.which);
    if (!txt.match(/[0-9]/)) {
      return false;
    }
  });

  //input mask bundle ip address
  var ipv4_address = $('#ipv4');
  ipv4_address.inputmask({
    alias: "ip",
    greedy: false //The initial mask shown will be "" instead of "-____".
  });

  //input mask bundle subnet
  var subnet_mask = $('#subnet');
  subnet_mask.inputmask({
    alias: "ip",
    greedy: false //The initial mask shown will be "" instead of "-____".
  });

  //input mask bundle default gateway
  var default_gateway = $('#defaultgateway');
  default_gateway.inputmask({
    alias: "ip",
    greedy: false //The initial mask shown will be "" instead of "-____".
  });

  //input mask bundle dns server
  var dns_server = $('#dnsserver');
  dns_server.inputmask({
    alias: "ip",
    greedy: false //The initial mask shown will be "" instead of "-____".
  });
</script>
</body>

</html>