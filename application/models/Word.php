<?php

/**
 * Created by PhpStorm.
 * User: 16
 * Date: 2015-10-10
 * Time: ���� 4:02
 */
class Word extends CI_Model
{
    function __construct()
    {
    	$this->table = 'word';
        parent::__construct();
    }

    function gets()
    {
        return $this->db->query("SELECT * FROM " . $this->table)->result();
    }

    function get($word)
    {
        return $this->db->get_where($this->table, array('word' => $word))->row_array();
    }
	
    function getById($wid)
    {
        return $this->db->get_where($this->table, array('wid' => $wid))->result();
    }

	function getsLimit($word, $limit, $offset) {
		if ($word != '') $this->db->like('word', $word);
		$this->db->limit($offset, $limit);
		
        return $this->db->get($this->table)->result();
	}

    function getByArray($arg) {
        return $this->db->get_where($this->table, $arg)->row_array();
    }

    function insert($arg) {
        $this->db->set($arg);

        return $this->db->insert($this->table);
    }
	
	function update($wid, $arg) {
		$this->db->where('wid', $wid);
		$this->db->update($this->table, $arg);
		
		return true;
	}
	
	function delete($wid) {
		
		$this->db->delete($this->table, array('wid' => $wid));
		
		return true;
	}
	
    function updateByArray($arg, $where) {
        $this->db->set($arg);

        return $this->db->update($this->table, $arg, $where);
    }
}
