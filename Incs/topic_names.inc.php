<?php
require ("connect.inc.php");
require ("core.inc.php");
 
@$pageUrl = curPageURL();
@$t_name = substr($pageUrl, 52);
@$query = "SELECT * FROM `forum_general_topics` WHERE `name`='".$t_name."'";
@$query_run = mysql_query($query);
@$query_num_rows = mysql_num_rows($query_run);
@$t_name;
if ($query_num_rows==0){
	echo $t_name." Available";
} else {
	echo $t_name." Unavailable";
}
?>