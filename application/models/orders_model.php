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
                    '已匯金額已收金額'=>$row-> 已匯金額已收金額,
                    // '待查帳金額'=>$row-> 待查帳金額,
                    // '轉出日期轉入日期'=>$row-> 轉出日期轉入日期,
                    // '匯款人'=>$row-> 匯款人,
                    '匯款銀行'=>$row-> 匯款銀行,
                    '匯款分行'=>$row-> 匯款分行,
                    '匯款戶名'=>$row-> 匯款戶名,
                    '匯款帳號'=>$row-> 匯款帳號,
                    // '匯款帳號末5碼'=>$row-> 匯款帳號末5碼,
                    '轉讓會員'=>$row-> 轉讓會員,
                    '完稅人'=>$row-> 完稅人,
                    // '一審'=>$row-> 一審,
                    '新舊'=>$row-> 新舊,
                    '自行應付'=>$row-> 自行應付,
                    '刻印'=>$row-> 刻印,
                    '收送'=>$row-> 收送,
                    '過戶日期'=>$row-> 過戶日期,
                    '過戶費'=>$row-> 過戶費,
                    '媒合'=>$row-> 媒合,
                    // '收付款'=>$row-> 收付款,
                    // '現金或匯款'=>$row-> 現金或匯款,
                    '匯款日期'=>$row-> 匯款日期,
                    '通知查帳'=>$row-> 通知查帳,
                    '成交單狀態'=>$row-> 成交單狀態,
                    '二審'=>$row-> 二審,
                    // '契約'=>$row-> 契約,
                    // '稅單'=>$row-> 稅單,
                    '已結案'=>$row-> 已結案,
                    '最後動作時間'=>$row-> 最後動作時間,
                                        );
            }
            return $result;
        } else {
             return false;
        }
}

    public function get($keyword,$權限名稱,$name,$type,$keyword2) {
        $query = null;
        if(is_null($keyword)) {
            if ($type == '股票') {
                if($權限名稱=='最高權限') {
                    $sql = "SELECT * FROM `ORDERS` WHERE `股票`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } elseif ($權限名稱=='業務') {
                    $this->db->order_by("最後動作時間", "desc"); 
                    $query = $this->db->get_where('ORDERS', array('業務' => $name, '股票' => $keyword2));
                } else {
                    $sql = "SELECT * FROM `ORDERS` ORDER BY `最後動作時間` DESC";
                    $this->db->where('股票', $keyword2);
                    $query = $this->db->query($sql);
                } 
            } else if ($type == '業務') {
                if($權限名稱=='最高權限') {
                    $sql = "SELECT * FROM `ORDERS` WHERE `業務`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } elseif ($權限名稱=='業務') {
                    $this->db->order_by("最後動作時間", "desc"); 
                    $query = $this->db->get_where('ORDERS', array('業務' => $name, '業務' => $keyword2));
                } else {
                    $sql = "SELECT * FROM `ORDERS` ORDER BY `最後動作時間` DESC";
                    $this->db->where('業務', $keyword2);
                    $query = $this->db->query($sql);
                } 
            } else if ($type == '客戶姓名') {
                if($權限名稱=='最高權限') {
                    $sql = "SELECT * FROM `ORDERS` WHERE `客戶姓名`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } elseif ($權限名稱=='業務') {
                    $this->db->order_by("最後動作時間", "desc"); 
                    $query = $this->db->get_where('ORDERS', array('業務' => $name, '客戶姓名' => $keyword2));
                } else {
                    $sql = "SELECT * FROM `ORDERS` ORDER BY `最後動作時間` DESC";
                    $this->db->where('客戶姓名', $keyword2);
                    $query = $this->db->query($sql);
                } 
            } else if ($type == '聯絡電話') {
                if($權限名稱=='最高權限') {
                    $sql = "SELECT * FROM `ORDERS` WHERE `聯絡電話`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } elseif ($權限名稱=='業務') {
                    $this->db->order_by("最後動作時間", "desc"); 
                    $query = $this->db->get_where('ORDERS', array('業務' => $name, '聯絡電話' => $keyword2));
                } else {
                    $sql = "SELECT * FROM `ORDERS` ORDER BY `最後動作時間` DESC";
                    $this->db->where('聯絡電話', $keyword2);
                    $query = $this->db->query($sql);
                } 
            } else {
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

    public function get_inventory($keyword,$權限名稱,$name,$type,$keyword2) {
        $query = null;
        if(is_null($keyword)) {
            if ($type == '股票') {
                if($權限名稱=='最高權限') {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='庫存' AND `股票`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } elseif ($權限名稱=='業務') {
                    $this->db->order_by("最後動作時間", "desc"); 
                    $query = $this->db->get_where('ORDERS', array('業務' => $name,'轉讓會員' => '庫存', '股票' => $keyword2));
                } else {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='庫存' AND `股票`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } 
            } else if ($type == '業務') {
                if($權限名稱=='最高權限') {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='庫存' AND `業務`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } elseif ($權限名稱=='業務') {
                    $this->db->order_by("最後動作時間", "desc"); 
                    $query = $this->db->get_where('ORDERS', array('業務' => $name,'轉讓會員' => '庫存', '業務' => $keyword2));
                } else {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='庫存' AND `業務`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } 
            } else if ($type == '客戶姓名') {
                if($權限名稱=='最高權限') {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='庫存' AND `客戶姓名`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } elseif ($權限名稱=='業務') {
                    $this->db->order_by("最後動作時間", "desc"); 
                    $query = $this->db->get_where('ORDERS', array('業務' => $name,'轉讓會員' => '庫存', '客戶姓名' => $keyword2));
                } else {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='庫存' AND `客戶姓名`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } 
            } else if ($type == '聯絡電話') {
                if($權限名稱=='最高權限') {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='庫存' AND `聯絡電話`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } elseif ($權限名稱=='業務') {
                    $this->db->order_by("最後動作時間", "desc"); 
                    $query = $this->db->get_where('ORDERS', array('業務' => $name,'轉讓會員' => '庫存', '聯絡電話' => $keyword2));
                } else {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='庫存' AND `聯絡電話`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } 
            } else {
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

    public function get_ko($keyword,$權限名稱,$name,$type,$keyword2) {
        $query = null;
        if(is_null($keyword)) {
            if ($type == '股票') {
                if($權限名稱=='最高權限') {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='KO' AND `股票`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } elseif ($權限名稱=='業務') {
                    $this->db->order_by("最後動作時間", "desc"); 
                    $query = $this->db->get_where('ORDERS', array('業務' => $name,'轉讓會員' => 'KO', '股票' => $keyword2));
                } else {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='KO' AND `股票`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } 
            } else if ($type == '業務') {
                if($權限名稱=='最高權限') {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='KO' AND `業務`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } elseif ($權限名稱=='業務') {
                    $this->db->order_by("最後動作時間", "desc"); 
                    $query = $this->db->get_where('ORDERS', array('業務' => $name,'轉讓會員' => 'KO', '業務' => $keyword2));
                } else {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='KO' AND `業務`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } 
            } else if ($type == '客戶姓名') {
                if($權限名稱=='最高權限') {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='KO' AND `客戶姓名`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } elseif ($權限名稱=='業務') {
                    $this->db->order_by("最後動作時間", "desc"); 
                    $query = $this->db->get_where('ORDERS', array('業務' => $name,'轉讓會員' => 'KO', '客戶姓名' => $keyword2));
                } else {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='KO' AND `客戶姓名`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } 
            } else if ($type == '聯絡電話') {
               if($權限名稱=='最高權限') {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='KO' AND `聯絡電話`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } elseif ($權限名稱=='業務') {
                    $this->db->order_by("最後動作時間", "desc"); 
                    $query = $this->db->get_where('ORDERS', array('業務' => $name,'轉讓會員' => 'KO', '聯絡電話' => $keyword2));
                } else {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='KO' AND `聯絡電話`='".$keyword2."' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } 
            } else {
               if($權限名稱=='最高權限') {
                    $sql = "SELECT * FROM `ORDERS` WHERE `轉讓會員`='KO' ORDER BY `最後動作時間` DESC";
                    $query = $this->db->query($sql);
                } elseif ($權限名稱=='業務') {
                    $this->db->order_by("最後動作時間", "desc"); 
                    $query = $this->db->get_where('ORDERS', array('業務' => $name,'轉讓會員' => 'KO'));
                } else {
                    $sql = "SELECT * FROM `ORDERS` ORDER BY `最後動作時間` DESC";
                    $this->db->where('轉讓會員', 'KO');
                    $query = $this->db->query($sql);
                } 
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
        if ($data['業務'] == 'JOY') {
            $array = array('成交單狀態'=>'審核完成', '二審'=>1);
            $this->db->where('ID', $id);
            $this->db->update('orders', $array);
        }
        return $id;
    }

    public function delete($id) {
        $query = $this->db->get_where('orders', array('ID' => $id));
        $i = $this->transformer($query);
        $this->db->insert('deleted_orders', $i[0]);
        $this->db->where('ID', $id);
        $this->db->delete('orders'); 
    }

    public function add_bill($data) {
        $this->db->insert('bills', $data);
    }

    public function move_record($name, $time, $move, $result, $effect) {
        $query = null;
        if ($move == '修改' || $move == 'admin修改') {
            $result = $result." ".$effect;
        }
        $data = array('員工'=>$name, '時間'=>$time, '動作'=>$move, '影響'=>$result, );
        $this->db->insert('move_record', $data);
    }

    public function get_move_record() {
        $sql = "SELECT * FROM `move_record` ORDER BY `時間` DESC";
        $query = $this->db->query($sql);
        if($query->result()!=null){
            foreach ($query->result() as $row) {
                $result[] = array('ID'=>$row-> ID,
                                '員工'=>$row-> 員工,
                                '時間'=>$row-> 時間,
                                '動作'=>$row-> 動作,
                                '影響'=>$row-> 影響,);
            }
            return  $result;
        } else {
            return false;
        }
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
                                '權限名稱'=>$row-> 權限名稱,
                                '趴數'=>$row-> 趴數,);
            }
            return  $result;
        } else {
            return false;
        }
    }

    public function get_bills() {
        $query = $this->db->get('bills');
        if($query->result()!=null){
            foreach ($query->result() as $row) {
                $result[] = array('id'=>$row-> id,
                                '日期'=>$row-> 日期,
                                '轉出'=>$row-> 轉出,
                                '轉入'=>$row-> 轉入,
                                '帳號'=>$row-> 帳號,
                                '備註'=>$row-> 備註,
                                '是否已對帳'=>$row-> 是否已對帳);
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

    public function get_dealer_info($keyword) {
        if (is_null($keyword)) {
            $sql = "SELECT * FROM `dealer`";
        } else {
            $type = intval($keyword);
            if (is_int($type)) {
                echo "int<br>";
                $sql = "SELECT * FROM `dealer` WHERE `id` = '".$keyword."'";
            } else {
                echo "notint<br>";
                $sql = "SELECT * FROM `dealer` WHERE `盤商名` = '".$keyword."'";
            }
        }
        $query = $this->db->query($sql);
        if($query->result()!=null){
            foreach ($query->result() as $row) {
                $result[] = array('id'=>$row-> id,
                                '盤商名'=>$row-> 盤商名,
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
                                '盤商名'=>$row-> 盤商名,
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
                                '匯款金額'=>$row-> 匯款金額,);
            }
            return  $result;
        } else {
            return false;
        }
    }

    public function get_checkbill() {
        $query = array();
        if($_SESSION['權限名稱']=='最高權限'||$_SESSION['權限名稱']=='會計') {
            $sql = "SELECT * FROM `ORDERS` WHERE `買賣`= '1' AND (`通知查帳` = '未通知' OR `通知查帳` = '待對帳' OR `通知查帳` = '待確認') ORDER BY `最後動作時間` DESC";
            $query = $this->db->query($sql);
        } elseif ($_SESSION['權限名稱']=='業務') {
            $sql = "SELECT * FROM `ORDERS` WHERE `買賣`= '1' AND (`通知查帳` = '未通知' OR `通知查帳` = '待對帳' OR `通知查帳` = '待確認') AND `業務`='".$_SESSION['NAME']."' ORDER BY `最後動作時間` DESC";
            $query = $this->db->query($sql);
        }
        if($query->num_rows()>0) {
            $result = $this->transformer($query);
            return $result;
        } else {
            return false;
        }
    }

    public function Buy_Edit_Model($id, $date, $date2) {
        $data = array('成交單狀態'=>'審核完成', '匯款日期'=>$date, '過戶日期'=>$date2);
        $this->db->where('ID', $id);
        $this->db->update('orders', $data);
    }

    // public function pushinto_checkbill($order_id, $move_time) {
    //     $data2 = array('通知查帳'=>'待對帳','最後動作時間'=>$move_time);
    //     $this->db->where('ID', $order_id);
    //     $this->db->update('orders', $data2);
    // }

    public function check_money_received($id, $成交單編號, $date, $money) {
        /*
        $data = array('通知查帳'=>'待確認');
        $this->db->where('ID', $成交單編號);
        $this->db->update('orders', $data);


        $record = array('待查帳金額'=>0, '查帳日期'=>$date, '已匯金額已收金額'=>$money, '最後動作時間'=>$date);
        $this->db->where('id', $id);
        $this->db->update('check_money_record', $record);
        */

        $record = array('查帳狀態'=>'待確認', '查帳日期'=>$date, '最後動作時間'=>$date);
        $this->db->where('id', $id);
        $this->db->update('check_money_record', $record);
    }

    public function check_money_exported($id, $money) {
        $data = array('已匯金額已收金額'=>$money, '通知查帳'=>$date);
        $this->db->where('ID', $id);
        $this->db->update('orders', $data);
    }

    public function check_bill_reconciled($id) {
        $data = array('是否已對帳'=>'1');
        $this->db->where('id', $id);
        $this->db->update('bills', $data);
    }

    public function inform_check_money_model($id, $way, $date, $name, $last5, $待查帳金額, $move_time) {
        $query = $this->db->get_where('ORDERS', array('ID' => $id));
        $result = $this->transformer($query);
        if ($way == '匯款') {
            $data = array('id'=>null, '成交單編號'=>$id, '轉出日期轉入日期'=>$date, '支付方式'=>$way, '支付人'=>$name, '匯款帳號末5碼'=>$last5, '待查帳金額'=>$待查帳金額, '通知日期'=>$move_time, '最後動作時間'=>$move_time);
        } else {
            //現金
            // $sql = "INSERT INTO `check_money_record`(`id`, `成交單編號`, `支付方式`, `支付人`, `匯款帳號末5碼`, `轉出日期轉入日期`, `待查帳金額`, `已匯金額已收金額`, `通知日期`, `查帳日期`, `最後動作時間`) VALUES (,'".$id."','".$way."','".$name.",null,".$date."','".$待查帳金額.",0,".$move_time."',,'".$move_time."')";
            // $this->db->query($sql);
            $data = array('id'=>NULL, '成交單編號'=>$id, '轉出日期轉入日期'=>$date, '支付方式'=>$way, '支付人'=>$name, '匯款帳號末5碼'=>null, '待查帳金額'=>$待查帳金額, '通知日期'=>$move_time, '最後動作時間'=>$move_time);
        }
        $this->db->insert('check_money_record', $data);
        $this->db->where('ID', $id);
        $this->db->update('orders', array('通知查帳'=>'待對帳'));
    }

    // public function get_ready_to_check() {
    //     $sql = "SELECT * FROM `check_money_record`";
    //     $query = $this->db->query($sql);
    //     if($query->num_rows()>0) {
    //         $result = $this->transformer($query);
    //         return $result;
    //     } else {
    //         return false;
    //     }
    // }

    public function check_end_model($id, $成交單編號, $money, $date, $move_time) {
        $order = $this->get($成交單編號, $_SESSION['權限名稱'], $_SESSION['NAME'],null,null,null);
        $總匯款金額 = $order[0]['已匯金額已收金額'] + $money;
        if ($總匯款金額 == $order[0]['匯款金額應收帳款']) {
            //一次匯款完
            if ($order[0]['業務'] == 'JOY') {
                //大姊確認金額就結案了,不用上傳水單
                $data = array('已匯金額已收金額'=>$總匯款金額, '通知查帳'=>$date, '已結案'=>1, '最後動作時間'=>$move_time);
            } else {
                $data = array('已匯金額已收金額'=>$總匯款金額, '通知查帳'=>$date, '最後動作時間'=>$move_time);
            }
            
        } else {
            //還沒匯完
            $data = $this->get_check_record($成交單編號, null);
            if (count($data)>1) {
                $data = array('已匯金額已收金額'=>$總匯款金額,'通知查帳'=>'待對帳', '最後動作時間'=>$move_time);
            } else {
                $data = array('已匯金額已收金額'=>$總匯款金額,'通知查帳'=>'未通知', '最後動作時間'=>$move_time);
            }
        }

        $this->db->where('ID', $成交單編號);
        $this->db->update('orders', $data);

        //待查帳金額轉至已匯金額, 而後歸零
        $record = array('待查帳金額'=>0, '查帳日期'=>$date, '已匯金額已收金額'=>$money, '查帳狀態'=>'已確認', '最後動作時間'=>$move_time);
        $this->db->where('id', $id);
        $this->db->update('check_money_record', $record);
    }

    public function get_check_record($成交單編號, $type) {
        if (is_null($成交單編號)) {
            if ($type == '未查帳') {
                $sql = "SELECT * FROM `check_money_record` WHERE `待查帳金額`!=0 ORDER BY `最後動作時間` DESC";
            } elseif($type == '已查帳') {
                //查完帳,待查帳金額=0,已收金額!=0
                $sql = "SELECT * FROM `check_money_record` WHERE `待查帳金額`=0 ORDER BY `最後動作時間` DESC";
            }
        } else {
            $sql = "SELECT * FROM `check_money_record` WHERE `成交單編號` = $成交單編號 and `待查帳金額`!=0";
        }

        $query = $this->db->query($sql);
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
                    $result[] = array('id'=>$row-> id,
                    '成交單編號'=>$row-> 成交單編號,
                    '支付方式'=>$row-> 支付方式,
                    '支付人'=>$row-> 支付人,
                    '匯款帳號末5碼'=>$row-> 匯款帳號末5碼,
                    '轉出日期轉入日期'=>$row-> 轉出日期轉入日期,
                    '待查帳金額'=>$row-> 待查帳金額,
                    '已匯金額已收金額'=>$row-> 已匯金額已收金額,
                    '查帳狀態'=>$row-> 查帳狀態,
                    '通知日期'=>$row-> 通知日期,
                    '查帳日期'=>$row-> 查帳日期,
                    '最後動作時間'=>$row-> 最後動作時間);
            }
            return $result;
        } else {
            return false;
        }
    }

    public function finish_order($id) {
        $sql = "UPDATE `orders` SET `已結案`= 1 WHERE `ID` = ".$id;
        $query = $this->db->query($sql);
    }

    public function add_dealer_model($data) {
        $this->db->insert('dealer',$data);
    }

    public function edit_dealer_model($data) {
        $this->db->where('id', $data['id']);
        $this->db->update('dealer', $data);
    }


}

?>