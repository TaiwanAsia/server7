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
		$this->load->model('orders_model');
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
		// echo $_SESSION['ACCOUNT'];
		// if (isset($_SESSION['ACCOUNT'])) {
		// 	echo $_SESSION['ACCOUNT'];
		// 	redirect('http://localhost/server7/index.php/orders/index');
		// } else {

			if (isset($_POST['acct'])&&!is_null($_POST['acct'])) {
				$error_message = '輸入錯誤，再試一次!';
				$flag = $this->login_model->login($_POST['acct'], $_POST['pswd']);
				if ($flag==True) {
					$_SESSION['ACCOUNT'] = $flag['ACCOUNT'];
					$_SESSION['權限名稱'] = $flag['權限名稱'];
					$_SESSION['NAME'] = $flag['NAME'];
					$_SESSION['趴數'] = $flag['趴數'];
					$_SESSION['勞保'] = $flag['勞保'];
					$_SESSION['健保'] = $flag['健保'];
					$_SESSION['勞退'] = $flag['勞退'];
					$authority = $this->login_model->get_authority($_SESSION['權限名稱']);

					$_SESSION['帳號設定權限'] = $authority[0]['帳號設定權限'];
					$_SESSION['新增權限'] = $authority[0]['新增權限'];
					$_SESSION['編輯權限'] = $authority[0]['編輯權限'];
					$_SESSION['刪除權限'] = $authority[0]['刪除權限'];
                    $_SESSION['成交日期權限'] = $authority[0]['成交日期權限'];
                    $_SESSION['業務權限'] = $authority[0]['業務權限'];
                    $_SESSION['所有成交單權限'] = $authority[0]['所有成交單權限'];
                    $_SESSION['客戶姓名權限'] = $authority[0]['客戶姓名權限'];
                    $_SESSION['身分證字號權限'] = $authority[0]['身分證字號權限'];
                    $_SESSION['聯絡電話權限'] = $authority[0]['聯絡電話權限'];
                    $_SESSION['聯絡人權限'] = $authority[0]['聯絡人權限'];
                    $_SESSION['聯絡地址權限'] = $authority[0]['聯絡地址權限'];
                    $_SESSION['股票資訊權限'] = $authority[0]['股票資訊權限'];
                    $_SESSION['盤價權限'] = $authority[0]['盤價權限'];
                    $_SESSION['匯款資訊權限'] = $authority[0]['匯款資訊權限'];
                    $_SESSION['轉讓會員權限'] = $authority[0]['轉讓會員權限'];
                    $_SESSION['完稅人權限'] = $authority[0]['完稅人權限'];
                    $_SESSION['媒合權限'] = $authority[0]['媒合權限'];
                    $_SESSION['一審權限'] = $authority[0]['一審權限'];
                    $_SESSION['二審權限'] = $authority[0]['二審權限'];
                    $_SESSION['通知查帳權限'] = $authority[0]['通知查帳權限'];
                    $_SESSION['剩下資訊權限'] = $authority[0]['剩下資訊權限'];

					$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '登入', null, null);

					// redirect('../index.php/orders/go_assign');
					$newURL = "../orders/go_assign";
					header('Location: '.$newURL);
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

    //進入帳號設定
	public function account() {
		$data = $this->login_model->show_account(null);//撈資料
		$this->load->view('templates/header');
		$this->load->view('pages/account/account_view', array('data' => $data,));
	}

	//進入權限設定
	public function authority() {
		$data = $this->login_model->show_authority(null);//撈資料
		$this->load->view('templates/header');
		$this->load->view('pages/account/authority', array('data' => $data,));
	}

	//刪除帳號
	public function delete_account() {
		$account_id = $_POST['account_id'];
		$this->login_model->delete_account($account_id);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '刪除', $account_id, null);
		$this->account();
	}

	//新增帳號頁面
	public function go_add_account() {
		$data = $this->login_model->show_account(null);//先撈account資料
		$this->load->view('templates/header');
		$this->load->view('pages/account/add_account_view', array('data' => $data,));
	}

	//新增帳號
	public function add_account() {
		$data = array('NAME' => $_POST['name'],
						'ACCOUNT' => $_POST['account'],
						'PASSWORD' => $_POST['password'],
						'權限名稱' => $_POST['權限名稱'],
						'趴數' => $_POST['趴數'],
						'勞保' => $_POST['勞保'],
						'健保' => $_POST['健保'],
						'勞退' => $_POST['勞退'],
						'隱藏' => $_POST['隱藏'],);
		$id = $this->login_model->add_account($data);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '新增帳號', $id, null);
		$this->account();
	}

	//編輯帳號頁面
	public function go_edit_account() {
		$account_id = $_POST['account_id'];
		$data = $this->login_model->show_account($account_id); //撈欲編輯資料
		$this->load->view('templates/header');
		$this->load->view('pages/account/edit_account_view', array('data' => $data,));
	}

	//編輯帳號
	public function edit_account() {
		$data = array('ID' => $_POST['id'],
						'NAME' => $_POST['name'],
						'ACCOUNT' => $_POST['account'],
						'PASSWORD' => $_POST['password'],
						'權限名稱' => $_POST['權限名稱'],
						'趴數' => $_POST['趴數'],
						'勞保' => $_POST['勞保'],
						'健保' => $_POST['健保'],
						'勞退' => $_POST['勞退'],
						'隱藏' => $_POST['隱藏'],);
		$this->login_model->edit_account($data);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '編輯帳號', $_POST['id'], null);
		$this->account();
	}

	public function logout()
	{
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '登出', null, null);
		unset($_SESSION['ACCOUNT']);
		unset($_SESSION['權限名稱']);
		unset($_SESSION['NAME']);
		unset($_SESSION['趴數']);
		session_destroy();
		redirect('login/index');
	}

}






