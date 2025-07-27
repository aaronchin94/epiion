<?php

require_once 'includes/db.php';
include 'includes/initialization.php';
include_once 'includes/secure_function.php';


function getassetbyassetID($connection, $asset_id)
{
  $stmt = $connection->prepare("
        SELECT 'komputer' AS type, penggunaan, staff_id, asset, asset_id, model, tahun, serial, kewpa, status, jen_perolehan, sumber FROM komputer WHERE asset_id = ?
        UNION ALL
        SELECT 'lan_switch' AS type, penggunaan, staff_id, asset, asset_id, model, NULL AS tahun, serial, kewpa, status, jen_perolehan, sumber FROM lan_switch WHERE asset_id = ?
        UNION ALL
        SELECT 'avr' AS type, penggunaan, staff_id, asset, asset_id, model, tahun, serial, kewpa, status, jen_perolehan, sumber FROM avr WHERE asset_id = ?
        UNION ALL
        SELECT 'laptop' AS type, penggunaan, staff_id, asset, asset_id, model, tahun, serial, kewpa, status, jen_perolehan, sumber FROM laptop WHERE asset_id = ?
        UNION ALL
        SELECT 'lcd' AS type, penggunaan, staff_id, asset, asset_id, model, tahun, serial, kewpa, status, jen_perolehan, sumber FROM lcd WHERE asset_id = ?
        UNION ALL
        SELECT 'monitor' AS type, penggunaan, staff_id, asset, asset_id, model, tahun, serial, kewpa, status, jen_perolehan, sumber FROM monitor WHERE asset_id = ?
        UNION ALL
        SELECT 'printer' AS type, penggunaan, staff_id, asset, asset_id, model, tahun, serial, kewpa, status, jen_perolehan, sumber FROM printer WHERE asset_id = ?
        UNION ALL
        SELECT 'scanner' AS type, penggunaan, staff_id, asset, asset_id, model, tahun, serial, kewpa, status, jen_perolehan, sumber FROM scanner WHERE asset_id = ?
        UNION ALL
        SELECT 'ups' AS type, penggunaan, staff_id, asset, asset_id, model, tahun, serial, kewpa, status, jen_perolehan, sumber FROM ups WHERE asset_id = ?
        UNION ALL
        SELECT 'tablet' AS type, penggunaan, staff_id, asset, asset_id, model, tahun, serial, kewpa, status, jen_perolehan, sumber FROM tablet WHERE asset_id = ?
    ");

  if (!$stmt) {
    die("Error: " . $connection->error);
  }

  $stmt->bind_param("ssssssssss", $asset_id, $asset_id, $asset_id, $asset_id, $asset_id, $asset_id, $asset_id, $asset_id, $asset_id, $asset_id);
  $stmt->execute();

  $asset = $stmt->get_result();
  return $asset->fetch_assoc();
}

if (isset($_GET['asset_id'])) {
  $asset_id = $_GET['asset_id'];

  $asset = getassetbyassetID($connection, $asset_id);
}

?>

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sistem Pengurusan Inventori ICT (e-PII) | Jabatan Pertanian Sabah</title>
  <link rel="icon" type="image/x-icon" href="images/DOA_logo.png">

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
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
      <div>
        <a href="index.php" class="site_title"><img src="images/DOA_logo.png" height="50"
            alt="Description of the image">
          <span style="font-size: 11.5px;"><b>e-PII Jabatan Pertanian Sabah</b></span></a>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <div class="x_panel">
          <div class="x_title">
            <h2 style="white-space: normal;">
              Paparan Maklumat
              <?php echo sanitizeText($asset['asset']) ?>
            </h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form role="form" action="asset_QR_redirect.php" method="post" id="registration-form" autocomplete="off">
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
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Nama Pengguna
            </label>
            <div class="col-md-4 col-sm-6 ">
              <select id="staff_id" name="staff_id" class="form-control" required="" onchange="getvalue()" disabled>
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
              <input type="hidden" name="asset_id" value="<?php echo $asset['asset_id']; ?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="model">Model
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="model" id="model" required="required" class="form-control"
                value="<?php echo sanitizeText($asset['model']) ?>" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="tahun">Tahun Diperoleh
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="tahun" id="tahun" required="required" class="form-control"
                value="<?php echo intval($asset['tahun']) ?>" disabled>
            </div>
          </div>


          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="serial">No. Siri
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="serial" id="serial" class="form-control" value="<?php echo sanitizeText($asset['serial']) ?>"
                disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="kewpa">No. KewPA
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="kewpa" id="kewpa" class="form-control" value="<?php echo sanitizeText($asset['kewpa']) ?>"
                disabled>
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
              <input id="sumber" name="sumber" type="text" class="form-control" value="<?php echo sanitizeText($asset['sumber']) ?>"
                disabled>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md-6 col-sm-6 offset-md-3">
              <button type="submit" class="btn btn-primary">View Full Details</button>
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