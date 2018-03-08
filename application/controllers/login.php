<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct()
    {
        parent::__construct();

        date_default_timezone_set('Asia/Taipei');
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('array');
		$this->load->library('form_validation');
		$this->load->model('login_model');
    }

    // public function index()
    // {
	// 	$this->load->view('templates/header');
	// 	$this->load->view('pages/home');
	// 	$this->load->view('templates/footer');
	// }

	public function index() {
		$this->login();
	}


	public function login()
	{
		// redirect('http://localhost/server7/index.php/orders/index');
		// echo "index";
		// if(isset($_SESSION['ACCOUNT'])){
		// 	echo $_SESSION['ACCOUNT'];
		// }
		// if (isset($_SESSION['ACCOUNT'])) {
		// 	redirect('http://localhost/server7/index.php/orders/index');
		// } else {
		// 	echo "string";
			if (isset($_POST['acct'])&&!is_null($_POST['acct'])) {
				$error_message = '輸入錯誤，再試一次!';
				$flag = $this->login_model->login($_POST['acct'], $_POST['pswd']);
				if ($flag==True) {
					$_SESSION['ACCOUNT'] = $flag['ACCOUNT'];
					$_SESSION['NAME'] = $flag['NAME'];
					// $this->login_model->login_move_record($_SESSION['name'],'login','login');
					redirect('http://localhost/server7/index.php/orders/index');
				} else {
					// $this->load->view('templates/header');
					$this->load->view('pages/login_view',array('error_message' => $error_message));
				}
			} else {
				$error_message = '尚未輸入，請輸入!';
				// $this->load->view('templates/header');
				$this->load->view('pages/login_view',array('error_message' => $error_message));
			}
		// }
	}

	public function logout()
	{
		// $this->login_model->login_move_record($_SESSION['name'],'login','logout');
		unset($_SESSION['ACCOUNT']);
		unset($_SESSION['NAME']);
		session_destroy();
		redirect('http://localhost/server7/index.php/login/index');
	}

}






