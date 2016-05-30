<div class="row">
	<div class="col-md-10 col-md-offset-1">
		<div id="game_wrap" class="center-block">
			<div id="page_end" class="" style="display: block">
				<div id="result_wrap">
					<div id="score_wrap">
						<div class="col-md-6">
							<div class="text-center title">RANK</div>
							<div id="text_rank" class="text-center value">1004</div>
						</div>
						<div class="col-md-6">
							<div class="text-center title">SCORE</div>
							<div id="text_score" class="text-center value">11234</div>
						</div>
					</div>
					<div id="detail_result_wrap">
						<div class="col-md-6">
							<div>TOTAL SCORE : <span id="text_totalScore"><?=$total?></span></div>
							<div>TODAY TOTAL SCORE : <span id="text_todayTotalScore"><?=$todayTotal?></span></div>
							<div>BEST SCORE : <span id="text_bestScore"><?=$topScore?></span></div>
						</div>
						<div class="col-md-6">
							<div>Playtime : <span id="text_playtime"><?=$game_log->playtime?></span></div>
							<div>Rate of correct : <span id="text_rate"><?=$game_log->rightCnt . '/' . $game_log->totalCnt?></span></div>
						</div>
					</div>
					<div class="etc_wrap">
						<div><!-- 
							<button class="btn btn-warning">Play again</button>
							<button class="btn btn-danger">Later</button> -->
						</div>
					</div>
				</div>
			</div>
			<div id="page_loading" class="page_popup">
				<img src="<?=IMG_URL?>/loading.gif" alt="" />
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
<script src="<?=JS_URL?>/JSON.js"></script>