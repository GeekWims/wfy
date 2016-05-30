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
	}

	public function index()
	{
		$this->load->view('test');
	}

	public function get($val) {
		$tmp = $this->tmp_model->get($val);

		echo $tmp->name;

		$this->load->view('welcome_message');
		$this->load->view('test', array('tmp'=> $tmp));
	}

	public function mailTest() {
		$this->load->library('email');

		date_default_timezone_set('Asia/Seoul');

		$this->email->from('suyoung154@gmail.com', 'SUYOUNG KIM');
		$this->email->to('suyoung154@naver.com');
		//$this->email->from('your@example.com', 'Your Name');
		//$this->email->to('someone@example.com');
		//$this->email->cc('another@another-example.com');
		//$this->email->bcc('them@their-example.com');

		//$this->email->subject('Email Test');
		//$this->email->message('Testing the email class.');
		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send();
	}
}
