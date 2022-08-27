<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "food";

// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$status=$_POST["status"];
$firstname=$_POST["firstname"];
$phone=$_POST["phone"];
$city=$_POST["city"];
$foodname1=$_POST["country"];
$foodqty=$_POST["address1"];
$address2=$_POST["address2"];
$phone2=$_POST["zipcode"];
$state=$_POST["state"];
$amount=$_POST["amount"];
$txnid=$_POST["txnid"];
$posted_hash=$_POST["hash"];
$key=$_POST["key"];
$productinfo=$_POST["productinfo"];
$email=$_POST["email"];
$msg = '';
$salt="Z9A14cI1yl";


$sql = "INSERT INTO orders (customer_id, payment_type, address, total, description,statuss,addr,qty) VALUES ($amount, '$status', '$foodname1', '$firstname', '$address2',$phone,'$txnid',$foodqty)";

	if ($conn->query($sql) === TRUE){
	}
	
// Salt should be same Post Request 

If (isset($_POST["additionalCharges"])) {
       $additionalCharges=$_POST["additionalCharges"];
        $retHashSeq = $additionalCharges.'|'.$salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
  } else {
        $retHashSeq = $salt.'|'.$status.'|||||||||||'.$email.'|'.$firstname.'|'.$productinfo.'|'.$amount.'|'.$txnid.'|'.$key;
         }
		 $hash = hash("sha512", $retHashSeq);
       if ($hash != $posted_hash) {
	       echo "Invalid Transaction. Please try again";
		   } else {
         $msg1 =  "<h2>Thank You. Your order status is<strong> ". $status ."</strong>. Your order will soon be shipped.</h2>";
          $msg .=  "<h5>Your Transaction ID for this transaction is <strong> ".$txnid.".</strong></h5>";
          $msg .= "<h5>We have received a payment of Rs.<strong> " . $amount . ".</strong></h4>";
		  
		  $msg .= "<h5>Customer email is :<strong> " . $email . ".</strong></h5>";
		   $msg .=  "<h5>Name of the customer is: <strong> " . $firstname . ".</strong> </h5>";
		    $msg .=  "<h5>The adress of customer is : <strong> " . $productinfo . ".</strong> </h5>";
		      $msg .=  "<h5>The phone no. of customer is: <strong> " . $phone . ".</strong> </h5>";
			     $msg .=  "<h5>City:<strong> " . $city . ".</strong> </h5>";
				 $msg .=  "<h5>Food name: <strong> " . $foodname1 . ".</strong> .</h5>";
				 $msg .=  "<h5>Food quantity: <strong> " . $foodqty . ".</strong> </h5>";
				 $msg .=  "<h5>Alternative address of customer is: <strong> " . $address2 . ".</strong> </h5>";
				 $msg .=  "<h5>Alternative phone no of the customer is:. <strong> " . $phone2 . ".</strong></h5>";
				
		 





	
?>
		   
<html>
<head>

 

   <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0">

    <!-- Site Metas -->
    <title>order food now</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon" />
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- color -->
    <link id="changeable-colors" rel="stylesheet" href="css/colors/orange.css" />

    <!-- Modernizer -->
    <script src="js/modernizer.js"></script>

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	<style>
	body{
	background:url(../images/headerimg1.jpg) no-repeat center top;
	background-attachment:fixed;
	background-size:cover;
	height:100vh;
	min-height:100%;);
}
</style>
</head>
<body>
<div id="banner" class="banner full-screen-mode parallax">
        <div class="container pr">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="banner-static">
                    <div class="banner-text">
                        <div class="banner-cell">
                            
                       <div class="alert alert-success" role="alert"><?php echo $msg1 ?></div>
<div class="alert alert-success" role="alert"><?php echo $msg ?></div>
							
  
                        </div>
						
                        <!-- end banner-cell -->
                    </div>
                    <!-- end banner-text -->
                </div>
                <!-- end banner-static -->
            </div>
            <!-- end col -->
        </div>
        <!-- end container -->
    </div>

</body>
</html>
           <?php 
            $to = "asmitkhankriyal@gmail.com";
$subject = "THE HILANS";
$txt = "Order placed!!.\r\nDetails given below.\r\nDeliver order soon!\r\n";
$txt .= "Name:".$firstname."\r\n" ."amount:".$amount."\r\n" ."txnid:".$txnid. "\r\n".
$txt .= "email:".$email."\r\n" ."address:".$productinfo."\r\n" ."phone no.:".$phone. "\r\n".
$txt .= "city:".$city."\r\n" ."phone no.2:".$phone2."\r\n" ."address2:".$address2. "\r\n".
$txt .= "food name:".$foodname1."\r\n" ."food quantity:".$foodqty."\r\n" .
$headers = "From: asmitkhankriyal@gmail.com" . "\r\n" .

"CC: asmitkhankriyal@gmail.com";

			
            
            if (mail($to,$subject,$txt,$headers)) {
                
                echo '<div class="alert alert-success" role="alert"><h5><strong>Your order is placed.Details have been shared.</strong></h5></div>';
                
                
            } else {
                
               echo '<div class="alert alert-danger" role="alert"><h5><strong>Something went wrong.Please try again later<strong><h5></div>';
                
                
            }
            
         }
?>	
