<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->hItem["home_nav"] = "active";
		$this->title = "Word For You";
		$this->subTitle = "Hello, this is for you";
	}

	public function index()
	{
		if (isLogined()) {
			$this->load->view('main');
		} else {
			$this->load->view('guest');
		}
	}

    public function test() {
        $this->load->view('test');
    }
}
