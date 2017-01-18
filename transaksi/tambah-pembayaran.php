<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Bootstrap Admin Theme</title>
  <!-- Bootstrap Core CSS -->
  <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
  <link href="../dist/css/bootstrap-toggle.min.css" rel="stylesheet">
  <link href="../dist/css/github.min.css" rel="stylesheet">
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
  <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
  <link href="../vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
  <link href="../vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">
  <link href="../vendor/bootstrap-toggle/doc/stylesheet.css" rel="stylesheet">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body>

  <div id="wrapper">

    <?php include 'header.php'; ?>

    <div class="navbar-default sidebar" role="navigation">
      <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">

          <li>
            <a href="../index.html"><i class="glyphicon glyphicon-tasks"></i> DASHBOARD</a>
          </li>
          <li>
            <a href="#"><i class="glyphicon glyphicon-inbox"></i> MASTER<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li class='nav-item'>
                <a class='nav-link' href='konsumen.php'><i class='fa fa-edit'></i> Entry Konsumen</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='jnsmobil.php'><i class='fa fa-edit'></i> Entry Jenis Mobil</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='mobil.php'><i class='fa fa-edit'></i> Entry Mobil</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='supir.php'><i class='fa fa-edit'></i> Entry Supir</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='staff.php'><i class='fa fa-edit'></i> Entry Staff</a>
              </li>
            </ul>
            <!-- /.nav-second-level -->
          </li>
          <li>
            <a href="#"><i class="glyphicon glyphicon-inbox"></i> TRANSAKSI<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li class='nav-item'>
                <a class='nav-link' href='../transaksi/pemesanan.php'><i class='fa fa-edit'></i> Entry Pemesanan</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../transaksi/peminjaman.php'><i class='fa fa-edit'></i> Entry Peminjaman</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../transaksi/pengembalian.php'><i class='fa fa-edit'></i> Entry Pengembalian</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../transaksi/pembayaran.php'><i class='fa fa-edit'></i> Entry Pembayaran</a>
              </li>
            </ul>
            <!-- /.nav-second-level -->
          </li>
          <li>
            <a href="#"><i class="glyphicon glyphicon-inbox"></i> LAPORAN<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li class='nav-item'>
                <a class='nav-link' href='../laporan/lap_pemesanan.php'><i class='fa fa-edit'></i> Laporan Pemesanan</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../laporan/lap_peminjaman.php'><i class='fa fa-edit'></i> Laporan Peminjaman</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../laporan/lap_pengembalian.php'><i class='fa fa-edit'></i> Laporan Pengembalian</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../laporan/lap_pembayaran.php'><i class='fa fa-edit'></i> Laporan Pembayaran</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../laporan/lap_pendapatan.php'><i class='fa fa-edit'></i> Laporan Pendapatan</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../laporan/lap_rekap.php'><i class='fa fa-edit'></i> Laporan Rekapitulasi</a>
              </li>
            </ul>
            <!-- /.nav-second-level -->
          </li>
        </ul>
      </div>
      <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
  </nav>

  <?php include '../view/tambah-konsumen.php'; ?>

</div>
<!-- /#wrapper -->

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="../vendor/metisMenu/metisMenu.min.js"></script>
  <script src="../vendor/raphael/raphael.min.js"></script>
  <script src="../vendor/morrisjs/morris.min.js"></script>
  <script src="../vendor/bootstrap-toggle/doc/script.js"></script>
  <script src="../dist/js/morris-data.js"></script>
  <script src="../dist/js/bootstrap-toggle.min.js"></script>
  <script src="../dist/js/highlight.min.js"></script>

  <!-- Custom Theme JavaScript -->
  <script src="../dist/js/sb-admin-2.js"></script>

  <!-- DataTables JavaScript -->
  <script src="../vendor/datatables/js/jquery.dataTables.min.js"></script>
  <script src="../vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
  <script src="../vendor/datatables-responsive/dataTables.responsive.js"></script>

  <script>
  $(document).ready(function() {
    $('#dataTables-example').DataTable({
      responsive: true
    });
  });
  </script>

</body>
</html>
