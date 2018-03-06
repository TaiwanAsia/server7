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
                        '轉讓會員'=>$row-> 轉讓會員,
                        '完稅人'=>$row-> 完稅人,
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

    public function add($data) {
        $this->db->insert('ORDERS',$data);
    }
}

?>