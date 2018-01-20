<?php

if(isset($_POST['searchval'])){
		$search=$_POST['searchval'];
		$filter_search=preg_replace('#[^0-9a-z]#i','',$search);
		if(!empty($filter_search)){
			$search_qry=mysql_query("select * from products where keywords like '%$filter_search%' or pro_name like '%$filter_search%'");
			$count_search=mysql_num_rows($search_qry);
			if($count_search==0){
				$output="No Search Results";
			}else{
				while($row_search=mysql_fetch_array($search_qry)){
					$keyword=$row_search['keywords'];
					$pro_name=$row_search['pro_name'];
					$output .=$pro_name;
				}	
			}			
		}
	}
	echo $output;

?>