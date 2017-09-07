<div style="width:739px; overflow-y:hidden; overflow:auto;" class="horizontal_scroll">
<table style=" position:relative; border-collapse:collapse; border:1px solid #CCCCCC;">
	<tr>
		<td class="user_cat_likes user_top_nav">
			<a href="<?php echo "user.php?=".$username."-view-user-likes";?>" style="text-decoration:none; color:#2B2B2B;">
				<?php echo "Likes (".$likes.")";?>
			</a>
		</td>
		<td class="user_cat_items_added user_top_nav">
			<a href="<?php echo "user.php?=".$username."-view-user-items-added";?>" style="text-decoration:none; color:#2B2B2B;">
				<?php echo "Items added (".$no_items.")";?>
			</a>
		</td>
		<td class="user_cat_items_added user_top_nav">
			<a href="<?php echo "user.php?=".$username."-view-user-comparisons-made";?>" style="text-decoration:none; color:#2B2B2B;">
				<?php echo "Comparisons Made (".$no_comparisons.")";?>
			</a>
		</td>
		<?php if($username==$usernameLoggedIn){ ?>
		<td class="user_cat_items_added user_top_nav" style="background-color:#DDDDDD;">
			<a href="<?php echo "user.php?=".$username."-view-user-view_messages";?>" style="text-decoration:none; color:#2B2B2B;">
				<?php echo  'Messages ('.$no_messages.')';;?>
			</a>
		</td>
		<?php } ?>
	</tr>
</table>
</div>