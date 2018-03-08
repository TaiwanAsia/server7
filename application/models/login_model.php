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
                                    'ID'=>$row-> ID,
                                    'LEVEL'=>$row-> LEVEL,);
            }
            return $result;
        }
        else {    
            return false;
        }
    }

        //查看帳號
        function show_account($id){
            if (is_null($id)) {
                $query = $this->db->get('EMPLOYEE'); 
            } else {
                $query = $this->db->get_where('EMPLOYEE', array('ID'=>$id)); 
            }
            if($query->result()!=null){
                foreach ($query->result() as $row) {
                    $result[] = array('ID'=>$row-> ID,
                                    'ACCOUNT'=>$row-> ACCOUNT,
                                    'PASSWORD'=>$row-> PASSWORD,
                                    'NAME'=>$row-> NAME,
                                    'LEVEL'=>$row-> LEVEL,);
                }
                return  $result;
            }
        }
    
        //刪除帳號
        function delete_account($delete_account){
            $this->db->delete('EMPLOYEE', array('ID' => $delete_account));
        }

        //增加帳號
        function add_account($data){
            $this->db->insert('EMPLOYEE',$data);
        }
    
        //編輯帳號
        function edit_account($data) {
            $this->db->where('ID', $data['ID']);
            $this->db->update('EMPLOYEE', $data); 
        }

    // public function login_move_record($name,$table,$action){
    //     $move = array('EMPLOYEE_NAME' => $name, 'MOVE_TABLE' => $table, 'ACTION' => $action, 'ACTION_TIME' => date("Y/m/d H:i:s"));
    //     $this->db->insert('move_record',$move);
    // }

}

?>