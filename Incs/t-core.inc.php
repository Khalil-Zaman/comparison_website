<?php
$current_file = $_SERVER["SCRIPT_FILENAME"];
@$http_referer = $_SERVER['HTTP_REFERER'];
$_SESSION["bkpg"]=-2;

function loggedin(){
	if (isset($_SESSION['user_id'])&&!empty($_SESSION['user_id'])){
	return true;
	} else {
	return false;
	}
}

function curPageURL() {
 $pageURL = 'http';
 if (@$_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

function queryNR($x, $field){
$query = "SELECT * FROM `laptops` WHERE `id`='$x'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
return $query_num_rows;
}

function queryR($x, $field){
$query = "SELECT `$field` FROM `laptops` WHERE `id`='$x'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$query_row = mysql_fetch_assoc($query_run);
return $query_row["$field"];
}

function queryLC($x, $field){
$query = "SELECT * FROM `compare_laptops` WHERE `id`='$x'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$query_row = mysql_fetch_assoc($query_run);
return $query_row["$field"];
}


function queryU($x1, $x2, $field){
$query = "SELECT * FROM `users` WHERE `$x1`='$x2'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$query_row = mysql_fetch_assoc($query_run);
return $query_row["$field"];
}

function queryCS($x, $field){
$query = "SELECT * FROM `laptop_comments` WHERE `laptop_compare_id`='".$x."'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$query_row = mysql_fetch_assoc($query_run);
return $query_row["$field"];
}

function queryFGT($x1, $x2, $field){
$query = "SELECT * FROM `forum_general_topics` WHERE `".$x1."`='".$x2."'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$query_row = mysql_fetch_assoc($query_run);
return $query_row["$field"];
}

function queryFP($x1, $x2, $field){
$query = "SELECT * FROM `forum_posts` WHERE `".$x1."`='".$x2."'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$query_row = mysql_fetch_assoc($query_run);
return $query_row["$field"];
}

function profile_pic (){
@$pic_ext = queryU('id',$_SESSION['user_id'],"pic_file");
	if ($pic_ext!="default_pic"){
		echo $_SESSION['user_username']."_profilepic_".$pic_ext;
	} else {
		echo "default_pic.jpg";
	}
}


// GAMES
function queryCG($x, $field){
$query = "SELECT * FROM `compare_games` WHERE `id`='$x'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$query_row = mysql_fetch_assoc($query_run);
return $query_row["$field"];
}

function queryULT($field, $table, $what,$x){
$query = "SELECT `$field` FROM `$table` WHERE `$what`='$x'";
$query_run = mysql_query($query);
$query_num_rows = mysql_num_rows($query_run);
$query_row = mysql_fetch_assoc($query_run);
return $query_row["$field"];
}

function queryUPD($table, $upd_what, $upd_to, $where_what, $is_what){
$query = "UPDATE `".$table."` SET `".$upd_what."`='".$upd_to."' WHERE `".$where_what."`='".$is_what."'";
$query_run = mysql_query($query);
}

function users_pic($username){
@$pic_ext = queryU('username',$username,"pic_file");
@$no_times = queryULT('no_dp_changed','users','username',$username);
	if ($pic_ext!="default_pic"){
		echo "dp_pics/".$username."_profilepic_".$no_times.'_'.$pic_ext;
	} else {
		echo "default_pic.jpg";
	}
}

function cover_pic($username){
@$pic_ext = queryULT('cover_pic','users','username',$username);
@$no_times = queryULT('no_cover_changed','users','username',$username);
	if ($pic_ext!="default_pic"){
		echo $username."_coverpic_".$no_times.'_'.$pic_ext;
	} else {
		echo "default_pic.jpg";
	}
}


// GENERAL CRAP
function query_choices ($choice, &$array, $Search, $query_choice, $field) {
	if ($choice != $array[0]){
		$Search = true;
		$query_choice = " AND `".$field."`='".$choice."'";
	} else {
		$query_choice = "";
	}
}

function Unsorted_array_upd(&$Array1, $field, $table){
	$x = 0;
	$query = "SELECT * FROM `".$table."`";
	$query_run = mysql_query($query);
	while ($query_row = mysql_fetch_assoc($query_run)){
		$query_field = $query_row[$field];
		
		if (strpos($query_field, ",")!== false){	
			$last_place = 0;
			$new_place = 0;
			$find = ",";
			$find_length = strlen($find);
			$x_times = substr_count($query_field, ",");
			
			for ($x2=0;$x2<=$x_times; $x2++){
				$last_place = $new_place;
				$new_place = strpos($query_field, $find, $new_place) + ($find_length);
				if ($x2>=1){
					$last_place +=1;
				}
				$difference = (($new_place-$last_place)-$find_length);
				if ($difference < 0){
					$difference = (strlen($query_field)-($new_place));
				}
				$input = substr($query_field, $last_place, $difference);
				if (!(in_array($input,$Array1))){
						$Array1[$x] = $input;
						$x++;
				}
			}
		} else {
			if (!(in_array($query_field,$Array1))){
				$Array1[$x]=$query_field;
				$x++;
			}
		}
	}
	sort($Array1);
}

function search(&$Array1, &$Array2){
	for ($x=0; $x<count($Array2); $x++){
		$Array1[$x+1]=$Array2[$x];
	}
}

function upd_top(){
	$comparison_category = array("phones","laptops","games");
	$x = 0;
	$x2 = 0;
	$x2_w = 0;
	$counter_id = 1;
	while ($x<count($comparison_category)){
		$pageURLArray = array();
		$place = 0;
		$query = "SELECT * FROM  `compare_".$comparison_category[$x]."` ORDER BY `pageViews_day` DESC ";
		$query_run = mysql_query($query);
		while (($query_row = mysql_fetch_assoc($query_run))&&($place < 10)){	
			$pageViews_day = $query_row["pageViews_day"];
			if ($pageViews_day != 0){
				$pageURL = $query_row["pageURL"];
				while(in_array($pageURL, $pageURLArray)){
					$query_row = mysql_fetch_assoc($query_run);
					$pageURL = $query_row["pageURL"];
				}
			} else {	
				$query = "SELECT * FROM  `compare_".$comparison_category[$x]."` ORDER BY `id` DESC ";
				$query_run = mysql_query($query);
				$query_num_rows = mysql_num_rows($query_run);
				while ($x2_w<=$x2){
					$query_row = mysql_fetch_assoc($query_run);
					$x2_w++;
				}
				$pageURL = $query_row["pageURL"];
				while(in_array($pageURL, $pageURLArray)){
					$query_row = mysql_fetch_assoc($query_run);
					$pageURL = $query_row["pageURL"];
				}			
				$x2_w = 0;
				$x2++;
			}
				$comparison_category[$x]." ";			
				$choice1_nr =  $query_row["choice_1"]." ";
				$choice2_nr =  $query_row["choice_2"]." ";
				$choice1_name_nr =  queryULT("Name", $comparison_category[$x], "id",$choice1_nr);
				$choice2_name_nr =  queryULT("Name", $comparison_category[$x], "id",$choice2_nr);
				$pageViews_day_nr =  $query_row["pageViews_day"];
				$pageUrl_nr =  $query_row["pageURL"];
				$query = "UPDATE `top_comparisons` SET 
				`category`='".$comparison_category[$x]."',
				`choice1`='".$choice1_nr."',
				`choice2`='".$choice2_nr."',
				`choice1_name`='".mysql_real_escape_string($choice1_name_nr)."',
				`choice2_name`='".mysql_real_escape_string($choice2_name_nr)."',
				`pageViews_day`='".$pageViews_day_nr."',
				`pageUrl`='".$pageUrl_nr."'
				WHERE `id`='".$counter_id."'
				";
				mysql_query($query);
				
			$pageURLArray[$place] = $pageURL;
			$place++;
			$counter_id++;
		}
		$x++;
		$x2 = 0;
		$x2_w = 0;
	}
}

function latest(){
	$x = 0;
	$comparison_category = array('laptops','games','phones');
	$category = 0;
	$counter_id=1;

	while ($category<count($comparison_category)){
		$query = "SELECT * FROM  `compare_".$comparison_category[$category]."` ORDER BY `id` DESC ";
		$query_run = mysql_query($query);
		while(($query_row = mysql_fetch_assoc($query_run))){
			$choice1 =  $query_row["choice_1"];
			$choice2 =  $query_row["choice_2"];
			$comparison_time = $query_row["comparison_time"];
			$choice1_name = queryULT("Name", $comparison_category[$category], "id",$choice1);
			$choice2_name = queryULT("Name", $comparison_category[$category], "id",$choice2);
			$pageUrl = $query_row["pageURL"];
			$x++;
			
			$query = "UPDATE `compare_latest` SET 
			`category`='".$comparison_category[$category]."',
			`choice_1`='".$choice1."',
			`choice_2`='".$choice2."',
			`choice1_name`='".mysql_real_escape_string($choice1_name)."',
			`choice2_name`='".mysql_real_escape_string($choice2_name)."',
			`comparison_time`='".$comparison_time."',
			`pageUrl`='".$pageUrl."'
			WHERE `id`='".$counter_id."'
			";
			mysql_query($query);
			$counter_id++;
		}
		$category++;
	}
}

function pageNumbers ($x){
	$pageURL = curPageUrl();
	if(strpos($pageURL, "page=")){
		$pageNo = substr($pageURL, (strpos($pageURL, "page="))+5);
		$pageNumberUrl = str_replace("page=".$pageNo, "page=".$x, $pageURL);
	} else {
		$pageNumberUrl = $pageURL."?page=".$x;
	}
	echo $pageNumberUrl;
}

?>