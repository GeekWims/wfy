<div class="modal fade" id="popupRank" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button> -->
				<h4 class="modal-title" id="myModalLabel">Ranking</h4>
			</div>
			<div class="modal-body">
				<div class="row col-md-10 col-md-offset-1">
					<table class="table table-striped table-bordered">
						<caption>Top 3</caption>
						<?
						$i = 1;
						foreach ($top3 as $key => $value) {
						?>
						<tr>
							<td><?=$i++?></td>
							<td><img style="width:50px;height:50px" src="<?=$value->profile_img?>" alt="" class="img-responsive" /></td>
							<td><?=$value->nickname?></td>
							<td><?=$value->totalScore?></td>
						</tr>
						<?
						}
						?>
					</table>
				</div>
				<div class="row col-md-10 col-md-offset-1">
					<table class="table table-striped table-bordered">
						<caption>My Ranking</caption>
						<?
						$i = 1;
						foreach ($sideOfMe as $key => $value) {
						?>
						<tr>
							<td><?=$i++?></td>
							<td><img style="width:50px;height:50px" src="<?=$value->profile_img?>" alt="" class="img-responsive" /></td>
							<td><?=$value->nickname?></td>
							<td><?=$value->totalScore?></td>
						</tr>
						<?
						}
						?>
					</table>
				</div>
			</div>
			<div class="modal-footer"> 
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
	<div style="display:none;">
		<form id="lib-form" action="/wordForYou/library/create_proc" method="post">
			
		</form>
	</div>
	<script>
		$('#popupRank').on('hidden.bs.modal', function(e){
			$(this).remove();
		});
		
	</script>
</div>
