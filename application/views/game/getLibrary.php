<?

foreach ($libraries as $key => $value) {
?>
<li href="#" class="list-group-item" data-lid='<?=$value->lid?>' onclick="itemSelect(this)"> <span class="badge"><?=$value->wordCount?></span><?=$value->title?></li>
<?	
}
?>