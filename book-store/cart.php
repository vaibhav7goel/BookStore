<?php
require 'log.php';
require 'connect.php';
 
  if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])){
	@$user_id=$_SESSION['user_id'];
	
	
	if(isset($_GET['cart_del_pro'])){
		$cart_del_pro=$_GET['cart_del_pro'];
		$cart_del_qry="delete from cart where cart_product=$cart_del_pro";
		$cart_del=mysql_query($cart_del_qry);
	}
	
	if(isset($_GET['add_cart'])){
		$cart_pro_id=$_GET['add_cart'];
		if(!empty($cart_pro_id)){
			$check_repeat="select * from cart where customer_id='$user_id' and cart_product='$cart_pro_id'";
			$check_run=mysql_query($check_repeat);
			if($rows=mysql_num_rows($check_run)>0){
				//already added
			}else{
				$insert_cart="insert into cart values ($user_id,$cart_pro_id)";
				$run_insert=mysql_query($insert_cart);
			}
		}
	}
	
	if(isset($_POST['grandtotal']) && !empty($_POST['grandtotal'])){
		$fetch_cart_but="select cart_product from cart where customer_id=$user_id";
		$pd=mysql_query($fetch_cart_but);
		
				$get_bought_id=mysql_query("SELECT bought_id FROM bought ORDER BY bought_id DESC LIMIT 1");
				$get_bought_id2=mysql_fetch_array($get_bought_id);	
				$get_bought_id3=$get_bought_id2['bought_id'];				
				 $new_b_id3=$get_bought_id3+1;
				
		while($bought_order=mysql_fetch_array($pd)){
			//update order table
				$pro_id3=$bought_order['cart_product'];
				$ins_order="insert into orders(customer_id,cart_product,qty) values($user_id,$pro_id3,1)";
				mysql_query($ins_order);
			//update bought table
				
				mysql_query("insert into bought values($new_b_id3,$pro_id3,$user_id)");
		}
		$del_q="DELETE FROM cart WHERE customer_id=$user_id";
		$_SESSION['Products'] = "";
		header('Location: http://localhost/book-store/index.php');
	}
	else{
		
	}
	
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Cart | BookShop</title>
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
								<li><a href="#"><i class="fa fa-phone"></i> 1234567890</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> bookshop@gmail.com</a></li>
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
							<a href="index.php"><img src="images/home/111.png" width="20%"alt="" /></a>
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
								<li><a href="account.php"><i class="fa fa-user"></i>Account</a></li>
								<li><a href="wishlist.php"><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="logout.php"><i class="fa fa-lock"></i> Logout</a></li>
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
	
	<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="index.php">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description"></td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="quantity">Discount</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					
					<tbody>
					<?php
					$fetch_cart="select cart_product from cart where customer_id=$user_id";
		$res_cart=mysql_query($fetch_cart);
		$count_cart_products=mysql_num_rows($res_cart);
		if($count_cart_products!=0){
			while($total_products=mysql_fetch_array($res_cart)){
				$pro_id=$total_products['cart_product'];
				$get_products="select * from products where pro_id='$pro_id'";
					$res_products=mysql_query($get_products);
					while($row_products=mysql_fetch_array($res_products)){
						$pro_id2=$row_products['pro_id'];
						$pro_name=$row_products['pro_name'];
						$pro_price=$row_products['pro_price'];
						$pro_discount=$row_products['discount'];
						$pro_discounted_price=$row_products['discounted_price'];
						$pro_image=base64_encode($row_products['image']);
					?>
						<tr>
							<td class="cart_product">
								<img src='data:image/jpeg;base64,<?php echo $pro_image;?> ' alt='' />
							</td>
							<td class="cart_description">
								<h4><a href=""><?php echo $pro_name; ?></a></h4>
								<p><?php echo 'ID: '.$pro_id; ?></p>
							</td>
							<td class="cart_price">
								<p><?php echo 'Rs. '.$pro_price ?></p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
								<?php
										if(!isset($_POST['quantity'])){
											@$qty=1;
										}
										else{
										@$qty=$_POST['quantity'];
										}
								?>
									
								<form action="cart.php" method="POST">
									<input class="cart_quantity_input" type="text" name="quantity" value="
									<?php echo $qty; ?>" autocomplete="off" size="2">
									<button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
									</form>
								</div>
								
							</td>
							<td class="cart_price">
								<p><?php echo $pro_discount.'%'; ?></p>
							</td>
							<?php
								$pro_discounted_price2=$pro_discounted_price*$qty;
							?>
							<td class="cart_total">
								<p class="cart_total_price"><?php echo $pro_discounted_price2; ?></p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="cart.php?cart_del_pro=<?php echo $pro_id2;?>"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						
<?php
					@$total=$total + $pro_discounted_price2;
					}
			}
		}else{
			//cart empty
		}
		?>	
						
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			<div class="heading">
				<h3>Just One Step Away..</h3>
				<p></p>
			</div>
			<div class="row">
				<div class="col-sm-6">
				<!--
					<div class="chose_area">
						<ul class="user_option">
							<li>
								<input type="checkbox">
								<label>Use Coupon Code</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Use Gift Voucher</label>
							</li>
							<li>
								<input type="checkbox">
								<label>Estimate Shipping & Taxes</label>
							</li>
						</ul>
						<ul class="user_info">
							<li class="single_field">
								<label>Country:</label>
								<select>
									<option>United States</option>
									<option>Bangladesh</option>
									<option>UK</option>
									<option>India</option>
									<option>Pakistan</option>
									<option>Ucrane</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
								
							</li>
							<li class="single_field">
								<label>Region / State:</label>
								<select>
									<option>Select</option>
									<option>Dhaka</option>
									<option>London</option>
									<option>Dillih</option>
									<option>Lahore</option>
									<option>Alaska</option>
									<option>Canada</option>
									<option>Dubai</option>
								</select>
							
							</li>
							<li class="single_field zip-field">
								<label>Zip Code:</label>
								<input type="text">
							</li>
						</ul>
						<a class="btn btn-default update" href="">Get Quotes</a>
						<a class="btn btn-default check_out" href="">Continue</a>
					</div>
				-->	
				</div>
				<div class="col-sm-6">
					<div class="total_area">
					
						<ul>
							<li>Cart Sub Total <span><?php echo 'Rs '.@$total; ?></span></li>
							<li>Shipping Cost <span>Free</span></li>
							<li>Total <span><?php echo 'Rs '.@$total; ?></span></li>
						</ul>
							<form action="cart.php" method="POST">
								GRAND TOTAL: <input type="text" name="grandtotal" value=<?php echo @$total; ?> readonly><br>
								<button type='submit'>Checkout/Buy</button>
							</form>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->

	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>Book</span>Shop</h2>
							<p>some text dude</p>
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
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.scrollUp.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
<?php
}else{
	include 'login.php';
}
?>