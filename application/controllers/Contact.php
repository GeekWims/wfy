<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->hItem["active_nav"] = "contact-nav";
    }

	public function index()
	{
		$this->load->view('header', $this->hItem);
		$this->load->view('main');
		$this->load->view('footer');
	}
}
