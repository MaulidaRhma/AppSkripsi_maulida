  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2023</strong> - DINAS PERHUBUNGAN TANAH LAUT
  </footer>


  </div>


  <script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>

  <script src="../assets/bower_components/jquery-ui/jquery-ui.min.js"></script>

  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>

  <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <script src="../assets/bower_components/raphael/raphael.min.js"></script>
  <script src="../assets/bower_components/morris.js/morris.min.js"></script>

  <script src="../assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>


  <script src="../assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <script src="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

  <script src="../assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

  <script src="../assets/bower_components/moment/min/moment.min.js"></script>
  <script src="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

  <script src="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

  <script src="../assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

  <script src="../assets/bower_components/fastclick/lib/fastclick.js"></script>

  <script src="../assets/dist/js/adminlte.min.js"></script>

  <script src="../assets/dist/js/pages/dashboard.js"></script>

  <script src="../assets/dist/js/demo.js"></script>
  <script src="../assets/bower_components/ckeditor/ckeditor.js"></script>
  <script src="../assets/bower_components/chart.js/Chart.min.js"></script>

  <script>
    $(document).ready(function() {

      // $(".edit").hide();

      $('#table-datatable').DataTable({
        'paging': true,
        'lengthChange': false,
        'searching': true,
        'ordering': false,
        'info': true,
        'autoWidth': true,
        "pageLength": 50
      });



    });

    $('#datepicker').datepicker({
      autoclose: true,
      format: 'dd/mm/yyyy',
    }).datepicker("setDate", new Date());

    $('.datepicker2').datepicker({
      autoclose: true,
      format: 'yyyy/mm/dd',
    });
  </script>


  <script>
    var randomScalingFactor = function() {
      return Math.round(Math.random() * 100)
    };

    var barChartData = {
      labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", "Agu", "Sep", "Okt", "Nov", "Des"],
      datasets: [{
          label: 'Pendapatan',
          fillColor: "rgba(51, 240, 113, 0.61)",
          strokeColor: "rgba(11, 246, 88, 0.61)",
          highlightFill: "rgba(220,220,220,0.75)",
          highlightStroke: "rgba(220,220,220,1)",
          data: [
            <?php
            for ($bulan = 1; $bulan <= 12; $bulan++) {
              $thn_ini = date('Y');
              $pemasukan = mysqli_query($koneksi, "select sum(jumlah) as total_pemasukan from pendapatan where month(tanggal)='$bulan' and year(tanggal)='$thn_ini'");
              $pem = mysqli_fetch_assoc($pemasukan);

              // $total = str_replace(",", "44", number_format($pem['total_pemasukan']));
              $total = $pem['total_pemasukan'];
              if ($pem['total_pemasukan'] == "") {
                echo "0,";
              } else {
                echo $total . ",";
              }
            }
            ?>
          ]
        },
        {
          label: 'Pengeluaran',
          fillColor: "rgba(255, 51, 51, 0.8)",
          strokeColor: "rgba(248, 5, 5, 0.8)",
          highlightFill: "rgba(151,187,205,0.75)",
          highlightStroke: "rgba(151,187,205,1)",
          data: [
            <?php
            for ($bulan = 1; $bulan <= 12; $bulan++) {
              $thn_ini = date('Y');
              $pengeluaran = mysqli_query($koneksi, "select sum(pengeluaran) as total_pengeluaran from pengeluaran where month(tanggal)='$bulan' and year(tanggal)='$thn_ini'");
              $peng = mysqli_fetch_assoc($pengeluaran);

              // $total = str_replace(",", "44", number_format($peng['total_pengeluaran']));
              $total = $peng['total_pengeluaran'];
              if ($peng['total_pengeluaran'] == "") {
                echo "0,";
              } else {

                echo $total . ",";
              }
            }
            ?>
          ]
        }
      ]

    }


    var barChartData2 = {
      labels: [
        <?php
        $tahun = mysqli_query($koneksi, "select distinct year(tanggal) as tahun from pendapatan order by year(tanggal) asc");
        while ($t = mysqli_fetch_array($tahun)) {
        ?> "<?php echo $t['tahun']; ?>",
        <?php
        }
        ?>
      ],
      datasets: [{
          label: 'Pemasukan',
          fillColor: "rgba(51, 240, 113, 0.61)",
          strokeColor: "rgba(11, 246, 88, 0.61)",
          highlightFill: "rgba(220,220,220,0.75)",
          highlightStroke: "rgba(220,220,220,1)",
          data: [
            <?php
            $tahun = mysqli_query($koneksi, "select distinct year(tanggal) as tahun from pendapatan order by year(tanggal) asc");
            while ($t = mysqli_fetch_array($tahun)) {
              $thn = $t['tahun'];
              $pemasukan = mysqli_query($koneksi, "select sum(jumlah) as total_pemasukan from pendapatan where  year(tanggal)='$thn'");
              $pem = mysqli_fetch_assoc($pemasukan);
              $total = $pem['total_pemasukan'];
              if ($pem['total_pemasukan'] == "") {
                echo "0,";
              } else {
                echo $total . ",";
              }
            }
            ?>
          ]
        },
        {
          label: 'Pengeluaran',
          fillColor: "rgba(255, 51, 51, 0.8)",
          strokeColor: "rgba(248, 5, 5, 0.8)",
          highlightFill: "rgba(151,187,205,0.75)",
          highlightStroke: "rgba(254, 29, 29, 0)",
          data: [
            <?php
            $tahun = mysqli_query($koneksi, "select distinct year(tanggal) as tahun from pengeluaran order by year(tanggal) asc");
            while ($t = mysqli_fetch_array($tahun)) {
              $thn = $t['tahun'];
              $pemasukan = mysqli_query($koneksi, "select sum(pengeluaran) as total_pengeluaran from pengeluaran where  year(tanggal)='$thn'");
              $pem = mysqli_fetch_assoc($pemasukan);
              $total = $pem['total_pengeluaran'];
              if ($pem['total_pengeluaran'] == "") {
                echo "0,";
              } else {
                echo $total . ",";
              }
            }
            ?>
          ]
        }
      ]

    }



    window.onload = function() {
      var ctx = document.getElementById("grafik1").getContext("2d");
      window.myBar = new Chart(ctx).Bar(barChartData, {
        responsive: true,
        animation: true,
        barValueSpacing: 5,
        barDatasetSpacing: 1,
        tooltipFillColor: "rgba(0,0,0,0.8)",
        multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
      });

      var ctx = document.getElementById("grafik2").getContext("2d");
      window.myBar = new Chart(ctx).Bar(barChartData2, {
        responsive: true,
        animation: true,
        barValueSpacing: 5,
        barDatasetSpacing: 1,
        tooltipFillColor: "rgba(0,0,0,0.8)",
        multiTooltipTemplate: "<%= datasetLabel %> - Rp.<%= value.toLocaleString() %>,-"
      });
    }
  </script>
  <script>
    jQuery(document).ready(function($) {
      $('#cmb_pegawai').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
          type: 'POST', // Metode pengiriman data menggunakan POST
          url: 'get_nip.php', // File yang akan memproses data
          data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
          success: function(data) { // Jika berhasil
            $('.tampung0').html(data); // Berikan hasil ke id kota
          }


        });
      });
    });
  </script>

  <script>
    jQuery(document).ready(function($) {
      $('#cmb_golongan').change(function() { // Jika Select Box id provinsi dipilih
        var tamp = $(this).val(); // Ciptakan variabel provinsi
        $.ajax({
          type: 'POST', // Metode pengiriman data menggunakan POST
          url: 'get_golongan.php', // File yang akan memproses data
          data: 'tamp=' + tamp, // Data yang akan dikirim ke file pemroses
          success: function(data) { // Jika berhasil
            $('.tampung1').html(data); // Berikan hasil ke id kota
          }


        });
      });
    });
  </script>


  <script>
    $(document).ready(function() { // Ketika halaman selesai di load
      $('.input-tanggal').datepicker({
        dateFormat: 'yy-mm-dd' // Set format tanggalnya jadi yyyy-mm-dd
      });
      $('#form-tanggal, #form-bulan, #form-tahun').hide(); // Sebagai default kita sembunyikan form filter tanggal, bulan & tahunnya
      $('#filter').change(function() { // Ketika user memilih filter
        if ($(this).val() == '1') { // Jika filter nya 1 (per tanggal)
          $('#form-bulan, #form-tahun').hide(); // Sembunyikan form bulan dan tahun
          $('#form-tanggal').show(); // Tampilkan form tanggal
        } else if ($(this).val() == '2') { // Jika filter nya 2 (per bulan)
          $('#form-tanggal').hide(); // Sembunyikan form tanggal
          $('#form-bulan, #form-tahun').show(); // Tampilkan form bulan dan tahun
        } else { // Jika filternya 3 (per tahun)
          $('#form-tanggal, #form-bulan').hide(); // Sembunyikan form tanggal dan bulan
          $('#form-tahun').show(); // Tampilkan form tahun
        }
        $('#form-tanggal input, #form-bulan select, #form-tahun select').val(''); // Clear data pada textbox tanggal, combobox bulan & tahun
      })
    })
  </script>

  <script src="../plugin/jquery-ui/jquery-ui.min.js"></script> <!-- Load file plugin js jquery-ui -->



  </body>

  </html>