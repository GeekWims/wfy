<?php
/**
 * Created by PhpStorm.
 * User: 16
 * Date: 2015-10-08
 * Time: ���� 3:39
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Etc extends CI_Controller {
    function __construct() {
        parent::__construct();
    }

    public function howtouse()
    {
        $this->load->view('etc/howtouse');
    }

    public function devinfo()
    {
        $this->load->view('etc/devinfo');
    }

}