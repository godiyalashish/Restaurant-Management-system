<?php

session_start();
require 'connection.php';
$conn = Connect();



if(isset($_POST) & !empty($_POST)){
$email = mysqli_real_escape_string($conn, $_POST['email']);
$sql = "SELECT * FROM `usersignup` WHERE email = '$email'";
$res = mysqli_query($conn, $sql);
$count = mysqli_num_rows($res);
if($count == 1){
$r = mysqli_fetch_assoc($res);
$password = $r['password'];
$to = $r['email'];
$subject = "Your Recovered Password";

$message = "Please use this password to login :   " . $password . "";

      
$headers = "From : hotelproject@hnbgu.com";
if(mail($to, $subject, $message, $headers)){
echo "<span style='color:white;'>Your Password has been sent to your email id</span>";
}else{
echo "<span style='color:white;'>Failed to Recover your password, try again</span>";
}
 
}else{
echo "<span style='color:white;'>Email does not exist in database</span>";
}
}
 
 
?>
<!DOCTYPE html>
<html>
<head>
<title>Forgot Password </title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  
	 <link href="../order/css/materialize.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="../order/css/style.min.css" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->    
    <link href="../order/css/custom/custom.min.css" type="text/css" rel="stylesheet" media="screen,projection">
  <link href="../order/css/layouts/page-center.css" type="text/css" rel="stylesheet" media="screen,projection">
</head>
<style>
	body{
	background:url(images/headerimg1.jpg) no-repeat center top;
	background-attachment:fixed;
	background-size:cover;
	height:100vh;
	min-height:100%;);
}
</style>
<body>
<div class="container">
      <?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
      <?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>
        <form id="register-form" role="form" autocomplete="off" class="form" method="post">    
  <div class="form-group">
<div class="input-group">
  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
  <input id="email" style="color:#bbb" name="email" placeholder="email address" class="form-control"  type="email">
</div>
  </div>
  <div class="form-group">
<input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Send Password" type="submit">
  </div>
  
  <input type="hidden" class="hide" name="token" id="token" value="">
</form>
</div>
</body>
</html>