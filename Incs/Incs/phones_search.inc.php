<?php
$comparison_category = 'phones';

$phones_Brand = 			array('All');
$phones_Display = 			array('All');
$phones_Internal_Storage = 	array('All');
$phones_Front_Camera = 		array('All');
$phones_Rear_Camera =	 	array('All');

$phones_Brand_unsorted = 			array ();
$phones_Display_unsorted = 			array ();
$phones_Internal_Storage_unsorted = array ();
$phones_Front_Camera_unsorted =	 	array ();
$phones_Rear_Camera_unsorted =		array ();

Unsorted_array_upd($phones_Brand_unsorted, 				"Brand", 			$comparison_category);
Unsorted_array_upd($phones_Display_unsorted, 			"Display", 			$comparison_category);
Unsorted_array_upd($phones_Internal_Storage_unsorted,	"Internal Storage", $comparison_category);
Unsorted_array_upd($phones_Front_Camera_unsorted,		"Front Camera",	 	$comparison_category);
Unsorted_array_upd($phones_Rear_Camera_unsorted, 		"Rear Camera", 		$comparison_category);

search($phones_Brand, 		$phones_Brand_unsorted);
search($phones_Display, 	$phones_Display_unsorted);
search($phones_Internal_Storage, 	$phones_Internal_Storage_unsorted);
search($phones_Front_Camera,$phones_Front_Camera_unsorted);
search($phones_Rear_Camera, $phones_Rear_Camera_unsorted);

// CHOICED SELECTIONS
if (isset($_GET["phones_Brand_Choice"])){
	$Display_all = false;
	$Search = true;
	
	$phones_Brand_Choice =  $_GET["phones_Brand_Choice"];
	$phones_Display_Choice =  $_GET["phones_Display_Choice"];
	$phones_Internal_Storage_Choice =  $_GET["phones_Internal_Storage_Choice"];
	$phones_Front_Camera_Choice =  $_GET["phones_Front_Camera_Choice"];
	$phones_Rear_Camera_Choice =  $_GET["phones_Rear_Camera_Choice"];
	$phones_query_brand = '';
	$phones_query_display = '';
	$phones_query_internal_storage = '';
	$phones_query_front_camera = '';
	$phones_query_rear_camera = '';
	
	$pageNo = (($_GET["page"])-1)*$num_comparisons_pp;
	
	if ($phones_Brand_Choice != $phones_Brand[0]){
		$Search = true;
		$phones_query_brand = " AND `Brand` LIKE '%".$phones_Brand_Choice."%'";
	} else {
		$phones_query_brand = "";
	}
	if ($phones_Display_Choice != $phones_Display[0]){
		$Search = true;
		$phones_query_display = " AND `Display` LIKE '%".$phones_Display_Choice."%'";
	} else {
		$phones_query_display = "";
	}
	if ($phones_Internal_Storage_Choice != $phones_Internal_Storage[0]){
		$Search = true;
		$phones_query_internal_storage = " AND `Internal Storage` LIKE '%".$phones_Internal_Storage_Choice."%'";
	} else {
		$phones_query_internal_storage = "";
	}
	if ($phones_Front_Camera_Choice != $phones_Front_Camera[0]){
		$Search = true;
		$phones_query_front_camera = " AND `Front Camera` LIKE '%".$phones_Front_Camera_Choice."%'";
	} else {
		$phones_query_front_camera = "";
	}
	if ($phones_Rear_Camera_Choice != $phones_Rear_Camera[0]){
		$Search = true;
		$phones_query_rear_camera = " AND `Rear Camera` LIKE '%".$phones_Rear_Camera_Choice."%'";
	} else {
		$phones_query_rear_camera = "";
	}
	$Display_all=false;
	$x = 0;
	
	$query = "SELECT * FROM `".$comparison_category."` WHERE 1 ".$phones_query_brand.$phones_query_display.$phones_query_internal_storage.
	$phones_query_front_camera.$phones_query_rear_camera." AND `verified`='1'";
	
	
	$query_run = mysql_query($query);
	$search_rows = $query_num_rows = mysql_num_rows($query_run);
	$pages_search = ceil($query_num_rows/$num_comparisons_pp);
	
	$query = "SELECT * FROM `".$comparison_category."` WHERE 1 ".$phones_query_brand.$phones_query_display.$phones_query_internal_storage.
	$phones_query_front_camera.$phones_query_rear_camera." AND `verified`='1' ORDER BY `time_added` DESC LIMIT ".$pageNo.",".$num_comparisons_pp;
	$query_run = mysql_query($query);
	$search_rows = $query_num_rows = mysql_num_rows($query_run);
	$Search = true;
	while ($query_row = mysql_fetch_assoc($query_run)){
		$Search = true;
		$choice_id[$x] =  $query_row["id"];
		$choice_name[$x] =  $query_row["Name"];
		$choice_pic_name[$x] =  $query_row["pic_name"];
		$choice_id[$x] =  $query_row["id"];
		$choice_name[$x] =  $query_row["Name"];
		$choice_pic_name[$x] =  $query_row["pic_name"];	
		$brand[$x] = $query_row['Brand'];
		$display[$x] = $query_row['Display'];
		$internal_storage[$x] = $query_row['Internal Storage'];
		$front_camera[$x] = $query_row['Front Camera'];
		$rear_camera[$x] = $query_row['Rear Camera'];
		$Category[$x] =  $query_row["category"];
		$x++;			
	}
	
}

if (isset($_GET["search"])&&isset($_GET["create"])){
		$input = htmlentities(mysql_real_escape_string($_GET['search']));
		$search = str_replace(' ','%',$input);
		$phones_ar = array('Name','Display','Front Camera','Internal Storage','Rear Camera','Brand','category');
		$phones_search = '';
		for($x=0; $x<count($phones_ar); $x++){
			if(($x+1)==count($phones_ar)){
				$phones_search = $phones_search."`".$phones_ar[$x]."` LIKE '%".$search."%'";
			} else {
				$phones_search = $phones_search."`".$phones_ar[$x]."` LIKE '%".$search."%' OR";
			}
		}
		$query = "
		SELECT `id`,`pic_name`,`category`,`Name`,`Display`,`Front Camera`,`Internal Storage`,`Rear Camera`,`Brand` FROM `phones` WHERE (".$phones_search.") AND `verified`='1'";
		$query_run = mysql_query($query);
		$search_rows = mysql_num_rows($query_run);
		$noPages = ceil($search_rows/$num_comparisons_pp);
		$query = "
		SELECT `id`,`pic_name`,`category`,`Name`,`Display`,`Front Camera`,`Internal Storage`,`Rear Camera`,`Brand` FROM `phones` WHERE (".$phones_search.") AND `verified`='1' 
		LIMIT ".(($page_number-1)*$num_comparisons_pp).", ".$num_comparisons_pp;
		$query_run = mysql_query($query);
		$search_rows = mysql_num_rows($query_run);
		unset($choice_id);
		unset($choice_name);
		unset($choice_pic_name);
		$x = 0;
		while ($query_row = mysql_fetch_assoc($query_run)){
			$choice_id[$x] =  $query_row["id"];
			$choice_name[$x] =  $query_row["Name"];
			$choice_pic_name[$x] =  $query_row["pic_name"];
			$x++;
		}
}
?>