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
			redirect('http://localhost/server7/index.php/login/index');
		} else {
			$orders = $this->orders_model->get(null);
			$arrayName = array('orders' => $orders,
								);
								
			$this->show($arrayName);
		}
	}

	public function new_order()
    {
		$this->load->view('templates/header');
		$this->load->view('pages/new_order');
	}   

	public function add_order()
	{	
		$data = array('日期' => $_POST['日期'],
						'業務' => $_POST['業務'],
						'客戶姓名' => $_POST['客戶姓名'],
						'身分證字號' => $_POST['身分證字號'],
						'聯絡電話' => $_POST['聯絡電話'],
						'聯絡人' => $_POST['聯絡人'],
						'聯絡地址' => $_POST['聯絡地址'],
						'買賣' => $_POST['買賣'],
						'股票' => $_POST['股票'],
						'張數' => $_POST['張數'],
						'完稅價' => $_POST['完稅價'],
						'成交價' => $_POST['成交價'],
						'盤價' => $_POST['盤價'],
						'匯款金額' => $_POST['匯款金額'],
						'匯款銀行' => $_POST['匯款銀行'],
						'匯款分行' => $_POST['匯款分行'],
						'匯款戶名' => $_POST['匯款戶名'],
						'轉讓會員' => $_POST['轉讓會員'],
						'完稅人' => $_POST['完稅人'],
						'新舊' => $_POST['新舊'],
						'自行應付' => $_POST['自行應付'],
						'刻印' => $_POST['刻印'],
						'過戶費' => $_POST['過戶費'],
						'媒合' => $_POST['媒合'],
						'收付款' => $_POST['收付款'],
						'過戶日' => $_POST['過戶日'],
						'通知查帳' => $_POST['通知查帳'],
						'契約' => $_POST['契約'],
						'稅單' => $_POST['稅單'],);
		$this -> orders_model -> add($data);
		$this->index();
	}
	
	public function checkbill() {
		$this->load->view('templates/header');
		$this->load->view('pages/receivable_view');
	}


}






