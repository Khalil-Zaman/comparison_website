<?php
$comparison_category='phones';

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
if (isset($_GET["phones_Brand_Choice_1"])){
	$Display_all = false;
	$Search = true;
	
	$Brand_Choice_1 =  $_GET["phones_Brand_Choice_1"];
	$Brand_Choice_2 =  $_GET["phones_Brand_Choice_2"];
	
	$Display_Choice_1 =  $_GET["phones_Display_Choice_1"];
	$Display_Choice_2 =  $_GET["phones_Display_Choice_2"];
	
	$Internal_Storage_Choice_1 =  $_GET["phones_Internal_Storage_Choice_1"];
	$Internal_Storage_Choice_2 =  $_GET["phones_Internal_Storage_Choice_2"];
	
	$Front_Camera_Choice_1 =  $_GET["phones_Front_Camera_Choice_1"];
	$Front_Camera_Choice_2 =  $_GET["phones_Front_Camera_Choice_2"];
	
	$Rear_Camera_Choice_1 =  $_GET["phones_Rear_Camera_Choice_1"];
	$Rear_Camera_Choice_2 =  $_GET["phones_Rear_Camera_Choice_2"];
	
	$pageNo = (($_GET["page"])-1)*$num_comparisons_pp;
	
	if ($Brand_Choice_1 != $phones_Brand[0]){
		$Search = true;
		$query_brand_1 = "`Brand` LIKE '%".$Brand_Choice_1."%'";
	} else {
		$query_brand_1 = "`Brand` LIKE '%'";
	}
	if ($Display_Choice_1 != $phones_Display[0]){
		$Search = true;
		$query_display_1 = " AND `Display` LIKE '%".$Display_Choice_1."%'";
	} else {
		$query_display_1 = " AND `Display` LIKE '%'";
	}
	if ($Internal_Storage_Choice_1 != $phones_Internal_Storage[0]){
		$Search = true;
		$query_internal_storage_1 = " AND `Internal Storage` LIKE '%".$Internal_Storage_Choice_1."%'";
	} else {
		$query_internal_storage_1 = " AND `Internal Storage` LIKE '%'";
	}
	if ($Front_Camera_Choice_1 != $phones_Front_Camera[0]){
		$Search = true;
		$query_front_camera_1 = " AND `Front Camera` LIKE '%".$Front_Camera_Choice_1."%'";
	} else {
		$query_front_camera_1 = " AND `Front Camera` LIKE '%'";
	}
	if ($Rear_Camera_Choice_1 != $phones_Rear_Camera[0]){
		$Search = true;
		$query_rear_camera_1 = " AND `Rear Camera` LIKE '%".$Rear_Camera_Choice_1."%'";
	} else {
		$query_rear_camera_1 = " AND `Rear Camera` LIKE '%'";
	}
	
	if ($Brand_Choice_2 != $phones_Brand[0]){
		$Search = true;
		$query_brand_2 = "`Brand` LIKE '%".$Brand_Choice_2."%'";
	} else {
		$query_brand_2 = "`Brand` LIKE '%'";
	}
	if ($Display_Choice_2 != $phones_Display[0]){
		$Search = true;
		$query_display_2 = " AND `Display` LIKE '%".$Display_Choice_2."%'";
	} else {
		$query_display_2 = " AND `Display` LIKE '%'";
	}
	if ($Internal_Storage_Choice_2 != $phones_Internal_Storage[0]){
		$Search = true;
		$query_internal_storage_2 = " AND `Internal Storage` LIKE '%".$Internal_Storage_Choice_2."%'";
	} else {
		$query_internal_storage_2 = " AND `Internal Storage` LIKE '%'";
	}
	if ($Front_Camera_Choice_2 != $phones_Front_Camera[0]){
		$Search = true;
		$query_front_camera_2 = " AND `Front Camera` LIKE '%".$Front_Camera_Choice_2."%'";
	} else {
		$query_front_camera_2 = " AND `Front Camera` LIKE '%'";
	}
	if ($Rear_Camera_Choice_2 != $phones_Rear_Camera[0]){
		$Search = true;
		$query_rear_camera_2 = " AND `Rear Camera` LIKE '%".$Rear_Camera_Choice_2."%'";
	} else {
		$query_rear_camera_2 = " AND `Rear Camera` LIKE '%'";
	}
	
	if ($Search == true){
		$Display_all=false;
		$choice1_search = $choice2_search = $choice1_name_search = $chocie2_name_search = $pageURL_search = $category = $ext = $select = array();
		$query = "SELECT * FROM `compare` WHERE ((
		`choice_1`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_1.$query_display_1.$query_internal_storage_1.$query_front_camera_1.$query_rear_camera_1.")) AND
		`choice_2`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_2.$query_display_2.$query_internal_storage_2.$query_front_camera_2.$query_rear_camera_2."))
		) OR (
		`choice_1`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_2.$query_display_2.$query_internal_storage_2.$query_front_camera_2.$query_rear_camera_2.")) AND
		`choice_2`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_1.$query_display_1.$query_internal_storage_1.$query_front_camera_1.$query_rear_camera_1."))
		)) AND `category`='phones'
		";
		$query_run = mysql_query($query);
		$search_rows = $query_num_rows = mysql_num_rows($query_run);
		$pages_search = ceil($query_num_rows/$num_comparisons_pp);
		
		$query = "SELECT * FROM `compare` WHERE ((
		`choice_1`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_1.$query_display_1.$query_internal_storage_1.$query_front_camera_1.$query_rear_camera_1.")) AND
		`choice_2`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_2.$query_display_2.$query_internal_storage_2.$query_front_camera_2.$query_rear_camera_2."))
		) OR (
		`choice_1`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_2.$query_display_2.$query_internal_storage_2.$query_front_camera_2.$query_rear_camera_2.")) AND
		`choice_2`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_1.$query_display_1.$query_internal_storage_1.$query_front_camera_1.$query_rear_camera_1."))
		)) AND `category`='phones' LIMIT ".$pageNo.",".$num_comparisons_pp;
		$query_run = mysql_query($query);
		$x=0;
		while($query_row = mysql_fetch_assoc($query_run)){
			$choice1_search[$x] =  $query_row["choice_1"];
			$choice2_search[$x] =  $query_row["choice_2"];
			$choice1_name_search[$x] = queryULT("Name", $comparison_category, "id",$choice1_search[$x]);
			$choice2_name_search[$x] = queryULT("Name", $comparison_category, "id",$choice2_search[$x]);
			$pageURL_search[$x] = $query_row["pageURL"];
			$category[$x] = $query_row['category'];
			$ext[$x] = '/';
			$select[$x] = 'pic_name';
			$x++;
		}		
	}
}
?>