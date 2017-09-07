<tr>
	<td style="text-align:center; font-size:18px; color:#4d4d4d; height:29px; width:209px;">
		<div style="position:relative; top:5px;">
		Choice 1
		</div>
	</td>
</tr>
<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Genre</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="games_Genre_Choice_1" style="width:209px; max-width:209px;">
		<?php for ($x=1;$x<=count($Genre);$x++){?>
		<option value="<?php echo $Genre[$x-1]?>"><?php echo $Genre[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Platform</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="games_Platform_Choice_1" style="width:209px; max-width:209px;">
		<?php for ($x=1;$x<=count($Platform);$x++){?>
		<option value="<?php echo $Platform[$x-1]?>"><?php echo $Platform[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Mode</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="games_Mode_Choice_1" style="width:209px; max-width:209px;">
		<?php for ($x=1;$x<=count($Mode);$x++){?>
		<option value="<?php echo $Mode[$x-1]?>"><?php echo $Mode[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="text-align:center; font-size:14px; color:#4d4d4d; height:30px; width:209px;">
		<div style="position:relative; top:3px;">
		VS
		</div>
	</td>
</tr>

<tr>
	<td style="text-align:center; font-size:18px; color:#4d4d4d; height:29px; width:209px;">
		<div style="position:relative; top:5px;">
		Choice 2
		</div>
	</td>
</tr>
<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Genre</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="games_Genre_Choice_2" style="width:209px; max-width:209px;">
		<?php for ($x=1;$x<=count($Genre);$x++){?>
		<option value="<?php echo $Genre[$x-1]?>"><?php echo $Genre[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Platform</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="games_Platform_Choice_2" style="width:209px; max-width:209px;">
		<?php for ($x=1;$x<=count($Platform);$x++){?>
		<option value="<?php echo $Platform[$x-1]?>"><?php echo $Platform[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Mode</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="games_Mode_Choice_2" style="width:209px; max-width:209px;">
		<?php for ($x=1;$x<=count($Mode);$x++){?>
		<option value="<?php echo $Mode[$x-1]?>"><?php echo $Mode[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<input type="hidden" readonly="true" value="1" name="page"/>
<tr>
	<td style="text-align:right; position:relative; left:7px;">
		<input type="submit" value="Go"/>
	</td>
</tr>