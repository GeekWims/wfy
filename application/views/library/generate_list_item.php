
<?
foreach ($libs as $key => $lib) {
?>
	<li id="<?=$prefix . $lib->lid?>" class="list-group-item cursor_pointer" draggable="true" ondragstart="<?=$dragEvent?>" data-id=<?=$lib->lid?> ondblclick="<?=$dblclickEvent?>" >
		<?
		if ($prefix == 'MLItem') {
		?>
		<input type="checkbox" class="MLItemCheckbox" name="toPlayLib[]" value="<?=$lib->lid?>" ondblclick="event.stopPropagation();" onchange="checkMLItem(event)"/>
		<?
		}
		?>
		<?=$lib->title?>
	</li>
<?
}
if (count($libs) != 0) {
?>
	<li class="list-group-item"><button class="btn btn-default center-block" onclick="<?=$loadFunc?>">Next</button></li>
<?
}
?>
