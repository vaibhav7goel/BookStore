<?php
require 'connect.php';
 require 'log.php';
 ?>

<?php
	
            $myfile = fopen("myrate.txt", "r") or die("Unable to open file!");
            $ad=[];

        while(!feof($myfile)) {
          $ad[]=fgets($myfile);
        }
        //echo $ad[0];
        fclose($myfile);

        $filecontents = file_get_contents("myrate.txt");

        $words = preg_split('/[\s]+/', $filecontents, -1, PREG_SPLIT_NO_EMPTY);

        $cars = array
          (
          array("words",0)

          );

         $ct=count($words);
         $f=0;
        for($i=0;$i<=5;$i++){
            for($j=0;$j<=1;$j++){

                $cars[$i][$j]=$words[$f];
                $f++;	
            }

        }


function naive_bays(){
	//this func train with positive file
	
		$positivefile = fopen("positive.txt", "r") or die("Unable to open file!");
		
		
		
		// Output one line until end-of-file
		
		  $single_line=file_get_contents("positive.txt");
		  $words2 = preg_split('/[\s]+/', $single_line, -1, PREG_SPLIT_NO_EMPTY);
			
				$flag1=0;
				$trunk="TRUNCATE TABLE vocab";
				//mysql_query($trunk);
			//this for loop saving unique words from positive file to database	
			for($j=0;$j<count($words2);$j++){
				$temp=$words2[$j];
				$flag1=0;
				
				
				$select_check="select vocab_name from vocab";
				$vocab_name=mysql_query($select_check);
				
				while($vocab_n=mysql_fetch_array($vocab_name)){
						$vocab_n2=$vocab_n['vocab_name'];
						
						if($vocab_n2==$temp){
							$flag1=1;
						}
				}
				
				if($flag1==0){
					
					$insert_in_vocab="insert into vocab(vocab_name) values('$temp')";
					mysql_query($insert_in_vocab);
				}

			}
			fclose($positivefile);
			
		
			
			$select_check="select vocab_name from vocab";
				$vocab_name=mysql_query($select_check);
				$score_g=0;
			
				while($vocab_n=mysql_fetch_array($vocab_name)){
						$vocab_n2=$vocab_n['vocab_name'];
						
						$positivefile = fopen("positive.txt", "r") or die("Unable to open file!");
						while(!feof($positivefile)){
							$sin_line=fgets($positivefile);
							$word_line = preg_split('/[\s]+/', $sin_line, -1, PREG_SPLIT_NO_EMPTY);
							//print_r($word_line);
								for($k=0;$k<count($word_line);$k++){
									$temp2=$word_line[$k];
									
										if($temp2==$vocab_n2){
											$score_g++;
											break;
										}
								}
								
								
						}	
						fclose($positivefile);
						//score_g is score for in how many lines each word is present
						$save_good="update vocab set vocab_g_count=$score_g where vocab_name='$vocab_n2'";
						mysql_query($save_good);
						$score_g=0;
				}
			
		   

}
function naive_bays2(){
	//this func train with negative file(saved as positive 2)
	
		$positivefile = fopen("positive2.txt", "r") or die("Unable to open file!");
		
		
		
		// Output one line until end-of-file
		
		  $single_line=file_get_contents("positive2.txt");
		  $words2 = preg_split('/[\s]+/', $single_line, -1, PREG_SPLIT_NO_EMPTY);
			
				$flag1=0;
			//	$trunk="TRUNCATE TABLE vocab";
			//	mysql_query($trunk);
			//this for loop saving unique words from negative file to database	
			for($j=0;$j<count($words2);$j++){
				$temp=$words2[$j];
				$flag1=0;
				
				
				$select_check="select vocab_name from vocab";
				$vocab_name=mysql_query($select_check);
				
				while($vocab_n=mysql_fetch_array($vocab_name)){
						$vocab_n2=$vocab_n['vocab_name'];
						
						if($vocab_n2==$temp){
							$flag1=1;
						}
				}
				
				if($flag1==0){
					
					$insert_in_vocab="insert into vocab(vocab_name) values('$temp')";
					mysql_query($insert_in_vocab);
				}

			}
			fclose($positivefile);
			
		
			
			$select_check="select vocab_name from vocab";
				$vocab_name=mysql_query($select_check);
				$score_g=0;
			
				while($vocab_n=mysql_fetch_array($vocab_name)){
						$vocab_n2=$vocab_n['vocab_name'];
						
						$positivefile = fopen("positive2.txt", "r") or die("Unable to open file!");
						while(!feof($positivefile)){
							$sin_line=fgets($positivefile);
							$word_line = preg_split('/[\s]+/', $sin_line, -1, PREG_SPLIT_NO_EMPTY);
							//print_r($word_line);
								for($k=0;$k<count($word_line);$k++){
									$temp2=$word_line[$k];
									
										if($temp2==$vocab_n2){
											$score_g++;
											break;
										}
								}
								
								
						}	
						fclose($positivefile);
						//score_g is score for in how many lines each word is present
						$save_good="update vocab set vocab_n_count=$score_g where vocab_name='$vocab_n2'";
						mysql_query($save_good);
						$score_g=0;
				}
			
		   

}


