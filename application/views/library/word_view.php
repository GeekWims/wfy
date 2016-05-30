<div class="modal fade" id="word_view" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" >
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button> -->
				<h4 class="modal-title" id="myModalLabel"><?=$word->word?></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<img class="center-block" src="<?=$word->img?>" style="width:150px" alt="" />
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="center-block">
							<h3 class="text-center">
								<?=$word->word?>
								<audio id="audio_<?=$word->wid?>" src="<?=$word->sound?>"></audio>
								<button class="btn btn-default btn-sm" onclick="playAudio(<?=$word->wid?>, event)">
									<span class="glyphicon glyphicon-play"></span>
								</button>
							</h3>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="center-block">
							<p class="text-center"><?=$word->word?></p>
						</div>
					</div>
				</div>
				<div class="row">
					
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
	</div>
	<script>
		$('#word_view').on('hidden.bs.modal', function(e){
			$(this).remove();
		});
	</script>
</div>
