<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rank extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->hItem["active_nav"] = "rank-nav";
    }

	public function index()
	{
		$this->load->view('test');
	}
	
	public function getRank($userID) {
		$this->load->model('game_log');
		
		$rank =  $this->game_log->getRank($userID);
		
		echo $rank->rank;
	}
}
