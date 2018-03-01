<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model {

    public function transformer($query) {
        if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                        $result[] = array('ID'=>$row-> ID,
                        'NAME'=>$row-> NAME,
                        'COMPANY'=>$row-> COMPANY,
                        'BUY'=>$row-> BUY,
                        'SELL'=>$row-> SELL,
                        'BUY_PRICE'=>$row-> BUY_PRICE,
                        'SELL_PRICE'=>$row-> SELL_PRICE,
                        'CELLPHONE'=>$row-> CELLPHONE,
                        'ADDRESS'=>$row-> ADDRESS,
                                            );
                }
                return $result;
        }
        else {
                return false;
        }
}

    public function get($keyword) {
        if(is_null($keyword)) {
            $sql = "SELECT * FROM `ORDERS`";
            $query = $this->db->query($sql);
        }
        $result = $this->transformer($query);
        return $result;
    }

}

?>