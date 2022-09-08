<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [
            "STL",
            "SAI",
            "HSD",
            "SBK",
            "ARP",
            "SKA",
            "MRK",
            "DOP",
            "KEP"
        ],
        datasets: [{
            label: 'Jumlah Karyawan',
            backgroundColor: [
                // COLORFUL
                'rgba(255, 99, 132, 0.4)',
                'rgba(255, 159, 64, 0.4)',
                'rgba(255, 205, 86, 0.4)',
                'rgba(75, 192, 192, 0.4)',
                'rgba(54, 162, 235, 0.4)',
                'rgba(153, 102, 255, 0.4)',
                'rgba(201, 203, 207, 0.4)',
                'rgba(75, 192, 192, 0.4)',
                'rgba(255, 159, 64, 0.4)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 205, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(201, 203, 207, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1,
            data: [
              <?= $count_stl; ?>,
              <?= $count_sai; ?>,
              <?= $count_hsd; ?>,
              <?= $count_sbk; ?>,
              <?= $count_arp; ?>,
              <?= $count_ska; ?>,
              <?= $count_mrk; ?>,
              <?= $count_dop; ?>,
              <?= $count_kep; ?>,
              0
            ],
        }],
    },
    options: {
      legend: {
         display: false
         //This will do the task
      }
   }
});
 
  </script>