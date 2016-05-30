<?php

/**
 * Created by PhpStorm.
 * User: suyoung
 * Date: 2015. 10. 12.
 * Time: 오전 2:13
 */
class Upload extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function tmp_upload($fileName = 'userfile') {
        $config['upload_path'] = 'uploads/tmp';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size']	= '300';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
		$config['encrypt_name'] = TRUE; 
		
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($fileName))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->output->set_status_header('400'); //Triggers the jQuery error callback
            // $this->data['message'] = $error['error'];
            // echo json_encode($this->data);
            echo $error['error'];
			return;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            //$this->load->view('upload_success', $data);
            echo SITE_NAME . '/uploads/tmp/' . $data['upload_data']['file_name'];
        }
    }
	
	function emptyTmp() {
		$this->load->helper('file');
		echo delete_files(TMP_URL.'/');
	}
	
	function copyFile($src, $target) {
		$this->load->helper('file');
		$data = read_file($src);
		echo write_file($target, $data);
	}

    function tmp_sound_upload($fileName = 'userfile') {
        $config['upload_path'] = 'uploads/tmp';
        $config['allowed_types'] = 'mp3|wav|aac';
        $config['max_size']	= '10000';
        $config['max_width']  = '1024';
        $config['max_height']  = '768';
		$config['encrypt_name'] = TRUE; 
		
        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($fileName))
        {
            $error = array('error' => $this->upload->display_errors());
            $this->output->set_status_header('400'); //Triggers the jQuery error callback
            // $this->data['message'] = $error['error'];
            // echo json_encode($this->data);
            echo $error['error'];
			return;
        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            //$this->load->view('upload_success', $data);
            echo SITE_NAME . '/uploads/tmp/' . $data['upload_data']['file_name'];
        }
    }
}