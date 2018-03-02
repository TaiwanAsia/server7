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
		$this->form_validation->set_rules('日期', '日期', 'required');
		$this->form_validation->set_rules('業務', '業務', 'required');
		$this->form_validation->set_rules('客戶姓名', '客戶姓名', 'required');
		$this->form_validation->set_rules('身分證字號', '身分證字號', 'required');
		$this->form_validation->set_rules('聯絡電話', '聯絡電話', 'required');
		$this->form_validation->set_rules('聯絡人', '聯絡人', 'required');
		$this->form_validation->set_rules('聯絡地址', '聯絡地址', 'required');
		$this->form_validation->set_rules('買賣', '買賣', 'required');
		$this->form_validation->set_rules('股票', '股票', 'required');
		$this->form_validation->set_rules('張數', '張數', 'required');

		$this->form_validation->set_rules('成交價', '成交價', 'required');
		$this->form_validation->set_rules('盤價', '盤價', 'required');
		$this->form_validation->set_rules('匯款金額', '匯款金額', 'required');
		$this->form_validation->set_rules('匯款銀行', '匯款銀行', 'required');

		$this->form_validation->set_rules('匯款戶名', '匯款戶名', 'required');
		$this->form_validation->set_rules('轉讓會員', '轉讓會員', 'required');
		$this->form_validation->set_rules('完稅人', '完稅人', 'required');
		$this->form_validation->set_rules('新舊', '新舊', 'required');



		$this->form_validation->set_rules('媒合', '媒合', 'required');
		$this->form_validation->set_rules('付款', '付款', 'required');
		$this->form_validation->set_rules('過戶日', '過戶日', 'required');
		$this->form_validation->set_rules('通知查帳', '通知查帳', 'required');
		$this->form_validation->set_rules('契約', '契約', 'required');
		$this->form_validation->set_rules('稅單', '稅單', 'required');

		$this->form_validation->set_message('日期', 'The {field} field can not be the word "test"');

		if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('pages/new_order');
        }
        else
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
							'付款' => $_POST['付款'],
							'過戶日' => $_POST['過戶日'],
							'通知查帳' => $_POST['通知查帳'],
							'契約' => $_POST['契約'],
							'稅單' => $_POST['稅單'],);
			// print_r($data);
			$this -> orders_model -> add($data);
			$this->index();
		}
	}
	
	public function testing() {
		// $this->load->view('templates/header');
		$this->load->view('pages/testing');
		// $this->load->view('templates/footer');
	}


}






