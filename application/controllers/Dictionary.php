<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dictionary extends MY_Controller {

	
	function __construct() {
		parent::__construct();
		$this->hItem["dic_nav"] = "active";
		$this->hItem["hTitle"] = "DICTIONARY";
        $this->hItem["hSubTitle"] = " good library or make your own.";
        array_push($this->hItem["styleSheets"],"static/css/lib.css");
        array_push($this->hItem["styleSheets"],"http://fonts.googleapis.com/css?family=Archivo+Narrow");
	}
	
	public function index()
	{
		$this->load->view('header', $this->hItem);
		$this->load->view('dic/main');
		$this->load->view('footer');
		
	}
}
