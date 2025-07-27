<?php
include 'header.php';
include 'includes/db.php';
include_once 'includes/secure_function.php';
?>

  <!-- Grab all available user -->
<?php 
    
    $query_drop = "SELECT name FROM staff ";
    $result_drop = $connection->query($query_drop);
?>
  <!-- Grab all available user -->

  <!-- Grab all category -->
  <?php 

    $query_cat = "SELECT * FROM asset_category ";
    $result_cat = $connection->query($query_cat);
?>

<?php 

    $query_cat = "SELECT MAX(k_id) AS k_id FROM komputer";
    $result_cat = $connection->query($query_cat);
?>
  <!-- Grab all category -->

            <?php
                            foreach($result_cat as $row){
                                //echo $row["k_id"];
                                $model_id =$row["k_id"] + 1;
                                //echo $test; 
                            }
            ?>

      <!-- page content -->

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
                <!--category-->
                <!--<form action="functions_insert.php" method="post">-->    <!--

                <div class="row">
                  <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                      <div class="x_content">
                        <div class="field item form-group">
                          <label class="col-form-label col-md-3 col-sm-3  label-align">Kategori Aset<span
                              class="required"></span></label>
                          <div class="col-md-6 col-sm-6">
                          <select class="form-control" id="asset">
                            <option value="-">-- Sila Pilih --</option>
                            <?php 
                            foreach($result_cat as $row){
                                echo '<option value="'.sanitizeText($row["category"]).'">'.sanitizeText($row["category"]).'</option>';
                            }
                            ?>  
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                        -->        

                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Maklumat Komputer</h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                        <form role="form" action="insert_komputer.php" method="post" id="registration-form" autocomplete="off">

                            <div id="usetype-div">

                              <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Penggunaan<span
                                    class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <select id="usetype" name="usetype" class="form-control" required>
                                    <option value="">--- Sila pilih ---</option>
                                    <option value="Individu">Individu</option>
                                    <option value="Gunasama">Gunasama </option>
                                  </select>
                                </div>
                              </div>



                    <div class="field item form-group">
                        
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama Pengguna<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select id="username" name="username" class="form-control"  required="">
                            <option value="" id="myInput" onkeyup="filterFunction()" onclick="myFunction()">-- Sila Pilih --</option>
                            <?php 
                            foreach($result_drop as $row){
                                echo '<option value="'.sanitizeText($row["name"]).'">'.sanitizeText($row["name"]).'</option>';
                            }
                            ?>  
                            </select>
                        </div>
                    </div>
                              <div class='assetid-div'>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align">Asset ID
                                  </label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input id="assetid" name="assetid" type="text" class="form-control"  
                                      readonly="readonly" value=K10<?php echo intval($model_id) ?>>
                                  </div>
                                </div>

                              <div class='model-div'>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align">Model <span
                                      class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input id="model" name="model" type="text"  required class="form-control ">
                                  </div>
                                </div>
                              </div>

                              <div class='status-div'>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Status<span
                                      class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select id="status" name="status" class="form-control"  required>
                                      <option value="">--- Sila pilih ---</option>
                                      <option value="Aktif">Aktif</option>
                                      <option value="Tidak Aktif">Tidak Aktif</option>
                                      <option value="Penyelenggaraan">Penyelenggaraan</option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class='perolehan-div'>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Jenis Perolehan <span
                                      class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select id="perolehan" name="perolehan" class="form-control"  required>
                                      <option value="">--- Sila pilih ---</option>
                                      <option value="Negeri">Negeri</option>
                                      <option value="Persekutuan">Persekutuan</option>
                                      <option value="Derma">Derma</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                              <div class='processor-div'>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align">Processor
                                  </label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="processor" name="processor" class="form-control" required>
                                  </div>
                                </div>

                              <div class='ram-div'>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">RAM (GB) <span
                                      class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select id="ram" name="ram" class="form-control"  required>
                                      <option value="">--- Sila pilih ---</option>
                                      <option value="4GB">4 GB</option>
                                      <option value="8GB">8 GB</option>
                                      <option value="16GB">16 GB</option>
                                      <option value="32GB">32 GB</option>
                                      <option value="64GB">64 GB</option>
                                      <option value="128GB">128 GB</option>
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
                                    <input type="text" id="harddisk" name="harddisk" required class="form-control">
                                  </div>
                                </div>
                              </div>

                              <div class='grafik-div'>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Kad Grafik <span
                                      class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select id="grafik" name="grafik" class="form-control" required>
                                      <option value="">--- Sila pilih ---</option>
                                      <option value="Ada">Ada</option>
                                      <option value="Tiada">Tiada</option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class='networklan-div'>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Network LAN<span
                                      class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select id="networklan" name="networklan" class="form-control"  required>
                                      <option value="">--- Sila pilih ---</option>
                                      <option value="PCI Card">PCI Card</option>
                                      <option value="Onboard">Onboard</option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class='modem-div'>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Modem <span
                                      class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select id="modem" name="modem" class="form-control"  required>
                                      <option value="">--- Sila pilih ---</option>
                                      <option value="Ada">Ada</option>
                                      <option value="Tiada">Tiada</option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class='ipv4-div'>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align">IP Address</label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input type="text" class="form-input form-control" id="ipv4" name="ipv4"
                                      placeholder="xxx.xxx.xxx.xxx" required />
                                  </div>
                                </div>
                              </div>

                              <div class='subnet-div'>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align">Subnet Mask</label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input type="text" class="form-input form-control" id="subnet" name="subnet"
                                      placeholder="255.255.255.0" value="255.255.255.0" required />
                                  </div>
                                </div>
                              </div>

                              <div class='defaultgateway-div'>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align">Default Gateway</label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input type="text" class="form-input form-control" id="defaultgateway" name="defaultgateway"
                                      placeholder="xxx.xxx.xxx.xxx" required />
                                  </div>
                                </div>
                              </div>

                              <div class='dnsserver-div'>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align">DNS Server</label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input type="text" class="form-input form-control" id="dnsserver" name="dnsserver"
                                      placeholder="xxx.xxx.xxx.xxx" value="10.250.253.1" required />
                                  </div>
                                </div>
                              </div>

                              <div class='supplynetwork-div'>
                                <div class="item form-group">
                                  <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Pembekal
                                    Rangkaian</label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input id="supplynetwork" class="form-control" name="supplynetwork" type="text"
                                      placeholder="SabahNet/Nyatakan lain-lain" required>
                                  </div>
                                </div>
                              </div>

                              <div class='typenerwork-div'>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Jenis Rangkaian<span
                                      class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select id="typenerwork" name="typenerwork" class="form-control"  required>
                                      <option value="">--- Sila pilih ---</option>
                                      <option value="Cable">Cable</option>
                                      <option value="Wireless">Wireless</option>
                                      <option value="Cable & Wireless">Cable & Wireless</option>
                                    </select>
                                  </div>
                                </div>
                              </div>


                              <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Jenis Capaian<span
                                    class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <select id="typeaccess" name="typeaccess" class="form-control"  required>
                                    <option value="">--- Sila pilih ---</option>
                                    <option value="VSAT">VSAT</option>
                                    <option value="ADSL">ADSL</option>
                                    <option value="Lease Line">Lease Line</option>
                                    <option value="Dail Up">Dail Up</option>
                                  </select>
                                </div>
                              </div>



                              <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Kelajuan (Mbps) <span
                                    class="required">*</span>
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                  <input type="text" id="internetspeed" name="internetspeed" required class="form-control">
                                </div>
                              </div>
                              
                              <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                        <div class="col-md-4 col-sm-3 ">
                          <button class="btn btn-primary" type="reset">Reset</button>
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
      </div>
    </div>

 <?php
 include 'footer.php';
 ?>

    <script>
         //asset caterory filter


      // harddisk gb number only
$('#harddisk').keypress(function (e) {
  var txt = String.fromCharCode(e.which);
  if (!txt.match(/[0-9]/)) {
    return false;
  }
});

// internet speed mbps number only
$('#internetspeed').keypress(function (e) {
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



</body>

</html>