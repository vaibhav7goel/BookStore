<?php
 require 'connect.php';
 require 'log.php';
 $current_php_page = @$_SERVER['SCRIPT_NAME'];
 if(isset($_POST['user_name'])&&isset($_POST['user_email'])){
   $username=$_POST['user_name'];
   $password=$_POST['user_email'];
   //$hash_pass=md5($password);
  $hash_pass=password_hash($password, PASSWORD_DEFAULT);
   
   if(!empty($username)&&!empty($hash_pass)){
     $email = $username;
		if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
			$qry="select Id,password from users where 
		email ='".mysql_real_escape_string($username)."' or phone ='".mysql_real_escape_string($username)."' ";
			if($q_run=mysql_query($qry)){
			$num_rows=mysql_num_rows($q_run);
			$passw=mysql_result($q_run,0,'password');
				if($num_rows==0){
					
					echo "not registered yet";
				
				}else if(password_verify($password,$passw)){  
				$user_id=mysql_result($q_run,0,'Id');
				echo $user_id;
				$_SESSION['user_id']=$user_id; 
				header("Location:$current_php_page"); 
				}else{
					echo "database failure";
				}
				
		
			}
		}else{
			echo 'This is an invalid email.';	
		}
    }else{
	  ?>
		    
		   <div id="invalid">
			  <strong>Fill all the fields</strong>
			</div>
		   
		  <?php
	}
 }
 
 
 //sign up form 
if(isset($_POST['f_name']) && isset($_POST['l_name']) && (isset($_POST['email']) || isset($_POST['phone'])) && isset($_POST['pass'])){
	$f_name=$_POST['f_name'];
	$l_name=$_POST['l_name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$pas=$_POST['pass'];
	
	$q="select count(Id) from users";
	 $r=mysql_query($q);
	 $ro=mysql_fetch_array($r);
		$i=$ro['count(Id)'] + 1;
		//$hash=md5($pas);
		$hash=password_hash($pas, PASSWORD_DEFAULT);
  
	if(!empty($f_name) && !empty($l_name) && (!empty($email) || !empty($phone)) && !empty($hash)){
		$insert="insert into users values('$i','$f_name','$l_name','$email','$phone','$hash') ";
			if($r=mysql_query($insert)){
				header('Location:index.php');
			}
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Login | E-Shopper</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/price-range.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
	<link href="css/main.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">	
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
			<!--					<li><a href="#"><i class="fa fa-linkedin"></i></a></li> 
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>-->
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.php"><img src="images/home/logo.png" alt="" /></a>
						</div>
						<!--
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canada</a></li>
									<li><a href="#">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Pound</a></li>
								</ul>
							</div>
						</div>
						-->
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-user"></i> Account</a></li>
								<li><a href="#"><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="index.php">New Books</a></li>
										<li><a href="old.php">Old Books</a></li>  
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Stationaries<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="#">Pens</a></li>
										<li><a href="#">Diaries and Notebooks</a></li>
										<li><a href="#">Calculators</a></li>
										<li><a href="#">More...</a></li>
                                    </ul>
                                </li> 
								
								<li><a href="contact-us.html">Contact	</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Type Book Or Author Name ....."/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="<?php echo $current_php_page; ?>" method="POST">
							<input type="text" placeholder="Email or Phone" name="user_name" />
							<input type="password" placeholder="Password"  name="user_email"/>
							<button type="submit" class="btn btn-default" name="submit">Login</button>
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="<?php echo $current_php_page; ?>" method="POST">
							<input type="text" placeholder="First Name" name="f_name"/>
							<input type="text" placeholder="Last Name"name="l_name" />
							<input type="text" placeholder="Email" name="email"/>
							<input type="text" placeholder="Phone" name="phone"/>
							<input type="password" placeholder="Password" name="pass"/>
							<button type="submit" class="btn btn-default">Signup</button>
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>e</span>-shopper</h2>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="col-sm-3">
						<!--	<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe1.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe2.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe3.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						
						<div class="col-sm-3">
							<div class="video-gallery text-center">
								<a href="#">
									<div class="iframe-img">
										<img src="images/home/iframe4.png" alt="" />
									</div>
									<div class="overlay-icon">
										<i class="fa fa-play-circle-o"></i>
									</div>
								</a>
								<p>Circle of Hands</p>
								<h2>24 DEC 2014</h2>
							</div>
						</div>
						-->
					</div>
					<!--
					<div class="col-sm-3">
						<div class="address">
							<img src="images/home/map.png" alt="" />
							<p>INDIA</p>
						</div>
					</div>
					-->
				</div>
			</div>
		</div>
		
		<div class="footer-widget">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Contact Us</h2>
							<ul class="nav nav-pills nav-stacked">
								<br>
								<li><font size='3' color='black'>Phone : </font><font color="#8C8C88">1234567890</font></li>
								<br>
								<li><font size='3' color='black'>Email : </font><font color="#8C8C88">abc@gmail.com</font></li>
								
							</ul>
						</div>
					</div>
					<!--
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>Quock Shop</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">T-Shirt</a></li>
								<li><a href="#">Mens</a></li>
								<li><a href="#">Womens</a></li>
								<li><a href="#">Gift Cards</a></li>
								<li><a href="#">Shoes</a></li>
							</ul>
						</div>
					</div>
					-->
					<div id="line1">
					</div>
					<div id= "pol" class="col-sm-2">
						<div class="single-widget">
							<h2>Policies</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="TermsOfUse.php">Terms of Use</a></li>
								<li><a href="privacy.php">Privacy Policy</a></li>
								<li><a href="refund.php">Cancellation</a></li>
								<li><a href="payment.php">Payment Mode</a></li>
							</ul>
						</div>
					</div>
					<!--
					<div class="col-sm-2">
						<div class="single-widget">
							<h2>About Shopper</h2>
							<ul class="nav nav-pills nav-stacked">
								<li><a href="#">Company Information</a></li>
								<li><a href="#">Careers</a></li>
								<li><a href="#">Store Location</a></li>
								<li><a href="#">Affillate Program</a></li>
								<li><a href="#">Copyright</a></li>
							</ul>
						</div>
					</div>
					-->
					<div id="subs" class="col-sm-3 col-sm-offset-1">
						<div class="single-widget">
							<h2 >Subscribe Us</h2>
							<form action="#" class="searchform">
								<input type="text" placeholder="Your email address" />
								<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
								<p>Get the most recent updates from <br />our site and be updated your self...</p>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		
		<div class="footer-bottom">
			<div class="container">
				<div class="row">
					<p class="pull-left">Copyright © ............... All rights reserved.</p>
					<p class="pull-right">Designed by <span><a target="_blank" href="#">........</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
	

  
    <script src="js/jquery.js"></script>
	<script src="js/price-range.js"></script>
    <script src="js/jquery.scrollUp.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>