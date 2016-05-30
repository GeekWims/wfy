<?php

/**
 * Created by PhpStorm.
 * User: kimsuyoung
 * Date: 2016. 4. 27.
 * Time: 오전 9:20
 */
defined('BASEPATH') OR exit('No direct script access allowed');


class MailWfy
{
    private $from = 'suyoung154@gmail.com';
    private $fromName = 'SUYOUNG KIM';
    private $CI;

    public function __construct() {
        date_default_timezone_set('Asia/Seoul');
        $this->CI =& get_instance();
    }

    public function send($to, $title, $content) {
        $this->CI->load->library('email');

        $this->CI->email->from($this->from,  $this->fromName);
        $this->CI->email->to($to);
        //$this->email->cc('another@another-example.com');
        //$this->email->bcc('them@their-example.com');

        $this->CI->email->subject($title);
        $this->CI->email->message($content);

        $this->CI->email->send();
    }
}