function naive_bays3(){
	//this func train with positive file
	
		$positivefile = fopen("positive_train.txt", "r") or die("Unable to open file!");
		
		
		
		// Output one line until end-of-file
		
		  $single_line=file_get_contents("positive_train.txt");
		  $words2 = preg_split('/[\s]+/', $single_line, -1, PREG_SPLIT_NO_EMPTY);
			
				$flag1=0;
				$trunk="TRUNCATE TABLE vocab";
				//mysql_query($trunk);
			//this for loop saving unique words from positive file to database	
			for($j=0;$j<count($words2);$j++){
				$temp=$words2[$j];
				$flag1=0;
				
				
				$select_check="select vocab_name from vocab";
				$vocab_name=mysql_query($select_check);
				
				while($vocab_n=mysql_fetch_array($vocab_name)){
						$vocab_n2=$vocab_n['vocab_name'];
						
						if($vocab_n2==$temp){
							$flag1=1;
						}
				}
				
				if($flag1==0){
					
					$insert_in_vocab="insert into vocab(vocab_name) values('$temp')";
					mysql_query($insert_in_vocab);
				}

			}
			fclose($positivefile);
			
		
			
			$select_check="select vocab_name from vocab";
				$vocab_name=mysql_query($select_check);
				$score_g=0;
			
				while($vocab_n=mysql_fetch_array($vocab_name)){
						$vocab_n2=$vocab_n['vocab_name'];
						
						$positivefile = fopen("positive_train.txt", "r") or die("Unable to open file!");
						while(!feof($positivefile)){
							$sin_line=fgets($positivefile);
							$word_line = preg_split('/[\s]+/', $sin_line, -1, PREG_SPLIT_NO_EMPTY);
							//print_r($word_line);
								for($k=0;$k<count($word_line);$k++){
									$temp2=$word_line[$k];
									
										if($temp2==$vocab_n2){
											$score_g++;
											break;
										}
								}
								
								
						}	
						fclose($positivefile);
						//score_g is score for in how many lines each word is present
						$save_good="update vocab set vocab_g_count=$score_g where vocab_name='$vocab_n2'";
						mysql_query($save_good);
						$score_g=0;
				}
			
		   

}
function naive_bays4(){
	//this func train with negative file(saved as positive 2)
	
		$positivefile = fopen("positive4.txt", "r") or die("Unable to open file!");
		
		
		
		// Output one line until end-of-file
		
		  $single_line=file_get_contents("positive4.txt");
		  $words2 = preg_split('/[\s]+/', $single_line, -1, PREG_SPLIT_NO_EMPTY);
			
				$flag1=0;
			//	$trunk="TRUNCATE TABLE vocab";
			//	mysql_query($trunk);
			//this for loop saving unique words from negative file to database	
			for($j=0;$j<count($words2);$j++){
				$temp=$words2[$j];
				$flag1=0;
				
				
				$select_check="select vocab_name from vocab";
				$vocab_name=mysql_query($select_check);
				
				while($vocab_n=mysql_fetch_array($vocab_name)){
						$vocab_n2=$vocab_n['vocab_name'];
						
						if($vocab_n2==$temp){
							$flag1=1;
						}
				}
				
				if($flag1==0){
					
					$insert_in_vocab="insert into vocab(vocab_name) values('$temp')";
					mysql_query($insert_in_vocab);
				}

			}
			fclose($positivefile);
			
		
			
			$select_check="select vocab_name from vocab";
				$vocab_name=mysql_query($select_check);
				$score_g=0;
			
				while($vocab_n=mysql_fetch_array($vocab_name)){
						$vocab_n2=$vocab_n['vocab_name'];
						
						$positivefile = fopen("positive4.txt", "r") or die("Unable to open file!");
						while(!feof($positivefile)){
							$sin_line=fgets($positivefile);
							$word_line = preg_split('/[\s]+/', $sin_line, -1, PREG_SPLIT_NO_EMPTY);
							//print_r($word_line);
								for($k=0;$k<count($word_line);$k++){
									$temp2=$word_line[$k];
									
										if($temp2==$vocab_n2){
											$score_g++;
											break;
										}
								}
								
								
						}	
						fclose($positivefile);
						//score_g is score for in how many lines each word is present
						$save_good="update vocab set vocab_n_count=$score_g where vocab_name='$vocab_n2'";
						mysql_query($save_good);
						$score_g=0;
				}
			
		   

}


