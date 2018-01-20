<?php

function cart(){
	if(isset($_GET['add_cart'])){
		$cart_pro_id=$_GET['add_cart'];
		if(!empty(cart_pro_id)){
			$check_repeat="select * from orders where customer_id='$user_id' and cart_product='$cart_pro_id'";
			$check_run=mysql_query($check_repeat);
			if(rows=mysql_num_rows($check_run)>0){
				//already added
			}else{
				$insert_cart="insert into cart values ($user_id,$cart_pro_id)";
				$run_insert=mysql_query($insert_cart);
			}
		}
	}
}

?>