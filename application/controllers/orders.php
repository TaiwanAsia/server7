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
			$all_orders = $orders;
			$employees = $this->orders_model->get_employee();
			$arrayName = array('orders' => $orders,
								'all_orders' => $all_orders,
								'employees' => $employees,);
			$this->show($arrayName);
		}
	}

	public function new_order()
    {
		$orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
		$employees = $this->orders_model->get_employee();
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
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '新增', $insert_id, null);
		$this->index();
	}

	public function delete() {
		$id = $_POST['id'];
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '刪除', $id, null);
		$this->orders_model->delete($id);
		$myJSON = json_encode('Done!');
		print_r($myJSON);
	}
	
	public function checkbill() {
		$orders = $this->orders_model->get_checkbill();
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

		$employees = $this->orders_model->get_employee();

		$arrayName = array('orders' => $orders,
							'employees' => $employees,
							'total_info' => $total_info,);
		
		$this->load->view('templates/header');
		$this->load->view('pages/receivable_view', $arrayName);
	}

	// public function pushinto_checkbill() {
	// 	$this->orders_model->pushinto_checkbill($_POST['成交單編號'], date('Y-m-d H:i:s'));
	// 	$this->index();
	// }

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
				$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '上傳契約', $id, null);
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
				$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '上傳稅單', $id, null);
				$this->index();
			}
		}
	}

	public function upload_water() {
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
				move_uploaded_file($_FILES["file"]["tmp_name"],"upload/water/".$id);
				$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '上傳水', $id, null);
				$this->orders_model->finish_order($id);
				$this->index();
			}
		}
	}

	public function match() {
		// echo $_POST['欲媒合對方ID'].", ".$_POST['欲媒合自身ID']."<br>";
		$this -> orders_model -> match($_POST['欲媒合自身ID'], $_POST['欲媒合對方ID']);
		$this->index();
	}

	//修改成交單資料
	public function go_edit() {
		$result = $this -> orders_model -> get($_GET['id'],null,null);
		// $old_date_timestamp = strtotime($result[0]['成交日期']);
		// $new_date = date('Y/m/d', $old_date_timestamp);
		// $result[0]['日期'] = $new_date;
		$employees = $this->orders_model->get_employee();
		// foreach ($result[0] as $key => $value) {
		// 	echo $key.": ".$value."<br>";
		// };  
		$all_orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
		$this->load->view('templates/header');
		if ($_SESSION['權限名稱']=='最高權限') {
			$this->load->view('pages/admin_edit_order_view',array('result' => $result,'employees' => $employees,'all_orders' => $all_orders,));
		} else {
			$this->load->view('pages/edit_order_view',array('result' => $result,'employees' => $employees,));
		}
	}

	//管理者修改成交單資料
	public function admin_go_edit() {
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
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '一審', $_POST['ID'], null);
		$this->index();

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
		$original = $this->orders_model->get($_POST['ID'], $_SESSION['權限名稱'], $_SESSION['NAME']);
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
		$this->index();
	}

	//單純修改成交單內容admin(全部欄位都能修改)
	public function admin_edit_order() {
		$title = $this->get_title('admin');
		$original = $this->orders_model->get($_POST['ID'], $_SESSION['權限名稱'], $_SESSION['NAME']);
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
			// if (file_exists("upload/tax/".$_POST['ID'])&&file_exists("upload/contact/".$_POST['ID'])){
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
			$this->index();
			// } else {
			// 	echo "<h3><p class='text-danger'><b>編號".$_POST['ID']."稅單或契約書上傳尚未完成!!!　　無法完成二審</b></p></h3>";
			// 	$this->index();
			// }
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

            $this->load->view('templates/header');
            $orders = $this->orders_model->get_checkbill();
			$employees = $this->orders_model->get_employee();
			$arrayName = array('orders' => $orders,
							'employees' => $employees,);
			$this->load->view('pages/receivable_view', $arrayName);
		}
    }

    public function reconcile() {
    	//先抓欲對帳表
    	//$orders = $this->orders_model->get_checkbill(); 
    	$orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME']);	//2018.5.9 更新買賣匯款一起處理
    	$datas = $this->orders_model->get_bills();
    	
    	for ($i = 0; $i < count($orders); $i++) {
    		$time = $orders[$i]['成交日期'];
    		$money = $orders[$i]['匯款金額應收帳款'];
    		$inform = $orders[$i]['通知查帳'];

    		if ($inform == '未通知' || $inform == '待對帳') {
	    		if ($orders[$i]['買賣'] == '1') {	//已收金額
	    			for ($j = 0; $j < count($datas); $j++) {
	    				if (abs(strtotime($time) - strtotime($datas[$j]['日期'])) <= 3600*24*7 && $money == $datas[$j]['轉入']) { //一周內
	    					//對帳完成
	    					echo $datas[$j]['日期']." ".$orders[$i]['ID'].'<br>';
	    					$this->orders_model->check_money_received($orders[$i]['ID'], $orders[$i]['待查帳金額'], $money);
	    					$this->orders_model->check_bill_reconciled($datas[$j]['id']);
	    				}
	    			}
	    		} else {	//已匯金額
	    			for ($j = 0; $j < count($datas); $j++) {
	    				if ($time == $datas[$j]['日期'] && $money == $datas[$j]['轉出']) { //一周內
	    					//對帳完成
	    					echo $datas[$j]['日期']." ".$orders[$i]['ID'].'<br>';
	    					$this->orders_model->check_money_exported($orders[$i]['ID'], $orders[$i]['待查帳金額'], $money);
	    					$this->orders_model->check_bill_reconciled($datas[$j]['id']);
	    				}
	    			}
	    		}
    		}
    	}

    	$this->load->view('templates/header');
        $orders = $this->orders_model->get_checkbill();
		$employees = $this->orders_model->get_employee();
		$arrayName = array('orders' => $orders,
						'employees' => $employees,);
		$this->load->view('pages/receivable_view', $arrayName);
    }

	//進入庫存頁面
	public function go_inventory() {
		$orders = $this->orders_model->get_inventory(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
		$all_orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
		$employees = $this->orders_model->get_employee();
		$arrayName = array('orders' => $orders,
							'all_orders' => $all_orders,
							'employees' => $employees,);
		$this->show($arrayName);
	}

	//進入KO頁面
	public function go_ko() {
		$orders = $this->orders_model->get_ko(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
		$all_orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
		$employees = $this->orders_model->get_employee();
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

	//新增成交單時匯入盤商資料
	public function import_dealer_info() {
		$info = $this->orders_model->get_dealer_info($_GET['dealer_name']);
		$myJSON = json_encode($info[0]);
		print_r($myJSON);
	}

	//新增成交單時匯入完稅人資料
	public function import_taxer_info() {
		$info = $this->orders_model->get_taxer_info($_GET['taxer_name']);
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
		$order = $this->orders_model->get($_GET['ID'],$_SESSION['權限名稱'], $_SESSION['NAME']);
		$arrayName = array('order' => $order);
		$this->load->view('pages/inform_check_money',$arrayName);
	}

	//更改通知查帳
	public function inform_check_money() {
		$this->orders_model->inform_check_money_model($_POST['ID'], $_POST['支付方式'], $_POST['轉出日期轉入日期'], $_POST['支付人'], $_POST['匯款帳號末5碼'], $_POST['待查帳金額'], date('Y-m-d H:i:s'));
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '通知查帳', $_POST['ID'], null);
		$this->index();
	}

	//大姊進入確認帳款頁面
	public function boss_check_money() {
		$data = $this->orders_model->get_check_record(null, '未查帳');
		$arrayName = array('data' => $data);
		$this->load->view('templates/header');
		$this->load->view('pages/ready_to_check',$arrayName);
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
		$this->load->view('pages/check_record', array('data'=>$data));
	}

	//查看動作紀錄
	public function move_record() {
		$data = $this->orders_model->get_move_record();
		$this->load->view('templates/header');
		$this->load->view('pages/move_record', array('data'=>$data));
	}
}






