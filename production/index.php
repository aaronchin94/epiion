<?php
include "header.php";
include_once "includes/db.php";
include_once "includes/firstlogincheck.php";
include_once "includes/counter.php";
include_once "includes/dashboard.php";
?>

<head>
	<!-- Include the Google Charts library -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<!-- page content -->
<div class="right_col" role="main">
	<div class="">
<h1><b>Sistem Pengurusan Inventori ICT (e-PII)</b></h1>
		<div class="page-title">
			<div class="title_left">
				<h3>Laman Utama</h3>
			</div>
		</div>

		<div class="clearfix"></div>

		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>Statistik Keseluruhan</b></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">

						<div class="tile_count">
							<div class="col-md-2 col-sm-4  tile_stats_count">
								<span class="count_top"><i class="fa fa-desktop"></i> Jumlah Aset</span>
								<div class="count"><?php echo intval($total_asset); ?></div>
								<span class="count_bottom"><i class="green"> </i> Buah </span>
							</div>
							<div class="col-md-2 col-sm-4  tile_stats_count">
								<span class="count_top"><i class="fa fa-user"></i> Jumlah Admin</span>
								<div class="count"><?php echo intval($total_admin); ?></div>
								<span class="count_bottom"><i class="green"> </i> Orang </span>
							</div>
							<div class="col-md-2 col-sm-4  tile_stats_count">
								<span class="count_top"><i class="fa fa-user"></i> Jumlah Pendaftar</span>
								<div class="count"><?php echo intval($total_pendaftar); ?></div>
								<span class="count_bottom"><i class="green"> </i> Orang </span>
							</div>
							<div class="col-md-2 col-sm-4  tile_stats_count">
								<span class="count_top"><i class="fa fa-user"></i> Jumlah Kakitangan</span>
								<div class="count"><?php echo intval($total_staff); ?></div>
								<span class="count_bottom"><i class="green"> </i> Orang </span>
							</div>
							<div class="col-md-2 col-sm-4  tile_stats_count">
								<span class="count_top"><i class="fa fa-user"></i> Pengunjung Hari Ini</span>
								<div class="count"><?php echo intval($today_visitors); ?></div>
								<span class="count_bottom">Pada <i class="green"> <?php echo $today; ?></i> </span>
							</div>
							<div class="col-md-2 col-sm-4  tile_stats_count">
								<span class="count_top"><i class="fa fa-user"></i> Jumlah Pengunjung</span>
								<div class="count"><?php echo intval($total_visitors); ?></div>
								<span class="count_bottom">Sejak <i class="green"> 2023-01-01</i> </span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Statistik khusus -->

		<div class="row">
			<div class="col-md-12 col-sm-12">
				<div class="x_panel">
					<div class="x_title">
						<h2><b>Statistik Khusus</b></h2>
						<div class="clearfix"></div>
					</div>
					<div class="x_content">

						<div class="tile_count">
							<div class="col-md-5">
								<!-- Create a container for the chart -->
								<div id="chart_div" style="width: 100%; height: 400px;"></div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
    </div>
    </div>
  
		<!-- /page content -->

    
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

		<!-- Include the JavaScript code for the chart -->
		<script type="text/javascript" src="js/chart.js"></script>

		<!-- Pass the chart data to the JavaScript code -->
		<script type="text/javascript">
			var chart_data = <?php echo $chart_data_json; ?>;
			drawChart(chart_data);
		</script>


		<?php include_once "footer.php"; ?>

		</body>

		</html>