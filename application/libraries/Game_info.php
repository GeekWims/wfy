<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Game_Info {
	public $lid;
	public $wordList;
	public $state;
	public $rightCnt;
	public $playTime;
	public $totalCnt;
	public $score;

	function __construct() {
		$lid = array();
		$wordList = array();
		$stat = "ready";
		$score = 0;
		$playTime = 0;
		$totalCnt = 0;
		$rightCnt = 0;
 	}

	public function generateList() {
		$this->totalCnt = count($this->wordList);
		shuffle($this->wordList);
	}
	
	public function popWord() {
		return array_pop($this->wordList);
	}
	
	public function result() {
		if ($this->playTime == 0) $this->score = 0;
		$this->score = round($this->rightCnt * $this->totalCnt * 123 * $this->playTime);
	}
}
