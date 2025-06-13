<?php
include_once 'header.php';
include_once 'includes/session.php';
require_once 'includes/db.php';
include 'includes/initialization.php';

$asset_type = $_GET['asset_type'];
switch ($asset_type) {
  case 'Desktop':
    $asset = getasset('komputer', 'k_id', $id, $connection, $row);
    break;
  case 'Laptop':
    $asset = getasset('laptop', 'la_id', $id, $connection, $row);
    break;
  case 'Monitor':
    $asset = getasset('monitor', 'm_id', $id, $connection, $row);
    break;
  case 'Printer':
    $asset = getasset('printer', 'p_id', $id, $connection, $row);
    break;
  case 'Scanner':
    $asset = getasset('scanner', 's_id', $id, $connection, $row);
    break;
  case 'Uninterruptible Power Supply':
    $asset = getasset('ups', 'u_id', $id, $connection, $row);
    break;
  case 'Automatic Voltage Regulator':
    $asset = getasset('avr', 'a_id', $id, $connection, $row);
    break;
  case 'Projector':
    $asset = getasset('lcd', 'l_id', $id, $connection, $row);
    break;
  case 'Switch':
    $asset = getasset('lan_switch', 'ls_id', $id, $connection, $row);
    break;
  case 'Tablet':
    $asset = getasset('tablet', 't_id', $id, $connection, $row);
    break;
  default:
    die("Unsupported asset type");
}

?>

<style>
  .custom-span {
    border: none;
    padding: 0px;
    color: black;
    width: 300%;
  }
</style>

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
</head>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Penyelenggaraan Asset</h3>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Permohonan Pembaikan Perkakasan</h2>
            <div margin class="col-md-1 col-sm-12  float-right">
              <a href='asset_view.php' class='btn btn-warning'>Kembali</a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form role="form" action="add_maintenance.php?id=<?php echo $id ?>" method="post" enctype="multipart/form-data" id="maintenance-registration-form" autocomplete="off" onsubmit="return checkFileSize()">
              <div class="form-group row">
                <label class="col-md-3 col-sm-3 label-align" for="asset_type">Jenis Aset</label>
                <div class="col-md-3 col-sm-6">
                  <input type="text" name="asset_type" id="asset_type" class="custom-span"
                    value="<?php echo htmlspecialchars($asset_type); ?>" readonly="readonly">
                </div>
                <label class="col-md-1 col-sm-3 label-align" for="ic">Aset ID
                </label>
                <div class="col-md-1 col-sm-3 ">
                  <input type="text" id="asset_id" name="asset_id" class="custom-span"
                    value="<?php echo htmlspecialchars($asset['asset_id']); ?>" readonly="readonly">
                </div>
              </div>


              <div class="form-group row">
                <label class="col-md-3 col-sm-3 label-align" for="model">Model
                </label>
                <div class="col-md-3 col-sm-6 ">
                  <input type="text" name="model" id="model" class="custom-span"
                    value="<?php echo htmlspecialchars($asset['model']); ?>" readonly="readonly">
                </div>
                <label class="col-md-1 col-sm-3 label-align" for="serial">No. Siri</label>
                <div class="col-md-1 col-sm-3">
                  <input type="text" name="serial" id="serial" class="custom-span"
                    value="<?php echo htmlspecialchars($asset['serial']); ?>" readonly="readonly">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-sm-3 label-align" for="username">Nama Pengguna
                </label>
                <div class="col-md-3 col-sm-6">
                  <input type="text" name="staff_name" id="staff_name" class="custom-span"
                    value="<?php echo htmlspecialchars($asset['name']); ?>" readonly="readonly">
                </div>
                <input type="hidden" id="staff_id" name="staff_id" class="custom-span"
                  value="<?php echo htmlspecialchars($asset['staff_id']); ?>">
                <label class="col-md-1 col-sm-3 label-align" for="lokasi">Lokasi
                </label>
                <div class="col-md-2 col-sm-3 ">
                  <input type="text" name="lokasi" id="lokasi" class="custom-span"
                    value="<?php echo htmlspecialchars($asset['unit']); ?>" readonly="readonly">
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class='maintenance_type-div'>
                <div class="form-group row">
                  <label class="col-form-label col-md-3 col-sm-3  label-align">Jenis Permintaan <span
                      class="required">*</span>
                    <!-- <?php tooltip('status'); ?> -->
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <select id="maintenance_type" name="maintenance_type" class="form-control" title="" required>
                      <?php
                      select_options($maintenance_type, "");
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class='maintenance_type-div'>
                <div class="form-group row">
                  <label class="col-form-label col-md-3 col-sm-3  label-align">Keutamaan <span class="required">*</span>
                    <!-- <?php tooltip('status'); ?> -->
                  </label>
                  <div class="col-md-6 col-sm-6">
                    <select id="maintenance_priority" name="maintenance_priority" class="form-control" title=""
                      required>
                      <?php
                      select_options($maintenance_priority, "");
                      ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Tarikh Diperlukan <span
                    class="required">*</span></label>
                <div class="col-md-6 col-sm-6">
                  <input type="date" id="maintenance_date" name="maintenance_date" class="form-control" required>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Keterangan Permohonan <br>Penyelenggaraan
                  <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6">
                  <textarea id="maintenance_description" name="maintenance_description" class="form-control" rows="4"
                    required></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Tambah Lampiran</label>
                <div class="col-md-6 col-sm-6">
                  <input type="file" id="maintenance_files" name="maintenance_files[]" class="form-control-file"
                    multiple accept=".pdf, .jpg, .jpeg, .png">
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align">Sebab-Sebab Diperlukan <span
                    class="required">*</span></label>
                <div class="col-md-6 col-sm-6">
                  <textarea id="maintenance_reason" name="maintenance_reason" class="form-control" rows="4"
                    required></textarea>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                <div class="col-md-4 col-sm-3 ">
                  <button class="btn btn-primary" id="maintenance_reset" type="reset">Set Semula</button>
                  <button type="submit" id="maintenance_submit" class="btn btn-success">Hantar
                    Permohonan</button>
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

<script>
  function disableButton() {
    var form = document.getElementById("maintenance-registration-form");
    if (form.checkValidity()) {
      document.getElementById("maintenance_submit").disabled = true;
      document.getElementById("maintenance_reset").disabled = true;
      form.submit();
    } else {
      return false;
    }
  }

  function checkFileSize() {
    var files = document.getElementById('maintenance_files').files;
    var maxFileSize = 2 * 1024 * 1024; // 2 MB

    for (var i = 0; i < files.length; i++) {
        if (files[i].size > maxFileSize) {
            alert('Saiz Fail "' + files[i].name + '" terlalu besar. Saiz maksimum adalah 2 MB.');
            return false; // Prevent form submission
        }
    }

    disableButton();

    return true; // Allow form submission
}
</script>


</body>

</html>