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

	public function session_check() {
		if (!isset($_SESSION['ACCOUNT'])) {
    		redirect('index.php/login/index');
    	} else {
    		return True;
    	}
	}

	public function show($arr_data)
    {
    	$boo = $this->session_check();
    	if ($boo) {
    		$this->load->view('templates/header');
			$this->load->view('pages/order_view', $arr_data);
    	}
    }

    public function index() {
    	$employees = $this->orders_model->get_employee(null);
    	$need = $this->orders_model->get_need_model(null);
    	$arrayName = array('need' => $need,
							'employees' => $employees,);
		$this->load->view('templates/header');
		$this->load->view('pages/home', $arrayName);
    }

    public function go_orders()
    {
    	// The following code define the actions when a 'clickable' table element
    	// is clicked.
		if (!isset($_SESSION['ACCOUNT'])) {
			// If not logged in, redirect to 'login/index'
			redirect('index.php/login/index');
		} else {
			// Handles queries on orders between 'date1' and 'date2'
			if (isset($_GET['date1']) && isset($_GET['date2']) && isset($_GET['業務'])) {
				$orders = $this->orders_model->get_byDate($_SESSION['權限名稱'],$_SESSION['NAME'],$_GET['業務'],$_GET['date1'],$_GET['date2']);
			// Handles 'click' on 股票
			} else if (isset($_GET['股票'])) {
				$orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'股票',$_GET['股票']);
			// Handles 'click' on 業務
			} else if (isset($_GET['業務'])) {
				$orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'業務',$_GET['業務']);
			// Handles 'click' on 客戶姓名
			} else if (isset($_GET['客戶姓名'])) {
				$orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'客戶姓名',$_GET['客戶姓名']);
			// Handles 'click' on 連絡電話
			} else if (isset($_GET['聯絡電話'])) {
				$orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'聯絡電話',$_GET['聯絡電話']);
			// Default handlers for unhandled actions
			} else {
				$orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME'],null,null);
			}
			$all_orders = $orders;
			$employees = $this->orders_model->get_employee(null);
			$arrayName = array('orders' => $orders,
								'all_orders' => $all_orders,
								'employees' => $employees,);
			$this->show($arrayName);
		}
	}

	public function search() {
		$orders = $this->orders_model->get($_GET['keyword'],$_SESSION['權限名稱'],$_SESSION['NAME'],null,null);
		$employees = $this->orders_model->get_employee(null);
		$arrayName = array('orders' => $orders,
							'employees' => $employees,);
		$this->show($arrayName);
	}

	public function new_order()
    {
		$orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME'],null,null);
		$employees = $this->orders_model->get_employee(null);
		$arrayName = array('orders' => $orders,
							'employees' => $employees,);

		$this->load->view('templates/header');
		$this->load->view('pages/new_order', $arrayName);
	}

	public function add_order()
	{
		$thelast_id = $this->orders_model->get_last_id();
		$today_y = date('Y');
		$today_m = date('m');
		$id_y = substr($thelast_id, 0, 4);
		$id_m = substr($thelast_id, 4, 2);
		if (($today_y == $id_y)&&($today_m == $id_m)) {
			$insert_id = $thelast_id+1;
		} else {
			$insert_id = $today_y.$today_m."0001";
		}
		$data = array(	'ID' => $insert_id,
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
						'匯款金額應收帳款' => $_POST['匯款金額應收帳款'],
						'匯款日期' => $_POST['匯款日期'],
						'匯款銀行' => $_POST['匯款銀行'],
						'匯款分行' => $_POST['匯款分行'],
						'匯款戶名' => $_POST['匯款戶名'],
						'匯款帳號' => $_POST['匯款帳號'],
						'轉讓會員' => $_POST['轉讓會員'],
						'完稅人' => $_POST['完稅人'],
						'新舊' => $_POST['新舊'],
						'自行應付' => $_POST['自行應付'],
						'刻印' => $_POST['刻印'],
						'收送' => $_POST['收送'],
						'過戶日期' => $_POST['過戶日期'],
						'過戶費' => $_POST['過戶費'],
						'備註' => $_POST['備註'],
						'最後動作時間' => date('Y-m-d H:i:s'),
					);
		$insert_id = $this -> orders_model -> add($data);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '新增', $insert_id, null);
		$this->go_orders();
	}

	public function record_info($data) {
		if ($data['買賣'] == 1) {
			//客戶買方 成>盤
			$價差 = $data['成交價'] - $data['盤價'];
			$稅金 = $data['成交價']*$data['張數']*1000*0.003;
			$個人實得 = ($價差*$data['張數']*1000 - $稅金 - $data['過戶費'] - $data['自行應付'])*$_SESSION['趴數'];
		} else {
			//客戶賣方 盤>成
			$價差 = $data['盤價'] - $data['成交價'];
			$稅金 = $data['盤價']*$data['張數']*1000*0.003;
			$個人實得 = ($價差*$data['張數']*1000 - $稅金 - $data['過戶費'] - $data['自行應付'])*$_SESSION['趴數'];
		}
		
		$result = array( 'ID' => $data['ID'],
						'日期' => $data['成交日期'],
						'姓名' => $data['客戶姓名'],
						'買賣' => $data['買賣'],
						'業務' => $data['業務'],
						'標的名稱' => $data['股票'],
						'張數' => $data['張數'],
						'成交價' => $data['成交價'],
						'盤價' => $data['盤價'],
						'價差' => $價差,
						'稅金' => $稅金,
						'過戶費' => $data['過戶費'],
						'金額' => $data['匯款金額應收帳款'],
						'自得比率' => $_SESSION['趴數'],
						'自行應付' => $data['自行應付'],
						// '扣款利息' => $_POST['扣款利息'],
						'個人實得' => $個人實得,
						// '營業支出' => $_POST['營業支出'],
						// '公司' => $_POST['公司'],
						'匯款日期' => $data['匯款日期'],
						'轉讓會員' => $data['轉讓會員'],
						'備註' => $data['備註'],
						'最後動作時間' => date('Y-m-d H:i:s'));
		return $result;
	}

	public function copy() {
		$result = $this->orders_model->get($_POST['id'],null,null,null,null);
		$thelast_id = $this->orders_model->get_last_id();
		$today_y = date('Y');
		$today_m = date('m');
		$id_y = substr($thelast_id, 0, 4);
		$id_m = substr($thelast_id, 4, 2);
		if (($today_y == $id_y)&&($today_m == $id_m)) {
			$insert_id = $thelast_id+1;
		} else {
			$insert_id = $today_y.$today_m."0001";
		}
		$data = array(	'ID' => $insert_id,
						'成交日期' => $result[0]['成交日期'],
						'業務' => $result[0]['業務'],
						'客戶姓名' => $result[0]['客戶姓名'],
						'身分證字號' => $result[0]['身分證字號'],
						'聯絡電話' => $result[0]['聯絡電話'],
						'聯絡人' => $result[0]['聯絡人'],
						'聯絡地址' => $result[0]['聯絡地址'],
						'買賣' => $result[0]['買賣'],
						'股票' => $result[0]['股票'],
						'張數' => $result[0]['張數'],
						'成交價' => $result[0]['成交價'],
						'盤價' => $result[0]['盤價'],
						'匯款金額應收帳款' => $result[0]['匯款金額應收帳款'],
						'匯款日期' => $result[0]['匯款日期'],
						'匯款銀行' => $result[0]['匯款銀行'],
						'匯款分行' => $result[0]['匯款分行'],
						'匯款戶名' => $result[0]['匯款戶名'],
						'匯款帳號' => $result[0]['匯款帳號'],
						'轉讓會員' => $result[0]['轉讓會員'],
						'完稅人' => $result[0]['完稅人'],
						'新舊' => $result[0]['新舊'],
						'自行應付' => $result[0]['自行應付'],
						'刻印' => $result[0]['刻印'],
						'收送' => $result[0]['收送'],
						'過戶日期' => $result[0]['過戶日期'],
						'過戶費' => $result[0]['過戶費'],
						'備註' => $result[0]['備註'],
						'最後動作時間' => date('Y-m-d H:i:s'),
					);
		$insert_id = $this->orders_model->add($data);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '複製', $insert_id, null);
		$myJSON = json_encode('Done!');
		print_r($myJSON);
	}

	public function delete() {
		$id = $_POST['id'];
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '刪除', $id, null);
		$this->orders_model->delete($id);
		$myJSON = json_encode('Done!');
		print_r($myJSON);
	}

	public function go_deleted() {
		$orders = $this->orders_model->go_deleted_model();
		$this->load->view('templates/header');
		$this->load->view('pages/deleted_view', array('orders'=>$orders));
	}

	public function checkbill() {
		if (isset($_GET['股票'])) {
			$orders = $this->orders_model->get_checkbill('股票',$_GET['股票']);
		} else if (isset($_GET['業務'])) {
			$orders = $this->orders_model->get_checkbill('業務',$_GET['業務']);
		} else if (isset($_GET['客戶姓名'])) {
			$orders = $this->orders_model->get_checkbill('客戶姓名',$_GET['客戶姓名']);
		} else if (isset($_GET['聯絡電話'])) {
			$orders = $this->orders_model->get_checkbill('聯絡電話',$_GET['聯絡電話']);
		} else {
			$orders = $this->orders_model->get_checkbill(null,null);
		}
		$total_receivable = 0;
		$total_received = 0;
		for ($i=0; $i < count($orders); $i++) {
			$total_receivable = $total_receivable + $orders[$i]['匯款金額應收帳款'];
			$total_received = $total_received + $orders[$i]['已匯金額已收金額'];
		}
		$total_left = $total_receivable - $total_received;
		$total_info = array('total_receivable' => $total_receivable,
							'total_received' => $total_received,
							'total_left' => $total_left,);

		$employees = $this->orders_model->get_employee(null);

		$arrayName = array('orders' => $orders,
							'employees' => $employees,
							'total_info' => $total_info,);

		$this->load->view('templates/header');
		$this->load->view('templates/receivable_header');
		$this->load->view('pages/receivable_view', $arrayName);
	}

	// public function pushinto_checkbill() {
	// 	$this->orders_model->pushinto_checkbill($_POST['成交單編號'], date('Y-m-d H:i:s'));
	// 	$this->index();
	// }

	public function upload_document() {
		$dir_info = scandir('upload/document');
		$dir_count = count($dir_info);
		$next_dir_index = $dir_count + 1;
		if ($_FILES["file"]["error"] > 0){
			echo "Error: " . $_FILES["file"]["error"];
		} else {
			// echo "編號: " . $id."<br>";
			// echo "檔案名稱: " . $_FILES["file"]["name"]."<br/>";
			// echo mb_detect_encoding($_FILES["file"]["name"]);
			$name = iconv("UTF-8", "BIG5", $_FILES["file"]["name"]);
			// echo "檔案類型: " . $_FILES["file"]["type"]."<br/>";
			// echo "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
			// echo "暫存名稱: " . $_FILES["file"]["tmp_name"];
			if (file_exists("upload/document/" . $name)){
				echo "<h2><font color='red'>檔案已經存在，請勿重覆上傳相同檔案</font></h2><br>";
				$this->document_download_view();
			} else {
				$target_path = "upload/document/";
				$target_path .= $_FILES['file']['name']; //上傳檔案名稱
				move_uploaded_file($_FILES['file']['tmp_name'],iconv("UTF-8", "big5", $target_path ));
				$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '上傳文件', $_FILES['file']['name'], null);
				echo "<h2><font color='red'>檔案".$_FILES["file"]["name"]."上傳成功</font></h2><br>";
				$this->document_download_view();
			}
		}
	}

	public function upload_contact() {
		$id = $_POST['id'];
		if ($_FILES["file"]["error"] > 0){
			echo "Error: " . $_FILES["file"]["error"];
		} else {
			// echo "編號: " . $id."<br>";
			// echo "檔案名稱: " . $_FILES["file"]["name"]."<br/>";
			// echo "檔案類型: " . $_FILES["file"]["type"]."<br/>";
			// echo "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
			// echo "暫存名稱: " . $_FILES["file"]["tmp_name"];

			if (file_exists("upload/contact/" . $id)){
				echo "檔案已經存在，請勿重覆上傳相同檔案<br>";
				$this->go_orders();
			} else {
				echo "<h2><font color='red'><b>成交單編號:".$id."契約已上傳成功。</b></font></h2>";
				move_uploaded_file($_FILES["file"]["tmp_name"],"upload/contact/".$id);
				$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '上傳契約', $id, null);
				$this->go_orders();
			}
		}
	}

	public function upload_tax() {
		$id = $_POST['id'];
		if ($_FILES["file"]["error"] > 0){
			echo "Error: " . $_FILES["file"]["error"];
		} else {
			// echo "編號: " . $id."<br>";
			// echo "檔案名稱: " . $_FILES["file"]["name"]."<br/>";
			// echo "檔案類型: " . $_FILES["file"]["type"]."<br/>";
			// echo "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
			// echo "暫存名稱: " . $_FILES["file"]["tmp_name"];
			if (file_exists("upload/tax/" . $id)){
				echo "檔案已經存在，請勿重覆上傳相同檔案<br>";
				$this->go_orders();
			} else {
				echo "<h2><font color='red'><b>成交單編號:".$id."稅單已上傳成功。</b></font></h2>";
				move_uploaded_file($_FILES["file"]["tmp_name"],"upload/tax/".$id);
				$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '上傳稅單', $id, null);
				$this->go_orders();
			}
		}
	}

	public function upload_water() {
		$id = $_POST['id'];
		if ($_FILES["file"]["error"] > 0){
			echo "Error: " . $_FILES["file"]["error"];
		} else {
			// echo "編號: " . $id."<br>";
			// echo "檔案名稱: " . $_FILES["file"]["name"]."<br/>";
			// echo "檔案類型: " . $_FILES["file"]["type"]."<br/>";
			// echo "檔案大小: " . ($_FILES["file"]["size"] / 1024)." Kb<br />";
			// echo "暫存名稱: " . $_FILES["file"]["tmp_name"];
			if (file_exists("upload/water/" . $id)){
				echo "檔案已經存在，請勿重覆上傳相同檔案<br>";
				$this->go_orders();
			} else {
				echo "<h2><font color='red'><b>成交單編號:".$id."水單已上傳成功。</b></font></h2>";
				move_uploaded_file($_FILES["file"]["tmp_name"],"upload/water/".$id);
				$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '上傳水', $id, null);
				$this->orders_model->finish_order($id);
				$this->go_orders();
			}
		}
	}

	public function admin_order_end() {
		$this->orders_model->finish_order($_POST['id']);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '結案', $id, null);
		$this->go_orders();
	}

	public function match() {
		// echo $_POST['欲媒合對方ID'].", ".$_POST['欲媒合自身ID']."<br>";
		$this -> orders_model -> match($_POST['欲媒合自身ID'], $_POST['欲媒合對方ID']);
		$this->go_orders();
	}

	//修改成交單資料
	public function go_edit() {
		$result = $this -> orders_model -> get($_GET['id'],null,null,null,null);
		// $old_date_timestamp = strtotime($result[0]['成交日期']);
		// $new_date = date('Y/m/d', $old_date_timestamp);
		// $result[0]['日期'] = $new_date;
		$employees = $this->orders_model->get_employee(null);
		// foreach ($result[0] as $key => $value) {
		// 	echo $key.": ".$value."<br>";
		// };
		$all_orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME'],null,null);
		$this->load->view('templates/header');
		if ($_SESSION['權限名稱']=='最高權限') {
			$this->load->view('pages/order_edit/admin_edit_order_view',array('result' => $result,'employees' => $employees,'all_orders' => $all_orders,));
		} else {
			$this->load->view('pages/order_edit/edit_order_view',array('result' => $result,'employees' => $employees,));
		}
	}

	//管理者修改成交單資料
	public function admin_go_edit() {
		$result = $this -> orders_model -> get($_GET['id'],null,null,null,null);
		$old_date_timestamp = strtotime($result[0]['成交日期']);
		$new_date = date('Y/m/d', $old_date_timestamp);
		$result[0]['日期'] = $new_date;
		$employees = $this->orders_model->get_employee(null);
		// foreach ($result[0] as $key => $value) {
		// 	echo $key.": ".$value."<br>";
		// };
		$this->load->view('templates/header');
		$this->load->view('pages/order_edit/edit_order_view',array('result' => $result,'employees' => $employees,));
	}

	//改成交單狀態(一審)
	public function edit_order_status() {
		if ($_POST['買賣']==0) {
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
				'自行應付' => $_POST['自行應付'],
				'匯款銀行' => $_POST['匯款銀行'],
				'匯款分行' => $_POST['匯款分行'],
				'匯款戶名' => $_POST['匯款戶名'],
				'匯款帳號' => $_POST['匯款帳號'],
				'轉讓會員' => $_POST['轉讓會員'],
				'匯款金額應收帳款' => $_POST['匯款金額應收帳款'],
				'完稅人' => $_POST['完稅人'],
				'過戶費' => $_POST['過戶費'],
				'刻印' => $_POST['刻印'],
				'收送' => $_POST['收送'],
				'成交單狀態' => $_POST['成交單狀態'],
				'通知查帳' => '待對帳',
				// '現金或匯款' => $_POST['現金或匯款'],
				'匯款日期' => $_POST['匯款日期'],
				'最後動作時間' => date('Y-m-d H:i:s'),);
		} else {
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
				'自行應付' => $_POST['自行應付'],
				'匯款銀行' => $_POST['匯款銀行'],
				'匯款分行' => $_POST['匯款分行'],
				'匯款戶名' => $_POST['匯款戶名'],
				'匯款帳號' => $_POST['匯款帳號'],
				'轉讓會員' => $_POST['轉讓會員'],
				'匯款金額應收帳款' => $_POST['匯款金額應收帳款'],
				'完稅人' => $_POST['完稅人'],
				'過戶費' => $_POST['過戶費'],
				'刻印' => $_POST['刻印'],
				'收送' => $_POST['收送'],
				'成交單狀態' => $_POST['成交單狀態'],
				// '通知查帳' => '待對帳',
				// '現金或匯款' => $_POST['現金或匯款'],
				'匯款日期' => $_POST['匯款日期'],
				'最後動作時間' => date('Y-m-d H:i:s'),);
		}
		$this -> orders_model -> edit($data);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '一審', $_POST['ID'], null);
		$this->go_orders();

	}

	//一審改已匯
	public function Buy_Edit() {
		$original = $this->orders_model->get($_POST['id'], $_SESSION['權限名稱'], $_SESSION['NAME'],null,null);
		$date = $original[0]['成交日期'];
		$this->orders_model->Buy_Edit_Model($_POST['id'], $date, date('Y-m-d', strtotime($date."+3 day")));
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '一審', $_POST['id'], null);
		$myJSON = json_encode('Done!');
		print_r($myJSON);
	}

	public function get_title($authority) {
		if ($authority == 'admin') {
			$title = array(0 => '成交日期',
	                        1 => 'ID',
	                        2 => '業務',
	                        3 => '客戶姓名',
	                        4 => '身分證字號',
	                        5 => '聯絡電話',
	                        6 => '聯絡人',
	                        7 => '聯絡地址',
	                        8 => '買賣',
	                        9 => '股票',
	                        10 => '張數',
	                        11 => '成交價',
	                        12 => '盤價',
	                        13 => '匯款金額應收帳款',
	                        14 => '已匯金額已收金額',
							// 15 => '待查帳金額',
							// 16 => '轉出日期轉入日期',
							// 17 => '匯款人',
	                        15 => '匯款銀行',
	                        16 => '匯款分行',
	                        17 => '匯款帳號',
	                        // 21 => '匯款帳號末5碼',
	                        18 => '匯款戶名',
	                        19 => '轉讓會員',
	                        20 => '完稅人',
	                        21 => '新舊',
	                        22 => '自行應付',
	                        23 => '刻印',
	                        24 => '過戶日期',
	                        25 => '過戶費',
	                    	26 => '媒合',
	                        // 31 => '匯款日期',
	                        27 => '通知查帳',
	                        28 => '成交單狀態',
	                    	29 => '二審',
	                    	30 => '已結案',);
		} else {
			$title = array(0 => '成交日期',
	                        1 => 'ID',
	                        2 => '業務',
	                        3 => '客戶姓名',
	                        4 => '身分證字號',
	                        5 => '聯絡電話',
	                        6 => '聯絡人',
	                        7 => '聯絡地址',
	                        8 => '買賣',
	                        9 => '股票',
	                        10 => '張數',
	                        11 => '成交價',
	                        12 => '盤價',
	                        13 => '匯款金額應收帳款',
	                        14 => '匯款銀行',
	                        15 => '匯款分行',
	                        16 => '匯款帳號',
	                        17 => '匯款戶名',
	                        18 => '轉讓會員',
	                        19 => '完稅人',
	                        20 => '新舊',
	                        21 => '自行應付',
	                        22 => '刻印',
	                        23 => '過戶費',);
		}
		return $title;
	}

	//單純修改成交單內容
	public function edit_order() {
		$title = $this->get_title('非admin');
		$original = $this->orders_model->get($_POST['ID'], $_SESSION['權限名稱'], $_SESSION['NAME'],null,null);
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
						'匯款金額應收帳款' => $_POST['匯款金額應收帳款'],
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
		$effect = '';
		for ($i=0; $i < count($title); $i++) {
			if ($original[0][$title[$i]] != $data[$title[$i]]) {
				$effect = $effect."[".$title[$i]."]"."=>".$original[0][$title[$i]]."改為".$data[$title[$i]]."  ";
			}
		}
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '修改', $_POST['ID'], $effect);
		$this -> orders_model -> edit($data);
		$this->go_orders();
	}

	//單純修改成交單內容admin(全部欄位都能修改)
	public function admin_edit_order() {
		$title = $this->get_title('admin');
		$original = $this->orders_model->get($_POST['ID'], $_SESSION['權限名稱'], $_SESSION['NAME'],null,null);
		$data = array(
						'ID' => $_POST['ID'],
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
						'匯款金額應收帳款' => $_POST['匯款金額應收帳款'],
						'已匯金額已收金額' => $_POST['已匯金額已收金額'],
						// '待查帳金額' => $_POST['待查帳金額'],
						// '轉出日期轉入日期' => $_POST['轉出日期轉入日期'],
						// '匯款人' => $_POST['匯款人'],
						'匯款銀行' => $_POST['匯款銀行'],
						'匯款分行' => $_POST['匯款分行'],
						'匯款帳號' => $_POST['匯款帳號'],
						// '匯款帳號末5碼' => $_POST['匯款帳號末5碼'],
						'匯款戶名' => $_POST['匯款戶名'],
						'轉讓會員' => $_POST['轉讓會員'],
						'完稅人' => $_POST['完稅人'],
						'新舊' => $_POST['新舊'],
						'自行應付' => $_POST['自行應付'],
						'刻印' => $_POST['刻印'],
						'過戶日期' => $_POST['過戶日期'],
						'過戶費' => $_POST['過戶費'],
						'媒合' => $_POST['媒合'],
						// '匯款日期' => $_POST['匯款日期'],
						'通知查帳' => $_POST['通知查帳'],
						'成交單狀態' => $_POST['成交單狀態'],
						'二審' => $_POST['二審'],
						'已結案' => $_POST['已結案'],
						'最後動作時間' => date('Y-m-d H:i:s'),);
		$effect = '';
		for ($i=0; $i < count($title); $i++) {
			if ($original[0][$title[$i]] != $data[$title[$i]]) {
				$effect = $effect."[".$title[$i]."]"."=>".$original[0][$title[$i]]."改為".$data[$title[$i]]."  ";
			}
		}
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), 'admin修改', $_POST['ID'], $effect);
		$this -> orders_model -> edit($data);
		$this->go_orders();
	}

	//自動填入客戶資料
	public function autofill() {
		$cus_info = $this -> orders_model -> get_cus_info($_POST['name']);
		return json_encode($cus_info);
	}

	//二審表格
	public function go_edit2() {
		$result = $this -> orders_model -> get($_GET['id'],null,null,null,null);
		$old_date_timestamp = strtotime($result[0]['成交日期']);
		$new_date = date('Y/m/d', $old_date_timestamp);
		$result[0]['日期'] = $new_date;
		$employees = $this->orders_model->get_employee(null);
		$this->load->view('templates/header');
		$this->load->view('pages/order_edit/edit2_order_view',array('result' => $result,'employees' => $employees));
	}

	//二審update
	public function edit2_order() {
		if ($_POST['成交單狀態'] == '審核完成') {
			if (file_exists("upload/tax/".$_POST['ID'])&&file_exists("upload/contact/".$_POST['ID'])){
				$data = array(
							'ID' => $_POST['ID'],
							'客戶姓名' => $_POST['客戶姓名'],
							'成交價' => $_POST['成交價'],
							'盤價' => $_POST['盤價'],
							'張數' => $_POST['張數'],
							'自行應付' => $_POST['自行應付'],
							'過戶費' => $_POST['過戶費'],
							'刻印' => $_POST['刻印'],
							'轉讓會員' => $_POST['轉讓會員'],
							'過戶日期' => $_POST['過戶日期'],
							'二審' => 1,
							'最後動作時間' => date('Y-m-d H:i:s'),);
				$this -> orders_model -> edit($data);
				$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '二審', $_POST['ID'], null);
				$origin_data = $this->orders_model->get($data['ID']);
				$pass_record_info = $this -> record_info($origin_data[0]);
				$this->orders_model->add_passrecord($pass_record_info);

				$this->go_orders();
			} else {
				// $url = 'index.php/orders/go_edit2?id='.$_POST['ID'];
				// redirect($url);
				echo "<h3><p class='text-danger'><b>編號".$_POST['ID']."稅單或契約書上傳尚未完成!!!　　無法完成二審</b></p></h3>";
				$this->go_orders();
			}

		} else {
			echo "<h3><p class='text-danger'><b>編號".$_POST['ID']."一審尚未完成!!!　　無法完成二審</b></p></h3>";
				$this->go_orders();
		}

	}

	public function export() {
		// 引入函式庫
		require_once APPPATH."third_party\PHPExcel.php";

		if (isset($_POST['Export'])) {
			$isSelected = false;
			if ($_POST['date1'] != null && $_POST['date2'] != null) {
				$date1 = $_POST['date1'];
				$date2 = $_POST['date2'];
				$isSelected = true;
			}
			//判斷content檔案存在與否，存在則刪除
			//$file = 'C:\xampp\tmp\excel\content.csv';
			$file = 'C:\xampp\tmp\excel\temp.xls';
			if(file_exists($file)){
				unlink($file);
			}

			$data = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME'],null,null);
			$title = array('ID',
						   '成交日期',
	                       '業務',
	                       '客戶姓名',
	                       '身分證字號',
	                       '聯絡電話',
	                       '聯絡人',
	                       '聯絡地址',
	                       '買賣',
	                       '股票',
	                       '張數',
	                       '成交價',
	                       '盤價',
	                       '匯款金額應收帳款',
	                       '已匯金額已收金額',
	                       '匯款銀行',
	                       '匯款分行',
	                       '匯款帳號',
	                       '匯款戶名',
	                       '轉讓會員',
	                       '完稅人',
	                       '新舊',
	                       '自行應付',
	                       '刻印',
	                       '收送',
	                       '匯款日期',
	                       '過戶日期',
	                       '過戶費',
	                       '媒合',
	                       '通知查帳',
	                       '成交單狀態',
	                       '二審',
	                       '備註',
	                       '開發者',
	                       '已結案',
	                       '最後動作時間'
	                    	);

			//建立EXCEL暫存檔並將資料重新寫入
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->setActiveSheetIndex(0);
			$sheet = $objPHPExcel->getActiveSheet();
			$row = 1;
			//填入標頭行
			for ($col = 1; $col <= count($title); $col++) {
				if ($col <= 26) {
					$sheet->setCellValue(chr($col + 64).$row, $title[$col - 1]);
				} else {
					$sheet->setCellValue('A'.chr($col + 64 - 26).$row, $title[$col - 1]);
				}
			}
			//填入符合條件之成交單資料
			$row = 2;
			for ($num = 0; $num < count($data); $num++) {	
				if ($_POST['業務'] == '所有業務' || $_POST['業務'] == $data[$num]['業務']) {
					if (!$isSelected || $isSelected && strtotime($date1) <= strtotime($data[$num]['成交日期']) && strtotime($date2) >= strtotime($data[$num]['成交日期'])) {
						for ($col = 1; $col <= count($title); $col++) {
							if ($col <= 26) {
								$sheet->setCellValue(chr($col + 64).$row, $data[$num][$title[$col - 1]]);
							} else {
								$sheet->setCellValue('A'.chr($col + 64 - 26).$row, $data[$num][$title[$col - 1]]);
							}
						}
						$row++;
					}
				}
			}
			$PHPExcelWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//匯出成xls檔
			//$PHPExcelWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007"); //匯出成xlsx檔
			$PHPExcelWriter->save($file);//建立暫存

			//下載EXCEL檔
			header("Content-type: application/force-download");
			header("Content-Disposition: attachment; filename=\""."temp".".xls\"");
			$PHPExcelWriter->save('php://output');
		} else {
			echo '<span style="color:#FF0000;"><b>下載失敗</b></span>';
		}
		$this->go_orders();
	}

	public function fax_exported() {
        // 引入函式庫
        require_once "vendor/autoload.php";

		if (isset($_POST["Fax_exported"])) {
			//判斷content檔案存在與否，存在則刪除
			//$file = 'C:\xampp\tmp\excel\content.csv';
			$file = 'C:\xampp\tmp\word\content.doc';
			if(file_exists($file)){
				unlink($file);
			}

			//建立暫存檔並將資料寫入
			$phpWord = new \PhpOffice\PhpWord\PhpWord();
			$section = $phpWord->createSection();
			$fontStyle = array('size' => 20);

			$section->addText("TO：".$_POST["dealer_name"], $fontStyle);
			$section->addText("傳真：".$_POST["dealer_fax"]." "."電話：".$_POST["dealer_tel"], $fontStyle);
			$section->addText(date("Y/m/d", strtotime($_POST["transaction_date"]))." 成交交易明細", $fontStyle);

			$styleTable = ['borderSize' => 6, 'borderColor' => '999999'];
			$phpWord->addTableStyle('Colspan Rowspan', $styleTable);
			$table = $section->addTable('Colspan Rowspan');

			$row = $table->addRow();
			$row->addCell()->addText('股票名稱', $fontStyle);
			$row->addCell(2500, ['gridSpan' => 2])->addText($_POST["stock_name"], $fontStyle);
			$row->addCell()->addText('方式', $fontStyle);
			$row->addCell(2500, ['gridSpan' => 2])->addText($_POST["way"], $fontStyle);

			$row = $table->addRow();
			$row->addCell()->addText('成交價', $fontStyle);
			$row->addCell(null, ['gridSpan' => 2])->addText($_POST["stock_price"], $fontStyle);
			$row->addCell()->addText('張數', $fontStyle);
			$row->addCell(null, ['gridSpan' => 2])->addText($_POST["stock_amount"], $fontStyle);

			$row = $table->addRow();
			$row->addCell()->addText('完稅姓名', $fontStyle);
			$row->addCell(null, ['gridSpan' => 2])->addText($_POST["taxer_name"], $fontStyle);
			$row->addCell()->addText('ID', $fontStyle);
			$row->addCell(null, ['gridSpan' => 2])->addText($_POST["taxer_id"], $fontStyle);

			$row = $table->addRow();
			$row->addCell()->addText('完稅地址', $fontStyle);
			$row->addCell(null, ['gridSpan' => 5])->addText($_POST["taxer_address"], $fontStyle);

			$row = $table->addRow();
			$row->addCell()->addText('銀行機構', $fontStyle);
			$row->addCell(null, ['gridSpan' => 2])->addText($_POST["payer_bank"], $fontStyle);
			$row->addCell()->addText('銀行帳號', $fontStyle);
			$row->addCell(null, ['gridSpan' => 2])->addText($_POST["payer_account"], $fontStyle);

			$row = $table->addRow();
			$row->addCell()->addText('戶名', $fontStyle);
			$row->addCell(null, ['gridSpan' => 2])->addText($_POST["payer_name"], $fontStyle);
			$row->addCell()->addText('金額', $fontStyle);
			$row->addCell(null, ['gridSpan' => 2])->addText($_POST["payer_amount"], $fontStyle);

			$row = $table->addRow();
			$row->addCell()->addText('交割日', $fontStyle);
			$row->addCell(null, ['gridSpan' => 5])->addText(date("Y/m/d", strtotime($_POST["transfer_date"])), $fontStyle);

			$row = $table->addRow();
			$row->addCell()->addText('備註', $fontStyle);
			$row->addCell(null, ['gridSpan' => 5])->addText("", $fontStyle);

			//下載WORD檔
			header("Content-type: application/vnd.ms-word");
			header("Content-Disposition: attachment; filename=\"".date('Y-m-d').".doc\"");
			header('Cache-Control: max-age=0');
			$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
			$objWriter->save($file);//建立暫存檔並將資料寫入
			$objWriter->save('php://output');	
		}
		$array = array('盤商名稱' => $_POST['dealer_name'], '成交單編號' => $_POST['order_id'], '完稅姓名' => $_POST['taxer_name'], '匯款姓名' => $_POST['payer_name'], '金額' => $_POST['payer_amount']);
		$id = $this->orders_model->insert_fax_info($array);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '下載傳真資料', $id, null);
        $this->fax_info();
    }

	public function import(){
		// 引入函式庫
		require_once APPPATH."third_party\PHPExcel.php";

		if(isset($_POST["Import"])){
			$filename = $_FILES["file"]["tmp_name"];

			$Max_Files = 10;
			if(count($filename) <= $Max_Files && $_FILES["file"]["size"][0] > 0){ //判斷上傳數量是否符合標準1～10
				for ($i = 0; $i < count($filename); $i++) {

					if ($_FILES["file"]["error"][$i] == UPLOAD_ERR_OK) {
						 // Read your Excel workbook
		                try {
		                    //看這個檔案是什麼類型
		                    $inputFileType = PHPExcel_IOFactory::identify($filename[$i]);
		                    //開這個類型的reader
		                    $objReader     = PHPExcel_IOFactory::createReader($inputFileType);
		                    //read檔案
		                    $objPHPExcel   = $objReader->load($filename[$i]);
		                } catch(Exception $e) {
		                    die('Error loading file "'.pathinfo($filename[$i],PATHINFO_BASENAME).'": '.$e->getMessage());
		                }

		                $sheet         = $objPHPExcel->getSheet(0);
		                $highestRow    = $sheet->getHighestRow();
		                $highestColumn = $sheet->getHighestColumn();

		                // Loop through each row of the worksheet in turn
		                $rowData = array();
		                $allrowData = array();
		                $Data_size = 0;

		                for ($row = 2; $row <= $highestRow; $row++){
		                	// Read a row of data into an array
		                    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
		                                                    NULL,
		                                                    TRUE,
		                                                    FALSE);
		                    // Insert row data array into your database of choice here

		                    if ($rowData[0][0] != '' && $rowData[0][0] != '銷單序號' && ($rowData[0][2] != NULL || $rowData[0][3] != NULL)) { // 避開匯入時的title行以及轉出轉入皆為空
		                    	$data = array(
		                    		'日期' => (substr($rowData[0][1], 0, 3)+1911).'-'.substr($rowData[0][1], 3, 2).'-'.substr($rowData[0][1], 5, 2),
		                    		'轉出' => $rowData[0][2],
		                    		'轉入' => $rowData[0][3],
		                    		'帳號' => $rowData[0][6],
		                    		'備註' => $rowData[0][7],
		                    		'是否已對帳' => '0',
		                    	);
		                    }
		                    $this->orders_model->add_bill($data);
		                }
		                echo '<span style="color:#FF0000;"><b>上傳成功<br></b></span>';
					} else {
		            	echo '<span style="color:#FF0000;"><b>上傳失敗<br></b></span>';
		            }
				}
			} elseif (count($filename) > $Max_Files) {
            	echo '<span style="color:#FF0000;"><h1><b>上傳數量超過最大值'.$Max_Files.'</b></h1></span>';
            } else {
            	echo '<span style="color:#FF0000;"><h1><b>您尚未選取檔案</b></h1></span>';
            }

            $this->checkbill();
		}
    }

    public function reconcile() {
    	//先抓欲對帳表
    	//$orders = $this->orders_model->get_checkbill();
    	$orders_sell = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME'],null,null);	//2018.5.23 更新此處只處理賣
    	$orders_buy = $this->orders_model->get_check_record(null, '未查帳'); //2018.5.23 更新買從已通知查帳處理
    	$datas = $this->orders_model->get_bills();

    	//對帳通知未查帳
    	if ($orders_buy != null && $datas != NULL) {
	    	for ($i = 0; $i < count($orders_buy); $i++) {
	    		$time = $orders_buy[$i]['轉出日期轉入日期'];
	    		$money = $orders_buy[$i]['待查帳金額'];

				for ($j = 0; $j < count($datas); $j++) {
					if ($datas[$j]['是否已對帳'] != '1') { //檢查明細是否對過
			    		if (($datas[$j]['帳號'] == null && abs(strtotime($time) - strtotime($datas[$j]['日期'])) <= 3600*24*7 || 
			    			substr($datas[$j]['帳號'], -5) == $orders_buy[$i]['匯款帳號末5碼']) && $money == $datas[$j]['轉入']) { //一周內
			    			//對帳完成
			    			echo "交易日期".$datas[$j]['日期']." 轉入 ".$money." ".$orders_buy[$i]['id'].'<br>';
			    			$this->orders_model->check_money_received($orders_buy[$i]['id'], date('Y-m-d H:i:s'), $money);
			    			$this->orders_model->check_bill_reconciled($datas[$j]['id']);
			    			break;
			    		}
			    	}
		    	}
	    	}
	    }

    	//對帳所有轉出匯款
    	if ($orders_sell != null && $datas != null) {
	    	for ($i = 0; $i < count($orders_sell); $i++) {
	    		$time = $orders_sell[$i]['成交日期'];
	    		$money = $orders_sell[$i]['匯款金額應收帳款'];
	    		$inform = $orders_sell[$i]['通知查帳'];
	    		$isCheckExported = false;
	    		$isError = false;

		    	if ($orders_sell[$i]['買賣'] == '0') {	//已匯金額
		    		if ($inform == '未通知' || $inform == '待對帳') {
		    			for ($j = 0; $j < count($datas); $j++) {
		    				if ($datas[$j]['是否已對帳'] != '1') { //檢查明細是否對過
			    				if (!$isCheckExported && $time == $datas[$j]['日期'] && $money == $datas[$j]['轉出']) { //當天
			    					//對帳完成
			    					echo "交易日期".$datas[$j]['日期']." 轉出 ".$money." ".$orders_sell[$i]['ID'].'<br>';
			    					$this->orders_model->check_money_exported($orders_sell[$i]['ID'], $money, date('Y-m-d'));
			    					$this->orders_model->check_bill_reconciled($datas[$j]['id']);
			    					$isCheckExported = true;
			    					$error_id = $datas[$j]['id'];
			    				} else if (abs(strtotime($time) - strtotime($datas[$j]['日期'])) <= 3600*24*7 && $money == $datas[$j]['轉出']) { //一周內重複
			    					$this->orders_model->check_money_exported($orders_sell[$i]['ID'], $money, '金額重複');
			    					$this->orders_model->check_bill_reconciled($datas[$j]['id']);
			    					$this->orders_model->add_bill_error($datas[$j]['id']);
			    					$isError = true;
			    				}
			    			}
		    			}
		    			if ($isError) {
		    				$this->orders_model->add_bill_error($error_id);
		    			}
		    		}
	    		}
	    	}
	    }

    	$this->checkbill();
    }

	//進入庫存頁面
	public function go_inventory() {
		if (isset($_GET['股票'])) {
			$orders = $this->orders_model->get_inventory(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'股票',$_GET['股票']);
		} else if (isset($_GET['業務'])) {
			$orders = $this->orders_model->get_inventory(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'業務',$_GET['業務']);
		} else if (isset($_GET['客戶姓名'])) {
			$orders = $this->orders_model->get_inventory(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'客戶姓名',$_GET['客戶姓名']);
		} else if (isset($_GET['聯絡電話'])) {
			$orders = $this->orders_model->get_inventory(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'聯絡電話',$_GET['聯絡電話']);
		} else {
			$orders = $this->orders_model->get_inventory(null,$_SESSION['權限名稱'],$_SESSION['NAME'],null,null);
		}
		$all_orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME'],null,null);
		$employees = $this->orders_model->get_employee(null);
		$arrayName = array('orders' => $orders,
							'all_orders' => $all_orders,
							'employees' => $employees,);
		$this->show($arrayName);
	}

	//進入KO頁面
	public function go_ko() {
		if (isset($_GET['股票'])) {
			$orders = $this->orders_model->get_ko(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'股票',$_GET['股票']);
		} else if (isset($_GET['業務'])) {
			$orders = $this->orders_model->get_ko(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'業務',$_GET['業務']);
		} else if (isset($_GET['客戶姓名'])) {
			$orders = $this->orders_model->get_ko(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'客戶姓名',$_GET['客戶姓名']);
		} else if (isset($_GET['聯絡電話'])) {
			$orders = $this->orders_model->get_ko(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'聯絡電話',$_GET['聯絡電話']);
		} else {
			$orders = $this->orders_model->get_ko(null,$_SESSION['權限名稱'],$_SESSION['NAME'],null,null);
		}
		$all_orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME'],null,null);
		$employees = $this->orders_model->get_employee(null);
		$arrayName = array('orders' => $orders,
							'all_orders' => $all_orders,
							'employees' => $employees,);
		$this->show($arrayName);
	}


	//新增成交單時匯入客戶資料
	public function import_customer_info() {
		$info = $this->orders_model->get_customer_info($_GET['customer_name']);
		if ($info[0]['業務'] == $_SESSION['NAME']) {
			$myJSON = json_encode($info[0]);
			print_r($myJSON);
		} else {
			echo "false";
		}

	}

	//傳真資料匯入成交單資料
	public function import_order_info() {
		$info = $this->orders_model->get($_GET['order_id'],null,null,null,null);
		$myJSON = json_encode($info[0]);
		print_r($myJSON);
	}

	//新增成交單時匯入盤商資料
	public function import_dealer_info() {
		$info = $this->orders_model->get_dealer_info(3, $_GET['dealer_name']);
		$myJSON = json_encode($info[0]);
		print_r($myJSON);
	}

	//新增成交單時匯入完稅人資料
	public function import_taxer_info() {
		$info = $this->orders_model->get_taxer_info(3, $_GET['taxer_name']);
		$myJSON = json_encode($info[0]);
		print_r($myJSON);
	}

	//新增成交單時匯入付款資料
	public function import_payer_info() {
		$info = $this->orders_model->get_payer_info($_GET['payer_name']);
		$myJSON = json_encode($info[0]);
		print_r($myJSON);
	}

	//頁面進入通知查帳頁面
	public function salesman_check_money() {
		$this->load->view('templates/header');
		$order = $this->orders_model->get($_GET['ID'],$_SESSION['權限名稱'], $_SESSION['NAME'],null,null);
		$array = array('order' => $order);
		$this->load->view('pages/money/inform_check_money_view',$array);
	}

	//更改通知查帳
	public function inform_check_money() {
		$this->orders_model->inform_check_money_model($_POST['ID'], $_POST['支付方式'], $_POST['轉出日期轉入日期'], $_POST['支付人'], $_POST['匯款帳號末5碼'], $_POST['待查帳金額'], date('Y-m-d H:i:s'));
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '通知查帳', $_POST['ID'], null);
		$this->checkbill();
	}

	//大姊進入確認帳款頁面
	public function boss_check_money() {
		$data = $this->orders_model->get_check_record(null, '未查帳');
		$arrayName = array('data' => $data);
		$this->load->view('templates/header');
		$this->load->view('templates/receivable_header');
		$this->load->view('pages/money/ready_to_check',$arrayName);
	}

	//大姊確認帳款
	public function check_end() {
		$this->orders_model->check_end_model($_POST['id'], $_POST['成交單編號'], $_POST['money'], $_POST['確認日期'], date('Y-m-d H:i:s'));
		$this->boss_check_money();
	}

	//查看匯款紀錄
	public function check_record() {
		$data = $this->orders_model->get_check_record(null, '已查帳');
		$this->load->view('templates/header');
		$this->load->view('templates/receivable_header');
		$this->load->view('pages/money/check_record', array('data'=>$data));
	}

	//查看動作紀錄
	public function move_record() {
		$data = $this->orders_model->get_move_record();
		$this->load->view('templates/header');
		$this->load->view('pages/admin/move_record', array('data'=>$data));
	}

	//進入傳真資料
	public function fax_info() {
		$this->load->view('templates/header');
		$this->load->view('pages/fax/fax_info');
	}

	//進入盤商資料
	public function go_dealer() {
		$data = $this->orders_model->get_dealer_info(1, NULL);
		$this->load->view('templates/header');
		$this->load->view('pages/fax/dealer_info', array('data'=>$data));
	}

	//進入完稅人資料
	public function go_taxer() {
		$data = $this->orders_model->get_taxer_info(1, NULL);
		$this->load->view('templates/header');
		$this->load->view('pages/fax/taxer_info', array('data'=>$data));
	}

	//新增盤商頁面
	public function go_add_dealer() {
		$this->load->view('templates/header');
		$this->load->view('pages/fax/add_dealer_view');
	}

	//新增完稅人頁面
	public function go_add_taxer() {
		$this->load->view('templates/header');
		$this->load->view('pages/fax/add_taxer_view');
	}

	//新增盤商
	public function add_dealer() {
		$data = array('盤商名' => $_POST['name'],
						'盤商傳真' => $_POST['fax'],
						'盤商電話' => $_POST['tel']);
		$this->orders_model->add_dealer_model($data);
		$this->go_dealer();
	}

	//新增完稅人
	public function add_taxer() {
		$data = array('盤商名' => $_POST['盤商名'],
						'完稅姓名' => $_POST['完稅姓名'],
						'完稅ID' => $_POST['完稅ID'],
						'完稅地址' => $_POST['完稅地址'],
						'匯款姓名' => $_POST['匯款姓名'],
						'匯款銀行' => $_POST['匯款銀行'],
						'匯款帳號' => $_POST['匯款帳號'],);
		$this->orders_model->add_taxer_model($data);
		$this->go_taxer();
	}

	//編輯盤商頁面
	public function go_edit_dealer() {
		$dealer_id = $_GET['dealer_id'];
		$data = $this->orders_model->get_dealer_info(2, $dealer_id); //撈欲編輯資料
		$this->load->view('templates/header');
		$this->load->view('pages/fax/edit_dealer_view', array('data' => $data,));
	}

	//編輯完稅人頁面
	public function go_edit_taxer() {
		$taxer_id = $_GET['taxer_id'];
		$data = $this->orders_model->get_taxer_info(2, $taxer_id); //撈欲編輯資料
		$this->load->view('templates/header');
		$this->load->view('pages/fax/edit_taxer_view', array('data' => $data,));
	}

	//編輯盤商
	public function edit_dealer() {
		$data = array(
						'id' => $_GET['id'],
						'盤商名' => $_GET['name'],
						'盤商傳真' => $_GET['fax'],
						'盤商電話' => $_GET['tel']);
		$this->orders_model->edit_dealer_model($data);
		$this->go_dealer();
	}

	//編輯完稅人
	public function edit_taxer() {
		$data = array(
						'id' => $_GET['id'],
						'盤商名' => $_GET['盤商名'],
						'完稅姓名' => $_GET['完稅姓名'],
						'完稅ID' => $_GET['完稅ID'],
						'完稅地址' => $_GET['完稅地址'],
						'匯款姓名' => $_GET['匯款姓名'],
						'匯款銀行' => $_GET['匯款銀行'],
						'匯款帳號' => $_GET['匯款帳號'],);
		$this->orders_model->edit_taxer_model($data);
		$this->go_taxer();
	}

	//刪除盤商
	public function delete_dealer() {
		$this->orders_model->delete_dealer_model($_GET['dealer_id']);
		$this->go_dealer();
	}

	//刪除完稅人
	public function delete_taxer() {
		$this->orders_model->delete_taxer_model($_GET['taxer_id']);
		$this->go_taxer();
	}

	public function document_download_view() {
		// if ($dh = opendir("upload/document")) {
	 //        while (($file = readdir($dh)) !== false) {
	 //            echo $file;
	 //            echo "<br />";
	 //        }
		// }
		$dir_info = scandir('upload/document');
		// print_r($dir_info);
		$file_info = array();
		for ($i=2; $i < count($dir_info); $i++) { 
			array_push($file_info, iconv("BIG5", "UTF-8", $dir_info[$i]));
		}
		// print_r($file_info);
		// echo "</br>".iconv("BIG5", "UTF-8", $dir_info[6])."可以秀中文阿";
		$this->load->view('templates/header');
		$this->load->view('pages/download/document_view', array('file_info' => $file_info));
	}

	public function document_download() {
		$this->load->helper('download');
		// echo mb_detect_encoding($_POST['type']);
		$file_big5 = iconv("UTF-8", "BIG5", $_POST['type']);
		force_download('upload/document/'.$file_big5, NULL);
		$this->document_download_view();
	}

	public function pay_error() {
		$data = $this->orders_model->get_bills_out();
		$this->load->view('templates/header');
		$this->load->view('templates/receivable_header');
		$this->load->view('pages/money/error_view', array('data'=>$data));
		//echo "轉出異常的成交單會出現在這(EX大姊匯了兩次)";
	}

	public function passrecord() {
		$data = $this->orders_model->get_pass_record();
		// print_r($data);
		$this->load->view('templates/header');
		$this->load->view('pages/money/passrecord_view', array('data'=>$data));
	}

	public function add_need() {
		$data = array('需求者'=>$_POST['需求者'],
						'股名'=>$_POST['股名'],
						'買賣'=>$_POST['買賣'],
						'價格'=>$_POST['價格'],
						'張數'=>$_POST['張數'],
						'委託到期日'=>$_POST['委託到期日'],
						'把握度'=>$_POST['把握度'],
						'進度'=>$_POST['進度'],
						'建立日期'=>date('Y-m-d'),
						'最後動作時間'=>date('Y-m-d H:i:s'));
		$this->orders_model->add_need_model($data);
		$this->index();
	}

	public function get_employee_byname() {
		$data = $this->orders_model->get_employee($_POST['$name']);
		return json_encode($data);
	}

	public function edit_note() {
		$original_data = $this->orders_model->get($_POST['note_id'],null,null,null,null);
		$diff = "[更改前]".$original_data[0]['備註']."[更改後]".$_POST['edit_備註'];
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '修改備註', $_POST['note_id'], $diff);

		$this->orders_model->edit_note_model($_POST['note_id'] , $_POST['edit_備註']);
		
		$this->go_orders();
	}

	public function go_assign() {
		$data = $this->orders_model->get_assign();
		$this->load->view('templates/header');
		$this->load->view('pages/assign_view', array('data'=>$data));
	}

	public function add_assign() {
		$工單對象 = $_POST['工單對象'];
		$data = array('工單對象'=>$工單對象,
						'工單屬性'=>$_POST['工單屬性'],
						'工單內容'=>$_POST['工單內容']);
		$this->orders_model->add_assign_model($data);
		// $this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '增加工單', $_POST['note_id'], $diff);
		$this->go_assign();
	}

	public function turn_passrecord() {
		$data = $this->orders_model->turn_passrecord_model();
		
		echo count($data)."</br>";
		for ($i=0; $i < count($data); $i++) {
			$insert_data[$i]['姓名'] = $data[$i]['客戶姓名'];
			$insert_data[$i]['買賣'] = $data[$i]['買賣'];
			$insert_data[$i]['業務'] = $data[$i]['業務'];
			$insert_data[$i]['標的名稱'] = $data[$i]['股票'];
			$insert_data[$i]['張數'] = $data[$i]['張數'];
			$insert_data[$i]['成交價'] = $data[$i]['成交價'];
			$insert_data[$i]['盤價'] = $data[$i]['盤價'];
			// $insert_data[$i]['價差'] = $data[$i]['價差'];
			// $insert_data[$i]['稅金'] = $data[$i]['客戶姓名'];
			$insert_data[$i]['過戶費'] = $data[$i]['過戶費'];
			$insert_data[$i]['金額'] = $data[$i]['匯款金額應收帳款'];
			$employees = $this->orders_model->get_employee($data[$i]['業務']);
			$insert_data[$i]['自得比率'] = $employees[0]['趴數'];
			$insert_data[$i]['自行應付'] = $data[$i]['自行應付'];
			// $insert_data[$i]['扣款利息'] = $data[$i]['客戶姓名'];
			// $insert_data[$i]['個人實得'] = $data[$i]['客戶姓名'];
			// $insert_data[$i]['營業'] = $data[$i]['客戶姓名'];
			// $insert_data[$i]['公司'] = $data[$i]['客戶姓名'];
			$insert_data[$i]['匯款日期'] = $data[$i]['匯款日期'];
			$insert_data[$i]['狀態'] = '未完成';
			$insert_data[$i]['轉讓會員'] = $data[$i]['轉讓會員'];
			$insert_data[$i]['備註'] = $data[$i]['備註'];
			$insert_data[$i]['動作時間'] = date('Y-m-d H:i:s');
			echo "<br>";
			print_r($insert_data[$i]);
			echo "<br>";
		}
	}

	public function show_bank() {
		$data = $this->orders_model->show_bank_model();
		$this->load->view('templates/header');
		$this->load->view('templates/receivable_header');
		$this->load->view('pages/money/show_bank_view', array('data'=>$data));
	}

	public function show_test() {
		$this->load->view('pages/money/testing');

	}

}






