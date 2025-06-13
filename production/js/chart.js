// Define the function to draw the chart
function drawChart(chart_data) {
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(function() {
    var data = google.visualization.arrayToDataTable(chart_data);

    var options = {
      title: 'Statistik Pendaftaran Aset ICT',
      width: '100%',
      height: 400,
      colors: ['#e60049', '#0bb4ff', '#50e991', '#e6d800', '#9b19f5', '#ffa300', '#dc0ab4', '#b3d4ff', '#00bfa0', '#ff6b6b'],
      legend: { position: 'bottom', maxLines: 3 },
      chartArea: { width: '60%', height: '80%' },
      titleTextStyle: { 
        color: '#333',
        fontSize: 20,
        bold: true,
        textAlign: 'center'
      }
    };

    var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
    chart.draw(data, options);
  });
}
  