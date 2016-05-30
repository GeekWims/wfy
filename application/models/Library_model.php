<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 16
 * Date: 2015-10-10
 * Time: ���� 4:02
 */
class Library_model extends CI_Model
{
    function __construct()
    {
    	$this->table = 'library';
		$this->item_table = 'word_list';
        parent::__construct();
    }

    function gets()
    {
        return $this->db->query("SELECT * FROM " . $this->table)->result();
    }
	
	function getCntAll() {
		$result = $this->db->query("SELECT COUNT(*) as cnt FROM " . $this->table)->result();
		
		if (!$result) {
			return null;
		}
		
		return $result[0]->cnt;
	}

    function get($lid)
    {
    	$result = $this->db->get_where($this->table, array('lid' => $lid))->result();
		if ($result) {
			return $result[0];
		}
        return null;
    }

	function getsLimitByTitle($title, $limit, $offset) {
		if ($title != '') $this->db->like('title', $title);
		$this->db->select('lid, title, nickname as writerName, account.create_date, writer as writerID')
		->join('account', 'account.userID = library.writer')
		->from($this->table)
		->limit($offset, $limit);
		
        return $this->db->get()->result();
	}

    function getByArray($arg) {
        return $this->db->get_where($this->table, $arg)->row_array();
    }
	
	function getLibraryInfo($title, $limit, $offset) {
		if ($title != '') $this->db->like('title', $title);
		$this->db->select('library.lid, library.title, nickname as writerName, account.create_date, writer as writerID, COUNT(word_list.wid) as wordCount');
		$this->db->join('account', 'account.userID = library.writer');
		$this->db->join('word_list', 'word_list.lid = library.lid');
		$this->db->group_by('library.lid');
		$this->db->limit($limit, $offset);
		
        return $this->db->get($this->table)->result();
	}

    function insert($arg) {
        $this->db->set($arg);

        return $this->db->insert($this->table);
    }
	
	function create($lib_arg, $wid_list) {
		$this->db->trans_start();
		
		if (!$this->insert($lib_arg)) {
			return FALSE;
		}
		
		$lid = $this->db->insert_id();
		$word_list_arg = array('lid' => $lid, 'wid' => 0);
		
		foreach ($wid_list as $wid) {
			$word_list_arg['wid'] = $wid;
			$this->db->insert($this->item_table, $word_list_arg);
		}
		
		$this->db->trans_complete();
		
		return $lid;
	}

	function deleteItem($id) {
		
		$this->db->delete($this->item_table, array('id' => $id));
		
		return true; 
	}

	function delete($lid) {
		
		$this->db->delete($this->table, array('lid' => $lid));
		
		return true;
	}
	
	function modify($lid, $create_wids, $delete_wids) {
		$this->db->trans_start();
	
		$word_list_arg = array('lid' => $lid, 'wid' => 0);
		
		foreach ($create_wids as $wid) {
			$word_list_arg['wid'] = $wid;
			$this->db->insert($this->item_table, $word_list_arg);
		}
		
		foreach ($delete_wids as $key => $value) {
			$this->db->delete($this->item_table, array('id' => $value)); 
		}
		
		$this->db->trans_complete();
		
		return $lid;
	}
	
	function addWord($wid, $lid) {
		
		$word_list_arg = array('lid' => $lid, 'wid' => $wid);
	
		$this->db->insert($this->item_table, $word_list_arg);
		
		return true; 
	}

    function updateByArray($arg, $where) {
        $this->db->set($arg);

        return $this->db->update($this->table, $arg, $where);
    }
	
	function getLibItems($lids) {
		$this->db->join('word', $this->item_table . '.wid = word.wid');
		$this->db->from($this->item_table);
		$this->db->where_in('lid', $lids);
        return $this->db->get()->result();
	}
}
