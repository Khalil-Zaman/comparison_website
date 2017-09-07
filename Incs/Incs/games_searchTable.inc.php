<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Genre</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px; ">
	<select name="Genre_Choice" style="width:209px; max-width:209px;">
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
	<select name="Platform_Choice" style="width:209px; max-width:209px;">
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
	<select name="Mode_Choice" style="width:209px; max-width:209px;">
		<?php for ($x=1;$x<=count($Mode);$x++){?>
		<option value="<?php echo $Mode[$x-1]?>"><?php echo $Mode[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>
	
<input type="hidden" readonly="true" value="1" name="page"/>
<tr>
	<td style="text-align:right; left:8px; position:relative;">
		<input type="submit" value="Go"/>
	</td>
</tr>