<?php
defined('BASEPATH') OR exit('No direct script access allowed');

abstract class MY_Controller extends CI_Controller
{

    // header Items
    // active-nav : add nav class 'current-page-item'
    // hTitle : header tite;; hSubTitle : header sub title;
    public $hItem = array("title" => "WORD FOR YOU", "active-nav" => "main-nav", "hTitle" => "WORD FOR YOU", "hSubTitle" => "DEVELOPED BY DEVSY",
        "styleSheets" => array("static/css/default.css", "static/css/fonts.css"), "home_nav" => "", "game_nav" => "", "lib_nav" => "", "qna_nav" => "", "contact_nav" => "", "dic_nav" => "");

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->library('session');
        /*
        $this->hItem["active_nav"] = "game-nav";
        -- Active nav item
        */
    }

}
