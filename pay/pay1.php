
<?php
session_start();
require 'connection.php';
$conn = Connect();
if(!isset($_SESSION['login_user2'])){
header("location: signin.php"); 
}
?>


<?php

$MERCHANT_KEY = "h5V5hkwa";
$SALT = "Z9A14cI1yl";
// Merchant Key and Salt as provided by Payu.

$PAYU_BASE_URL = "https://sandboxsecure.payu.in";		// For Sandbox Mode
//$PAYU_BASE_URL = "https://secure.payu.in";			// For Production Mode

$action = '';

$posted = array();
if(!empty($_POST)) {
    //print_r($_POST);
  foreach($_POST as $key => $value) {    
    $posted[$key] = $value; 
	
  }
}

$formError = 0;

if(empty($posted['txnid'])) {
  // Generate random transaction id
  $txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
} else {
  $txnid = $posted['txnid'];
}
$hash = '';
// Hash Sequence
$hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
if(empty($posted['hash']) && sizeof($posted) > 0) {
  if(
          empty($posted['key'])
          || empty($posted['txnid'])
          || empty($posted['amount'])
		  || empty($posted['firstname'])
		  || empty($posted['productinfo'])
		  || empty($posted['address2'])
		  || empty($posted['city'])
		  || empty($posted['state'])
		  || empty($posted['phone'])
		  || empty($posted['zipcode'])
		    || empty($posted['email'])
			  || empty($posted['country'])
			    || empty($posted['address1'])
   
  ) {
    $formError = 1;
  } else {
    //$posted['productinfo'] = json_encode(json_decode('[{"name":"tutionfee","description":"","value":"500","isRequired":"false"},{"name":"developmentfee","description":"monthly tution fee","value":"1500","isRequired":"false"}]'));
	$hashVarsSeq = explode('|', $hashSequence);
    $hash_string = '';	
	foreach($hashVarsSeq as $hash_var) {
      $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
      $hash_string .= '|';
    }

    $hash_string .= $SALT;


    $hash = strtolower(hash('sha512', $hash_string));
    $action = $PAYU_BASE_URL . '/_payment';
  }
} elseif(!empty($posted['hash'])) {
  $hash = $posted['hash'];
  $action = $PAYU_BASE_URL . '/_payment';
}
?>
<html>
  <head>
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <script>
    var hash = '<?php echo $hash ?>';
    function submitPayuForm() {
      if(hash == '') {
        return;
      }
      var payuForm = document.forms.payuForm;
      payuForm.submit();
    }
  </script>
  <style>
  html,body,.wrapper{
    background: #f7f7f7;
}
.steps {
    margin-top: -41px;
    display: inline-block;
    float: right;
    font-size: 16px
}
.step {
    float: left;
    background: white;
    padding: 7px 13px;
    border-radius: 1px;
    text-align: center;
    width: 100px;
    position: relative
}
.step_line {
    margin: 0;
    width: 0;
    height: 0;
    border-left: 16px solid #fff;
    border-top: 16px solid transparent;
    border-bottom: 16px solid transparent;
    z-index: 1008;
    position: absolute;
    left: 99px;
    top: 1px
}
.step_line.backline {
    border-left: 20px solid #f7f7f7;
    border-top: 20px solid transparent;
    border-bottom: 20px solid transparent;
    z-index: 1006;
    position: absolute;
    left: 99px;
    top: -3px
}
.step_complete {
    background: #357ebd
}
.step_complete a.check-bc, .step_complete a.check-bc:hover,.afix-1,.afix-1:hover{
    color: #eee;
}
.step_line.step_complete {
    background: 0;
    border-left: 16px solid #357ebd
}
.step_thankyou {
    float: left;
    background: white;
    padding: 7px 13px;
    border-radius: 1px;
    text-align: center;
    width: 100px;
}
.step.check_step {
    margin-left: 5px;
}
.ch_pp {
    text-decoration: underline;
}
.ch_pp.sip {
    margin-left: 10px;
}
.check-bc,
.check-bc:hover {
    color: #222;
}
.SuccessField {
    border-color: #458845 !important;
    -webkit-box-shadow: 0 0 7px #9acc9a !important;
    -moz-box-shadow: 0 0 7px #9acc9a !important;
    box-shadow: 0 0 7px #9acc9a !important;
    background: #f9f9f9 url(../images/valid.png) no-repeat 98% center !important
}

