<?php
session_start();
$error=''; // Variable pesan error
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Cari $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
$connection = mysql_connect("localhost", "root", "root");
// Proteksi SQL Injection
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);

$db = mysql_select_db("db_rentmobil", $connection);

$query = mysql_query("SELECT * FROM staff WHERE password='$password' AND username='$username'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Inisial Session
header("location: index.php");
} else {
echo "<script>alert('Username dan Password Anda Salah!');window.location='login.php';</script>";
}
mysql_close($connection);
}
}
?>
