<?php
$comparison_category='laptops';

$Processor = 		array ("All");
$Brand = 			array ("All");
$Ram = 				array ("All");
$Screen_Size = 		array ("All");
$Storage = 			array ("All");
$Resolution = 		array ("All");
$Graphics_Card = 	array ("All");

$Processor_unsorted =	array ();
$Brand_unsorted =		array ();
$Ram_unsorted =			array ();
$Screen_Size_unsorted = array ();
$Storage_unsorted =		array ();
$Resolution_unsorted =	array ();
$Graphics_Card_unsorted =	array ();

Unsorted_array_upd($Processor_unsorted, 	"Processor",	$comparison_category);
Unsorted_array_upd($Brand_unsorted, 		"Brand", 		$comparison_category);
Unsorted_array_upd($Ram_unsorted, 			"Ram", 			$comparison_category);
Unsorted_array_upd($Screen_Size_unsorted,	"Screen Size",	$comparison_category);
Unsorted_array_upd($Storage_unsorted, 		"HDD",			$comparison_category);
Unsorted_array_upd($Resolution_unsorted, 	"Resolution",	$comparison_category);
Unsorted_array_upd($Graphics_Card_unsorted, "Graphics Card",$comparison_category);

search($Processor,	$Processor_unsorted);
search($Brand, 		$Brand_unsorted);
search($Ram,		$Ram_unsorted);
search($Screen_Size,$Screen_Size_unsorted);
search($Storage,	$Storage_unsorted);
search($Resolution, $Resolution_unsorted);
search($Graphics_Card, $Graphics_Card_unsorted);

