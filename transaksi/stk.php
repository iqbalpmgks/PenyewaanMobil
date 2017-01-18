<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Transaksi STK - Artha Laras</title>
  <!-- Bootstrap Core CSS -->
  <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
  <link href="../dist/css/bootstrap-toggle.min.css" rel="stylesheet">
  <link href="../dist/css/github.min.css" rel="stylesheet">
  <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
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

    <?php include 'nav.php'; ?>

    <?php include '../view/stk.php'; ?>
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