.btn-xs{
    line-height: 28px;
}

/*login form*/
.login-container{
    margin-top:30px ;
}
.login-container input[type=submit] {
  width: 100%;
  display: block;
  margin-bottom: 10px;
  position: relative;
}

.login-container input[type=text], input[type=password] {
  height: 44px;
  font-size: 16px;
  width: 100%;
  margin-bottom: 10px;
  -webkit-appearance: none;
  background: #fff;
  border: 1px solid #d9d9d9;
  border-top: 1px solid #c0c0c0;
  /* border-radius: 2px; */
  padding: 0 8px;
  box-sizing: border-box;
  -moz-box-sizing: border-box;
}

.login-container input[type=text]:hover, input[type=password]:hover {
  border: 1px solid #b9b9b9;
  border-top: 1px solid #a0a0a0;
  -moz-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  -webkit-box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
  box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
}

.login-container-submit {
  /* border: 1px solid #3079ed; */
  border: 0px;
  color: #fff;
  text-shadow: 0 1px rgba(0,0,0,0.1); 
  background-color: #357ebd;/*#4d90fe;*/
  padding: 17px 0px;
  font-family: roboto;
  font-size: 14px;
  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#4787ed)); */
}

.login-container-submit:hover {
  /* border: 1px solid #2f5bb7; */
  border: 0px;
  text-shadow: 0 1px rgba(0,0,0,0.3);
  background-color: #357ae8;
  /* background-image: -webkit-gradient(linear, 0 0, 0 100%,   from(#4d90fe), to(#357ae8)); */
}

.login-help{
  font-size: 12px;
}

.asterix{
    background:#f9f9f9 url(../images/red_asterisk.png) no-repeat 98% center !important;
}

/* images*/
ol, ul {
  list-style: none;
}
.hand {
  cursor: pointer;
  cursor: pointer;
}
.cards{
    padding-left:0;
}
.cards li {
  -webkit-transition: all .2s;
  -moz-transition: all .2s;
  -ms-transition: all .2s;
  -o-transition: all .2s;
  transition: all .2s;
  background-image: url('//c2.staticflickr.com/4/3713/20116660060_f1e51a5248_m.jpg');
  background-position: 0 0;
  float: left;
  height: 32px;
  margin-right: 8px;
  text-indent: -9999px;
  width: 51px;
}
.cards .mastercard {
  background-position: -51px 0;
}

}
.cards .amex {
  background-position: -102px 0;
}

.cards li:last-child {
  margin-right: 0;
}
/* images end */



/*
 * BOOTSTRAP
 */
.container{
    border: none;
}
.panel-footer{
   
}
.btn{
    border-radius: 1px;
}
.btn-sm, .btn-group-sm > .btn{
    border-radius: 1px;
}
.input-sm, .form-horizontal .form-group-sm .form-control{
    border-radius: 1px;
}

.panel-info {
    border-color: #999;
}

