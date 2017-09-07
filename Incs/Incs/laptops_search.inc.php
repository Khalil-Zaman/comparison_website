<?php
$comparison_category = 'laptops';

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
$top_position=1;
$left_position=1;
$laptops_already_showed = array();
$laptops_shown_id = 0;
$Choice1_ar = array();
$Choice2_ar = array();
$Choice1_name_ar = array();
$Choice2_name_ar = array();
$Choice1_brand_ar = array();
$Choice2_brand_ar = array();
$pageURL_ar = array();
	
if (isset($_GET["Brand_Choice"])){
	$x = 0;
	$Display_all = false;
	$Brand_Choice =  $_GET["Brand_Choice"];
	$Ram_Choice =  $_GET["Ram_Choice"];
	$Processor_Choice =  $_GET["Processor_Choice"];
	$Screen_Size_Choice =  $_GET["Screen_Size_Choice"];
	$Storage_Choice =  $_GET["Storage_Choice"];
	$Resolution_Choice =  $_GET["Resolution_Choice"];
	$Graphics_Card_Choice =  $_GET["Graphics_Card_Choice"];
	
	$pageNo = (($_GET["page"])-1)*$num_comparisons_pp;
	
	if ($Brand_Choice != $Brand[0]){
		$Search = true;
		$query_brand = " AND `Brand` LIKE '%".$Brand_Choice."%'"; 
	} else {
		$query_brand = "";
	}
	
	if ($Ram_Choice != $Ram[0]){
		$Search = true;
		$query_ram = " AND `Ram` LIKE '%".$Ram_Choice."%'"; 
	} else {
		$query_ram = "";
	}
	
	if ($Processor_Choice != $Processor[0]){
		$Search = true;
		$query_processor = " AND `Processor` LIKE '%".$Processor_Choice."%'"; 
	} else {
		$query_processor = "";
	}
	
	if ($Screen_Size_Choice != $Screen_Size[0]){
		$Search = true;
		$query_screen_size = " AND `Screen Size` LIKE '%".$Screen_Size_Choice."%'"; 
	} else {
		$query_screen_size = "";
	}
	
	if ($Storage_Choice != $Storage[0]){
		$Search = true;
		$query_storage = " AND `HDD` LIKE '%".$Storage_Choice."%'"; 
	} else {
		$query_storage = "";
	}
	
	if ($Resolution_Choice != $Resolution[0]){
		$Search = true;
		$query_resolution = " AND `Resolution` LIKE '%".$Resolution_Choice."%'"; 
	} else {
		$query_resolution = "";
	}
	
	if ($Graphics_Card_Choice != $Graphics_Card[0]){
		$Search = true;
		$query_graphics_card = " AND `Graphics Card` LIKE '%".$Graphics_Card_Choice."%'"; 
	} else {
		$query_graphics_card = "";
	}
	
	$query = "SELECT * FROM `laptops` WHERE 1 ".$query_brand.$query_ram.$query_processor.$query_screen_size.$query_storage.$query_resolution.$query_graphics_card." AND `verified`='1'";
	
	$query_run = mysql_query($query);
	$search_rows = $query_num_rows = mysql_num_rows($query_run);
	$pages_search = ceil($query_num_rows/$num_comparisons_pp);
	
	$query = "SELECT * FROM `laptops` WHERE 1 ".$query_brand.$query_ram.$query_processor.$query_screen_size.$query_storage.$query_resolution.$query_graphics_card." AND `verified`='1' 
	ORDER BY `time_added` DESC LIMIT ".$pageNo.",".$num_comparisons_pp;
	$query_run = mysql_query($query);
	$search_rows = $query_num_rows = mysql_num_rows($query_run);
	while ($query_row = mysql_fetch_assoc($query_run)){
		$Search = true;
		$choice_id[$x] =  $query_row["id"];
		$choice_name[$x] =  $query_row["Name"];
		$choice_pic_name[$x] =  $query_row["pic_name"];
		$screen_size[$x] =  $query_row["Screen Size"];
		$hdd[$x] =  $query_row["HDD"];
		$resolution[$x] =  $query_row["Resolution"];
		$ram[$x] =  $query_row["Ram"];
		$bluetooth[$x] =  $query_row["Bluetooth"];
		$processor[$x] =  $query_row["Processor"];
		$graphics_card[$x] =  $query_row["Graphics Card"];
		$Category[$x] = $query_row['category'];
		$x++;
	}	
}

if (isset($_GET["search"])&&isset($_GET["create"])){
		$input = htmlentities(mysql_real_escape_string($_GET['search']));
		$search = str_replace(' ','%',$input);
		$laptops_ar = array('Name','Brand','Processor','HDD','Resolution','Ram','Screen size','Graphics Card','category');
		$laptops_search = '';
		for($x=0; $x<count($laptops_ar); $x++){
			if(($x+1)==count($laptops_ar)){
				$laptops_search = $laptops_search."`".$laptops_ar[$x]."` LIKE '%".$search."%'";
			} else {
				$laptops_search = $laptops_search."`".$laptops_ar[$x]."` LIKE '%".$search."%' OR";
			}
		}
		$query = "
		SELECT `id`,`pic_name`,`category`,`Name`,`Brand`,`Processor`,`HDD`,`Resolution`,`Ram`,`Screen Size`,`Graphics Card` FROM `laptops` WHERE (".$laptops_search.") AND `verified`='1'";
		$query_run = mysql_query($query);
		$search_rows = mysql_num_rows($query_run);
		$noPages = ceil($search_rows/$num_comparisons_pp);
		$query = "
		SELECT `id`,`pic_name`,`category`,`Name`,`Brand`,`Processor`,`HDD`,`Resolution`,`Ram`,`Screen Size`,`Graphics Card` FROM `laptops` WHERE (".$laptops_search.") AND `verified`='1' 
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