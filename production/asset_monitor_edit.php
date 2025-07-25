<?php
include_once 'header.php';
include_once 'includes/session.php';
require_once 'includes/db.php';
require_once 'includes/initialization.php';

$asset = getasset('monitor', 'm_id', $id, $connection, $row);
$kewpa_check = getkewpa('monitor', $connection);
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
    const def_kewpa = '<?php echo $asset['kewpa'] ?>';

    function validate() {
      var valid = true;

      const kewpa = document.getElementById('kewpa').value;
      var kewpa_arr = <?php echo $kewpa_check ?>;
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
            <h2>Kemaskini Maklumat Monitor</h2>
            <div margin class="col-md-1 col-sm-12  float-right">
              <a href='asset_view.php' class='btn btn-warning'>Kembali</a>
            </div>
            <div class="clearfix"></div>
          </div>
          <label><?php echo $required ?></label>
          <div class="x_content">
            <form role="form" action="includes/update_monitor.php" method="post" id="registration-form"
              autocomplete="off" onsubmit="return validate();">
              <input type="text" hidden name="m_id" value="<?= $asset['m_id'] ?>">

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
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="ic">Aset ID</label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="asset_id" id="asset_id" required="required" class="form-control"
                value="<?php echo $asset['asset_id'] ?>" readonly>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="model">Model <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="model" id="model" required="required" class="form-control"
                value="<?php echo $asset['model'] ?>" placeholder="Model">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="tahun">Tahun Diperoleh <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="tahun" id="tahun" required="required" class="form-control"
                value="<?php echo $asset['tahun'] ?>" placeholder="Tahun Diperoleh">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="saiz">Saiz Monitor <span
                class="required">*</span>
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="size" id="size" required="required" class="form-control"
                value="<?php echo $asset['size'] ?>" placeholder="Saiz Monitor">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="serial">No. Siri</label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="serial" id="serial" class="form-control" value="<?php echo $asset['serial'] ?>"
                placeholder="No. Siri">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="kewpa">No. KewPA</label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="kewpa" id="kewpa" class="form-control" value="<?php echo $asset['kewpa'] ?>"
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
              <input id="sumber" name="sumber" type="text" class="form-control" value="<?php echo $asset['sumber'] ?>"
                placeholder="Sumber Penerimaan" required>
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
</script>
</body>

</html>