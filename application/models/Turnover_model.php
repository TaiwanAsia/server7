<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Turnover_model extends CI_Model {

	public function get_turnover() {
		$sql = "SELECT * FROM `table 1`";
        $query = $this->db->query($sql);

       	if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                        $result[] = array('成交單編號'=>$row-> COL1,
                        '客戶姓名'=>$row-> COL2,);
                }
                return $result;
        }
        else {
                return false;
        }
	}

}