function good_bad(){
	
	$qry="select * from vocab";
	$q_res=mysql_query($qry);
	while($q_row=mysql_fetch_array($q_res)){
		$good=$q_row['vocab_g_count'];
		$bad=$q_row['vocab_n_count'];
		$id=$q_row['vocab_id'];
		
		
		@$goodness=$good/($good+$bad);
		@$badness=$bad/($good+$bad);
		//$goodness=round($goodness,3);
		
		$qry2="update vocab set goodness=$goodness, badness=$badness where vocab_id=$id";
		$qry2_res=mysql_query($qry2);
		
	}
	
}
if(isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])){
	@$user_id_visit=$_SESSION['user_id'];
	@$visit_pro=$_GET['pro_id'];
	
	mysql_query("insert into visit_records(user_visit,page_visit) values($user_id_visit,$visit_pro) ");
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Product Details | E-Shopper</title>
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
<?php

naive_bays();
naive_bays2();
naive_bays3();
naive_bays4();
good_bad();

?>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">	
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> 99889988998899</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> bookstore@gmail.com</a></li>
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
								<li><a href="account.php"><i class="fa fa-user"></i> Account</a></li>
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
                                        <li><a href="index.html">New Books</a></li>
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
								
								<li><a href="contact-us.php">Contact	</a></li>
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
	<section id="advertisement">
		<div class="container">
			<img src="images/shop/advertisement.jpg" alt="" />
		</div>
	</section>
	
	<section>
	
	<?php
		if(isset($_GET['pro_id'])){
			$pro_id=$_GET['pro_id'];
            
           
            
            mysql_query("update products set product_views=product_views+1 where pro_id='$pro_id' ");
            //fetch product
			$get_products="select * from products where pro_id='$pro_id'";
					$res_products=mysql_query($get_products);
					while($row_products=mysql_fetch_array($res_products)){
						$pro_id=$row_products['pro_id'];
						$pro_name=$row_products['pro_name'];
						$pro_mrp=$row_products['pro_price'];
						$pro_discount=$row_products['discount'];
						$pro_price=$row_products['discounted_price'];
						$pro_cat=$row_products['product_cat'];
						$pro_aut=$row_products['author'];
	?>
	
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					
					
				</div>
				
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="images/product-details/gmat20.png" alt="" />
								
							</div>
							
						</div>
						
						<div class="col-sm-7">
						<div class="pd2">
							<div class="product-information"><!--/product-information-->
							
								
								<h1><?php echo $pro_name ?></h1>
								<p><b>Book ID:</b> 1089772</p>
								<img src="images/product-details/rating.png" alt="" />
								<br>
								<br>
								<p><b>MRP:</b> <?php echo $pro_mrp ?> Rs</p>
								<p><b>Discount:    </b><?php echo $pro_discount ?> %</p>
								
								
								<span>
								
									<span>Rs. <?php echo $pro_price ?></span>
									
									<form action="">
									<button type="submit" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Buy
									</button>
									<form>
									<button id="wish" type="submit" class="btn btn-fefault cart">
										
										Add to Wishlist
									</button>
									
									<button id="wish" type="submit" class="btn btn-fefault cart">
										<a id='comment_but'href='product-comments.php?pro_id=<?php echo $pro_id ?>'>Comment</a>
									</button>
									 
									
								</span>
								<p><b>Availability:</b><span id="txt">In Stock<span></p>
								<p><b>Condition:</b> New</p>
								
							</div><!--/product-information-->
							</div>
						</div>
					</div><!--/product-details-->
			
					</div>
					<div class="detailsofproduct">
					
						<table class="dop">
                            
					<thead>
						<tr class="table_dop">
							<td class="image" colspan="2">Book Details </td>
							
							<td></td>
						</tr>
					</thead>
                            
					<tbody>
						<tr class="table_dop2">
							<td>ISBN</td>
							<td>1233423423</td>
						</tr>
						<tr class="table_dop2">
							<td>Publisher</td>
							<td>its going to be fun</td>
						</tr>
						<tr class="table_dop2">
							<td>No of Pages</td>
							<td>not a matter of fact</td>
						</tr>
						<tr class="table_dop2">
							<td>Binding</td>
							<td>not a matter of fact</td>
						</tr>	
						<tr class="table_dop2">
							<td>Edition</td>
							<td>not a matter of fact</td>
						</tr>	
						<tr class="table_dop2">
							<td>Year</td>
							<td>not a matter of fact</td>
						</tr>	
						<tr class="table_dop2">
							<td>Book Type</td>
							<td>not a matter of fact</td>
						</tr>						
					</tbody>
					
                            
                                   
					<thead>
						<tr class="table_dop">
							<td >Reviews</td>
							<td align='center'>TOTAL SCORE</td>
							<td align='center'>COMPARATIVE</td>
							
							
						</tr>
					</thead>
                           
                    <tbody>
                        <?php
        
        
                        $get_product_com="select * from comments where product_id='$pro_id'";
                        $res_product_com=mysql_query($get_product_com);
							$avg=0;$avg2=0;$num=0;
					       while($row_product_com=mysql_fetch_array($res_product_com)){
						          $pro_com=$row_product_com['comment'];
                                    $score=0;
                               
                                    $words_com = explode(" ",$pro_com);
                               //echo $words_com[1];
                              
                               for($z=0;$z<count($words_com);$z++){
                                    for($x=0;$x<count($cars);$x++){
                                        if($words_com[$z]==$cars[$x][0]){
                                            $score+=$cars[$x][1];
											$avg=$avg+$cars[$x][1];
                                        }
                                    }
                               }
							   if ($score!=0){
								   $num++;
							   }
                               
                               @$comparative=round($score/count($cars),3);
							   @$avg2=$avg2+$comparative;
                        
                                    echo "<tr class='table_dop2'>
                                    
                                            <td align='left'>$pro_com</td>
                                            <td align='center'>$score</td>
                                            <td align='center'>$comparative</td>
                                          </tr>";
                               unset($words_com);
                           }
						   @$aa=$avg/$num;
						   @$aa2=$avg2/$num;
						   
                        ?>
						
					</tbody> 
					<thead>
						<tr class="table_dop">
							<td align="center">Avg. Rating</td>
							<td align="center"><?php echo "  ".$aa?></td>
							<td align="center"><?php echo round($aa2,3)?></td>
							
                            
						</tr>
					</thead>
					
					<tbody>
					<?php
					
							$get_product_com="select * from comments where product_id='$pro_id'";
							$res_product_com=mysql_query($get_product_com);
							
							$qq1="select * from vocab";
							$qq_res=mysql_query($qq1);
							$gs_score=0;
							$bs_score=0;
							
							 while($row_product_com=mysql_fetch_array($res_product_com)){
						          $pro_com=$row_product_com['comment'];
                                    
									//$score=0;
                             
                                   $words_com = explode(" ",$pro_com);//divide words as array
								   for($g=0;$g<count($words_com);$g++){
									   $qq1="select * from vocab";
										$qq_res=mysql_query($qq1);
									   while($qq_row=mysql_fetch_array($qq_res)){
										   
										   $gness=$qq_row['goodness'];
										   $bness=$qq_row['badness'];
										   $name_v=$qq_row['vocab_name'];
										   
										   if($name_v==$words_com[$g]){
											   //echo $words_com[$g].":".$gness." ".$bness."<br>";
											   $gs_score=$gs_score+$gness;
											   $bs_score=$bs_score+$bness;
										   }
									   }
								   }
								   
								   //here we will sum goodness and badness
								  // echo $gs_score."|".$bs_score;
								   $q_update_cmnt="update comments set gns=$gs_score, bns=$bs_score where comment='$pro_com'";
								   mysql_query($q_update_cmnt);
								   $gs_score=0;
									$bs_score=0;
								  // echo "<hr>";
								   
								   
							 }
							 
						
					?>
					<?php
					
							//this function will update training sets 
							function dynamic_comment($pro_id){
								$file1=fopen('positive_train.txt','w');
								$file2=fopen('positive4.txt','w');
								
									$get_product_com="select * from comments";
									$res_product_com=mysql_query($get_product_com);
					       while($row_product_com=mysql_fetch_array($res_product_com)){
						          $pro_com=$row_product_com['comment'];
								  $gns_1=$row_product_com['gns'];
								  $bns_1=$row_product_com['bns'];
								  $type='NEGATIVE';
								  if($gns_1>$bns_1){
									  $type='POSITIVE';
									  
									  fwrite($file1,$pro_com.PHP_EOL);
									  
								  }
								  else if($gns_1==$bns_1){
									  $type='NEUTRAL';
									  
									  fwrite($file1,$pro_com.PHP_EOL);
									  //we are also adding neutral comments in positive file
								  }else{
									  
									  fwrite($file2,$pro_com.PHP_EOL);
									  
								  }
								  
								$type='NEGATIVE';
						   }
								fclose($file1);
								fclose($file2);
							}
							dynamic_comment($pro_id);
							
					?>
					</tbody>
					<td>.....................................................................................</td>
					<td></td>
					<td></td>
					<thead>
						<tr class="table_dop">
							<td align="center">COMMENT</td>
							
							<td align="center">CONCLUSION</td>
						</tr>
					</thead>
					<tbody>
					<?php
							//fetch comment 
							$get_product_com="select * from comments where product_id='$pro_id'";
								$res_product_com=mysql_query($get_product_com);
							$avg=0;$avg2=0;$num=0;
					       while($row_product_com=mysql_fetch_array($res_product_com)){
						          $pro_com=$row_product_com['comment'];
								  $gns_1=$row_product_com['gns'];
								  $bns_1=$row_product_com['bns'];
								  $type='NEGATIVE';
								  if($gns_1>$bns_1){
									  $type='POSITIVE';
								  }
								  else if($gns_1==$bns_1){
									  $type='NEUTRAL';
								  }
								  echo "<tr class='table_dop2'>                              
                                            <td align='left'>$pro_com</td>
								
											<td align='center'>$type</td>
											
                                        </tr>";
								$type='NEGATIVE';
						   }
					?>
					
					</tbody>
					
					</table>
				
					</div>
					
					
					
					<div class="recommended_items">
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
					<?php
						//recommend1
						
							$qry_rec=mysql_query("select * from products where product_cat=$pro_cat order by rand()");
							while($q_res_rec=mysql_fetch_array($qry_rec)){
								$p_name_rec=$q_res_rec['pro_name'];
								$p_price_rec=$q_res_rec['pro_price'];
								$pro_image=base64_encode($q_res_rec['image']);
								echo '<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="data:image/jpeg;base64,'."$pro_image".'" alt="" />
													<h2>'."$p_price_rec".'</h2>
													<p>'."$p_name_rec".'</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>';
							}
							$qry_rec2=mysql_query("select * from products where author=$pro_aut order by rand()");
							while($q_res_rec2=@mysql_fetch_array($qry_rec2)){
								$p_name_rec2=$q_res_rec2['pro_name'];
								$p_price_rec2=$q_res_rec2['pro_price'];
								$pro_image2=base64_encode($q_res_rec2['image']);
								echo '<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="data:image/jpeg;base64,'."$pro_image2".'" alt="" />
													<h2>'."$p_price_rec2".'</h2>
													<p>'."$p_name_rec2".'</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>';
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
						$nn6[]=array();
				
					$nn3=$visit_pro;
					
					$nn4=mysql_query("select * from product_matrix where score_visit=(select max(score_visit) from product_matrix where pro_1=$nn3 or pro_2=$nn3)");
					$nn5=mysql_fetch_array($nn4);
					
					$nntemp=$nn5['pro_1'];
					if($nntemp==$nn3){
						$nn6[]=$nn5['pro_2'];
					}else{
						$nn6[]=$nn5['pro_1'];
					}	
					//array $nn6 has ids of reccommended products by product visits
					
					$nn7=mysql_query("select * from product_matrix where score_bought=(select max(score_bought) from product_matrix where pro_1=$nn3 or pro_2=$nn3)");
					$nn8=mysql_fetch_array($nn7);
					
					$nntemp2=$nn8['pro_1'];
					if($nntemp2==$nn3){
						$nn6[]=$nn8['pro_2'];
					}else{
						$nn6[]=$nn8['pro_1'];
					}	
					
				
				
				@$nn6=array_unique($nn6);
				
					?>
					<div class="recommended_items">
						<h2 class="title text-center">recommended items from this product</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<div class="item active">	
					<?php
						//recommend 2
						
							for($tmpm=1;$tmpm<=count($nn6);$tmpm++){
							$qry_rec3=@mysql_query("select * from products where pro_id=$nn6[$tmpm]");
							$q_res_rec3=@mysql_fetch_array($qry_rec3);
								$p_name_rec3=$q_res_rec3['pro_name'];
								$p_price_rec3=$q_res_rec3['pro_price'];
								$pro_image3=base64_encode($q_res_rec3['image']);
								if(@mysql_num_rows($qry_rec3)!=0){
									
								echo '<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img src="data:image/jpeg;base64,'."$pro_image3".'" alt="" />
													<h2>'."$p_price_rec3".'</h2>
													<p>'."$p_name_rec3".'</p>
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
												</div>
											</div>
										</div>
									</div>';
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
					
				</div>
			</div>
		</div>
		</div>
	</section>
	<?php
						
					}
		}
	?>
	
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
