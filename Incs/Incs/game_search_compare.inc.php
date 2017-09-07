<?php
$comparison_category = 'games';

$Genre = 	array ('All');
$Platform = array ('All');
$Mode = 	array ('All');

$Genre_unsorted = 		array();
$Platform_unsorted =	array();
$Mode_unsorted = 		array();

Unsorted_array_upd($Genre_unsorted, 	"Genre", 	$comparison_category);
Unsorted_array_upd($Platform_unsorted, 	"Platforms",$comparison_category);
Unsorted_array_upd($Mode_unsorted, 		"Mode",		$comparison_category);

search($Genre, 		$Genre_unsorted);
search($Platform, 	$Platform_unsorted);
search($Mode, 		$Mode_unsorted);

// CHOICED SELECTIONS
if (isset($_GET["games_Genre_Choice_1"])){	
	$Display_all = false;
	$Search = true;
	
	$Genre_Choice_1 =  $_GET["games_Genre_Choice_1"];
	$Genre_Choice_2 =  $_GET["games_Genre_Choice_2"];
	
	$Platform_Choice_1 =  $_GET["games_Platform_Choice_1"];
	$Platform_Choice_2 =  $_GET["games_Platform_Choice_2"];
	
	$Mode_Choice_1 =  $_GET["games_Mode_Choice_1"];
	$Mode_Choice_2 =  $_GET["games_Mode_Choice_2"];
	
	$pageNo = (($_GET["page"])-1)*$num_comparisons_pp;
	
	if ($Genre_Choice_1 != $Genre[0]){
		$Search = true;
		$query_genre_1 = "`Genre` LIKE '%".$Genre_Choice_1."%'"; 
	} else {
		$query_genre_1 = "`Genre` LIKE '%'";
	}
	if ($Platform_Choice_1 != $Platform[0]){
		$Search = true;
		$query_platform_1 = " AND `Platforms` LIKE '%".$Platform_Choice_1."%'"; 
	} else {
		$query_platform_1 = " AND `Platforms` LIKE '%'";
	}
	if ($Mode_Choice_1 != $Mode[0]){
		$Search = true;
		$query_mode_1 = " AND `Mode` LIKE '%".$Mode_Choice_1."%'"; 
	} else {
		$query_mode_1 = " AND `Mode` LIKE '%'";
	}
	
	if ($Genre_Choice_2 != $Genre[0]){
		$Search = true;
		$query_genre_2 = "`Genre` LIKE '%".$Genre_Choice_2."%'"; 
	} else {
		$query_genre_2 = "`Genre` LIKE '%'";
	}
	if ($Platform_Choice_2 != $Platform[0]){
		$Search = true;
		$query_platform_2 = " AND `Platforms` LIKE '%".$Platform_Choice_2."%'"; 
	} else {
		$query_platform_2 = " AND `Platforms` LIKE '%'";
	}
	if ($Mode_Choice_2 != $Mode[0]){
		$Search = true;
		$query_mode_2 = " AND `Mode` LIKE '%".$Mode_Choice_2."%'"; 
	} else {
		$query_mode_2 = " AND `Mode` LIKE '%'";
	}
	
	if ($Search == true){
		$Display_all=false;
		$choice1_search = $choice2_search = $choice1_name_search = $chocie2_name_search = $pageURL_search = $category = $ext = $select = array();
		$query = "SELECT * FROM `compare` WHERE ((
		`choice_1`IN(SELECT `id` FROM `games` WHERE  (".$query_genre_1.$query_platform_1.$query_mode_1.")) AND
		`choice_2`IN(SELECT `id` FROM `games` WHERE  (".$query_genre_2.$query_platform_2.$query_mode_2."))
		) OR (
		`choice_1`IN(SELECT `id` FROM `games` WHERE  (".$query_genre_2.$query_platform_2.$query_mode_2.")) AND
		`choice_2`IN(SELECT `id` FROM `games` WHERE  (".$query_genre_1.$query_platform_1.$query_mode_1."))
		)) AND `category`='games'";
		
		$query_run = mysql_query($query);
		$search_rows = $query_num_rows = mysql_num_rows($query_run);
		$pages_search = ceil($query_num_rows/$num_comparisons_pp);
		
		$query = "SELECT * FROM `compare` WHERE ((
		`choice_1`IN(SELECT `id` FROM `games` WHERE  (".$query_genre_1.$query_platform_1.$query_mode_1.")) AND
		`choice_2`IN(SELECT `id` FROM `games` WHERE  (".$query_genre_2.$query_platform_2.$query_mode_2."))
		) OR (
		`choice_1`IN(SELECT `id` FROM `games` WHERE  (".$query_genre_2.$query_platform_2.$query_mode_2.")) AND
		`choice_2`IN(SELECT `id` FROM `games` WHERE  (".$query_genre_1.$query_platform_1.$query_mode_1."))
		)) AND `category`='games' LIMIT ".$pageNo.",".$num_comparisons_pp;
		$query_run = mysql_query($query);
		$x=0;
		while($query_row = mysql_fetch_assoc($query_run)){
			$choice1_search[$x] =  $query_row["choice_1"];
			$choice2_search[$x] =  $query_row["choice_2"];
			$choice1_name_search[$x] = queryULT("Name", 'games', "id",$choice1_search[$x]);
			$choice2_name_search[$x] = queryULT("Name", 'games', "id",$choice2_search[$x]);
			$pageURL_search[$x] = $query_row["pageURL"];
			$category[$x] = $query_row['category'];
			$ext[$x] = '/Icons/';
			$select[$x] = 'icon_img';
			$x++;
		}		
	}
}
?> 