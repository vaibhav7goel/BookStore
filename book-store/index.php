<?php
require 'connect.php';
 require 'log.php';
 $login_button='Login';
 $user="";
 $output="";
 
 if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])){
	@$user_id=$_SESSION['user_id'];
	$login_button='Logout';
	$l='index.php?add_cart=$pro_id';
	$sql="SELECT * FROM users WHERE Id='$user_id'";
		$run=mysql_query($sql);
		$row=mysql_fetch_array($run);
 }
 


 
 function product(){
	if(!isset($_GET['cat'])){
				
					$get_products='select * from products order by rand() limit 0,6 ';
					$res_products=mysql_query($get_products);
					while($row_products=mysql_fetch_array($res_products)){
						$pro_id=$row_products['pro_id'];
						$pro_name=$row_products['pro_name'];
						$pro_price=$row_products['pro_price'];
						$pro_discount=$row_products['discount'];
						$availability=$row_products['availability'];
						$pro_image=base64_encode($row_products['image']);
						
						
					//	$pro_image=$row_products['pro_image'];
					
				
						
					    echo"<div class='col-sm-4'>
							<div class='product-image-wrapper'>
								<div class='single-products'>
										<div class='productinfo text-center'>
											<img src='data:image/jpeg;base64,$pro_image' alt='' />

											<h2>Rs $pro_price</h2>
											<p>$pro_name</p>

											<a href='cart.php?add_cart=$pro_id' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>
											
										</div>
										<div class='product-overlay'>
											<div class='overlay-content'>
												<h2>$pro_discount% OFF</h2>
											<p>$availability</p>
											</div>
										</div>
								</div>
								<div class='choose'>
									<ul class='nav nav-pills nav-justified'>
										<li><a href='#'><i class='fa fa-plus-square'></i>Add to wishlist</a></li>
										<li><a href='product-details.php?pro_id=$pro_id'><i class='fa fa-plus-square'></i>Details</a></li>
									</ul>
								</div>
							</div>
						</div>";
					}
				}
 }
 
 function product_cat(){
	
	if(isset($_GET['cat'])){
				$cat_id=$_GET['cat'];
					$get_products_cat="select * from products where product_cat='$cat_id'";
					$res_products_cat=mysql_query($get_products_cat);
					$count_pro=mysql_num_rows($res_products_cat);
				if($count_pro!=0){	
					while($row_products_cat=mysql_fetch_array($res_products_cat)){
						$pro_id=$row_products_cat['pro_id'];
						$pro_name=$row_products_cat['pro_name'];
						$pro_price=$row_products_cat['pro_price'];
					//	$pro_image=$row_products['pro_image'];
					
				
						
					    echo"<div class='col-sm-4'>
							<div class='product-image-wrapper'>
								<div class='single-products'>
										<div class='productinfo text-center'>
											<img src='images/home/product1.jpg' alt='' />
											<h2>$pro_price</h2>
											<p>$pro_name</p>
											<a href='cart.php?add_cart=$pro_id' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>
										</div>
										<div class='product-overlay'>
											<div class='overlay-content'>
												<h2>20% OFF</h2>
											<p>Available Soon</p>
											</div>
										</div>
								</div>
								<div class='choose'>
									<ul class='nav nav-pills nav-justified'>
										<li><a href='#'><i class='fa fa-plus-square'></i>Add to wishlist</a></li>
										<li><a href='product-details.php?pro_id=$pro_id'><i class='fa fa-plus-square'></i>Details</a></li>
									</ul>
								</div>
							</div>
						</div>";
					}
				}else{
				       //insert image for no products available now
					   //but you can contact us 
				echo"	<section id='advertisement'>
						<div class='container'>
							<img src='images/shop/advertisement.jpg' alt='' /> 
						</div>
					</section>";

				}	
	}
 }
 function subscribe(){
	if(isset($_POST['email'])){
		if(!empty($_POST['email'])){
			$user_email=$_POST['email'];
				$check_email=mysql_query("select * from subscriptions where email='$user_email'");
				$count_em=mysql_num_rows($check_email);
				if($count_em==0){
					$insert_email="insert into subscriptions values ('$user_email')";
					mysql_query($insert_email);
					//image for successfully subscribed
				}else{
					//image for already subscribed
				}
	    }
	}
 }
 subscribe();

 
	

