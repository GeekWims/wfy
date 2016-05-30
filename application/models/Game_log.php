<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: 16
 * Date: 2015-10-10
 * Time: ���� 4:02
 */
class Game_log extends CI_Model
{
    function __construct()
    {
    	$this->table = 'game_log';
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

    function get($id)
    {
    	$result = $this->db->get_where($this->table, array('id' => $id))->result();
		if ($result) {
			return $result[0];
		}
        return null;
    }
// 
	// function getsLimitByTitle($title, $limit, $offset) {
		// if ($title != '') $this->db->like('title', $title);
		// $this->db->select('lid, title, nickname as writerName, account.create_date, writer as writerID');
		// $this->db->join('account', 'account.userID = library.writer');
		// $this->db->limit($limit, $offset);
// 		
        // return $this->db->get($this->table)->result();
	// }
	

	function getPlayTime($userID) {
		$this->db->select('sum(playtime) as total');
		$this->db->from($this->table);
		$this->db->where('userID', $userID);
        return $this->db->get()->result()[0]->total;
	}
	
	function getTotal($userID) {
		$this->db->select('sum(score) as total');
		$this->db->from($this->table);
		$this->db->where('userID', $userID);
        return $this->db->get()->result()[0]->total;
	}
	
	function getTodayTotal($userID) {
		$this->db->select('sum(score) as total');
		date_default_timezone_set('Asia/Seoul');
		
		$date = new DateTime("now");

		$curr_date = $date->format('Y-m-d');
		
		$this->db->from($this->table);
		$this->db->where('userID', $userID);
		$this->db->where('Date(date) = Date(NOW())');
		
        return $this->db->get()->result()[0]->total;
        //return $this->db->get_where($this->table, array('lid' => $lid, 'userID' => $userID, 'Date(date)' => $curr_date))->result()[0]->total;
	}
	
	function getTopScore($userID) {
		$this->db->select('max(score) as total');
		$this->db->from($this->table);
		$this->db->where('userID', $userID);
		
        return $this->db->get()->result()[0]->total;
        //return $this->db->get_where($this->table, array('lid' => $lid, 'userID' => $userID))->result()[0]->total;
	}

    function getByArray($arg) {
        return $this->db->get_where($this->table, $arg)->row_array();
    }

    function insert($arg) {
        $this->db->set($arg);

        return $this->db->insert($this->table);
    }

    function updateByArray($arg, $where) {
        $this->db->set($arg);

        return $this->db->update($this->table, $arg, $where);
    }
	
	function create_result($gameInfo, $userID, $lids) {
		
		$this->db->trans_start();
		
		if (!$this->insert(array('score' => $gameInfo->score, 'userID' => $userID, 'playtime' => $gameInfo->playTime, 'leftTime' => $gameInfo->leftTime, 'rightCnt' => $gameInfo->rightCnt, 'totalCnt' => $gameInfo->totalCnt))) {
			return FALSE;
		}
		
		$gameLogID = $this->db->insert_id();
		
		foreach ($lids as $key => $value) {
			$this->db->insert('played_library', array('game_log_id' => $gameLogID, 'lid' => $value));
		}
		
		
		$this->db->trans_complete();
		
		return $gameLogID;
	}
	
	function getRank($userID) {
		//select userID from game_log group by userID having sum(score) >= (select sum(score) as total_score from game_log where userID = 7 group by userID);
		
		$query = $this->db->select('sum(score)')
		->from($this->table)->where('userID', $userID)->
		group_by('userID')->get_compiled_select();
		
		return count($this->db->query('select count(distinct userID) as rank from game_log group by userID having sum(score) >= (' . $query . ')')->result());
	}
	
	function getTop3() {
		//select ac.nickname, ac.profile_img, sum(score) as totalScore from game_log as gl join account as ac on gl.userID = ac.userID group by ac.userID order by sum(score) desc
		$query = $this->db->select('ac.nickname, ac.profile_img, sum(score) as totalScore')
		->from($this->table . ' as gl')->join('account as ac', 'ac.userID = gl.userID')->
		group_by('ac.userID')->order_by('totalScore', "DESC");
		
		return $query->get()->result();
	}
	
	function getSide($userID) {
		$rank = $this->getRank($userID);
		$offset = $rank-2;
		if ($offset < 0) $offset = 0;
		//select ac.nickname, ac.profile_img, sum(score) as totalScore from game_log as gl join account as ac on gl.userID = ac.userID group by ac.userID order by sum(score) desc limit rank-2, 3
		$query = $this->db->select('ac.nickname, ac.profile_img, sum(score) as totalScore')
		->from($this->table . ' as gl')->join('account as ac', 'ac.userID = gl.userID')->
		group_by('ac.userID')->order_by('totalScore', "DESC")->limit(3,$offset);
		
		return $query->get()->result();
	}
}
