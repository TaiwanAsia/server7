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
		$employees = $this->orders_model->get_employee();
		$arrayName = array('orders' => $orders,
							'employees' => $employees,	);

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
						'匯款銀行' => $_POST['匯款銀行'],
						'匯款分行' => $_POST['匯款分行'],
						'匯款戶名' => $_POST['匯款戶名'],
						'匯款帳號' => $_POST['匯款帳號'],
						'轉讓會員' => $_POST['轉讓會員'],
						'完稅人' => $_POST['完稅人'],
						'新舊' => $_POST['新舊'],
						'自行應付' => $_POST['自行應付'],
						'刻印' => $_POST['刻印'],
						'過戶費' => $_POST['過戶費'],
						'最後動作時間' => date('Y-m-d H:i:s'),
					);
		$insert_id = $this -> orders_model -> add($data);
		$this->index();
	}
	
	public function checkbill() {
		$this->load->view('templates/header');
		$orders = $this->orders_model->get_checkbill();
		$employees = $this->orders_model->get_employee();
		$arrayName = array('orders' => $orders,
							'employees' => $employees,);
		$this->load->view('pages/receivable_view', $arrayName);
	}

	public function pushinto_checkbill() {
		$this->orders_model->pushinto_checkbill($_POST['成交單編號']);
		$this->index();
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
				echo "string";
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
		$employees = $this->orders_model->get_employee();
		// foreach ($result[0] as $key => $value) {
		// 	echo $key.": ".$value."<br>";
		// };  
		$this->load->view('templates/header');
		$this->load->view('pages/edit_order_view',array('result' => $result,'employees' => $employees,));
	}

	//改成交單狀態(一審)
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
			'刻印收送' => $_POST['刻印收送'],
			'成交單狀態' => $_POST['成交單狀態'],
			'現金或匯款' => $_POST['現金或匯款'],
			'匯款日期' => $_POST['匯款日期'],
			'最後動作時間' => date('Y-m-d H:i:s'),);
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
						'匯款金額應收帳款' => $_POST['匯款金額應收帳款'],
						'匯款銀行' => $_POST['匯款銀行'],
						'匯款分行' => $_POST['匯款分行'],
						'匯款帳號' => $_POST['匯款帳號'],
						'匯款戶名' => $_POST['匯款戶名'],
						'轉讓會員' => $_POST['轉讓會員'],
						// '從庫存出' => $_POST['從庫存出'],
						'完稅人' => $_POST['完稅人'],
						'新舊' => $_POST['新舊'],
						'自行應付' => $_POST['自行應付'],
						'刻印' => $_POST['刻印'],
						'過戶費' => $_POST['過戶費'],
						'最後動作時間' => date('Y-m-d H:i:s'),);
		$this -> orders_model -> edit($data);
		$this->index();
	}

	//自動填入客戶資料
	public function autofill() {
		$cus_info = $this -> orders_model -> get_cus_info($_POST['name']);
		return json_encode($cus_info);
	}

	//二審表格
	public function go_edit2() {
		$result = $this -> orders_model -> get($_GET['id'],null,null);
		$old_date_timestamp = strtotime($result[0]['成交日期']);
		$new_date = date('Y/m/d', $old_date_timestamp);
		$result[0]['日期'] = $new_date;
		$employees = $this->orders_model->get_employee();
		$this->load->view('templates/header');
		$this->load->view('pages/edit2_order_view',array('result' => $result,'employees' => $employees));
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
			$this->index();
			} else {
				echo "<h3><p class='text-danger'><b>編號".$_POST['ID']."稅單或契約書上傳尚未完成!!!　　無法完成二審</b></p></h3>";
				$this->index();
			}
		} else {
			echo "<h3><p class='text-danger'><b>編號".$_POST['ID']."一審尚未完成!!!　　無法完成二審</b></p></h3>";
				$this->index();
		}
		
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

		                    if ($rowData[0][0] != '' && $rowData[0][0] != '銷單序號' && $rowData[0][3] != '') { // 避開匯入時的title行以及轉入為0
		                    	$datas[$i][$Data_size++] = array(
		                    		'日期' => substr($rowData[0][1], 0, 3).'-'.substr($rowData[0][1], 3, 2).'-'.substr($rowData[0][1], 5, 2),
		                    		'轉入' => $rowData[0][3],
		                    	);
		                    }

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
            $this->reconcile($datas);

            $this->load->view('templates/header');
            $orders = $this->orders_model->get_checkbill();
			$employees = $this->orders_model->get_employee();
			$arrayName = array('orders' => $orders,
							'employees' => $employees,);
			$this->load->view('pages/receivable_view', $arrayName);
		}
    }

    public function reconcile($datas) {
    	$orders = $this->orders_model->get_checkbill(); //先抓欲對帳表

    	for ($i = 0; $i < count($orders); $i++) {
    		$time = $orders[$i]['成交日期'];
    		$money = $orders[$i]['匯款金額應收帳款'];

    		if ($money != '0') {
    			for ($j = 0; $j < count($datas); $j++) {
    				for ($k = 0; $k < count($datas[$j]); $k++) {
    					if (abs(strtotime($time) - strtotime($datas[$j][$k]['日期'])) <= 3600*24*7 && $money == $datas[$j][$k]['轉入']) { //一周內
    						//對帳完成
    					}
    				}
    			}
    		}
    	}
    }

	//進入庫存頁面
	public function go_inventory() {
		$orders = $this->orders_model->get_inventory(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
		$employees = $this->orders_model->get_employee();
		$arrayName = array('orders' => $orders,
							'employees' => $employees,);
		$this->show($arrayName);
	}

	public function import_customer_info() {
		$info = $this->orders_model->get_customer_info($_GET['customer_name']);
		if ($info[0]['業務'] == $_SESSION['NAME']) {
			$myJSON = json_encode($info[0]);
			print_r($myJSON);
		} else {
			echo "false";
		}
		
	}

	public function import_dealer_info() {
		$info = $this->orders_model->get_dealer_info($_GET['dealer_name']);
		$myJSON = json_encode($info[0]);
		print_r($myJSON);
	}

	public function import_taxer_info() {
		$info = $this->orders_model->get_taxer_info($_GET['taxer_name']);
		$myJSON = json_encode($info[0]);
		print_r($myJSON);
	}

	public function import_payer_info() {
		$info = $this->orders_model->get_payer_info($_GET['payer_name']);
		$myJSON = json_encode($info[0]);
		print_r($myJSON);
	}
}






