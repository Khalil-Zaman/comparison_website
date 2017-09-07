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

if (isset($_GET["Genre_Choice"])){
	$x = 0;
	$Display_all = false;
	$Genre_Choice =  $_GET["Genre_Choice"];
	$Platform_Choice =  $_GET["Platform_Choice"];
	$Mode_Choice =  $_GET["Mode_Choice"];
	
	$pageNo = (($_GET["page"])-1)*$num_comparisons_pp;
	
	if ($Genre_Choice != $Genre[0]){
		$Search = true;
		$query_genre = " AND `Genre` LIKE '%".$Genre_Choice."%'"; 
	} else {
		$query_genre = "";
	}
	
	if ($Platform_Choice != $Platform[0]){
		$Search = true;
		$query_platform = " AND `Platforms` LIKE '%".$Platform_Choice."%'"; 
	} else {
		$query_platform = "";
	}
	
	if ($Mode_Choice != $Mode[0]){
		$Search = true;
		$query_mode = " AND `Mode` LIKE '%".$Mode_Choice."%'"; 
	} else {
		$query_mode = "";
	}
	
	$query = "SELECT `id`,`Name`,`pic_name`,`category` FROM `".$comparison_category."` WHERE 1 ".$query_genre.$query_platform.$query_mode."  AND `verified`='1'";
	
	$query_run = mysql_query($query);
	$search_rows = $query_num_rows = mysql_num_rows($query_run);
	$pages_search = ceil($query_num_rows/$num_comparisons_pp);
	
	$query = "SELECT `id`,`Name`,`pic_name`,`category` FROM `".$comparison_category."` WHERE 1 ".$query_genre.$query_platform.$query_mode."  AND `verified`='1'
	ORDER BY `time_added` DESC LIMIT ".$pageNo.",".$num_comparisons_pp;
	$query_run = mysql_query($query);
	$search_rows = $query_num_rows = mysql_num_rows($query_run);
	$choice_id = $choice_name = $choice_pic_name = $Category = array();
	$Search = true;
	while ($query_row = mysql_fetch_assoc($query_run)){	
		$Search = true;
		$choice_id[$x] = $query_row['id'];
		$choice_name[$x] = $query_row['Name'];
		$choice_pic_name[$x] = $query_row['pic_name'];
		$Category[$x] = $query_row['category'];
		$x++;
	}
}

if (isset($_GET["search"])&&isset($_GET["create"])){
		$input = htmlentities(mysql_real_escape_string($_GET['search']));
		$search = str_replace(' ','%',$input);
		$games_ar = array('Name','Genre','Platforms','Released','Mode','category');
		$games_search = '';
		for($x=0; $x<count($games_ar); $x++){
			if(($x+1)==count($games_ar)){
				$games_search = $games_search."`".$games_ar[$x]."` LIKE '%".$search."%'";
			} else {
				$games_search = $games_search."`".$games_ar[$x]."` LIKE '%".$search."%' OR";
			}
		}
		$query = "
		SELECT `id`,`Name`,`category`,`pic_name`,`Genre`,`Platforms`,`Mode`,`Released` FROM `games` WHERE (".$games_search.") AND `verified`='1'";
		$query_run = mysql_query($query);
		$search_rows = mysql_num_rows($query_run);
		$noPages = ceil($search_rows/$num_comparisons_pp);
		$query = 
		"SELECT `id`,`Name`,`category`,`pic_name`,`Genre`,`Platforms`,`Mode`,`Released` FROM `games` WHERE (".$games_search.") AND `verified`='1' 
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