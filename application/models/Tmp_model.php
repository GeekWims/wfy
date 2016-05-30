<?

class Tmp_model extends CI_Model {
	function __construct() {
		parent::__construct();
	}

	function gets() {
		return $this->db->query("SELECT * FROM tmp")->result();
	}

	function get($tmp_id) {
		return $this->db->get_where('tmp', array('id'=>$tmp_id))->row();
	}
}

?>