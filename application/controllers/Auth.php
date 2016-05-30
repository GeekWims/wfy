<?php
/**
 * Created by PhpStorm.
 * User: 16
 * Date: 2015-10-08
 * Time: ���� 3:39
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url','security'));
        $this->load->library('form_validation');
    }

	public function popupLogin() {
        $this->load->view('auth/popupLogin');
	}

	public function popupCreate() {
        $this->load->view('auth/popupCreate');
	}

    public function index()
    {
        $this->signInPage();
    }

    public function signInPage() {
        //$this->load->view('auth/sign_in');
        
		redirect('/');
    }

    public function signIn($kind = 'internal') {
        $this->load->model('account');
		$msg = "";

        if ($kind == 'internal') {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

            if ($this->form_validation->run() == TRUE) {
                $userInfo = $this->account->getSignIn();
                if ($userInfo != null) {
                    $this->session->set_userdata('userID', $userInfo['userID']);
                    $this->session->set_userdata('nickname', $userInfo['nickname']);
                    $this->session->set_userdata('profile_img', $userInfo['profile_img']);
					echo "success";
                } else {
                	$this->output->set_status_header('500');
                    echo "The username or password you entered is incorrect, please try again.";
					return;
                }
            }
			echo validation_errors();
        } else if ($kind == 'facebook') {
            $email = $this->input->post('email');
            if ($email == null) $email = $this->input->post('key');
            $userID = 0;
            $nickname = $this->input->post('nickname');
            $profile_img = $this->input->post('profile_img');
            $key = $this->input->post('key');

            $map = $this->account->getMap($key, $kind);

            if ($map == null) {
                if (($user = $this->account->get($email)) != null) {
                    $userID = $user['userID'];
                } else {

                    $this->account->insertByArray(array(
                        'email'   => $email,
                        'nickname'    => $nickname,
                        'profile_img'   => $profile_img
                    ));
                    $userID = $this->account->get($email)['userID'];
                }

                $this->account->createMapByArray(array(
                    'key' => $key,
                    'userID' => $userID,
                    'type' => $kind
                ));
                $map = $this->account->getMap($key, $kind);
            }
            $this->account->updateByArray(array(
                'nickname'    => $nickname,
                'profile_img'   => $profile_img
            ), array(
                'email' => $email
            ));
            $userInfo = $this->account->getByArray(array('userID' => $map['userID']));

            $this->session->set_userdata('userID', $userInfo['userID']);
            $this->session->set_userdata('nickname', $userInfo['nickname']);
            $this->session->set_userdata('profile_img', $userInfo['profile_img']);

			echo "success";
        }
    }

    public function signOut() {
        unset(
            $_SESSION['userID'],
            $_SESSION['nickname'],
            $_SESSION['profile_img']
        );
        redirect('/main', 'refresh');
    }

    public function signUpPage() {
        $this->load->view('auth/sign_up');
    }

    public function signUp() {
        if (!$this->session->userdata('account')) {

        }
        //rules
        $this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|callback_isAllowEmail');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
        $this->form_validation->set_rules('re-password', 'Repeated password', 'trim|required|xss_clean|matches[password]');
        $this->form_validation->set_rules('nickname', 'Nickname', 'trim|xss_clean');
        $this->form_validation->set_rules('profile_img', 'Profile Image', 'required|trim|xss_clean');

        if ($this->form_validation->run() == TRUE) {
            $this->load->model('account');
            $this->account->insert();
            $this->signInPage();
        } else {
            $this->signUpPage();
        }
    }

    public function isAllowEmail($email) {
        $this->load->model('account');
        $this->form_validation->set_message('isAllowEmail', 'The %s is already used');
        if ($this->account->get($email) != null) {
            return false;
        } else {
            return true;
        }
    }


    public function forgotPasswdView() {
        $this->load->view('auth/forgotPasswd');
    }

    public function sendNewPassword() {
        $this->load->model('Account');

        $email = $this->input->get_post('email');
        $userInfo = null;
        $newPassword = $this->generateRandPasswd(8);

        if ($userInfo = $this->Account->get($email)) {
            $userInfo['password'] = "password('$newPassword')";

            if($this->Account->changePassword($email, $newPassword)) {
                $this->sendMail($email, $newPassword);
                echo '{"status":"success","msg":" to ' . $email.'."}';
            }
        } else {
            echo '{"status":"err","msg":"there is no email"}';
        }
    }

    public function sendMail($email, $newPassword) {
        $this->load->library('MailWfy');

        $mailContent = "email : $email\nNew password : $newPassword";
        $this->mailwfy->send($email, '[WordForYou] New password!!', $mailContent);
    }

    private function generateRandPasswd($length = 8) {

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }

    public function updateView() {
        $this->load->view('auth/popupUpdate');
        
    }
}