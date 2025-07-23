<?php
include 'header.php';
include 'includes/db.php';
include 'includes/initialization.php';
include_once 'includes/secure_function.php';
include_once 'includes/utils.php';

//Grab asset id
$query_cat = "SELECT MAX(k_id) AS k_id FROM komputer";
$result_cat = $connection->query($query_cat);
foreach ($result_cat as $result_id) {
  $model_id = $result_id["k_id"] + 1;
}

$kewpa_check = getkewpa('komputer', $connection);
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
  <!-- jquery.inputmask -->
  <script src="../vendors/jquery.inputmask/dist/min/jquery.inputmask.bundle.min.js"></script>
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
                    <h2>Maklumat Desktop</h2>
                    <div class="clearfix"></div>
                  </div>
                  <label><?php echo $required ?></label>
                  <div class="x_content">
                    <form role="form" action="insert_komputer.php" method="post" id="registration-form"
                      name="registration-form" autocomplete="off" onsubmit="return validate();">

                      <div id="usetype-div">

                        <div class="field item form-group">
                          <label class="col-form-label col-md-3 col-sm-3  label-align">Penggunaan <span
                              class="required">*</span> <?php tooltip('usetype'); ?></label>
                          <div class="col-md-6 col-sm-6">
                            <select id="usetype" name="usetype" class="form-control" title="" required onchange="checkusetype()">
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
                            <select id="staff_id" name="staff_id" class="form-control" title="" required onchange="getvalue()">
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
                                value=K10<?php echo intval($model_id) ?>>
                            </div>
                          </div>
                          <div class='model-div'>
                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align">Model <span
                                  class="required">*</span>
                              </label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="model" name="model" type="text" title="" required class="form-control"
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
                                <input id="tahun" name="tahun" type="text" title="" required class="form-control"
                                  placeholder="Tahun Diperoleh">
                              </div>
                            </div>
                          </div>
                          <div class='serial-div'>
                            <div class="item form-group">
                              <label class="col-form-label col-md-3 col-sm-3 label-align">No. Siri</label>
                              <div class="col-md-6 col-sm-6 ">
                                <input id="serial" name="serial" type="text" title="" class="form-control"
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
                                <select id="status" name="status" class="form-control" title="" required>
                                  <?php
                                  select_options($status_options, "");
                                  ?>
                                </select>
                              </div>
                            </div>
                          </div>
                          <div class='perolehan-div'>
                            <div class="field item form-group">
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
                        </div>
                        <div class='sumber-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Sumber Penerimaan <span
                                class="required">*</span> <?php tooltip('sumber'); ?>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="sumber" name="sumber" type="text" class="form-control" title="" required
                                placeholder="Sumber Penerimaan">
                            </div>
                          </div>
                        </div>
                        <div class='os-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Sistem Operasi <span
                                class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <select id="os" name="os" class="form-control" required>
                                <?php
                                select_options($os_options, "");
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class='app_kerja-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Aplikasi Kerja <span
                                class="required">*</span> <?php tooltip('app_kerja'); ?>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="app_kerja" name="app_kerja" type="text" title="" required class="form-control"
                                placeholder="Aplikasi Kerja">
                            </div>
                          </div>
                        </div>
                        <div class='anti_v-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Anti Virus <span
                                class="required">*</span> <?php tooltip('anti_v'); ?>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input id="anti_v" name="anti_v" type="text" title="" required class="form-control"
                                placeholder="Anti Virus">
                            </div>
                          </div>
                        </div>
                        <div class='processor-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Processor <span
                                class="required">*</span> <?php tooltip('processor'); ?>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" id="processor" name="processor" class="form-control"
                                placeholder="Processor" title="" required>
                            </div>
                          </div>
                        </div>
                        <div class='ram-div'>
                          <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">RAM (GB) <span
                                class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                              <select id="ram" name="ram" class="form-control" title="" required>
                                <?php
                                select_options($ram_options, "");
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class='harddisk-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Kapasiti Harddisk (GB)
                              <span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" id="harddisk" name="harddisk" title="" required class="form-control"
                                placeholder="Kapasiti Harddisk (GB)">
                            </div>
                          </div>
                        </div>
                        <div class='grafik-div'>
                          <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Kad Grafik <span
                                class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                              <select id="grafik" name="grafik" class="form-control" title="" required>
                                <?php
                                select_options($yesno_options, "");
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class='networklan-div'>
                          <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Network <span
                                class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                              <select id="networklan" name="networklan" class="form-control" title="" required>
                                <?php
                                select_options($lan_options, "");
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class='modem-div'>
                          <div class="field item form-group">
                            <label class="col-form-label col-md-3 col-sm-3  label-align">Modem <span
                                class="required">*</span></label>
                            <div class="col-md-6 col-sm-6">
                              <select id="modem" name="modem" class="form-control" title="" required>
                                <?php
                                select_options($yesno_options, "");
                                ?>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class='ipv4-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">IP Address <span
                                class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" class="form-input form-control" id="ipv4" name="ipv4"
                                placeholder="IP Address" title="" required />
                            </div>
                          </div>
                        </div>
                        <div class='subnet-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Subnet Mask <span
                                class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" class="form-input form-control" id="subnet" name="subnet"
                                placeholder="Subnet Mask" value="255.255.255.0" title="" required />
                            </div>
                          </div>
                        </div>
                        <div class='defaultgateway-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">Default Gateway <span
                                class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" class="form-input form-control" id="defaultgateway"
                                name="defaultgateway" placeholder="Default Gateway" title="" required />
                            </div>
                          </div>
                        </div>
                        <div class='dnsserver-div'>
                          <div class="item form-group">
                            <label class="col-form-label col-md-3 col-sm-3 label-align">DNS Server <span
                                class="required">*</span></label>
                            <div class="col-md-6 col-sm-6 ">
                              <input type="text" class="form-input form-control" id="dnsserver" name="dnsserver"
                                placeholder="DNS Server" value="10.250.253.1" title="" required />
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

    // tahun numbers only
    $('#tahun').keypress(function (e) {
      var txt = String.fromCharCode(e.which);
      if (!txt.match(/[0-9]/)) {
        return false;
      }
    });

    // harddisk gb number only
    $('#harddisk').keypress(function (e) {
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