<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

    public function login($acc, $pswd) {
        $acc = $acc;
        $pswd = md5(substr(md5($pswd.SECRETBABE), 0, 16));
        $sql = "SELECT * FROM `EMPLOYEE` WHERE `ACCOUNT` = '$acc' AND `PASSWORD` = '$pswd' AND `隱藏` = 0";
        $query = $this->db->query($sql);

        if ($query->num_rows() == 1) {
            foreach ($query->result() as $row) {
                $result = array(
                                'ID'=>$row-> ID,
                                'NAME'=>$row-> NAME,
                                'ACCOUNT'=>$row-> ACCOUNT,
                                'PASSWORD'=>$row-> PASSWORD,
                                '權限名稱'=>$row-> 權限名稱,
                                '趴數'=>$row-> 趴數,
                                '勞保'=>$row-> 勞保,
                                '健保'=>$row-> 健保,
                                '勞退'=>$row-> 勞退,
                                '隱藏'=>$row-> 隱藏,);
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
                                    '權限名稱'=>$row-> 權限名稱,
                                    '趴數'=>$row-> 趴數,
                                    '勞保'=>$row-> 勞保,
                                    '健保'=>$row-> 健保,
                                    '勞退'=>$row-> 勞退,
                                    '隱藏'=>$row-> 隱藏,);
                }
                return  $result;
            }
        }

        //查看權限
        function show_authority($name){
            if (is_null($name)) {
                $query = $this->db->get('account_type');
            } else {
                $query = $this->db->get_where('account_type', array('權限名稱'=>$name));
            }
            if($query->result()!=null){
                foreach ($query->result() as $row) {
                    $result[] = array('權限名稱'=>$row-> 權限名稱,
                                    '帳號設定權限'=>$row-> 帳號設定權限,
                                    '編輯權限'=>$row-> 編輯權限,
                                    '刪除權限'=>$row-> 刪除權限,
                                    '成交日期權限'=>$row-> 成交日期權限,
                                    '業務權限'=>$row-> 業務權限,
                                    '客戶姓名權限'=>$row-> 客戶姓名權限,);
                }
                return  $result;
            }
        }

        //刪除帳號
        function delete_employee($id){
            $this->db->delete('EMPLOYEE', array('ID' => $id));
        }

        //增加帳號
        function add_account($data){
            $data['PASSWORD'] = md5(substr(md5($data['PASSWORD'].SECRETBABE), 0, 16));
            $data['趴數'] = empty($data['趴數']) ? '0' : $data['趴數'];

            if ($res = $this->db->insert('EMPLOYEE',$data)){
                return $this->db->insert_id();
            } else {
                return false;
            }
        }

        //編輯帳號
        function edit_account($data) {
            $data['趴數'] = empty($data['趴數']) ? '0' : $data['趴數'];
            $this->db->where('ID', $data['ID']);
            $this->db->update('EMPLOYEE', $data);
        }

        //依照權限名稱抓權限
        public function get_authority($data) {
            $this->db->where('權限名稱', $data);
            $query = $this->db->get('account_type');
            if($query->result()!=null){
                foreach ($query->result() as $row) {
                    $result[] = array(
                                '帳號設定權限'=>$row-> 帳號設定權限,
                                '新增權限'=>$row-> 新增權限,
                                '編輯權限'=>$row-> 編輯權限,
                                '刪除權限'=>$row-> 刪除權限,
                                '成交日期權限'=>$row-> 成交日期權限,
                                '業務權限'=>$row-> 業務權限,
                                '所有成交單權限'=>$row-> 所有成交單權限,
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
                                '一審權限'=>$row-> 一審權限,
                                '二審權限'=>$row-> 二審權限,
                                '通知查帳權限'=>$row-> 通知查帳權限,
                                '剩下資訊權限'=>$row-> 剩下資訊權限,);
                }
                return  $result;
            } else {
                return flase;
            }
        }

}

?>