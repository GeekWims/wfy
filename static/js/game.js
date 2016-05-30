/**
 * Created by suyoung on 15. 9. 15..
 */
var ROOT_URL = '/wordForYou';

function sound_control(target, stat) {
	var audio = document.getElementById(target);

	switch (stat) {
	case "play" :
		audio.play();
		break;
	case "pause" :
		audio.pause();
		break;
	case "stop" :
		audio.load();
		break;
	}
}

/*
 * game process
 */

var gameInfo = {
	status : 'wait',
	totalCnt : 0,
	rightCnt : 0,
	leftTime : 60,
	timeLimit : 60,
	bonusTime : 0,
	words : [],
	lids : [],
	begineTime : 0,
	processID : 0,
	timerID : 0
};

function gameInit() {
	var selectedLib = $('#wrapPlayLib li');
	var selectedLid = [];

	selectedLib.each(function() {
		selectedLid.push($(this).data('id'));
	});

	if (selectedLid.length == 0)
		return false;

	gameInfo.lids = selectedLid;
	selectedLid = JSON.stringify(selectedLid);

	$.ajax({
		url : "/wordForYou/game/proceed/start",
		data : 'selectedLid=' + selectedLid,
		method : "post",
		async : false,
		beforeSend : function() {
			$('#page_loading').show();
		},
		success : function(data, textState, jqXHR) {
			console.log('data : ' + data + ' textStat : ' + textState + ' jqXHR : ' + jqXHR);
			gameInfo.words = $.parseJSON(data);
			gameInfo.totalCnt = gameInfo.words.length;
			$('#page_start').hide();
			$('#page_end').hide();
		},
		error : function(jqXHR, textState, errorThrown) {
			console.log('gameInit : jqXHR : ' + jqXHR + ' textState : ' + textState + ' errorThrown : ' + errorThrown);
		},
		complete : function() {
			$('#page_loading').hide();
			$('#page_game').show();
		}
	});

	gameInfo.beginTime = Date.now();
	gameInfo.status = 'next';

	return true;
}

function gameStart() {
	if (!gameInit()) {
		alert('error occured');
		return;
	}

	gameInfo.processID = setInterval(gameProc, 1);
}

function gameProc() {
	switch(gameInfo.status) {
	case 'next' :
		gameNext();
		break;
	case 'result' :
		gameInfo.status = 'end';
		clearInterval(gameInfo.timerID);
		gameResult();
		clearInterval(gameInfo.processID);
		break;
	case 'end' :
		return;
		break;
	}
}

function gameNext() {
	word = gameInfo.words.pop();
	if (word == undefined || word == null) {
		gameInfo.status = 'result';
		return;
	}
	gameInfo.curWord = word;
	$('#spelling').text(word['word']);
	$('#word_img').attr('src', word['img']);
	$('#word_sound').attr('src', word['sound']);
	$('#word_mean').text(word['mean']);
	$('#word_example').text(word['example']);
	$('#word_wrap').attr('data-wid', word['wid']);
	$('#word_wrap').attr('data-answer', word['word']);

	gameInfo.timerID = setInterval(gameTimer, 100);
	sound_control('word_sound', 'play');

	gameInfo.status = 'wait';
}

function gameTimer() {
	gameInfo.playTime = (Date.now() - gameInfo.beginTime) / 1000;
	gameInfo.leftTime = gameInfo.timeLimit - gameInfo.playTime + gameInfo.bonusTime;
	if (gameInfo.leftTime < 0) {
		gameInfo.status = 'result';
		clearInterval(gameInfo.timerID);
		alert('game over');
		return;
	}

	var timer_bar = $('#timer_bar');
	timer_bar.attr('style', 'width:' + (gameInfo.leftTime * 100 / 60) + '%;');
	timer_bar.attr('aria-valuenow', gameInfo.leftTime);
	timer_bar.text(Math.round(gameInfo.leftTime) + ' s');
}

function isAnswer() {
	clearInterval(gameInfo.timerID);
	var userAnswer = String($('#inputAnswer').val());

	if (userAnswer == gameInfo.curWord.word) {
		gameInfo.rightCnt++;
		gameInfo.bonusTime += 3;
		showSucess();
	} else {
		showFail();
	}

	$('#inputAnswer').val('');
	gameInfo.status = 'next';
}

function showSucess() {
	$('#page_success').fadeIn(1000);
	$('#page_success').fadeOut(1000);
}

function showFail() {
	$('#page_fail').fadeIn(1000);
	$('#page_fail').fadeOut(1000);
}

function gameResult() {
	$.ajax({
		url : "/wordForYou/game/proceed/result",
		data : "gameInfo=" + JSON.stringify(gameInfo),
		method : "post",
		async : false,
		beforeSend : function() {
			$('#page_loading').show();
			sound_control('word_sound', 'stop');
		},
		success : function(data, textState, jqXHR) {
			console.log('data : ' + data + ' textStat : ' + textState + ' jqXHR : ' + jqXHR);
			var json = $.parseJSON(data);
			console.log(json);
			var result = json['cur'];
			var total = json['total'];
			var todayTotal = json['todayTotal'];
			var topScore = json['topScore'];
			var gameLogId = json['gameLogId'];
			var rank = json['rank'];
			$('#text_rank').text();
			var second = Math.round(result.playTime % 60);
			var min = Math.round((result.playTime - second) % 3600);
			$('#text_playtime').text(min + ' min ' + second + ' s');
			$('#text_rate').text(gameInfo.rightCnt + '/' + gameInfo.totalCnt);
			$('#text_score').text(result.score);
			$('#text_totalScore').text(total);
			$('#text_todayTotalScore').text(todayTotal);
			$('#text_bestScore').text(topScore);
			$('#text_rank').text(rank);
			$('#btn_share').attr('onclick', 'facebook_share(' + gameLogId + ')');
		},
		error : function(jqXHR, textState, errorThrown) {
			console.log('gameResult : jqXHR : ' + jqXHR + ' textState : ' + textState + ' errorThrown : ' + errorThrown);
			console.log(jqXHR.responseText);
		},
		complete : function() {
			$('#page_loading').hide();
			$('#page_game').hide();
			$('#page_end').fadeIn(1500);
			sound_control('word_sound', 'stop');
		}
	});
}
