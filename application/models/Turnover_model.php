<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Turnover_model extends CI_Model {

	public function get_turnover() {
		$sql = "SELECT * FROM `table 1`";
        $query = $this->db->query($sql);

       	if ($query->num_rows() > 0) {
                foreach ($query->result() as $row) {
                        $result[] = array('ID'=>$row-> ID,
                        '客戶姓名'=>$row-> 客戶姓名,
                        '身分證字號'=>$row-> 身分證字號,
                        '聯絡地址'=>$row-> 聯絡地址,
                        '聯絡電話'=>$row-> 聯絡電話,
                        '成交日期'=>$row-> 成交日期,
                        '業務'=>$row-> 業務,
                        '轉讓會員'=>$row-> 轉讓會員,
                        '股票'=>$row-> 股票,
                        '買賣'=>$row-> 買賣,
                        '張數'=>$row-> 張數,
                        '成交價'=>$row-> 成交價,
                        '盤價'=>$row-> 盤價,
                        '匯款金額應收帳款'=>$row-> 匯款金額應收帳款,
                        '刻印'=>$row-> 刻印,
                        '刻印收送'=>$row-> 刻印收送,
                        '完稅人'=>$row-> 完稅人,
                        // '交割日期'=>$row-> 交割日期,
                        '過戶費'=>$row-> 過戶費,
                        '自行應付'=>$row-> 自行應付,
                        // '收送費用'=>$row-> 收送費用,
                        '聯絡人'=>$row-> 聯絡人,
                        '匯款日期'=>$row-> 匯款日期,
                        '過戶日期'=>$row-> 過戶日期,
                        // '審核完日期'=>$row-> 審核完日期,
                        '已匯金額已收金額'=>$row-> 已匯金額已收金額,
                        );
                }
                return $result;
        }
        else {
                return false;
        }
	}

    public function insert_to_orders($data) {
        $this->db->insert('orders',$data);
    }

}