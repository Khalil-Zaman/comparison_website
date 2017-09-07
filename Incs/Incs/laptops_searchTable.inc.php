<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Brand</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="Brand_Choice" style="width:209px;">
		<?php for ($x=1;$x<=count($Brand);$x++){?>
		<option value="<?php echo $Brand[$x-1]?>"><?php echo $Brand[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Storage (HDD)</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="Storage_Choice" style="width:209px;">
		<?php for ($x=1;$x<=count($Storage);$x++){?>
		<option value="<?php echo $Storage[$x-1]?>"><?php echo $Storage[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Ram</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="Ram_Choice" style="width:209px;">
		<?php for ($x=1;$x<=count($Ram);$x++){?>
		<option value="<?php echo $Ram[$x-1]?>"><?php echo $Ram[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Processor</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="Processor_Choice" style="width:209px;">
		<?php for ($x=1;$x<=count($Processor);$x++){?>
		<option value="<?php echo $Processor[$x-1]?>"><?php echo $Processor[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Screen Size</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="Screen_Size_Choice" style="width:209px;">
		<?php for ($x=1;$x<=count($Screen_Size);$x++){?>
		<option value="<?php echo $Screen_Size[$x-1]?>"><?php echo $Screen_Size[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Resolution</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="Resolution_Choice" style="width:209px;">
		<?php for ($x=1;$x<=count($Resolution);$x++){?>
		<option value="<?php echo $Resolution[$x-1]?>"><?php echo $Resolution[$x-1] ?></option>
		<?php } ?>
	</select>
	</td>
</tr>

<tr>
	<td style="position:relative; left:5px;"><div class="divSearchFields">Graphics Card</div></td>
</tr>
<tr>
	<td style="position:relative; left:5px;">
	<select name="Graphics_Card_Choice" style="width:209px;">
		<?php for ($x=1;$x<=count($Graphics_Card);$x++){?>
		<option value="<?php echo $Graphics_Card[$x-1]?>"><?php echo $Graphics_Card[$x-1] ?></option>
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