<div class="col-md-10 col-md-offset-1">
	<div class="row">
	<? if (isset($error)) {?>
		<? foreach ($error as $key => $value) {?>
		<p class="bg-danger text-danger">
			<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span><? echo $value?></span>
		</p>
		<? } ?>
	<? } ?>
	</div>
	<div class="row">
		<form action="">
			<label for="title">Title : </label>
			<input type="text" />
			<button type="submit" class="btn btn-default btn-sm">
				search
			</button>
		</form>
	</div>
	<div class="row">
		<table class="table table-hover">
			<col width="60%"/>
			<col width="10%"/>
			<col width="20%"/>
			<col width="10%"/>
			<th>Title</th>
			<th>Writer</th>
			<th>Date</th>
			<th></th>
			<?
			foreach ($libs as $key => $value) {
			?>
			<tr>
				<td><a href="<?echo ROOT_URL?>/library/view/<?=$value->lid?>"><?= $value->title?></a></td>
				<td><?=$value->writerName?></td>
				<td><?=$value->create_date?></td>
				<td><a href="<?echo ROOT_URL?>/game/start" class="btn btn-default btn-sm pull-right"> Start </a></td>
			</tr>
			<?
			}
			?>
		</table>
	</div>
	<div class="row">
		<div class="col-md-6 col-md-offset-3 text-center">
			<ul class="pagination">
				<li>
					<a href="#" aria-label="Previous"> <span aria-hidden="true">&laquo;</span> </a>
				</li>
				<?
				for ($page = 1; $page <= $pageNation; $page++) {
				?>
				<li class="<?=$page == $curPage ? "active" : ""?>">
					<a href="<?=LIB_URL . '/showList/' . $page?>"><?=$page?></a>
				</li>
				<?
				}
				?>
				<li>
					<a href="#" aria-label="Next"> <span aria-hidden="true">&raquo;</span> </a>
				</li>
			</ul>
		</div>
		<div class="col-md-3">
			<a href="<?echo ROOT_URL?>/library/create" class="btn btn-default btn-sm pull-right"> Create </a>
		</div>
	</div>
</div>