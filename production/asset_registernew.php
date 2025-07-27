<?php 
  include_once 'includes/secure_function.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sistem Pengurusan Aset DOA | </title>

  <!-- jquery ipinputmask scripts -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">


  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">

  <!-- Grab all available user -->
<?php 
    $connect = new PDO("mysql:host=localhost;dbname=inventory", "root", "");
    $query_drop = "SELECT name FROM users ";
    $result_drop = $connect->query($query_drop);
?>
  <!-- Grab all available user -->

  <!-- Grab all category -->
  <?php 
    $connect = new PDO("mysql:host=localhost;dbname=inventory", "root", "");
    $query_cat = "SELECT * FROM asset_category ";
    $result_cat = $connect->query($query_cat);
?>
  <!-- Grab all category -->
<?php

?>

</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">
          <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title"><span>Sistem Pengurusan Aset DOA</span></a>
          </div>

          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_info">
              <span>Welcome,</span>
              <h2>John Doe</h2>
            </div>
            <div class="clearfix"></div>
          </div>
          <!-- /menu profile quick info -->

          <br />

          <!-- sidebar menu -->
          <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
              <h3>General</h3>
              <ul class="nav side-menu">
                <li id="home"><a href="index.html"><i class="fa fa-home"></i> Laman Utama </a></li>
                <li><a><i class="fa fa-users"></i> Pengguna <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="user_register.html">Daftar Pengguna Baru</a></li>
                    <li><a href="user_view.html">Carian Pengguna</a></li>
                  </ul>
                </li>
                <li><a><i class="fa fa-desktop"></i> Aset <span class="fa fa-chevron-down"></span></a>
                  <ul class="nav child_menu">
                    <li><a href="asset_register.html">Daftar Aset</a></li>
                    <li><a href="asset_view.html">Carian Aset</a></li>
                  </ul>
                </li>
              </ul>
            </div>
          </div>
          <!-- /sidebar menu -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
          </div>
          <nav class="nav navbar-nav">
            <ul class=" navbar-right">
              <li class="nav-item dropdown open" style="padding-left: 15px;">
                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                  data-toggle="dropdown" aria-expanded="false">
                  John Doe
                </a>
                <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item" href="user_changepassword.html"> Tukar Kata laluan</a>
                  <a class="dropdown-item" href="login.html"><i class="fa fa-sign-out pull-right"></i> Log Keluar</a>
                </div>
              </li>
            </ul>
          </nav>
        </div>
      </div>
      <!-- /top navigation -->

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
                  <div class="clearfix"></div>
                </div>

                <!--category-->
                <div class="row">
                  <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                      <div class="x_content">
                        <div class="field item form-group">
                          <label class="col-form-label col-md-3 col-sm-3  label-align">Kategori Aset<span
                              class="required"></span></label>
                          <div class="col-md-6 col-sm-6">
                            <select class="form-control" id="asset">
                              <option value="-">--Sila Pilih--</option>
                              <option value="komputer">Komputer</option>
                              <option value="monitor">Monitor</option>
                              <option value="printer">Printer</option>
                              <option value="scanner">Scanner</option>
                              <option value="ups">UPS</option>
                              <option value="avr">AVR</option>
                              <option value="lcd">LCD</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!--
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

                
                <div class="assetform" id="assetform-div" style="display:none;">
                  <div class="row">
                    <div class="col-md-12 col-sm-12">
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>Maklumat</h2>
                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                          <form id="demo-form2" class="form-horizontal form-label-left">

                            <div id="usetype-div">

                              <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Penggunaan<span
                                    class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <select class="form-control" id="usetype" required>
                                    <option value="">--- Sila pilih ---</option>
                                    <option value="Individu">Individu</option>
                                    <option value="Gunasama">Gunasama </option>
                                  </select>
                                </div>
                              </div>



                <div id='individu-select' style="display:none;">
                    <div class="field item form-group">
                        
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Nama Pengguna<span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6">
                            <select id="select_box" name="unit" class="form-control" id="username" name="username" required="">
                            <option value="" id="myInput" onkeyup="filterFunction()" onclick="myFunction()">-- Sila Pilih --</option>
                            <?php 
                            foreach($result_drop as $row){
                                echo '<option value="'.sanitizeText($row["name"]).'">'.sanitizeText($row["name"]).'</option>';
                            }
                            ?>  
                            </select>
                        </div>
                    </div>
                </div>


                            <div id="shared-div" style="display:none;">
                              <div class='assetid-div'>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align">Asset ID
                                  </label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="assetid" class="form-control" name="assetid" disabled
                                      readonly="readonly" value="">
                                  </div>
                                </div>
                              </div>

                              <div class='model-div'>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align">Model <span
                                      class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="model" name="mdoel" required class="form-control ">
                                  </div>
                                </div>
                              </div>

                              <div class='status-div'>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Status<span
                                      class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select class="form-control" id="status" name="status" required>
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
                                    <select class="form-control" id="perolehan" name="perolehan" required>
                                      <option value="">--- Sila pilih ---</option>
                                      <option value="Negeri">Negeri</option>
                                      <option value="Persekutuan">Persekutuan</option>
                                      <option value="Derma">Derma</option>
                                    </select>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div id="pconly-div" style="display:none;">
                              <div class='processor-div'>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align">Processor
                                  </label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input type="text" id="processor" name="processor" class="form-control" required>
                                  </div>
                                </div>
                              </div>

                              <div class='ram-div'>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">RAM (GB) <span
                                      class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select class="form-control" id="ram" name="ram" required>
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
                                    <select class="form-control" id="grafik" required>
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
                                    <select class="form-control" id="networklan" required>
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
                                    <select class="form-control" id="modem" required>
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
                                    <input type="text" class="form-input form-control" id="ipv4"
                                      placeholder="xxx.xxx.xxx.xxx" required />
                                  </div>
                                </div>
                              </div>

                              <div class='subnet-div'>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align">Subnet Mask</label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input type="text" class="form-input form-control" id="subnet"
                                      placeholder="255.255.255.0" value="255.255.255.0" required />
                                  </div>
                                </div>
                              </div>

                              <div class='defaultgateway-div'>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align">Default Gateway</label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input type="text" class="form-input form-control" id="defaultgateway"
                                      placeholder="xxx.xxx.xxx.xxx" required />
                                  </div>
                                </div>
                              </div>

                              <div class='dnsserver-div'>
                                <div class="item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3 label-align">DNS Server</label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input type="text" class="form-input form-control" id="dnsserver"
                                      placeholder="xxx.xxx.xxx.xxx" value="10.250.253.1" required />
                                  </div>
                                </div>
                              </div>

                              <div class='supplynetwork-div'>
                                <div class="item form-group">
                                  <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Pembekal
                                    Rangkaian</label>
                                  <div class="col-md-6 col-sm-6 ">
                                    <input id="supplynetwork" class="form-control" type="text"
                                      placeholder="SabahNet/Nyatakan lain-lain" required>
                                  </div>
                                </div>
                              </div>

                              <div class='typenerwork-div'>
                                <div class="field item form-group">
                                  <label class="col-form-label col-md-3 col-sm-3  label-align">Jenis Rangkaian<span
                                      class="required">*</span></label>
                                  <div class="col-md-6 col-sm-6">
                                    <select class="form-control" id="typenerwork" required>
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
                                  <select class="form-control" id="typeaccess" required>
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
                                  <input type="text" id="internetspeed" required class="form-control">
                                </div>
                              </div>

                            </div>

                            <div id="printer-div" style="display:none;">
                              <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Jenis Cetakan<span
                                    class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <select class="form-control" id="jeniscetakan" required>
                                    <option value="">--- Sila pilih ---</option>
                                    <option value="LaserJet">LaserJet</option>
                                    <option value="InkJet">InkJet</option>
                                    <option value="DotMatrik">Lease Line</option>
                                  </select>
                                </div>
                              </div>
                            </div>

                            <div id="scanner-div" style="display:none;">
                              <div class="item form-group">
                                <label class="col-form-label col-md-3 col-sm-3 label-align">Resolution
                                </label>
                                <div class="col-md-6 col-sm-6 ">
                                  <input type="text" id="resolution" class="form-control">
                                </div>
                              </div>
                            </div>

                            <div id="network-div" style="display:none;">
                              <div class="field item form-group">
                                <label class="col-form-label col-md-3 col-sm-3  label-align">Network <span
                                    class="required">*</span></label>
                                <div class="col-md-6 col-sm-6">
                                  <select class="form-control" id="network" required>
                                    <option value="">--- Sila pilih ---</option>
                                    <option value="Ada">Ada</option>
                                    <option value="Tiada">Tiada</option>
                                  </select>
                                </div>
                              </div>
                            </div>








                            <div id="button-div" style="display:none;">
                              <div class="clearfix"></div>
                              <div class="item form-group">
                                <div class="col-md-6 col-sm-6 offset-md-3">
                                  <button class="btn btn-primary" type="reset">Reset</button>
                                  <button type="submit" class="btn btn-success">Simpan</button>
                                </div>
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

    <!-- footer content -->
    <footer>
      <div class="pull-right">
        <span>Hakcipta Terpelihara © Jabatan Pertanian Sabah 2007 – 2022</span>
      </div>
      <div class="clearfix"></div>
    </footer>
    <!-- /footer content -->

 
    <script>
         //asset caterory filter
      $(function () {
        $('#asset').change(function () {
          $('#demo-form2')[0].reset();
          if ($('#asset').val() == 'komputer') {
            $('#demo-form2')[0].reset();
            $('#assetform-div',).show();
            $('#usetype-div',).show();
            $('#shared-div',).show();
            $('#button-div',).show();
            $('#pconly-div',).show();
            $('#printer-div',).hide();
            $('#scanner-div',).hide();
            $('#network-div',).hide();

          }
          else if ($('#asset').val() == 'monitor') {
            $('#demo-form2')[0].reset();
            $('#assetform-div',).show();
            $('#usetype-div',).show();
            $('#shared-div',).show();
            $('#button-div',).show();
            $('#pconly-div',).hide();
            $('#printer-div',).hide();
            $('#scanner-div',).hide();
            $('#network-div',).hide();
          }
          else if ($('#asset').val() == 'printer') {
            $('#demo-form2')[0].reset();
            $('#assetform-div',).show();
            $('#usetype-div',).show();
            $('#shared-div',).show();
            $('#pconly-div',).hide();
            $('#printer-div',).show();
            $('#button-div',).show();
            $('#scanner-div',).hide();
            $('#network-div',).show();
          }
          else if ($('#asset').val() == 'scanner') {
            $('#demo-form2')[0].reset();
            $('#assetform-div',).show();
            $('#usetype-div',).show();
            $('#shared-div',).show();
            $('#pconly-div',).hide();
            $('#button-div',).show();
            $('#scanner-div',).show();
            $('#printer-div',).hide();
            $('#network-div',).show();
          }
          else if ($('#asset').val() == 'ups') {
            $('#demo-form2')[0].reset();
            $('#assetform-div',).show();
            $('#usetype-div',).show();
            $('#shared-div',).show();
            $('#pconly-div',).hide();
            $('#button-div',).show();
            $('#scanner-div',).hide();
            $('#printer-div',).hide();
            $('#network-div',).hide();
          }
          else if ($('#asset').val() == 'avr') {
            $('#demo-form2')[0].reset();
            $('#assetform-div',).show();
            $('#usetype-div',).show();
            $('#shared-div',).show();
            $('#pconly-div',).hide();
            $('#button-div',).show();
            $('#scanner-div',).hide();
            $('#printer-div',).hide();
            $('#network-div',).hide();
          }
          else if ($('#asset').val() == 'lcd') {
            $('#demo-form2')[0].reset();
            $('#assetform-div',).show();
            $('#usetype-div',).show();
            $('#shared-div',).show();
            $('#pconly-div',).hide();
            $('#button-div',).show();
            $('#scanner-div',).hide();
            $('#printer-div',).hide();
            $('#network-div',).hide();
          }
          else {
            $('#demo-form2')[0].reset();
            $('#assetform-div',).hide();
            $('#usetype-div',).hide();
            $('#shared-div',).hide();
            $('#pconly-div',).hide();
            $('#button-div',).hide();
            $('#scanner-div',).hide();
            $('#printer-div',).hide();
            $('#network-div',).hide();
          }
        });
      });

      //usetype cat
      $(function () {
        $('#usetype').change(function () {
          selection = $(this).val();
          switch (selection) {
            case 'Individu':
              $('#individu-select').show();
              break;
            default:
              $('#individu-select').hide();
              break;
          }
        }); 
      });

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