<?php
include '../koneksi.php';
session_start();
if (isset($_SESSION['login_user'])) {

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Dashboard - Artha Laras</title>
  <!-- Bootstrap Core CSS -->
  <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
  <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
  <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
            <a href="index.php"><i class="glyphicon glyphicon-tasks"></i> DASHBOARD</a>
          </li>
          <li>
            <a href="#"><i class="glyphicon glyphicon-inbox"></i> MASTER<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li class='nav-item'>
                <a class='nav-link' href='../master/penyewa.php'><i class='fa fa-edit'></i> Entry Data Penyewa</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../master/mobil.php'><i class='fa fa-edit'></i> Entry Data Mobil</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../master/perlengkapan.php'><i class='fa fa-edit'></i> Entry Data Perlengkapan</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../master/supir.php'><i class='fa fa-edit'></i> Entry Data Supir</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../master/jns_denda.php'><i class='fa fa-edit'></i> Entry Data Jenis Denda</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../master/staff.php'><i class='fa fa-edit'></i> Entry Data Staff</a>
              </li>
            </ul>
            <!-- /.nav-second-level -->
          </li>
          <li>
            <a href="#"><i class="glyphicon glyphicon-inbox"></i> TRANSAKSI<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li class='nav-item'>
                <a class='nav-link' href='../transaksi/spsk.php'><i class='fa fa-edit'></i> Cetak SPSK</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../transaksi/invoice.php'><i class='fa fa-edit'></i> Cetak Invoice</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../transaksi/kwitansi.php'><i class='fa fa-edit'></i> Cetak Kwitansi</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../transaksi/spk.php'><i class='fa fa-edit'></i> Cetak SPK</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../transaksi/stk.php'><i class='fa fa-edit'></i> Cetak STK</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../transaksi/pengembalian.php'><i class='fa fa-edit'></i> Entri Pengembalian</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../transaksi/bukden.php'><i class='fa fa-edit'></i> Cetak Bukti Denda</a>
              </li>
            </ul>
            <!-- /.nav-second-level -->
          </li>
          <li>
            <a href="#"><i class="glyphicon glyphicon-inbox"></i> LAPORAN<span class="fa arrow"></span></a>
            <ul class="nav nav-second-level">
              <li class='nav-item'>
                <a class='nav-link' href='../laporan/lapsewa.php'><i class='fa fa-edit'></i> Cetak Lap. Penyewaan</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../laporan/lapkembali.php'><i class='fa fa-edit'></i> Cetak Lap. Pengembalian</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../laporan/lapdenda.php'><i class='fa fa-edit'></i> Cetak Lap. Denda</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../laporan/lapsupir.php'><i class='fa fa-edit'></i> Cetak Lap. Supir</a>
              </li>
              <li class='nav-item'>
                <a class='nav-link' href='../laporan/laprekap.php'><i class='fa fa-edit'></i> Laporan Rekapitulasi Mobil</a>
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

  <div id="page-wrapper">
    <div class="row">
      <div class="col-lg-12">
        <h1 class="page-header">Dashboard</h1>
      </div>
      <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-primary">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-comments fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge">
                  <?php
                    $x=mysql_query("SELECT COUNT(id_penyewa) AS Jumlah FROM penyewa");
                    $xx=mysql_fetch_array($x);
                    echo "<b>".$xx['Jumlah']."</b>";
                  ?>
                </div>
                <div>Penyewa Baru!</div>
              </div>
            </div>
          </div>
          <a href="../master/penyewa.php">
            <div class="panel-footer">
              <span class="pull-left">View Details</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-green">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-tasks fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge">
                  <?php
                    $x=mysql_query("SELECT COUNT(id_mobil) AS Jumlah FROM mobil");
                    $xx=mysql_fetch_array($x);
                    echo "<b>".$xx['Jumlah']."</b>";
                  ?>
                </div>
                <div>Mobil Baru!</div>
              </div>
            </div>
          </div>
          <a href="../master/mobil.php">
            <div class="panel-footer">
              <span class="pull-left">View Details</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-yellow">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-shopping-cart fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge">
                  <?php
                    $x=mysql_query("SELECT COUNT(no_spsk) AS Jumlah FROM spsk");
                    $xx=mysql_fetch_array($x);
                    echo "<b>".$xx['Jumlah']."</b>";
                  ?>
                </div>
                <div>Pesanan Baru!</div>
              </div>
            </div>
          </div>
          <a href="../transaksi/spsk.php">
            <div class="panel-footer">
              <span class="pull-left">View Details</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="panel panel-red">
          <div class="panel-heading">
            <div class="row">
              <div class="col-xs-3">
                <i class="fa fa-support fa-5x"></i>
              </div>
              <div class="col-xs-9 text-right">
                <div class="huge">
                  <?php
                    $x=mysql_query("SELECT COUNT(no_pengembalian) AS Jumlah FROM pengembalian");
                    $xx=mysql_fetch_array($x);
                    echo "<b>".$xx['Jumlah']."</b>";
                  ?>
                </div>
                <div>Pengembalian Baru!</div>
              </div>
            </div>
          </div>
          <a href="../transaksi/pengembalian.php">
            <div class="panel-footer">
              <span class="pull-left">View Details</span>
              <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
              <div class="clearfix"></div>
            </div>
          </a>
        </div>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /#page-wrapper -->
</div>

<!-- /#wrapper -->

<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="../vendor/metisMenu/metisMenu.min.js"></script>
<script src="../vendor/raphael/raphael.min.js"></script>
<script src="../vendor/morrisjs/morris.min.js"></script>
<script src="../data/morris-data.js"></script> -->
<!-- Custom Theme JavaScript -->
<script src="../dist/js/sb-admin-2.js"></script>

</body>
</html>
<?php
} else {
  header("location: login.php");
}
?>
