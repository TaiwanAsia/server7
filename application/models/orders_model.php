<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model {

    public function transformer($query) {
        if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                        $result[] = array('ID'=>$row-> ID,
                        '日期'=>$row-> 日期,
                        '業務'=>$row-> 業務,
                        '客戶姓名'=>$row->客戶姓名,
                        '身分證字號'=>$row-> 身分證字號,
                        '聯絡電話'=>$row-> 聯絡電話,
                        '聯絡人'=>$row-> 聯絡人,
                        '聯絡地址'=>$row-> 聯絡地址,
                        '買賣'=>$row-> 買賣,
                        '股票'=>$row-> 股票,
                        '張數'=>$row-> 張數,
                        '完稅價'=>$row-> 完稅價,
                        '成交價'=>$row-> 成交價,
                        '盤價'=>$row-> 盤價,
                        '匯款金額'=>$row-> 匯款金額,
                        '匯款銀行'=>$row-> 匯款銀行,
                        '匯款分行'=>$row-> 匯款分行,
                        '匯款戶名'=>$row-> 匯款戶名,
                        '匯款帳號'=>$row-> 匯款帳號,
                        '轉讓會員'=>$row-> 轉讓會員,
                        '完稅人'=>$row-> 完稅人,
                        '一審'=>$row-> 一審,
                        '二審'=>$row-> 二審,
                        '新舊'=>$row-> 新舊,
                        '自行應付'=>$row-> 自行應付,
                        '刻印'=>$row-> 刻印,
                        '過戶費'=>$row-> 過戶費,
                        '媒合'=>$row-> 媒合,
                        '收付款'=>$row-> 收付款,
                        '過戶日'=>$row-> 過戶日,
                        '通知查帳'=>$row-> 通知查帳,
                        '契約'=>$row-> 契約,
                        '稅單'=>$row-> 稅單,
                        '已結案'=>$row-> 已結案,
                                            );
                }
                return $result;
        }
        else {
                return false;
        }
}

    public function get($keyword,$level,$name) {
        if(is_null($keyword)) {
            if($level==2) {
                $sql = "SELECT * FROM `ORDERS` ORDER BY ID DESC";
                $query = $this->db->query($sql);
            } else {
                $this->db->order_by("ID", "desc"); 
                $query = $this->db->get_where('ORDERS', array('業務' => $name));
                // echo $sql;
                // $query = $this->db->query($sql);
            }   
        } else {
            $query = $this->db->get_where('ORDERS', array('id' => $keyword));
        }

        if($query->num_rows()>0) {
            $result = $this->transformer($query);
            return $result;
        } else {
            return false;
        }
        print_r($result);
    }

    public function edit($data) {
        $this->db->where('id', $data['ID']);
        $this->db->update('orders', $data);
    }

    public function add($data) {
        $this->db->insert('ORDERS',$data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function edit($data) {
        $this->db->where('id', $id);
        $this->db->update('mytable', $data); 
        $id = $this->db->insert_id();
        return $id;
    }

    public function match($self, $other) {
        //先update自己的媒合
        $data = array(
            '媒合' => $other,
         );
        $this->db->where('ID', $self);
        $this->db->update('orders', $data);
        //再update被媒合的媒合
        $data2 = array(
            '媒合' => $self,
         );
        $this->db->where('ID', $other);
        $this->db->update('orders', $data2); 
    }

    public function get_employee() {
        $query = $this->db->get('EMPLOYEE');
        if($query->result()!=null){
            foreach ($query->result() as $row) {
                $result[] = array('ID'=>$row-> ID,
                                'ACCOUNT'=>$row-> ACCOUNT,
                                'PASSWORD'=>$row-> PASSWORD,
                                'NAME'=>$row-> NAME,
                                'LEVEL'=>$row-> LEVEL,);
            }
            return  $result;
        } else {
            return false;
        }
    }
}

?>