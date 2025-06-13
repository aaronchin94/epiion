<?php
include_once "header.php";
include_once "includes/session.php";
include_once 'includes/adminonly.php';
//include_once 'includes/approveronly.php';

?>
<?php
require_once "includes/db.php";

function getPemohonById($connection, $id)
{
  $stmt = $connection->prepare("SELECT * FROM staff WHERE id = ?");
  $stmt->bind_param("s", $id);
  $stmt->execute();
  $pemohon = $stmt->get_result();
  return $pemohon->fetch_assoc();
}

?>

<head>
  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-1.11.0.js"></script>
  <script type="text/javascript" charset="utf8">
    $(document).ready(function () {
      $(".datatable-buttons").DataTable({
        dom: 'B<"clear">lfrtip',
        buttons: true,
        fixedHeader: {
          header: true
        }
      });

      $("#datatable-responsive").DataTable({
        order: [[5, 'asc']],
        columnDefs: [
          {
            targets: [1, 2], // Column index (zero-based) to hide
            visible: false
          }
        ]
      });
    });

  </script>
</head>

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
              <h2>Senarai Kerja Penyelenggaraan</h2>
              <div class="clearfix"></div>
            </div>

            <!--carian staff-->
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_content" style="display: block;">


                    <div class="x_content" style="display: block;">
                      <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap"
                        cellspacing="0" width="100%">
                        <thead>
                          <tr>
                            <th scope="col">ID <br>Kerja</th>
                            <th scope="col">ID <br> Penyelenggaraan</th>
                            <th scope="col">Emel <br> Pemohon</th>
                            <th scope="col">Nama Juruteknik </th>
                            <th scope="col">Jenis Penyelenggaraan </th>
                            <th scope="col">Tarikh <br>Ditugaskan</th>
                            <th scope="col">Tarikh <br>Siap</th>
                            <th scope="col">Status Kerja</th>
                            <th scope="col">Tindakan</th>

                          </tr>
                        </thead>
                        <tbody>

                          <?php
                          if ($row["role"] == "Admin") {
                            $query = "SELECT * FROM maintenance AS m JOIN maintenance_work AS mw ON m.maintenance_id = mw.maintenance_id 
                            JOIN staff AS tv ON mw.technician_id = tv.id";
                          } elseif ($row["role"] == "Juruteknik") {
                            $query = "SELECT * FROM maintenance AS m JOIN maintenance_work AS mw ON m.maintenance_id = mw.maintenance_id 
                            JOIN staff AS tv ON mw.technician_id = tv.id 
                            WHERE tv.id = " . $row['id'];
                          }



                          $result = mysqli_query($connection, $query);
                          if ($result === false) {
                            die(mysqli_error($connection));
                          }
                          while ($rowk = mysqli_fetch_assoc($result)) {
                            $id = $rowk['maintenance_id'];
                            $pemohon = getPemohonById($connection, $rowk['RequestedBy']);
                            echo "<tr>";
                            echo '<td>' . $rowk['work_id'] . '</td>';
                            echo '<td>' . $id . '</td>';
                            echo '<td>' . $pemohon['email'] . '</td>';
                            echo '<td>' . $rowk['name'] . '</td>';
                            echo '<td>' . $rowk['maintenance_type'] . '</td>';
                            echo '<td>' . $rowk['assignment_date'] . '</td>';
                            echo '<td>' . ($rowk['completion_date'] !== null ? $rowk['completion_date'] : '<div style="text-align: center;">-</div>') . '</td>';

                            $status = '';
                            $color = '';
                            switch ($rowk['work_status']) {
                              case 0:
                                $status = 'Dalam Proses';
                                $class = 'badge badge-warning';
                                break;
                              case 1:
                                $status = 'Sedia untuk Diambil';
                                $class = 'badge badge-info';
                                break;
                              case 2:
                                $status = 'Siap';
                                $class = 'badge badge-success';
                                break;
                            }
                            echo '<td style="text-align: center; vertical-align: middle; padding: 10px;"><span class="' . $class . '" style="width: 100%;"><b style="font-size: 1.3em;">' . $status . '</b></span></td>';
                            if ($rowk['work_status'] != 2) {
                              echo '<td>
                              <a href="asset_maintenance_assign.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                              <a  href="#"><i class="fa fa-check-square" style="font-size:20px;margin:0px 5px 0px 5px;color:#7DDA58;" title="Siap Kerja"onmouseover="this.style.color=\'green\'" onmouseout="this.style.color=\'#7DDA58\'"></i></a>
                              </td>';
                            } else {
                              echo '<td>
                              <a href="asset_maintenance_assign.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
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


      <!-- Add this Bootstrap modal structure -->
      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="myModalLabel">Dilaksanakan Oleh</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="workModalForm">
                <!-- <div class="form-group">
                  <label for="maintenance_id">ID Penyelenggaraan:</label>
                  <span id="maintenance_idSpan"></span>
                </div> -->
                <div class="form-group">
                  <label for="workID">ID Kerja:</label>
                  <span id="workIDSpan"></span>
                </div>
                <div class="form-group">
                  <label for="namaJuruteknik">Nama Juruteknik:</label>
                  <span id="namaJuruteknikSpan"></span>
                </div>
                <div class="form-group">
                  <label for="jenisPenyelenggaraan">Jenis Penyelenggaraan:</label>
                  <span id="jenisPenyelenggaraanSpan"></span>
                </div>
                <div class="form-group">
                  <label for="tarikhDitugaskan">Tarikh Ditugaskan:</label>
                  <span id="tarikhDitugaskanSpan"></span>
                </div>
                <div class="form-group">
                  &nbsp;
                </div>
                <div class="form-group">
                  <label for="remark">Kerja-Kerja Pembaikan Yang Dilaksanakan/Catatan:</label>
                  <textarea class="form-control" id="remark" name="remark" rows="5"></textarea>
                </div>
                <button type="submit" id="work_button" class="btn btn-primary">Hantar</button>
              </form>
            </div>
          </div>
        </div>
      </div>



      <script>
        var maintenance_id;
        var email_pemohon;
        // When the user clicks on the button, open the modal
        $('.fa-check-square').click(function () {
          var rowData = $(this).closest('tr').find('td').map(function () {
            return $(this).text();
          }).get();

          maintenance_id = $('#datatable-responsive').DataTable().row($(this).closest('tr')).data()[1];
          email_pemohon = $('#datatable-responsive').DataTable().row($(this).closest('tr')).data()[2];
          $('#workIDSpan').text(rowData[0]);
          $('#namaJuruteknikSpan').text(rowData[1]);
          $('#jenisPenyelenggaraanSpan').text(rowData[2]);
          $('#tarikhDitugaskanSpan').text(rowData[3]);

          $('#myModal').modal('show');
        });

        // Submit form
        $('#workModalForm').submit(function (event) {
          event.preventDefault();
          var remark = $('#remark').val();
          var workID = $('#workIDSpan').text();

          disableButton();

          $.ajax({
            type: "POST",
            url: "asset_maintenance_readypickup.php",
            data: { remark: remark, work_id: workID, maintenance_id: maintenance_id, email_pemohon: email_pemohon }, // Include work_id in the data
            success: function (response) {
              // Check the response from the server
              setTimeout(function () {
                alert("Status Kerja Siap!");
                location.reload();
              }, 500);
            },
            error: function (xhr, status, error) {
              console.error("Error:", error);
              alert("An error occurred while updating the remark.");
            }

          });
        });

        function disableButton() {
          var form = document.getElementById("workModalForm");
          if (form.checkValidity()) {
            document.getElementById("work_button").disabled = true;
          } else {
            return false;
          }
        }
      </script>
      </body>

      </html>