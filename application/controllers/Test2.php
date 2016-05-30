<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->model('tmp_model');
	}

	public function index()
	{
		rename('Test.php','Test2.php');
	}

	public function get($val) {
		$tmp = $this->tmp_model->get($val);

		echo $tmp->name;

		$this->load->view('welcome_message');
		$this->load->view('test', array('tmp'=> $tmp));
	}
}
