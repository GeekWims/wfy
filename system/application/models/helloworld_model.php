<?php
class Helloworld_model extends Model {

    function Helloworld_model()
    {
        // �� ������ ȣ��
        parent::Model();
    }
    
    function getData()
	{
		// data���̺��� ��� ���ڵ带 �ҷ� ��.
		$query = $this->db->get('data');
		
		if ($query->num_rows() > 0)
		{
			return $query->result();
		}else{
			show_error('Database is empty!');
		}
	}
}
?>