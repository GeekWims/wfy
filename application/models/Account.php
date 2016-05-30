<?php

/**
 * Created by PhpStorm.
 * User: 16
 * Date: 2015-10-10
 * Time: ���� 4:02
 */
class Account extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function gets()
    {
        return $this->db->query("SELECT * FROM account")->result();
    }

    function get($email)
    {
        return $this->db->get_where('account', array('email' => $email))->row_array();
    }

    function getByArray($arg) {
        return $this->db->get_where('account', $arg)->row_array();
    }

    function insertByArray($arg) {
        $this->db->set($arg);

        return $this->db->insert('account');
    }

    function updateByArray($arg, $where) {

        echo $this->db->set($arg)
            ->from('account')
            ->where($where)->get_compiled_update();

        $result = $this->db->update('account', $arg, $where);

        return $result;
    }

    function changePassword($email, $password) {
        return $this->db->set('password', "password('$password')", false)
            ->from('account')->where('email', $email)->update();
    }

    function createMapByArray($arg) {
        $this->db->set($arg);

        return $this->db->insert('extern_account_map');
    }

    function getMap($key, $type)
    {
        return $this->db->get_where('extern_account_map', array('key' => $key, 'type' => $type))->row_array();
    }

    function getSignIn() {
        $this->db->where("email", $this->input->post('email'));
        $this->db->where("password = password('{$this->input->post('password')}')", NULL, FALSE);
        $query = $this->db->get('account');
        return $query->row_array();
    }

    function insert()
    {
        $this->db->set(array(
            'email'   => $this->input->post('email'),
            'nickname'    => $this->input->post('nickname'),
            'profile_img'   => $this->input->post('profile_img')
        ));

        $this->db->set('password', "password('" . $this->input->post('password') . "')", FALSE);

        return $this->db->insert('account');
    }
}
