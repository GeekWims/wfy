<?
foreach ($items as $key => $item) {
?>
<li id="<?=$prefix . $item->wid?>" class="list-group-item cursor_pointer" draggable="true" ondragstart="<?=$dragEvent?>" data-id=<?=$item->wid?> ondblclick="<?=$dblclickEvent?>" >
	<img src="<?=$item->img?>" style="width:25px;height:25px;" alt="" />
	<?=$item->word?>
	<div class="pull-right">
		<audio id="audio_<?=$item->wid?>" src="<?=$item->sound?>"></audio>
		<button class="btn btn-default btn-sm" onclick="playAudio(<?=$item->wid?>, event)">
			<span class="glyphicon glyphicon-play"></span>
		</button>
	</div>
	<div class="clearfix"></div>
</li>
<?
}
?>
<?
if (count($items) != 0) {
?>
	<li class="list-group-item"><button class="btn btn-default center-block" onclick="<?=$loadFunc?>">Next</button></li>
<?
}
?>

