<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game extends MY_Controller {
	function __construct() {
		parent::__construct();

	}

	public function index()
	{
		if (isLogined())
			$this->load->view('game/game_main');
		else
			$this->load->view('game/game_main_guest');
	}
	
	public function proceed($step) {
		switch($step) {
			case "start" :
				$this->game_init();
				break;
			case "next" :
				$this->game_next();
				break;
			case "submit" :
				$this->game_submit();
				break;
			case "result" :
				$this->game_result();
				break;
			case "resultGuest" :
				$this->resultGuest();
				break;
			default :
				break;
		}
	}
	
	public function getPlaytime() {
		$this->load->model('game_log');
		
		$playTime = $this->game_log->getPlaytime($_SESSION['userID']);
		
		$second = $playTime % 60;
		$min = round(($playTime-$second) / 60);
		$hour = round($playTime / 3600);
		
		if ($hour < 10) {
			$hour = '0' . $hour;
		}
		if ($min < 10) {
			$min = '0' . $min;
		}
		if ($second < 10) {
			$second = '0' . $second;
		}
		
		echo $hour . ":" . $min. ":" . $second;
	}
	
	public function getTopScore() {
		$this->load->model('game_log');
		echo $this->game_log->getTopScore($_SESSION['userID']);
	}
	
	public function result($game_log_id = -1) {
		$this->load->model('game_log');
		
		$game_log = $this->game_log->get($game_log_id);
		$userID = $game_log->userID;
		
		$result = array(
			'game_log' => $game_log, 
			'total' => $this->game_log->getTotal($userID),
			'todayTotal' => $this->game_log->getTodayTotal($userID),
			'topScore' => $this->game_log->getTopScore($userID)
		);
		
		$this->load->view('header', $this->hItem);
		$this->load->view('game/game_result', $result);
		$this->load->view('footer');
	}
	
	private function game_init() {
		$lids = json_decode($this->input->post('selectedLid'));

		
		$this->load->library('game_info');
		$this->load->model('library_model');

		
		$gameInfo = $this->game_info;
		
		$gameInfo->lid = $lids;
		$gameInfo->wordList = $this->library_model->getLibItems($lids);
		//var_dump($gameInfo->wordList);
		$gameInfo->generateList();
		
		$_SESSION['gameInfo'] = serialize($gameInfo);
		
		echo json_encode($gameInfo->wordList);
	}

	private function game_result() {
		$this->load->library('game_info');
		$this->load->model('game_log');

		$gameInfo = $this->input->post('gameInfo');

		$gameInfo = json_decode($gameInfo);

		$result = array();
		$userID = $_SESSION['userID'];
		$lids = $gameInfo->lids;



		$this->load->model('game_log');

		$gameInfo->score = round($gameInfo->leftTime * $gameInfo->rightCnt * 31);

		$gameLogId = $this->game_log->create_result($gameInfo, $userID, $gameInfo->lids);

		$result = array(
			'cur' => $gameInfo,
			'total' => $this->game_log->getTotal($userID),
			'todayTotal' => $this->game_log->getTodayTotal($userID),
			'topScore' => $this->game_log->getTopScore($userID),
			'gameLogId' => $gameLogId,
			'rank' => $this->game_log->getRank($userID)
		);

		echo json_encode($result);
	}

	private function resultGuest() {
		$gameInfo = $this->input->post('gameInfo');

		$gameInfo = json_decode($gameInfo);


		$gameInfo->score = round($gameInfo->leftTime * $gameInfo->rightCnt * 31);

		$result = array(
			'cur' => $gameInfo,
			'total' => $gameInfo->score,
			'todayTotal' => $gameInfo->score,
			'topScore' => $gameInfo->score,
			'gameLogId' => 0,
			'rank' => 0
		);

		echo json_encode($result);
	}
	
	private function game_next() {
		$this->load->library('game_info');
		$gameInfo = unserialize($_SESSION['gameInfo']);
		
		if (!count($gameInfo->wordList)) {
			echo 'end';
			return;
		} else {
			$aWord = array_pop($gameInfo->wordList);
			if (count($gameInfo->wordList) == 0) $aWord->isLast = true;
			echo json_encode($aWord);
		}
		$_SESSION['gameInfo'] = serialize($gameInfo);
	}
	
	public function getLibraries($title = '') {
		$this->load->model('library_model');
		
		$libraries = $this->library_model->getLibraryInfo($title, 0, 20);
		
		$this->load->view('game/getLibrary', array('libraries' => $libraries));
	}
	
	public function userRank() {
		$this->load->model('game_log');
		
		$var['top3'] = $this->game_log->getTop3();
		$var['sideOfMe'] = $this->game_log->getSide($_SESSION['userID']);
		
		$this->load->view('game/rank', $var);
	}
}