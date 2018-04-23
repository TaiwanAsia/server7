<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Taipei');
		$this->load->helper(array('form', 'url', 'array'));
		$this->load->library('form_validation');
		$this->load->model('orders_model');
	}

	public function show($arr_data)
    {
		$this->load->view('templates/header');
		// $this->load->view('templates/sidebar');
		$this->load->view('pages/order_view', $arr_data);
		// $this->load->view('templates/footer');
    }

    public function index()
    {
		if (!isset($_SESSION['ACCOUNT'])) {
			redirect('index.php/login/index');
		} else {
			$orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
			$employees = $this->orders_model->get_employee();
			$arrayName = array('orders' => $orders,
								'employees' => $employees,);
			$this->show($arrayName);
		}
	}

	public function new_order()
    {
		$orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
		$arrayName = array('orders' => $orders,
								);
		$this->load->view('templates/header');
		$this->load->view('pages/new_order', $arrayName);
	}   

	public function add_order()
	{	
		$data = array(
						'成交日期' => $_POST['成交日期'],
						'業務' => $_POST['業務'],
						'客戶姓名' => $_POST['客戶姓名'],
						'身分證字號' => $_POST['身分證字號'],
						'聯絡電話' => $_POST['聯絡電話'],
						'聯絡人' => $_POST['聯絡人'],
						'聯絡地址' => $_POST['聯絡地址'],
						'買賣' => $_POST['買賣'],
						'股票' => $_POST['股票'],
						'張數' => $_POST['張數'],
						'成交價' => $_POST['成交價'],
						'盤價' => $_POST['盤價'],
						'匯款金額' => $_POST['匯款金額'],
						'匯款銀行' => $_POST['匯款銀行'],
						'匯款分行' => $_POST['匯款分行'],
						'匯款戶名' => $_POST['匯款戶名'],
						'匯款帳號' => $_POST['匯款帳號'],
						'轉讓會員' => $_POST['轉讓會員'],
						'完稅人' => $_POST['完稅人'],
						'新舊' => $_POST['新舊'],
						'自行應付' => $_POST['自行應付'],
						'刻印' => $_POST['刻印'],
						'刻印收送' => $_POST['刻印收送'],
						'過戶日期' => $_POST['過戶日期'],
						'過戶費' => $_POST['過戶費'],
						'媒合' => $_POST['媒合'],
						'收付款' => $_POST['收付款'],
						'現金或匯款' => $_POST['現金或匯款'],
						'匯款日期' => $_POST['匯款日期'],
						'通知查帳' => $_POST['通知查帳'],
						'契約' => $_POST['契約'],
						'稅單' => $_POST['稅單'],
						'成交單狀態' => $_POST['成交單狀態'],
						'已結案' => $_POST['已結案'],
					);
		$insert_id = $this -> orders_model -> add($data);
		$this->index();
	}
	
	public function checkbill() {
		$this->load->view('templates/header');
		$this->load->view('pages/receivable_view');
	}

	public function upload_contact() {
		$id = $_POST['id'];
		if ($_FILES["file"]["error"] > 0){
			echo "Error: " . $_FILES["file"]["error"];
		} else {
			echo "編號: " . $id."<br>";
			echo "檔案名稱: " . $_FILES["file"]["name"]."<br/>";
			echo "檔案類型: " . $_FILES["file"]["type"]."<br/>";
			echo "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
			echo "暫存名稱: " . $_FILES["file"]["tmp_name"];
			if (file_exists("upload/contact/" . $id)){
				echo "檔案已經存在，請勿重覆上傳相同檔案<br>";
				$this->index();
			} else {
				move_uploaded_file($_FILES["file"]["tmp_name"],"upload/contact/".$id);
				$this->index();
			}
		}
	}

	public function upload_tax() {
		$id = $_POST['id'];
		if ($_FILES["file"]["error"] > 0){
			echo "Error: " . $_FILES["file"]["error"];
		} else {
			echo "編號: " . $id."<br>";
			echo "檔案名稱: " . $_FILES["file"]["name"]."<br/>";
			echo "檔案類型: " . $_FILES["file"]["type"]."<br/>";
			echo "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
			echo "暫存名稱: " . $_FILES["file"]["tmp_name"];
			if (file_exists("upload/tax/" . $id)){
				echo "檔案已經存在，請勿重覆上傳相同檔案<br>";
				$this->index();
			} else {
				move_uploaded_file($_FILES["file"]["tmp_name"],"upload/tax/".$id);
				$this->index();
			}
		}
	}

	public function match() {
		// echo $_POST['欲媒合對方ID'].", ".$_POST['欲媒合自身ID']."<br>";
		$this -> orders_model -> match($_POST['欲媒合自身ID'], $_POST['欲媒合對方ID']);
		$this->index();
	}


	public function go_edit() {
		$result = $this -> orders_model -> get($_GET['id'],null,null);
		$old_date_timestamp = strtotime($result[0]['成交日期']);
		$new_date = date('Y/m/d', $old_date_timestamp);
		$result[0]['日期'] = $new_date;
		// foreach ($result[0] as $key => $value) {
		// 	echo $key.": ".$value."<br>";
		// };  
		$this->load->view('templates/header');
		$this->load->view('pages/edit_order_view',array('result' => $result,));
	}

	//改成交單狀態
	public function edit_order_status() {
		$data = array(
			'ID' => $_POST['ID'],
			'客戶姓名' => $_POST['客戶姓名'],
			'身分證字號' => $_POST['身分證字號'],
			'聯絡地址' => $_POST['聯絡地址'],
			'聯絡電話' => $_POST['聯絡電話'],
			'成交日期' => $_POST['成交日期'],
			'過戶日期' => $_POST['過戶日期'],
			'股票' => $_POST['股票'],
			'買賣' => $_POST['買賣'],
			'張數' => $_POST['張數'],
			'成交價' => $_POST['成交價'],
			'盤價' => $_POST['盤價'],
			'自行應付' => $_POST['自付額'],
			'匯款銀行' => $_POST['匯款銀行'],
			'匯款分行' => $_POST['匯款分行'],
			'匯款戶名' => $_POST['匯款戶名'],
			'匯款帳號' => $_POST['匯款帳號'],
			'轉讓會員' => $_POST['轉讓會員'],
			'匯款金額' => $_POST['匯款金額'],
			'完稅人' => $_POST['完稅人'],
			'過戶費' => $_POST['過戶費'],
			'刻印收送' => $_POST['刻印收送'],
			'成交單狀態' => $_POST['成交單狀態'],
			'現金或匯款' => $_POST['現金或匯款'],
			'匯款日期' => $_POST['匯款日期'],);
		$this -> orders_model -> edit($data);
		$this->index();

	}

	//單純修改成交單內容
	public function edit_order() {
		$data = array('成交日期' => $_POST['成交日期'],
						'ID' => $_POST['ID'],
						'業務' => $_POST['業務'],
						'客戶姓名' => $_POST['客戶姓名'],
						'身分證字號' => $_POST['身分證字號'],
						'聯絡電話' => $_POST['聯絡電話'],
						'聯絡人' => $_POST['聯絡人'],
						'聯絡地址' => $_POST['聯絡地址'],
						'買賣' => $_POST['買賣'],
						'股票' => $_POST['股票'],
						'張數' => $_POST['張數'],
						'成交價' => $_POST['成交價'],
						'盤價' => $_POST['盤價'],
						'匯款金額' => $_POST['匯款金額'],
						'匯款銀行' => $_POST['匯款銀行'],
						'匯款分行' => $_POST['匯款分行'],
						'匯款帳號' => $_POST['匯款帳號'],
						'匯款戶名' => $_POST['匯款戶名'],
						'轉讓會員' => $_POST['轉讓會員'],
						'完稅人' => $_POST['完稅人'],
						'新舊' => $_POST['新舊'],
						'自行應付' => $_POST['自行應付'],
						'刻印' => $_POST['刻印'],
						'過戶費' => $_POST['過戶費'],
						'最後動作時間' => date('Y-m-d H:i:s'),);
		$this -> orders_model -> edit($data);
		$this->index();
	}
}






