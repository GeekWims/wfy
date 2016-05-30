<style>
	.fb_dialog_content iframe {
		width: 800px !important;
		height: 600px !important;
	}
</style>

<div class="modal fade" id="popupGame" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button> -->
				<h4 class="modal-title" id="myModalLabel">
					Game
				</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div id="game_page_wrap">
						<div class="col-md-10 col-md-offset-1">
							<div id="page_start" class="">
								<button id="btn-start" class="btn btn-info btn-lg center-block" onclick="gameStart();" style="margin-top:200px;height:100px;font-size:35px;">
									Start
								</button>
							</div>
							<div id="game_wrap" class="center-block">
								<div id="page_game" class="">
									<div id="word_wrap" class="">
										<div class="wrap">
											<div id="game_info">
												<div class="text-center">
													<span class="">This is for game info</span>
												</div>
											</div>
											<div id="timer_wrap" class="clearfix">
												<div class="col-md-2 text-right">
													<span>Time : </span>
												</div>
												<div class="col-md-8">
													<div class="progress">
														<div id="timer_bar" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="60" style="width: 100%;">
															60s
														</div>
													</div>
												</div>
											</div>
											<div id="word_description_wrap" class="clearfix">
												<div class="row">
													<div class="col-md-8 col-md-offset-2" style="height:250px;">
														<div class="text-center">
															<img id="word_img" style="max-height: 250px;vertical-align: middle" class="img-responsive word-img" src="http://placehold.it/800x600" alt="" />
														</div>
													</div>
												</div>
												<div class="text-center">
													<div>
														<h3 id="spelling" class="">Description</h3>
													</div>
												</div>
												<div class="">
													<div class="row">
														<div class="text-center audio-control-wrap">
															<audio id="word_sound" src="" style="display: none;"></audio>
															<div class="btn-group">
																<button id="" class="btn btn-default btn-sound-play" data-target="lib-audio-8" onclick="sound_control('word_sound', 'play')">
																	<span class="glyphicon glyphicon-play"></span>
																</button>
																<button id="" class="btn btn-default btn-sound-pause" data-target="lib-audio-8" onclick="sound_control('word_sound', 'pause')">
																	<span class="glyphicon glyphicon-pause"></span>
																</button>
																<button id="" class="btn btn-default btn-sound-stop" data-target="lib-audio-8" onclick="sound_control('word_sound', 'stop')">
																	<span class="glyphicon glyphicon-stop"></span>
																</button>
															</div>
														</div>
													</div>
													<div class="row">
														<div class="text-center">
															<div class="description-body">
																<h4 id="word_mean">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt debitis quidem amet vero fugiat voluptas asperiores facere officiis nam enim tempora odio perspiciatis repellat impedit reprehenderit porro culpa nisi corrupti.</h4>
															</div>
															<div class="description-body">
																<p id="word_example">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deserunt debitis quidem amet vero fugiat voluptas asperiores facere officiis nam enim tempora odio perspiciatis repellat impedit reprehenderit porro culpa nisi corrupti.</p>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div id="answer_wrap" class="row">
												<div class="col-md-10 col-md-offset-1">
													<form class="form-horizontal" onsubmit="isAnswer(); return false;">
														<div class="form-group">
															<label for="answer" class="col-sm-2 control-label">ANSWER</label>
															<div class="col-sm-8">
																<input type="text" class="form-control" id="inputAnswer" placeholder="">
															</div>
															<div class="col-sm-2">
																<button type="button" class="btn btn-default" onclick="isAnswer();">
																	Submit
																</button>
															</div>
														</div>
													</form>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div id="page_end" class="">
									<div id="result_wrap">
										<div class="row">
											<div class="col-md-8 col-md-offset-2">
												
											</div>
										</div>
										<div class="row">
											<div id="score_wrap">
												<table class="table">
													<tr>
														<td colspan="2">
															<div id="profile-wrap center-block">
																<img id="word_img" class="img-responsive word-img" src="<?=$_SESSION['profile_img']?>" alt="" />
																<span id="" class="label label-info"><?=$_SESSION['nickname']?></span>
															</div>
														</td>
													</tr>
													<tr class="bg-primary">
														<td class="text-center">
															RANK
														</td>
														<td class="text-center" colspan="">
															SCORE
														</td>
													</tr>
													<tr>
														<td id="text_rank" class="text-center">NaN</td>
														<td id="text_score" class="text-center">NaN</td>
													</tr>
													<tr class="bg-primary">
														<td colspan="2" class="text-center">Today Best Score</td>
													</tr>
													<tr>
														<td id="text_todayTotalScore" class="text-center" colspan="2">NaN</td>
													</tr>
												</table>
											</div>
										</div>
										<div class="row">
											<div class="etc_wrap">
												<div class="pull-right">
													<button class="btn btn-warning" onclick="gameStart();">
														Play again
													</button>
													<button id="btn_share" class="btn btn-success">
														Share
													</button>
												</div>
												<div class="clearfix"></div>
											</div>
										</div>
									</div>
								</div>
								<div id="page_loading" class="page_popup">
									<img src="<?=IMG_URL ?>/loading.gif" alt="" />
								</div>
								<div id="page_success" class="page_popup">
									<h3>Success</h3>
								</div>
								<div id="page_fail" class="page_popup">
									<h3>Fail...</h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Cancel
				</button>
			</div>
		</div>
	</div>
	<script src="<?=JS_URL ?>/fb-sdk.js"></script>
	<script src="<?=JS_URL ?>/JSON.js"></script>
	<script src="<?=JS_URL ?>/game.js"></script>
	<script>

		$('#popupGame').on('hidden.bs.modal', function(e){
			$(this).remove();
		});
		
		$('#popupGame').on('hide.bs.modal', function(e){
			clearInterval(gameInfo.timerID);
			clearInterval(gameInfo.processID);
		});

		function facebook_share(game_log_id) {
			FB.Canvas.setAutoGrow(false);
			FB.ui({
				method: 'share',
				href: '<?=GAME_URL ?>
					/result/' + game_log_id,
					caption: 'YOU GOT NICE SCORE',
					}, function(response){});
					$('.FB_UI_Dialog').attr('scrolling', 'yes');
			}
	</script>
</div>