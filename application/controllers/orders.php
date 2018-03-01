<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Taipei');
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('array');
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
	
	public function testing() {
		// $this->load->view('templates/header');
		$this->load->view('pages/testing');
		// $this->load->view('templates/footer');
	}


}






