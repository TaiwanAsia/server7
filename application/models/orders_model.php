<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Orders_model extends CI_Model {

    public function transformer($query) {
        if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                        $result[] = array('ID'=>$row-> ID,
                        '成交日期'=>$row-> 成交日期,
                        '業務'=>$row-> 業務,
                        '客戶姓名'=>$row->客戶姓名,
                        '身分證字號'=>$row-> 身分證字號,
                        '聯絡電話'=>$row-> 聯絡電話,
                        '聯絡人'=>$row-> 聯絡人,
                        '聯絡地址'=>$row-> 聯絡地址,
                        '買賣'=>$row-> 買賣,
                        '股票'=>$row-> 股票,
                        '張數'=>$row-> 張數,
                        '成交價'=>$row-> 成交價,
                        '盤價'=>$row-> 盤價,
                        '匯款金額應收帳款'=>$row-> 匯款金額應收帳款,
                        '已收金額'=>$row-> 已收金額,
                        '匯款銀行'=>$row-> 匯款銀行,
                        '匯款分行'=>$row-> 匯款分行,
                        '匯款戶名'=>$row-> 匯款戶名,
                        '匯款帳號'=>$row-> 匯款帳號,
                        '轉讓會員'=>$row-> 轉讓會員,
                        '完稅人'=>$row-> 完稅人,
                        // '一審'=>$row-> 一審,
                        '二審'=>$row-> 二審,
                        '新舊'=>$row-> 新舊,
                        '自行應付'=>$row-> 自行應付,
                        '刻印'=>$row-> 刻印,
                        '刻印收送'=>$row-> 刻印收送,
                        '過戶日期'=>$row-> 過戶日期,
                        '過戶費'=>$row-> 過戶費,
                        '媒合'=>$row-> 媒合,
                        // '收付款'=>$row-> 收付款,
                        '現金或匯款'=>$row-> 現金或匯款,
                        '匯款日期'=>$row-> 匯款日期,
                        '通知查帳'=>$row-> 通知查帳,
                        '成交單狀態'=>$row-> 成交單狀態,
                        // '契約'=>$row-> 契約,
                        // '稅單'=>$row-> 稅單,
                        '已結案'=>$row-> 已結案,
                        '最後動作時間'=>$row-> 最後動作時間,
                                            );
                }
                return $result;
        }
        else {
                return false;
        }
}

    public function get($keyword,$權限名稱,$name) {
        $query = null;
        if(is_null($keyword)) {
            if($權限名稱=='最高權限') {
                $sql = "SELECT * FROM `ORDERS` ORDER BY `最後動作時間` DESC";
                $query = $this->db->query($sql);
            } elseif ($權限名稱=='業務') {
                $this->db->order_by("最後動作時間", "desc"); 
                $query = $this->db->get_where('ORDERS', array('業務' => $name));
            } else {
                $sql = "SELECT * FROM `ORDERS` ORDER BY `最後動作時間` DESC";
                $query = $this->db->query($sql);
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
    }

    public function get_inventory($keyword,$權限名稱,$name) {
        $query = null;
        if(is_null($keyword)) {
            if($權限名稱=='最高權限') {
                $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='庫存' ORDER BY `最後動作時間` DESC";
                $query = $this->db->query($sql);
            } elseif ($權限名稱=='業務') {
                $this->db->order_by("最後動作時間", "desc"); 
                $query = $this->db->get_where('ORDERS', array('業務' => $name,'轉讓會員' => '庫存'));
            } else {
                $sql = "SELECT * FROM `ORDERS` ORDER BY `最後動作時間` DESC";
                $this->db->where('轉讓會員', '庫存');
                $query = $this->db->query($sql);
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
    }

    //抓最後一筆ID
    public function get_last_id() {
        $query = $this->db->query("SELECT * FROM `orders` ORDER BY `ID` DESC LIMIT 1");
        if ($query->num_rows()>0) {
            $row = $query->row();
            $thelastid = $row->ID;
            return $thelastid;
        } else {
            return false;
        }
    }
    
    public function edit($data) {
        $this->db->where('id', $data['ID']);
        $this->db->update('orders', $data);
    }

    public function edit2($data) {
        $sql = '';
    }

    public function add($data) {
        $this->db->insert('orders',$data);
        $id = $this->db->insert_id();
        return $id;
    }

    public function match($self, $other) {
        echo "自己編號:".$self."  對方編號".$other;
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
                                '權限名稱'=>$row-> 權限名稱,);
            }
            return  $result;
        } else {
            return false;
        }
    }

    public function get_customer_info($name) {
        $sql = "SELECT * FROM `orders` WHERE `客戶姓名` = '".$name."' LIMIT 1";
        $query = $this->db->query($sql);
        if($query->result()!=null){
            foreach ($query->result() as $row) {
                $result[] = array('業務'=>$row-> 業務,
                                '客戶姓名'=>$row-> 客戶姓名,
                                '身分證字號'=>$row-> 身分證字號,
                                '聯絡電話'=>$row-> 聯絡電話,
                                '聯絡人'=>$row-> 聯絡人,
                                '聯絡地址'=>$row-> 聯絡地址,);
            }
            return  $result;
        } else {
            return false;
        }
    }

    public function get_dealer_info($name) {
        $sql = "SELECT * FROM `dealer` WHERE `盤商名` = '".$name."'";
        $query = $this->db->query($sql);
        if($query->result()!=null){
            foreach ($query->result() as $row) {
                $result[] = array('盤商名'=>$row-> 盤商名,
                                '盤商傳真'=>$row-> 盤商傳真,
                                '盤商電話'=>$row-> 盤商電話,);
            }
            return  $result;
        } else {
            return false;
        }
    }

    public function get_taxer_info($name) {
        $sql = "SELECT * FROM `taxer` WHERE `完稅姓名` = '".$name."'";
        $query = $this->db->query($sql);
        if($query->result()!=null){
            foreach ($query->result() as $row) {
                $result[] = array(
                                '完稅姓名'=>$row-> 完稅姓名,
                                '完稅ID'=>$row-> 完稅ID,
                                '完稅地址'=>$row-> 完稅地址,);
            }
            return  $result;
        } else {
            return false;
        }
    }

    public function get_payer_info($name) {
        $sql = "SELECT * FROM `taxer` WHERE `完稅姓名` = '".$name."'";
        $query = $this->db->query($sql);
        if($query->result()!=null){
            foreach ($query->result() as $row) {
                $result[] = array(
                                '匯款姓名'=>$row-> 完稅姓名,
                                '匯款銀行'=>$row-> 匯款銀行,
                                '匯款帳號'=>$row-> 匯款帳號,
                                '匯款金額應收帳款'=>$row-> 匯款金額應收帳款,);
            }
            return  $result;
        } else {
            return false;
        }
    }

    public function get_checkbill() {
        $query = array();
        if($_SESSION['權限名稱']=='最高權限'||$_SESSION['權限名稱']=='會計') {
            $sql = "SELECT * FROM `ORDERS` WHERE `買賣`= '1' ORDER BY `最後動作時間` DESC";
            $query = $this->db->query($sql);
        } elseif ($_SESSION['權限名稱']=='業務') {
            $sql = "SELECT * FROM `ORDERS` WHERE `買賣`= '1' AND `業務`='".$_SESSION['NAME']."' ORDER BY `最後動作時間` DESC";
            $query = $this->db->query($sql);
        }
        if($query->num_rows()>0) {
            $result = $this->transformer($query);
            return $result;
        } else {
            return false;
        }
    }

    public function pushinto_checkbill($order_id) {
        $data = array('成交單編號'=>$order_id);
        $this->db->insert('check_money', $data);
        $data2 = array('通知查帳'=>1);
        $this->db->where('ID', $order_id);
        $this->db->update('orders', $data2);
    }

    public function check_money_received($id, $money) {
        $data = array('已收金額'=>$money, '通知查帳'=>'已查帳');
        $this->db->where('ID', $id);
        $this->db->update('orders', $data);
    }

}

?>