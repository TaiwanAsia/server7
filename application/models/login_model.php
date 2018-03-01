<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function login($acc, $pswd) {
        $acc = $acc;
        $pswd = $pswd;
        $sql = "SELECT * FROM `EMPLOYEE` WHERE `ACCOUNT` = '$acc' AND `PASSWORD` = '$pswd'";
        $query = $this->db->query($sql);

        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                $result = array('ACCOUNT'=>$row-> ACCOUNT,
                                    'PASSWORD'=>$row-> PASSWORD,
                                    'NAME'=>$row-> NAME,
                                    'ID'=>$row-> ID);
            }
            return $result;
        }
        else {    
            return false;
        }
    }

    // public function login_move_record($name,$table,$action){
    //     $move = array('EMPLOYEE_NAME' => $name, 'MOVE_TABLE' => $table, 'ACTION' => $action, 'ACTION_TIME' => date("Y/m/d H:i:s"));
    //     $this->db->insert('move_record',$move);
    // }

}

?>