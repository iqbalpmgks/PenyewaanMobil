<?php include '../koneksi.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login Form - Artha Laras</title>

  <link href="../dist/css/login.css" rel="stylesheet">
  <link href="../vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
  <link href="../vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
  <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
  <link href="../vendor/morrisjs/morris.css" rel="stylesheet">
  <link href="../vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

</head>
<body>
  <div class="container">
    <div class="card card-container">
        <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
        <img id="profile-img" class="profile-img-card" src="//ssl.gstatic.com/accounts/ui/avatar_2x.png" />
        <p id="profile-name" class="profile-name-card"></p>
        <form action="loginact.php" method="POST" class="form-signin">
            <span id="reauth-email" class="reauth-email"></span>
            <input type="text" id="inputEmail" name="username" class="form-control" placeholder="Username" required>
            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
            <div id="remember" class="checkbox">
                <label>
                    <input type="checkbox" value="remember-me"> Remember me
                </label>
            </div>
            <button class="btn btn-lg btn-primary btn-signin" name="submit" type="submit">Sign in</button>
        </form><!-- /form -->
        <a href="#" class="forgot-password">
            Forgot the password?
        </a>
    </div><!-- /card-container -->
</div><!-- /container -->

  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="../vendor/metisMenu/metisMenu.min.js"></script>
  <script src="../vendor/raphael/raphael.min.js"></script>
  <script src="../vendor/morrisjs/morris.min.js"></script>
  <script src="../data/morris-data.js"></script>
  <!-- Custom Theme JavaScript -->
  <!-- <script src="../dist/js/login.js"></script> -->
</body>
</html>
