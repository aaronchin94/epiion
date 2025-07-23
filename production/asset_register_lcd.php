<?php
include 'header.php';
include 'includes/db.php';
include 'includes/initialization.php';
include_once 'includes/secure_function.php';
include_once 'includes/utils.php';

//Grab asset id
$query_cat = "SELECT MAX(l_id) AS l_id FROM lcd";
$result_cat = $connection->query($query_cat);
foreach ($result_cat as $result_id) {
  $model_id = $result_id["l_id"] + 1;
}

$kewpa_check = getkewpa('lcd', $connection);
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
    function validate() {
      var valid = true;

      const kewpa = document.getElementById('kewpa').value;
      var kewpa_arr = <?php echo $kewpa_check ?>;
      if (kewpa != "" && kewpa_arr.indexOf(kewpa) !== -1) {
        alert("No. KewPA sudah didaftar");
        valid = false;
      }

      return valid;
    }
  </script>
</head>
<!-- page content -->

<body>
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Aset</h3>
        </div>
      </div>
      <div class="clearfix"></div>
      <div class="row">
        <div class="col-md-12 col-sm-12  ">
          <div class="x_panel">
            <div class="x_title">
              <h2>Daftar Aset Baharu</h2>
              <div margin class="col-md-1 col-sm-12  float-right">
                <a href="#" class='btn btn-warning' onclick="history.back();">Kembali</a>
              </div>
              <div class="clearfix"></div>
            </div>
            <div class="row">
              <div class="col-md-12 col-sm-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Maklumat Projector</h2>
                    <div class="clearfix"></div>
                  </div>
                  <label><?php echo $required ?></label>
                  <div class="x_content">
                    <form role="form" action="insert_lcd.php" method="post" id="registration-form"
                      name="registration-form" autocomplete="off" onsubmit="return validate();">

                      <div id="usetype-div">

                        <div class="field item form-group">
                          <label class="col-form-label col-md-3 col-sm-3  label-align">Penggunaan <span
                              class="required">*</span> <?php tooltip('usetype'); ?></label>
                          <div class="col-md-6 col-sm-6">
                            <select id="usetype" name="usetype" class="form-control" required onchange="checkusetype()">
                              <?php
                              select_options($usetype_options, "");
                              ?>
                            </select>
                          </div>
                        </div>
                        <div class="field item form-group">
                          <label class="col-form-label col-md-3 col-sm-3  label-align">Nama Pengguna <span
                              class="required">*</span></label>
                          <div class="col-md-6 col-sm-6">
                            <select id="staff_id" name="staff_id" class="form-control" required onchange="getvalue()">
                              <?php
                              stafflist("", $connection, $row);
                              ?>
                            </select>

                          </div>
                        </div>
                        <div class='assetid-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Aset ID
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="assetid" name="assetid" type="text" class="form-control" readonly="readonly"
                                value=L10<?php echo intval($model_id) ?>>
                            </div>
                          </div>
                        </div>
                        <div class='model-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Model <span
                                class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="model" name="model" type="text" required class="form-control"
                                placeholder="Model">
                            </div>
                          </div>
                        </div>
                        <div class='tahun-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Tahun Diperoleh <span
                                class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="tahun" name="tahun" type="text" required class="form-control"
                                placeholder="Tahun Diperoleh">
                            </div>
                          </div>
                        </div>
                        <div class='serial-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">No. Siri</label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="serial" name="serial" type="text" class="form-control"
                                placeholder="No. Siri">
                            </div>
                          </div>
                        </div>
                        <div class='kewpa-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">No. KewPA</label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="kewpa" name="kewpa" type="text" class="form-control" placeholder="No. KewPA">
                            </div>
                          </div>
                        </div>
                        <div class='status-div'>
                          <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Status <span
                                class="required">*</span> <?php tooltip('status'); ?></label>
                            <div class="col-md-6 col-sm-6">
                              <select id="status" name="status" class="form-control" required>
                                <?php
                                select_options($status_options, "");
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class='perolehan-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Jenis Perolehan <span
                                class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                              <select id="perolehan" name="perolehan" class="form-control" required>
                                <?php
                                select_options($jen_options, "");
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class='sumber-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Sumber Penerimaan <span
                                class="required">*</span> <?php tooltip('sumber'); ?></label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="sumber" name="sumber" type="text" class="form-control"
                                placeholder="Sumber Penerimaan" required>
                            </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                          <div class="col-md-4 col-sm-3 ">
                            <button class="btn btn-primary" type="reset">Set Semula</button>
                            <button type="submit" class="btn btn-success" action="">Simpan</button>
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
    </div>
  </div>

  <?php
  include 'footer.php';
  ?>

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