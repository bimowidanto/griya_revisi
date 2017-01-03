<?php
error_reporting(0);
session_start(); // Starting Session
if(isset($_SESSION['login_user'])){
header("location: halaman.php");
}
?>

<?php
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['username']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
// Define $username and $password
$username=$_POST['username'];
$password=$_POST['password'];
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
$connection = mysql_connect("localhost", "root", "");
// To protect MySQL injection for Security purpose
$username = stripslashes($username);
$password = stripslashes($password);
$username = mysql_real_escape_string($username);
$password = mysql_real_escape_string($password);
// Selecting Database
$db = mysql_select_db("griya_natura", $connection);
// SQL query to fetch information of registerd users and finds user match.
$query = mysql_query("select * from tbl_user where password='$password' AND username='$username'", $connection);
$rows = mysql_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$username; // Initializing Session
header("location: halaman.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
}
mysql_close($connection); // Closing Connection
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Griya Sehat Natura</title>
<link href="matrializer/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <style type="text/css">
     .edo {
    @extend .blue, .lighten-4;
  }
    </style>


<div id="main">
<div id="login" class="edo card-panel teal lighten-2">
<h2>Login Form</h2>
    <form action="" method="post" background="honeydew">
        <label>UserName :</label>
        <input id="name" name="username" placeholder="username" type="text">
        <label>Password :</label>
        <input id="password" name="password" placeholder="**********" type="password">
        <input name="submit" type="submit" value=" Login ">
        <span><?php echo $error; ?></span>
    </form>
</div>
</div>
</body>
</html>