.panel-heading {
    border-top-left-radius: 1px;
    border-top-right-radius: 1px;
}
.panel {
    border-radius: 1px;
}
.panel-info > .panel-heading {
    color: #eee;
	font-size:20px;
    border-color: #999;
}
.panel-info > .panel-heading {
    background-image: linear-gradient(to bottom, #555 0px, #888 100%);
}

hr {
    border-color: #999 -moz-use-text-color -moz-use-text-color;
}

.panel-footer {
    border-bottom-left-radius: 1px;
    border-bottom-right-radius: 1px;
    border-top: 1px solid #999;
}

.btn-link {
    color: #888;
}

hr{
    margin-bottom: 10px;
    margin-top: 10px;
}

/** MEDIA QUERIES **/
@media only screen and (max-width: 989px){
    .span1{
        margin-bottom: 15px;
        clear:both;
    }
}

@media only screen and (max-width: 764px){
    .inverse-1{
        float:right;
    }
}

@media only screen and (max-width: 586px){
    .cart-titles{
        display:none;
    }
    .panel {
        margin-bottom: 1px;
    }
}

.form-control {
    border-radius: 1px;
}

@media only screen and (max-width: 486px){
    .col-xss-12{
        width:100%;
    }
    .cart-img-show{
        display: none;
    }
    .btn-submit-fix{
        width:100%;
    }
    
}
/*
@media only screen and (max-width: 777px){
    .container{
        overflow-x: hidden;
    }
}*/
body{
	background:url(../images/headerimg1.jpg) no-repeat center top;
	background-attachment:fixed;
	background-size:cover;
	height:100vh;
	min-height:100%;);
}
  </style>
  </head>
  <body onload="submitPayuForm()">
    <h2 style="color:teal;font-family: 'nautilus_pompiliusregular';font-size:50px;margin-bottom:10px;margin-top:10px;" class="block-title text-center">Order details:</h2>
    <br/>
    <?php if($formError) { ?>
	
     <div class="alert alert-danger" role="alert">Please fill all mandatory fields.</div>
      <br/>
      <br/>
    <?php } ?>
    <form action="<?php echo $action; ?>" method="post" name="payuForm">
      <input type="hidden" name="key" value="<?php echo $MERCHANT_KEY ?>" />
      <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
      <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
      <table>
        
			
		
 <?php
