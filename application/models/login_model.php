<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function login($acc, $pswd) {
        $acc = $acc;
        $pswd = $pswd;
        $sql = "SELECT * FROM `EMPLOYEE` WHERE `ACCOUNT` = '$acc' AND `PASSWORD` = '$pswd'";
        $query = $this->db->query($sql);

        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                $result = array(
                                'ID'=>$row-> ID,
                                'NAME'=>$row-> NAME,
                                'ACCOUNT'=>$row-> ACCOUNT,
                                'PASSWORD'=>$row-> PASSWORD,
                                '權限名稱'=>$row-> 權限名稱,);
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
                                    '權限名稱'=>$row-> 權限名稱,);
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

        //依照權限名稱抓權限
        public function get_authority($data) {
            $this->db->where('權限名稱', $data);
            $query = $this->db->get('account_type');
            if($query->result()!=null){
                foreach ($query->result() as $row) {
                    $result[] = array(
                                '帳號設定權限'=>$row-> 帳號設定權限,
                                '編輯權限'=>$row-> 編輯權限,
                                '成交日期權限'=>$row-> 成交日期權限,
                                '業務權限'=>$row-> 業務權限,
                                '客戶姓名權限'=>$row-> 客戶姓名權限,
                                '身分證字號權限'=>$row-> 身分證字號權限,
                                '聯絡電話權限'=>$row-> 聯絡電話權限,
                                '聯絡人權限'=>$row-> 聯絡人權限,
                                '聯絡地址權限'=>$row-> 聯絡地址權限,
                                '股票資訊權限'=>$row-> 股票資訊權限,
                                '盤價權限'=>$row-> 盤價權限,
                                '匯款資訊權限'=>$row-> 匯款資訊權限,
                                '轉讓會員權限'=>$row-> 轉讓會員權限,
                                '完稅人權限'=>$row-> 完稅人權限,
                                '媒合權限'=>$row-> 媒合權限,
                                '一二審通知查帳權限'=>$row-> 一二審通知查帳權限,
                                '剩下資訊權限'=>$row-> 剩下資訊權限,);
                }
                print_r($result);
                return  $result;
            } else {
                return flase;
            }
        }

}

?>