if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])){
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
}else{
	
}

	
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Home | BOOKSHOP</title>
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
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js">
	</script>
	
	
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">	
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +0000000000</a></li>
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
							<?php
								if(!empty($_SESSION['user_id'])){
									$user=$row['f_name'];
							    }
							?>
								<li><a href="account.php"><i class="fa fa-user"></i><?php echo $user ?>(Account)</a></li>
								<li><a href="wishlist.php"><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="<?php echo $login_button; ?>.php"><i class="fa fa-lock"></i><?php echo $login_button ?></a></li>
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
								<li><a href="index.html" class="active">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="index.html">New Books</a></li>
										<li><a href="old.html">Old Books</a></li>  
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
						<form action="index.php" method="POST">
							<input type="text" placeholder="Type Book Or Author Name ....." onkeydown="searchq();"/>
							
						</form>	
						</div>
						<div id="search_output">
						
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	

	<section id="slider"><!--slider-->
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">	
								<div class="col-sm-6">
									<img src="images/f.jpg" />
									
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<img src="images/e.jpg"  />	
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<img src="images/d.jpg"  />	<!--height=900,width=500-->
								</div>
							</div>
							
							
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	
	<section id="b">
	
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="left-sidebar">
						<h2>Categories</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
						<!-- query to get categories from table -->
							<?php
								$qry_categories='select * from categories';
								$run_categories=mysql_query($qry_categories);
								
								while($row_categories=mysql_fetch_array($run_categories)){
									$cat_id=$row_categories['cat_id'];
									$cat_name=$row_categories['cat_name'];
									
									

									echo"<div class='panel panel-default'>
											<div class='panel-heading'>
												<h4 class='panel-title'>
													<a href='index.php?cat=$cat_id'>
														$cat_name
													</a>
												</h4>
											</div>	
										</div>";
								}
							?>
							
							
						</div><!--/category-products-->
					<!--
						<div class="brands_products">
							<h2>AUTHORS</h2>
							<div class="brands-name">
								<ul class="nav nav-pills nav-stacked">
									<li><a href="#"> <span class="pull-right">(50)</span>Acne</a></li>
									<li><a href="#"> <span class="pull-right">(56)</span>Grüne Erde</a></li>
									<li><a href="#"> <span class="pull-right">(27)</span>Albiro</a></li>
									<li><a href="#"> <span class="pull-right">(32)</span>Ronhill</a></li>
									<li><a href="#"> <span class="pull-right">(5)</span>Oddmolly</a></li>
									<li><a href="#"> <span class="pull-right">(9)</span>Boudestijn</a></li>
									<li><a href="#"> <span class="pull-right">(4)</span>Rösch creative culture</a></li>
								</ul>
							</div>
						</div>
					
						<div class="price-range">
							<h2>Price Range</h2>
							<div class="well text-center">
								 <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
								 <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
							</div>
						</div><!--/price-range-->
						
						
					
					</div>
				</div>
				
				
				
				<div class="col-sm-9 padding-right">
					
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Features Items</h2>
						
						<!-- fetching product data -->
			<?php
				product();
				product_cat();
			?>
						
						
						
					</div><!--features_items-->
					
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#tshirt" data-toggle="tab">ACADEMIC</a></li>
								<li><a href="#blazers" data-toggle="tab">LITERATURE</a></li>
								<li><a href="#sunglass" data-toggle="tab">NON-FICTION</a></li>
								<li><a href="#kids" data-toggle="tab">PROFESSIONAL</a></li>
								<li><a href="#poloshirt" data-toggle="tab">NEW RELEASE</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="tshirt" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book1.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book2.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book3.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book4.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="blazers" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book4.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book3.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book2.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book4.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="sunglass" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book3.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book4.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book1.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book2.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="kids" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book1.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book2.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book3.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book4.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
							
							<div class="tab-pane fade" id="poloshirt" >
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book2.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book4.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book3.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
												<img src="images/home/book1.jpg" alt="" />
												<h2>Rs 250</h2>
												<p>book</p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div><!--/category-tab-->
					<?php
		
				$get_products='select * from products' ;
					$res_products=mysql_query($get_products);
					$prod[]=array();//array with all products ids
					
					
					while($row_products=mysql_fetch_array($res_products)){
						$pro_id=$row_products['pro_id'];
						$prod[]=$pro_id;
						
					}
					
					$prod2[]=array();
					$prod2=$prod;
					
					mysql_query("delete from product_matrix");
					//update pairs in pro matrix
					for($pc=1;$pc<count($prod);$pc++){
						for($pc2=$pc+1;$pc2<count($prod);$pc2++){
							//echo $prod[$pc]; 
							//echo $prod[$pc2].'<br>';
							mysql_query("insert into product_matrix(pro_1,pro_2) values($prod[$pc],$prod[$pc2])");
						}
					}
					
					
					//now we neet to update matrix from the bought table
					$dd1=mysql_query("select * from product_matrix");
					while($dd2=mysql_fetch_array($dd1)){
						$dd3=$dd2['pro_1'];
						$dd4=$dd2['pro_2'];
						
						$temm[]=array();
						$temm2[]=array();
						$ddx1=mysql_query("select * from bought where product_b_id=$dd3");
						while($ddx=mysql_fetch_array($ddx1)){
							 $ddb6=$ddx['Bought_id'];
							 $temm[]=$ddb6;
							 
						}
						
						//print_r($temm);
						$ddb3=mysql_query("select * from bought where product_b_id=$dd4");
						while($ddb4=mysql_fetch_array($ddb3)){
							@$temm2[]=$ddb4['Bought_id'];
						}
						$cnt=0;
						for($tt=1;$tt<count($temm);$tt++){
							for($tt1=1;$tt1<count($temm2);$tt1++){
								if($temm[$tt]==$temm2[$tt1]){
									$cnt++;
								}
							}
						}
						
						//echo $cnt;
						mysql_query("update product_matrix set matrix_count=$cnt where pro_1=$dd3 && pro_2=$dd4");
						unset($temm);
						unset($temm2);
						
					}
		?>
		<?php
				//page visits in 5 min interval
				
				$xx1=mysql_query("select * from visit_records where date_visit<21-5-2017");
				
				while($xx2=mysql_fetch_array($xx1)){
					echo $xx2['id_visit'];
				}
				
				//updating no of items bought individually
				for($vr=1;$vr<count($prod2);$vr++){
					$cnnt=0;
					
					$ff1=mysql_query("select * from bought where product_b_id=$prod2[$vr]");
					$cnnt=mysql_num_rows($ff1);
					mysql_query("update products set times_bought=$cnnt where pro_id=$prod2[$vr]");
				}
				
				//different products in 5 min interval
				$gg1=mysql_query("select * from visit_records s1, visit_records s2 where s1.user_visit=s2.user_visit and timestampdiff(minute,s1.date_visit,s2.date_visit)<5 and date(s1.date_visit)=date(s2.date_visit) and s1.id_visit != s2.id_visit");
				
				mysql_query("update product_matrix set visit_cnt=0");//make visit_cnt column 0
				
				while($gg2=mysql_fetch_array($gg1)){
					$gg3=$gg2['2'];//page1
					$gg4=$gg2['6'];//page2
					
					$hh1=mysql_query("update product_matrix set visit_cnt=visit_cnt+1 where (pro_1=$gg3 && pro_2=$gg4) or (pro_1=$gg4 && pro_2=$gg3)");
					
				}
			
				//trigger for visit and bought score update
					$yy1=mysql_query("select * from product_matrix");
					while($yy2=mysql_fetch_array($yy1)){
						$yy3=$yy2['pro_1'];
						$yy4=$yy2['pro_2'];
						$yy9=$yy2['matrix_count'];
						$yy10=$yy2['visit_cnt'];
						
						$yy5=mysql_query("select product_views,times_bought from products where pro_id=$yy3");
						$yy6=mysql_fetch_array($yy5);
						$yy6_view=$yy6['product_views'];
						$yy6_bought=$yy6['times_bought'];
						
						$yy7=mysql_query("select product_views,times_bought from products where pro_id=$yy4");
						$yy8=mysql_fetch_array($yy7);
						$yy8_view=$yy8['product_views'];
						$yy8_bought=$yy8['times_bought'];
						
						@$bought_score1=($yy9*$yy9)/($yy6_bought*$yy8_bought);
						$bought_score=round($bought_score1,3);
						
						@$view_score1=($yy10*$yy10)/($yy6_view*$yy8_view);
						$view_score=round($view_score1,3);
						
						@mysql_query("update product_matrix set score_bought=$bought_score,score_visit=$view_score where pro_1=$yy3 && pro_2=$yy4");
						
					}
		?>		
		<?php
				//recommend from user product visits
				$kk6[]=array();
				$kk1=mysql_query("select page_visit from visit_records where user_visit=$user_id");
				while($kk2=mysql_fetch_array($kk1)){
					$kk3=$kk2['page_visit'];
					
					$kk4=mysql_query("select * from product_matrix where score_visit=(select max(score_visit) from product_matrix where pro_1=$kk3 or pro_2=$kk3)");
					$kk5=mysql_fetch_array($kk4);
					
					$kktemp=$kk5['pro_1'];
					if($kktemp==$kk3){
						$kk6[]=$kk5['pro_2'];
					}else{
						$kk6[]=$kk5['pro_1'];
					}	
					//array $kk6 has ids of reccommended products by product visits
					
					$kk7=mysql_query("select * from product_matrix where score_bought=(select max(score_bought) from product_matrix where pro_1=$kk3 or pro_2=$kk3)");
					$kk8=mysql_fetch_array($kk7);
					
					$kktemp2=$kk8['pro_1'];
					if($kktemp2==$kk3){
						$kk6[]=$kk8['pro_2'];
					}else{
						$kk6[]=$kk8['pro_1'];
					}	
					
				}
				
				@$kk6=array_unique($kk6);
				
				//now kk7 has ids of products from both bought and visit history
		?>
					<div class="recommended_items">
						<h2 class="title text-center">recommended items from your history</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
								
									<?php
									for($vvr=1;$vvr<=count($kk6);$vvr++){
									@$mm1=mysql_query("select * from products where pro_id=$kk6[$vvr]");
									
									@$mm0=mysql_fetch_array($mm1);
									if(@mysql_num_rows($mm1)!=0){
									$mm2=$mm0['pro_price'];
									$mm3=$mm0['pro_name'];
									$mm4=base64_encode($mm0['image']);
									echo "<div class='col-sm-4'>
										<div class='product-image-wrapper'>
											<div class='single-products'>
												<div class='productinfo text-center'>
													<img src='data:image/jpeg;base64,$mm4' alt='' />
													<h2>$mm2</h2>
													<p>$mm3</p>
													<a href='#' class='btn btn-default add-to-cart'><i class='fa fa-shopping-cart'></i>Add to cart</a>
												</div>
												
											</div>
										</div>
									</div>";
									}
									}
									?>
									
								</div>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div> 
					
					<?php
							//racommend from user set
							$ssr[]=array();
							$ss1=@mysql_query("select * from bought where user_b_id=$user_id");
							while($ss2=mysql_fetch_array($ss1)){
								$ssr[]=$ss2['Product_b_id'];
							}
							$ssr=@array_unique($ssr);
							//$ssr contains all bought items unique
							$user_it[]=array();
							
						for($us1=4;$us1<6;$us1++){	
							for($ssi=1;$ssi<=count($ssr);$ssi++){
								$ss3=@mysql_query("select * from bought where Product_b_id=$ssr[$ssi] && user_b_id=$us1");
								if(@mysql_num_rows($ss3)!=0){
									@$user_it[$us1]++;
								}
								
							}
						}
						//$user_it contains similar product count for all users 
						$rec_prod[]=array();
						for($us2=4;$us2<=count($user_it);$us2++){
							if($user_it[$us2]>=2){
								$ss6=mysql_query("select * from bought where user_b_id=$us2");
								while($ss7=mysql_fetch_array($ss6)){
									$rec_prod[]=$ss7['Product_b_id'];
								}
							}
						}
						$rec_prod=array_unique($rec_prod);
						
						$rec_prod=@array_diff($rec_prod,$ssr);
					?>
					
				</div>
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		<div class="footer-top">
			<div class="container">
				<div class="row">
					<div class="col-sm-2">
						<div class="companyinfo">
							<h2><span>Book</span>Shop</h2>
							<p>Shop like never Before</p>
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
								<li><font size='3' color='black'>Phone : </font><font color="#8C8C88">1234567890</font>  </li>
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
							<form action="index.php" class="searchform" method="POST">
								<input type="text" placeholder="Your email address" name="email"/>
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
	<script src="js/price-range.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/main.js"></script>
	<script src="js/my.js"></script>
	<script src="js/popup.js"></script>
</body>
</html>