$gtotal = 0;
  foreach($_SESSION["cart"] as $keys => $values)
  {

    $F_ID = $values["food_id"];
    $foodname = $values["food_name"];
    $quantity = $values["food_quantity"];
    $price =  $values["food_price"];
    $total = ($values["food_quantity"] * $values["food_price"] + 40);
    $R_ID = $values["R_ID"];
    $username = $_SESSION["login_user2"];
    $order_date = date('Y-m-d');
    
    $gtotal = $gtotal + $total;


     $query = "INSERT INTO ORDERS (F_ID, foodname, price,  quantity, order_date, username, R_ID) 
              VALUES ('" . $F_ID . "','" . $foodname . "','" . $price . "','" . $quantity . "','" . $order_date . "','" . $username . "','" . $R_ID . "')";
             

              $success = $conn->query($query);  
              			  $posted['amount'] = '';
						  $posted['address1'] = '';
						  $posted['country'] = '';
						  
						
            $posted['amount'] = $gtotal;
			 $posted['address1'] = $quantity;
			  $posted['country'] = $foodname;
  }
        ?>
       
            <div class="row cart-head">
                <div class="container">
                <div class="row">
                    <p></p>
                </div>
                <div class="row">
                    <div style="display: table; margin: auto;">
                        <span class="step step_complete"> <a href="" class="check-bc">Cart</a> <span class="step_line step_complete"> </span> <span class="step_line backline"> </span> </span>
                        <span class="step step_complete"> <a href="pay1.php" class="check-bc">Checkout</a> <span class="step_line "> </span> <span class="step_line step_complete"> </span> </span>
                        <span class="step_thankyou check-bc step_complete">Thank you</span>
                    </div>
                </div>
                <div class="row">
                    <p></p>
                </div>
                </div>
            </div>    
            <div class="row cart-body">
                
             
                    <!--SHIPPING METHOD-->
                    <div class="panel panel-info">
                      <div class="panel-heading"><span><i class="glyphicon glyphicon-check"></i></span> Details</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12">
                                    <h3 style="color:teal;"><strong>Enter your details(all fields are mandatory)</strong></h3>
                                </div>
                            </div>
                           
                            <div class="form-group">
                                <div class="col-md-12 col-xs-12">
                                    <strong style="color:teal;">Full Name:</strong>
                                    <input type="text" name="firstname" class="form-control" id="firstname" value="<?php echo (empty($posted['firstname'])) ? '' : $posted['firstname']; ?>" />
                                </div>
                                <div class="span1"></div>
                                
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong style="color:teal;">Address 1:</strong></div>
                                <div class="col-md-12">
                                    <input type="text" name="productinfo"  class="form-control" value="<?php echo (empty($posted['productinfo'])) ? '' : $posted['productinfo'] ?>" />
                                </div>
                            </div>
							  <div class="form-group">
                                <div class="col-md-12"><strong style="color:teal;">Address 2:</strong></div>
                                <div class="col-md-12">
                                    <input type="address" name="address2" class="form-control" value="<?php echo (empty($posted['address2'])) ? '' : $posted['address2']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong style="color:teal;">City:</strong></div>
                                <div class="col-md-12">
                                    <input  type="text" name="city" class="form-control" value="<?php echo (empty($posted['city'])) ? '' : $posted['city']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong style="color:teal;">State:</strong></div>
                                <div class="col-md-12">
                                   <input type="text" name="state"  class="form-control" value="<?php echo (empty($posted['state'])) ? '' : $posted['state']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong style="color:teal;">phone number 1</strong></div>
                                <div class="col-md-12">
                                    <input type="tel" name="phone" class="form-control" value="<?php echo (empty($posted['phone'])) ? '' : $posted['phone']; ?>" />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong style="color:teal;">Phone Number 2:</strong></div>
                                <div class="col-md-12"><input type="tel" name="zipcode"  class="form-control" value="<?php echo (empty($posted['zipcode'])) ? '' : $posted['zipcode']; ?>" /></div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong style="color:teal;">Email Address:</strong></div>
                                <div class="col-md-12"><input type="email" name="email" id="email" class="form-control" value="<?php echo (empty($posted['email'])) ? '' : $posted['email']; ?>" /></div>
                            </div>
                      
						<tr>
          <td class="hidden">Success URI: </td>
          <td class="hidden" colspan="3"><input name="surl" value="http://localhost/htdocs/pay/success.php" readonly /></td>
        </tr>
        <tr>
          <td class="hidden">Failure URI: </td>
          <td class="hidden" colspan="3"><input name="furl" value="http://localhost/htdocs/pay/failure.php" size="64" readonly /></td>
        </tr>
						 <tr>
          <td colspan="3"><input type="hidden" name="service_provider" value="payu_paisa" size="64" readonly /></td>
        </tr>
		
                    
                    <!--SHIPPING METHOD END-->
				
                    <!--CREDIT CART PAYMENT-->
                    <div class="panel panel-info">
                        <div class="panel-heading"><span><i class="glyphicon glyphicon-check"></i></span> Review order</div>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-md-12"><strong style="color:teal;">Order total(shipping included:40):</strong></div>
                                <div class="col-md-12">
                                  <input type="text" class="form-control" name="amount" value="<?php echo (empty($posted['amount'])) ? '' : $posted['amount'] ?>" readonly />
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong style="color:teal;">Food name:</strong></div>
                                <div class="col-md-12">
								 <input type="text" class="form-control" name="country" value="<?php echo (empty($posted['country'])) ? '' : $posted['country']; ?>" readonly />
								</div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12"><strong style="color:teal;">Food quantity:</strong></div>
                                <div class="col-md-12">
								 <input type="text"  class="form-control" name="address1" value="<?php echo (empty($posted['address1'])) ? '' : $posted['address1']; ?>" readonly />
								</div>
                            </div>
                           
                            </div>
                          
                        </div>
                   
					  </div>
					
                    <!--CREDIT CART PAYMENT END-->
					 <tr>
          <?php if(!$hash) { ?>
            <td  colspan="4" ><input type="submit" class="add-to-cart" value="Pay now" /></td>
			
			
          <?php } ?>
        </tr>
        </div>
      </table>
    </form>
	
                </div>
				
                
                </form>
            </div>
           
    
  </body>
</html>
