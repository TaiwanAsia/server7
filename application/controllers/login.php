<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {


	public function __construct()
    {
        parent::__construct();

        $newURL = "../login/index";
        if(isset($_SESSION['expiretime'])) {
            if($_SESSION['expiretime'] < time()){
                header('Location: '.$newURL);
                $_SESSION['expiretime'] = time() + 3600; // 給予時間戳
            } else {
                $_SESSION['expiretime'] = time() + 3600; // 刷新時間戳
            }
        } else {
            header('Location: '.$newURL);
            $_SESSION['expiretime'] = time() + 3600; // 給予時間戳
        }

        date_default_timezone_set('Asia/Taipei');
        $this->load->helper('url');
		$this->load->helper('form');
		$this->load->helper('array');
		$this->load->library('form_validation');
		$this->load->model('login_model');
		$this->load->model('orders_model');
    }

	public function index() {
		$this->login();
	}

	public function login()
	{

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

                $_SESSION['expiretime'] = time() + 3600;

                if(!empty($_SERVER["HTTP_CLIENT_IP"])){
                    $cip = $_SERVER["HTTP_CLIENT_IP"];
                }
                elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
                    $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
                }
                elseif(!empty($_SERVER["REMOTE_ADDR"])){
                    $cip = $_SERVER["REMOTE_ADDR"];
                }
                else{
                    $cip = "無法取得IP位址！";
                }

                $this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '登入 ', $cip, null);

                header("refresh:2;url=//".$_SERVER['HTTP_HOST']."/server7/orders/index");

            } else {
                $this->load->view('pages/login_view',array('error_message' => $error_message));
            }
        } else {
            $error_message = '尚未輸入，請輸入!';
            $this->load->view('pages/login_view',array('error_message' => $error_message));
        }
	}

    //進入帳號設定
	public function account() {
		$data = $this->login_model->show_account(null);//撈資料
        foreach ($data as $k => $v){
            if (in_array($v['NAME'],array('庫存','盤商','KO'))){
                unset($data[$k]);
            }
        }
        $data = array_values($data);
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
	public function delete_employee() {
		$employee_id = $_GET['id'];
        $employee_name = $_GET['name'];
		$this->login_model->delete_employee($employee_id);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '刪除帳號', $employee_name, null);
		$this->account();
	}

	//新增帳號頁面
	public function go_add_employee($msg=false) {
		$data = $this->login_model->show_account(null);//先撈account資料
		$this->load->view('templates/header');
		$this->load->view('pages/account/add_account_view', array('data' => $data, 'msg'=>$msg));
	}

	//新增帳號
	public function add_employee() {

        $data = array('NAME' => $_POST['name'],
						'ACCOUNT' => $_POST['account'],
						'PASSWORD' => $_POST['password'],
						'權限名稱' => $_POST['權限名稱'],
						'趴數' => $_POST['趴數'],
						'勞保' => $_POST['勞保'],
						'健保' => $_POST['健保'],
						'勞退' => $_POST['勞退'],
						'隱藏' => $_POST['隱藏'],);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', '用戶名', 'required');
        $this->form_validation->set_rules('account', '帳號', 'required');
        $this->form_validation->set_rules('password', '密碼', 'required');
        $this->form_validation->set_rules('權限名稱', '權限名稱', 'required');
        $this->form_validation->set_rules('趴數', '趴數', 'required|greater_than[0]', array('greater_than'=>'趴數需大於0'));

        if ($this->form_validation->run() == FALSE){
            $msg = validation_errors();
            $this->go_add_employee(strip_tags($msg));
        } else {
            $id = $this->login_model->add_account($data);
            $this->account();
        }
	}

	//編輯帳號頁面
	public function go_edit_employee($employee_id=false, $msg=false) {
	    if ($employee_id){
	        $id = $employee_id;
        } else {
	        $id = $_GET['employee_id'];
        }
		$data = $this->login_model->show_account($id); //撈欲編輯資料
		$this->load->view('templates/header');
		$this->load->view('pages/account/edit_account_view', array('data' => $data, 'msg'=>$msg));
	}

	//編輯帳號
	public function edit_employee() {
	    $employee_id = $_POST['id'];
	    $employee = $this->login_model->show_account($employee_id);
	    $oldPassword = $employee[0]['PASSWORD'];
	    $newPassword = $_POST['password'];
		$data = array('ID' => $_POST['id'],
						'NAME' => $_POST['name'],
						'ACCOUNT' => $_POST['account'],
						'PASSWORD'=> empty($newPassword) ? $oldPassword : md5(substr(md5($newPassword.SECRETBABE), 0, 16)),
						'權限名稱' => $_POST['權限名稱'],
						'趴數' => $_POST['趴數'],
						'勞保' => $_POST['勞保'],
						'健保' => $_POST['健保'],
						'勞退' => $_POST['勞退'],
						'隱藏' => $_POST['隱藏'],);

        $this->load->library('form_validation');
        $this->form_validation->set_rules('name', '用戶名', 'required');
        $this->form_validation->set_rules('account', '帳號', 'required');
        $this->form_validation->set_rules('權限名稱', '權限名稱', 'required');
        $this->form_validation->set_rules('趴數', '趴數', 'required|greater_than_equal_to[0]', array('greater_than'=>'趴數不可為負數'));

        if ($this->form_validation->run() == FALSE){
            $msg = validation_errors();
            $this->go_edit_employee($employee_id, strip_tags($msg));
        } else {
            $this->login_model->edit_account($data);
            $this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '編輯帳號', 'id: '.$_POST['id'], null);
            $this->account();
        }
	}

	public function logout()
	{
	    if (isset($_SESSION['NAME'])) {
            $this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '登出', null, null);
            unset($_SESSION['ACCOUNT']);
            unset($_SESSION['權限名稱']);
            unset($_SESSION['NAME']);
            unset($_SESSION['趴數']);
            unset($_SESSION['expiretime']);
            session_destroy();
            header("refresh:2;url=//".$_SERVER['HTTP_HOST']."/server7/login/");
            echo "<div style='display: flex; flex-direction: row; height: 500px; justify-content: center; align-items: center';><h3 style='letter-spacing:1.5px;'>請稍等...三秒後自動跳轉至登入頁...</h3>";
        } else {
            header("refresh:2;url=//".$_SERVER['HTTP_HOST']."/server7/login/");
            echo "<h3>請稍等...三秒後自動跳轉至登入頁...</h3></div>";
        }

	}

}






