<?php
include_once "header.php";
include_once "includes/session.php";
//include_once 'includes/adminonly.php';
include_once 'includes/secure_function.php';

?>
<?php
require_once "includes/db.php";

?>

  
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script type="text/javascript" charset="utf8">
    $(document).ready(function () {
      // var table = $("#datatable-responsive").DataTable({
      //   order: [[6, 'desc'], [5, 'asc']]
      // });
      var table;
      if ($.fn.dataTable.isDataTable("#datatable-responsive")) {
          table = $("#datatable-responsive").DataTable();
      } else {
          table = $("#datatable-responsive").DataTable({
              order: [[6, 'desc'], [5, 'asc']],
              destroy: true
          });
      }

      $('.filter-option').on('click', function () {
        var status = $(this).data('value');
        table.column(6).search(status).draw();
      });


    });
  </script>


  <style>
    #filterDropdown {
      display: inline-block;
      border-radius: 4px;
      background-color: #1ABB9C;
      color: #fff;
      text-align: center;
      font-size: 16px;
      padding: 5px;
      width: 150px;
      transition: all 0.5s;
      cursor: pointer;
      margin: 20px;
    }

    #filterDropdown:hover {
      background-color: #169F85;
      color: #fff;

    }
  </style>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Penyelenggaraan</h3>
      </div>
    </div>
    <div class="clearfix"></div>


    <!--category-->
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_content">
            <div class="x_title">
              <h2>Senarai Permohonan Penyelenggaraan</h2>
              <div class="clearfix"></div>
            </div>

            <!--carian staff-->
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_content" style="display: block;">

                    <div class="dropdown float-left">
                      <button class="btn buttondownload dropdown-toggle" type="button" id="filterDropdown"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Status
                      </button>
                      <div class="dropdown-menu" aria-labelledby="filterDropdown">
                        <a class="dropdown-item filter-option" data-value="">Semua</a>
                        <a class="dropdown-item filter-option" data-value="Perlu Tindakan">Perlu Tindakan</a>
                        <a class="dropdown-item filter-option" data-value="Ditangguh">Ditangguh</a>
                        <a class="dropdown-item filter-option" data-value="Diterima">Diterima</a>
                        <a class="dropdown-item filter-option" data-value="Ditolak">Ditolak</a>
                      </div>
                    </div>



                    <div class="x_content" style="display: block;">
                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                        cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th scope="col">Penyelenggaraan <br> ID</th>
                            <th scope="col">Aset ID </th>
                            <th scope="col">Jenis Aset </th>
                            <th scope="col">Model </th>
                            <th scope="col">Keutamaan <br>Penyelenggaraan</th>
                            <th scope="col">Tarikh<br> Diperlukan</th>
                            <th scope="col">Status</th>
                            <th scope="col">Tindakan</th>
                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          $query = "SELECT * FROM maintenance ORDER BY UpdatedAt DESC";
                          $result = mysqli_query($connection, $query);
                          if ($result === false) {
                            die (mysqli_error($connection));
                          }
                          while ($rowk = mysqli_fetch_assoc($result)) {
                            $id = $rowk['maintenance_id'];
                            echo "<tr>";
                            echo '<td>' . intval($rowk['maintenance_id']) . '</td>';
                            echo '<td>' . sanitizeText($rowk['asset_id']) . '</td>';
                            echo '<td>' . sanitizeText($rowk['asset']) . '</td>';
                            echo '<td>' . sanitizeText($rowk['model']) . '</td>';

                            switch ($rowk['maintenance_priority']) {
                              case 'Biasa':
                                $class = 'badge badge-success';
                                break;
                              case 'Penting':
                                $class = 'badge badge-warning';
                                break;
                              case 'Sangat Penting':
                                $class = 'badge badge-danger';
                                break;
                            }
                            echo '<td style="text-align: center; vertical-align: middle; padding: 10px;"><span class="' . $class . '" style="width: 100%;"><b style="font-size: 1.3em;">' . $rowk['maintenance_priority'] . '</b></span></td>';
                            echo '<td>' . sanitizeText($rowk['maintenance_date']) . '</td>';
                            $status = '';
                            switch ($rowk['maintenance_status']) {
                              case 0:
                                $status = 'Perlu Tindakan';
                                $class = 'badge badge-info';
                                break;
                              case 1:
                                $status = 'Ditangguh';
                                $class = 'badge badge-warning';
                                break;
                              case 2:
                                $status = 'Diterima';
                                $class = 'badge badge-success';
                                break;
                              case 3:
                                $status = 'Ditolak';
                                $class = 'badge badge-danger';
                                break;

                            }
                            echo '<td style="text-align: center; vertical-align: middle; padding: 10px;"><span class="' . $class . '" style="width: 100%;"><b style="font-size: 1.3em;">' . $status . '</b></span></td>';
                            // if (($rowk['maintenance_status'] != 3) && ($row['ic'] == '000719120127')) {
                            if (($rowk['maintenance_status'] < 3)) {
                              echo '<td>
                              <a href="asset_maintenance_review.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                              <a href="asset_maintenance_assign.php?id=' . $id . '" ><i class="fa fa-user-plus" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Tugaskan Juruteknik"></i></a>
                              </td>';
                            } else {
                              echo '<td>
                              <a href="asset_maintenance_review.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                              </td>';
                            }

                            echo "</tr>";
                          }
                          ?>
                        </tbody>

                      </table>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /page content -->



      <?php include_once "footer.php"; ?>
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
      <!-- Datatables -->
      <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
      <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
      <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
      <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
      <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
      <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
      <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
      <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
      <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
      <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
      <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
      <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
      <script src="../vendors/jszip/dist/jszip.min.js"></script>
      <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
      <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

      </body>

      </html>