// CHOICED SELECTIONS
if (isset($_GET["laptops_Brand_Choice_1"])){
	$Search = true;
	$Display_all = false;
	
	$Brand_Choice_1 =  $_GET["laptops_Brand_Choice_1"];
	$Brand_Choice_2 =  $_GET["laptops_Brand_Choice_2"];
	
	$Ram_Choice_1 =  $_GET["laptops_Ram_Choice_1"];
	$Ram_Choice_2 =  $_GET["laptops_Ram_Choice_2"];
	
	$Processor_Choice_1 =  $_GET["laptops_Processor_Choice_1"];
	$Processor_Choice_2 =  $_GET["laptops_Processor_Choice_2"];
	
	$Storage_Choice_1 =  $_GET["laptops_Storage_Choice_1"];
	$Storage_Choice_2 =  $_GET["laptops_Storage_Choice_2"];
	
	$Screen_Size_Choice_1 =  $_GET["laptops_Screen_Size_Choice_1"];
	$Screen_Size_Choice_2 =  $_GET["laptops_Screen_Size_Choice_2"];
	
	$Resolution_Choice_1 =  $_GET["laptops_Resolution_Choice_1"];
	$Resolution_Choice_2 =  $_GET["laptops_Resolution_Choice_2"];
	
	$Graphics_Card_Choice_1 =  $_GET["laptops_Graphics_Card_Choice_1"];
	$Graphics_Card_Choice_2 =  $_GET["laptops_Graphics_Card_Choice_2"];
	
	$pageNo = (($_GET["page"])-1)*$num_comparisons_pp;
	//$pageNo = 1;
	
	if ($Brand_Choice_1 != $Brand[0]){
		$Search = true;
		$query_brand_1 = "`Brand` LIKE '%".$Brand_Choice_1."%'"; 
	} else {
		$query_brand_1 = "`Brand` LIKE '%'";
	}
	if ($Storage_Choice_1 != $Storage[0]){
		$Search = true;
		$query_storage_1 = " AND `HDD` LIKE '%".$Storage_Choice_1."%'"; 
	} else {
		$query_storage_1 = " AND `HDD` LIKE '%'";
	}
	if ($Ram_Choice_1 != $Ram[0]){
		$Search = true;
		$query_ram_1 = " AND `Ram` LIKE '%".$Ram_Choice_1."%'"; 
	} else {
		$query_ram_1 = " AND `Ram` LIKE '%'";
	}	
	if ($Processor_Choice_1 != $Processor[0]){
		$Search = true;
		$query_processor_1 = " AND `Processor` LIKE '%".$Processor_Choice_1."%'"; 
	} else {
		$query_processor_1 = " AND `Processor` LIKE '%'";
	}
	if ($Screen_Size_Choice_1 != $Screen_Size[0]){
		$Search = true;
		$query_screen_size_1 = " AND `Screen Size` LIKE '%".$Screen_Size_Choice_1."%'"; 
	} else {
		$query_screen_size_1 = " AND `Screen Size` LIKE '%'";
	}
	if ($Resolution_Choice_1 != $Resolution[0]){
		$Search = true;
		$query_resolution_1 = " AND `Resolution` LIKE '%".$Resolution_Choice_1."%'"; 
	} else {
		$query_resolution_1 = " AND `Resolution` LIKE '%'";
	}
	if ($Graphics_Card_Choice_1 != $Graphics_Card[0]){
		$Search = true;
		$query_graphics_card_1 = " AND `Graphics Card` LIKE '%".$Graphics_Card_Choice_1."%'"; 
	} else {
		$query_graphics_card_1 = " AND `Graphics Card` LIKE '%'";
	}
	
	if ($Brand_Choice_2 != $Brand[0]){
		$Search = true;
		$query_brand_2 = "`Brand` LIKE '%".$Brand_Choice_2."%'"; 
	} else {
		$query_brand_2 = "`Brand` LIKE '%'";
	}
	if ($Storage_Choice_2 != $Storage[0]){
		$Search = true;
		$query_storage_2 = " AND `HDD` LIKE '%".$Storage_Choice_2."%'"; 
	} else {
		$query_storage_2 = " AND `HDD` LIKE '%'";
	}
	if ($Ram_Choice_2 != $Ram[0]){
		$Search = true;
		$query_ram_2 = " AND `Ram` LIKE '%".$Ram_Choice_2."%'"; 
	} else {
		$query_ram_2 = " AND `Ram` LIKE '%'";
	}	
	if ($Processor_Choice_2 != $Processor[0]){
		$Search = true;
		$query_processor_2 = " AND `Processor` LIKE '%".$Processor_Choice_2."%'"; 
	} else {
		$query_processor_2 = " AND `Processor` LIKE '%'";
	}
	if ($Screen_Size_Choice_2 != $Screen_Size[0]){
		$Search = true;
		$query_screen_size_2 = " AND `Screen Size` LIKE '%".$Screen_Size_Choice_2."%'"; 
	} else {
		$query_screen_size_2 = " AND `Screen Size` LIKE '%'";
	}
	if ($Resolution_Choice_2 != $Resolution[0]){
		$Search = true;
		$query_resolution_2 = " AND `Resolution` LIKE '%".$Resolution_Choice_2."%'"; 
	} else {
		$query_resolution_2 = " AND `Resolution` LIKE '%'";
	}
	if ($Graphics_Card_Choice_2 != $Graphics_Card[0]){
		$Search = true;
		$query_graphics_card_2 = " AND `Graphics Card` LIKE '%".$Graphics_Card_Choice_2."%'"; 
	} else {
		$query_graphics_card_2 = " AND `Graphics Card` LIKE '%'";
	}
	
	$Search = true;
	if ($Search == true){
		$Search = true;
		$Display_all=false;		
		$choice1_search = $choice2_search = $choice1_name_search = $choice1_brand_search = $choice2_brand_search = 
		$chocie2_name_search = $pageURL_search = $category = $ext = $select = array();
		$query = "SELECT * FROM `compare` WHERE ((
		`choice_1`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_1.$query_storage_1.$query_ram_1.$query_processor_1.$query_screen_size_1.$query_resolution_1.$query_graphics_card_1.")) AND
		`choice_2`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_2.$query_storage_2.$query_ram_2.$query_processor_2.$query_screen_size_2.$query_resolution_2.$query_graphics_card_2."))
		) OR (
		`choice_1`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_2.$query_storage_2.$query_ram_2.$query_processor_2.$query_screen_size_2.$query_resolution_2.$query_graphics_card_2.")) AND
		`choice_2`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_1.$query_storage_1.$query_ram_1.$query_processor_1.$query_screen_size_1.$query_resolution_1.$query_graphics_card_1."))
		)) AND `category`='laptops'
		";
		$query_run = mysql_query($query);
		$search_rows = $query_num_rows = mysql_num_rows($query_run);
		$pages_search = ceil($query_num_rows/$num_comparisons_pp);
		
		$query = "SELECT * FROM `compare` WHERE ((
		`choice_1`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_1.$query_storage_1.$query_ram_1.$query_processor_1.$query_screen_size_1.$query_resolution_1.$query_graphics_card_1.")) AND
		`choice_2`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_2.$query_storage_2.$query_ram_2.$query_processor_2.$query_screen_size_2.$query_resolution_2.$query_graphics_card_2."))
		) OR (
		`choice_1`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_2.$query_storage_2.$query_ram_2.$query_processor_2.$query_screen_size_2.$query_resolution_2.$query_graphics_card_2.")) AND
		`choice_2`IN(SELECT `id` FROM `".$comparison_category."` WHERE  (".$query_brand_1.$query_storage_1.$query_ram_1.$query_processor_1.$query_screen_size_1.$query_resolution_1.$query_graphics_card_1."))
		)) AND `category`='laptops' LIMIT ".$pageNo.",".$num_comparisons_pp;
		$query_run = mysql_query($query);
		$x=0;
		while($query_row = mysql_fetch_assoc($query_run)){
			$choice1_search[$x] =  $query_row["choice_1"];
			$choice2_search[$x] =  $query_row["choice_2"];
			$choice1_name = queryULT("Name", $comparison_category, "id",$choice1_search[$x]);
			$choice2_name = queryULT("Name", $comparison_category, "id",$choice2_search[$x]);
			$choice1_brand = queryULT("Brand", $comparison_category, "id",$choice1_search[$x]);
			$choice2_brand = queryULT("Brand", $comparison_category, "id",$choice2_search[$x]);
			$choice1_name_search[$x] = $choice1_brand."<br><span style='font-size:13px;'>".$choice1_name."</span>";
			$choice2_name_search[$x] = $choice2_brand."<br><span style='font-size:13px;'>".$choice2_name."</span>";
			$pageURL_search[$x] = $query_row["pageURL"];
			$category[$x] = $query_row['category'];
			$ext[$x] = '/';
			$select[$x] = 'pic_name';
			$x++;
		}		
	}
}
?>