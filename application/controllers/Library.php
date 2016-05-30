<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library extends MY_Controller {
	private $CNT_OF_ITEM_BY_A_PAGE = 10;
	
	function __construct() {
		parent::__construct();
		$this->hItem["lib_nav"] = "active";
		$this->hItem["hTitle"] = "LIBRARY";
        $this->hItem["hSubTitle"] = " good library or make your own.";
        array_push($this->hItem["styleSheets"],"static/css/lib.css");
        array_push($this->hItem["styleSheets"],"http://fonts.googleapis.com/css?family=Archivo+Narrow");
	}
	
	public function index()
	{
		$this->showList(1);
	}
	
	public function test() {
		echo "<li class='list-group-item'>test</li>";
	}
	
	public function showList($page = 1)
	{
		$vars = array();
		
		if (!isset($vars['error'])) $vars['error'] = array();
		
		if(!isLogined()) {
			javascript("alert", "This page require signIn");
			$vars['error'][] = 'This page require signIn';
		}
		
		
		$this->load->model('library_model');
		
		// limits start from zero;
		$vars['libs'] = $this->library_model->getsLimitByTitle('', $page - 1, $this->CNT_OF_ITEM_BY_A_PAGE);
		$vars['pageNation'] = $this->library_model->getCntAll() / $this->CNT_OF_ITEM_BY_A_PAGE + 1;
		$vars['curPage'] = $page;
		
		$this->load->view('header', $this->hItem);
		$this->load->view('library/library_list', $vars);
		$this->load->view('footer');
	}
	
	public function getLibraryList($page = 1,$title = '') {
		$this->load->model('library_model');
		
		$var = array();
		
		if ($page < 1) {
			$page = 1;
		}
		
		// limits start from zero;
		$var['prefix'] = 'PLItem';
		$var['dblclickEvent'] = 'popLibItem(event)';
		$var['libs'] = $this->library_model->getsLimitByTitle($title, ($page - 1) * $this->CNT_OF_ITEM_BY_A_PAGE, $this->CNT_OF_ITEM_BY_A_PAGE);
		$var['dragEvent'] = 'PLDrag(event)';
		$var['loadFunc'] = "PLibraryLoad('next', event)";
		
		
		$this->load->view('library/generate_list_item', $var);
	}
	
	public function getMyLibraryList($page = 1,$title = '') {
		$this->load->model('myLibrary_model');
		
		$var = array();
		
		if ($page < 1) {
			$page = 1;
		}
		
		// limits start from zero;
		$var['dblclickEvent'] = 'popLibItem(event)';
		$var['prefix'] = 'MLItem';
		$var['libs'] = $this->myLibrary_model->getsLimitByTitle($title, ($page - 1) * $this->CNT_OF_ITEM_BY_A_PAGE, $this->CNT_OF_ITEM_BY_A_PAGE);
		$var['dragEvent'] = 'MLDrag(event)';
		$var['loadFunc'] = "MLibraryLoad('next',event)";
		
		
		$this->load->view('library/generate_list_item', $var);
	}

	public function addMylibrary($target) {
		$this->load->model('MyLibrary_model');
		
		if ($this->MyLibrary_model->get($target) != null) {
			echo '{"msg":"already in your library", "status" : "error"}';
			return ;
		}
		
		if ($this->MyLibrary_model->add($target, $_SESSION['userID'])) {
			echo '{"msg":"done.", "status" : "success"}';
		}
	}
	
	public function addWordToLib($wid, $lid) {
		$this->load->model('library_model');
		
		if ($this->library_model->addWord($wid, $lid)) {
			echo '{"msg":"done.", "status" : "success"}';
		}
	}
	
	public function delItem($id) {
		$this->load->model('library_model');
		
		if ($this->library_model->deleteItem($id)) {
			echo '{"msg":"done.", "status" : "success"}';
		}
	}
	
	public function removeMylibrary($target) {
		$this->load->model('myLibrary_model');
		
		if ($this->myLibrary_model->get($target) == null) {
			echo '{"msg":"already deleted in your library", "status" : "error"}';
			return ;
		}
		
		if ($this->myLibrary_model->remove($target, $_SESSION['userID'])) {
			echo '{"msg":"done.", "status" : "success"}';
		}
	}
	
	public function create() {
		if(!isLogined()) {
			$this->index();
			return;
		}
		
		$vars = array();
		
		$this->load->view('library/library_create');
	}
	
	public function view($lid) {
		if(!isLogined()) {
			$this->index();
			return;
		}
		
		$this->load->model('library_model');
		
		$vars['lib'] = $this->library_model->get($lid);
		$vars['items'] = $this->library_model->getLibItems($lid);
		
		if ($vars['lib']->writer == $_SESSION['userID']) {
			$this->load->view('library/library_update', $vars);
		} else {
			$this->load->view('library/library_view', $vars);
		}
		
	}
	
	public function getWord($page, $page_unit, $word = null) {
		$this->load->model('word');
		
		$var = array();
		
		if ($word == null) {
			$var['items'] = $this->word->getsLimit('', ($page - 1) * $page_unit, $page_unit);
		} else {
			$var['items'] = $this->word->getsLimit($word, ($page - 1) * $page_unit, $page_unit);	
		}
		
		$var['prefix'] = 'word';
		$var['dblclickEvent'] = 'popupItem(event)';
		$var['dragEvent'] = 'wordDrag(event)';
		$var['loadFunc'] = "WordLoad('next', event)";

		$this->load->view('library/generate_word_items', $var);
	}
	
	public function wordView($wid) {
		$this->load->model('word');
		
		$var = array();
		
		$word = $this->word->getById($wid);
		
		if ($word == null) {
			$this->output->set_status_header('400');
			return;
		}

		$var['word'] = $word[0];
		if ($word[0]->writer == $_SESSION['userID']) {
			$this->load->view('library/word_update', $var);
		} else {
			$this->load->view('library/word_view', $var);	
		}
	}
	
	public function create_proc() {
		if(!isLogined()) {
			$this->index();
			return;
		}
		
		$data = $this->input->post(null);
		$create_wids = $data['create_wid'];
		$title = $this->input->post('title');
		$lib_data = array('title' => $title, 'writer' => $_SESSION['userID']);
		
		$this->load->model('library_model');
		
		$lid = -1;
		
		if (!($lid = $this->library_model->create($lib_data, $create_wids))) {
			//$error = array('error' => $this->library_model->display_errors());
			$this->output->set_status_header('400');
            //echo $error['error'];
            echo "error";
		}
		
		$this->addMylibrary($lid);
	}
	private function modify_proc() {
		if(!isLogined()) {
			$this->index();
			return;
		}
		
		$data = $this->input->post(null);
		$create_wids = isset($data['create_wid']) ? $data['create_wid'] : array();
		$delete_wids = isset($data['delete-wid']) ? $data['delete-wid'] : array();
		$lid = $data['lid'];
		
		$this->load->model('library_model');
		
		if (!$this->library_model->modify($lid, $create_wids, $delete_wids)) {
			show_error('Can\'t modify library', 500);
			return;
		}
		
		$this->view($lid);
	}
	
	public function delete($lid) {
		$this->load->model('library_model');
		
		
		if ($this->library_model->delete($lid)) {
			echo '{"msg":"done.", "status" : "success"}';
			return;
		}
		
		echo '{"msg":"delete error", "status" : "error"}';
	}

	public function proc() {
		$mode = $this->input->post('mode');
		
		if ($mode == 'create') {
			$this->create_proc();
		} else if ($mode == 'modify') {
			$this->modify_proc();
		} else {
			show_error('There is no such a process : ' . $mode, 500);
		}
	}
	
	public function deleteWord($wid) {
		$this->load->model('word');
		
		if ($this->word->getById($wid)[0]->writer != $_SESSION['userID']) {
			echo '{"msg" : "it\'s not your word", "status" : "error"}';
			return;
		}
		
		if ($this->word->delete($wid)) {
			echo '{"msg" : "done", "status" : "success"}';
			return;
		}
		echo '{"msg" : "delete Fail", "status" : "error"}';
	}
	
	public function createWord() {
		$this->load->view('library/word_create');
		
	}
	
	public function create_word_proc() {
		if(!isLogined()) {
			$this->index();
			return;
		}
		$tmpLocation =  '/uploads/tmp/';
		$imgLocation =  '/uploads/img/';
		$soundLocation =  '/uploads/sound/';
		$img = $this->input->post('img');
		$oldImg = str_replace(SITE_NAME, '.', $img);
		$newImg = str_replace(SITE_NAME . $tmpLocation, '.' .  $imgLocation, $img);
		$sound = $this->input->post('sound');
		$oldSound = str_replace(SITE_NAME, '.', $sound);
		$newSound = str_replace(SITE_NAME .  $tmpLocation, '.' .  $soundLocation, $sound);
		
		if ($img != '') {
			if (!rename($oldImg, $newImg)) {
				$this->output->set_status_header('400');
				return;
			}
		}
		
		if ($sound != '') {
			if (!rename($oldSound, $newSound)) {
				$this->output->set_status_header('400');
				return;
			}
		}
		
		$data = array(
			'word' => $this->input->post('word'),
			'mean' => $this->input->post('mean'),
			'writer' => $_SESSION['userID'],
			'img' => str_replace($tmpLocation, $imgLocation, $img),
			'sound' => str_replace($tmpLocation, $soundLocation, $sound),
			'example' => $this->input->post('example')
		);
		
		$this->load->model('word');
		
		if (!$this->word->insert($data)) {
			$this->output->set_status_header('400');
            echo $error['error'];
		}
		
		//echo "{'status' : 'success', 'msg' : 'done'}";
		echo 'success';
	}

	
	public function update_word_proc() {
		if(!isLogined()) {
			$this->index();
			return;
		}
		$tmpLocation =  '/uploads/tmp/';
		$imgLocation =  '/uploads/img/';
		$soundLocation =  '/uploads/sound/';
		$img = $this->input->post('img');
		$oldImg = str_replace(SITE_NAME, '.', $img);
		$newImg = str_replace(SITE_NAME . $tmpLocation, '.' .  $imgLocation, $oldImg);
		$sound = $this->input->post('sound');
		$oldSound = str_replace(SITE_NAME, '.', $sound);
		$newSound = str_replace(SITE_NAME .  $tmpLocation, '.' .  $soundLocation, $oldSound);
		
		if ($img != '' && $oldImg != $newImg) {
			if (!rename($oldImg, $newImg)) {
				$this->output->set_status_header('400');
				return;
			}
		}
		
		if ($sound != '' && $oldSound != $newSound) {
			if (!rename($oldSound, $newSound)) {
				$this->output->set_status_header('400');
				return;
			}
		}
		
		$data = array(
			'word' => $this->input->post('word'),
			'mean' => $this->input->post('mean'),
			'writer' => $_SESSION['userID'],
			'img' => str_replace($tmpLocation, $imgLocation, $img),
			'sound' => str_replace($tmpLocation, $soundLocation, $sound),
			'example' => $this->input->post('example')
		);
		
		$this->load->model('word');
		
		if (!$this->word->update($this->input->post('wid'), $data)) {
			$this->output->set_status_header('400');
            echo $error['error'];
		}
		
		//echo "{'status' : 'success', 'msg' : 'done'}";
		echo 'success';
	}
	
}