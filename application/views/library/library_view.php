<div class="modal fade" id="popupLibraryView" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button> -->
				<h4 class="modal-title" id="myModalLabel"><?=$lib->title?></h4>
			</div>
			<div class="modal-body">
				<ul class="list-group">
				<?
				foreach ($items as $key => $value) {
					?>
					<li class="list-group-item">
						<img src="<?=$value->img?>" style="width:25px;height:25px;" alt="" />
						<?=$value->word?>
						<div class="pull-right">
							<audio id="audio_<?=$value->wid?>" src="<?=$value->sound?>"></audio>
							<button class="btn btn-default btn-sm" onclick="playAudio(<?=$value->wid?>, event)">
								<span class="glyphicon glyphicon-play"></span>
							</button>
						</div>
						<div class="clearfix"></div>
					</li>
					<?
				}
				?>
				</ul>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
	<script>
		$('#popupLibraryView').on('hidden.bs.modal', function(e){
			$(this).remove();
		});
	</script>
</div>
