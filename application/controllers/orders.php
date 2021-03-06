<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class Orders extends CI_Controller {


	public function __construct()
    {
        parent::__construct();

        $newURL = "../login/logout";
        if(isset($_SESSION['expiretime'])) {
            if($_SESSION['expiretime'] < time()){
                header('Location: '.$newURL);
                $_SESSION['expiretime'] = time() + 3600; // 給予時間戳
            } else {
                $_SESSION['expiretime'] = time() + 3600; // 刷新時間戳
            }
        }
        if (!isset($_SESSION['NAME'])){
            $newURL = "../login/index";
            header('Location: '.$newURL);
            $_SESSION['expiretime'] = time() + 3600; // 給予時間戳
        }

		date_default_timezone_set('Asia/Taipei');
		$this->load->helper(array('form', 'url', 'array'));
		$this->load->library('form_validation');

		$this->load->model('login_model');
		$this->load->model('orders_model');
	}

	public function session_check() {
		if (!isset($_SESSION['ACCOUNT'])) {
    		redirect('login/index');
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
			$this->load->view('templates/footer');
    	}
    }

    public function index($mgs="") {
    	$employees = $this->orders_model->get_employee(null);
    	$need = $this->orders_model->get_need_model(null);
        $assigns = $this->orders_model->get_assign();
        $reply = $this->orders_model->get_assigns_reply();

    	$result = array('need' => $need,
            'employees' => $employees,
            'assigns'=>$assigns,
            'reply'=>$reply);
		$this->load->view('templates/header');
		$this->load->view('pages/home', $result);
		$this->load->view('templates/footer');
    }

    public function go_orders($msg='')
    {
    	// The following code define the actions when a 'clickable' table element
    	// is clicked.
		if (!isset($_SESSION['ACCOUNT'])) {
			// If not logged in, redirect to 'login/index'
			redirect('login/index');
		} else {
			// Handles queries on orders between 'date1' and 'date2'
			if (isset($_GET['date1']) && isset($_GET['date2']) && isset($_GET['業務'])) {
				$orders = $this->orders_model->get_byDate($_SESSION['權限名稱'],$_SESSION['NAME'],$_GET['業務'],$_GET['date1'],$_GET['date2']);
			} else {
				$orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
			}

			if ($orders != null) {
				foreach ($orders as $key => $value) {
					if (isset($_GET['股票']) && $_GET['股票'] != $value['股票']) {
						unset($orders[$key]);
					}
					if (isset($_GET['業務']) && $_GET['業務'] != $value['業務'] && $_GET['業務'] != '所有業務') {
						unset($orders[$key]);
					}
					if (isset($_GET['客戶姓名']) && $_GET['客戶姓名'] != $value['客戶姓名']) {
						unset($orders[$key]);
					}
					if (isset($_GET['聯絡電話']) && $_GET['聯絡電話'] != $value['聯絡電話']) {
						unset($orders[$key]);
					}
				}
				$orders = array_values($orders);
				
			}
			

			$add_quene = $this->orders_model->get_add_quene(1, $_SESSION['NAME']);
			$all_orders = $orders;
			$employees = $this->orders_model->get_employee(null);
			$arrayName = array('orders' => $orders,
								'all_orders' => $all_orders,
								'employees' => $employees,
								'add_quene' => $add_quene,
                                'msg' => $msg);
			$this->show($arrayName);
		}
	}

	public function search() {
		$orders = $this->orders_model->get($_GET['keyword'],$_SESSION['權限名稱'],$_SESSION['NAME']);
		$employees = $this->orders_model->get_employee(null);
		$add_quene = $this->orders_model->get_add_quene(1, $_SESSION['NAME']);
		$arrayName = array('orders' => $orders,
							'employees' => $employees,
							'add_quene' => $add_quene,);
		$this->show($arrayName);
	}

	/*
	 * 棄用，直接new_order
	 */
	public function new_order_choose()
    {
    	$add_quene = $this->orders_model->get_add_quene(1, $_SESSION['NAME']);
		$orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
		$employees = $this->orders_model->get_employee(null);
		$arrayName = array('orders' => $orders,
							'employees' => $employees,
							'add_quene' => $add_quene,);
		$this->load->view('templates/header');
		$this->load->view('pages/new_order_choose', $arrayName);
		$this->load->view('templates/footer');
	}

	public function new_order()
    {
    	$add_quene = $this->orders_model->get_add_quene(3, $_POST['id']);
		$employees = $this->orders_model->get_employee(null);
		$arrayName = array(
							'employees' => $employees,
							'add_quene' => $add_quene[0],);
		$this->load->view('templates/header');
		$this->load->view('pages/new_order', $arrayName);
		$this->load->view('templates/footer');
	}

	public function admin_new_order() {
		$quene = $this->orders_model->get_add_quene(0);
		$order_max_媒合 = $this->orders_model->get_max_媒合();
		$employees = $this->orders_model->get_employee('業務');
		// if ($quene != null && $quene[count($quene)-1]['媒合編號']!=0) {
		// 	$庫存下一編號 = $quene[count($quene)-1]['媒合編號']+1;
		// } else {
		// 	$現有下一編號 = $order_max_媒合[0]['媒合']+1;
		// }
		$庫存下一編號 = $quene[count($quene)-1]['媒合編號']+1;
		$現有下一編號 = $order_max_媒合[0]['媒合']+1;
		if ($庫存下一編號 >= $現有下一編號) {
			$新媒合編號 = $庫存下一編號;
		} else {
			$新媒合編號 = $現有下一編號;
		}
		if (isset($_GET['庫存ID'])) {
			$order = $this->orders_model->get($_GET['庫存ID']);
			$arrayName = array(
							'order' => $order,
							'新媒合編號' => $新媒合編號,
							'employees' => $employees,);
		} else {
			$arrayName = array(
							'新媒合編號' => $新媒合編號,
							'employees' => $employees,);
		}
		$this->load->view('templates/header');
		$this->load->view('pages/admin_new_order', $arrayName);
		$this->load->view('templates/footer');
	}

	public function add_quene_view() {
		$quene = $this->orders_model->get_add_quene(0);
		$arrayName = array('data' => $quene,);
		$this->load->view('templates/header');
		$this->load->view('pages/add_quene_view', $arrayName);
		$this->load->view('templates/footer');
	}

	public function delete_add_quene_by_matchid() {
		$quene = $this->orders_model->delete_add_quene_by_matchid_model($_POST['id'], $_POST['媒合編號']);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), 'admin刪除尚未key的成交單', '編號: '.$_POST['id'].'媒合: '.$_POST['媒合編號'], null);
		redirect('orders/add_quene_view');
	}

	public function add_order_id() {
		$買賣張數差 = ($_POST['主賣張數']+$_POST['副賣張數']) - ($_POST['主買張數']+$_POST['副買張數']);

		//買賣張數不相等,有進庫存
		if ($買賣張數差 > 0) {
			//沒有副賣, 主賣剩餘張數直接進庫存
			if ($_POST['副賣張數']==null && $_POST['副買張數']==null) {
				// echo "1:0";
				if ($_POST['主買張數']=='') {
					$array = array('媒合編號' => '',
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '0',
								'業務' => $_POST['客戶主賣'],
								'張數' => $_POST['主賣張數'],
								'主要' => '2',);
					$this->orders_model->insert_add_quene($array);
				} else {
				// echo "1:1";
					if (isset($_POST['ID'])) {
						$array = array(
							'ID' => $_POST['ID'],
							'媒合' => $_POST['媒合編號'],
							'轉讓會員' => $_POST['客戶主買'],
							'備註' => '從庫存出',);
						$this->orders_model->edit($array);
					} else {
						$array = array('媒合編號' => $_POST['媒合編號'],
										'成交日期' => $_POST['成交日期'],
										'股票名稱' => $_POST['股票名稱'],
										'買賣' => '0',
										'業務' => $_POST['客戶主賣'],
										'張數' => $_POST['主買張數'],
										'主要' => '1',);
						$this->orders_model->insert_add_quene($array);
					}
					$array = array('媒合編號' => '',
									'成交日期' => $_POST['成交日期'],
									'股票名稱' => $_POST['股票名稱'],
									'買賣' => '0',
									'業務' => $_POST['客戶主賣'],
									'張數' => $買賣張數差,
									'主要' => '2',);
					$this->orders_model->insert_add_quene($array);
					$array = array('媒合編號' => $_POST['媒合編號'],
									'成交日期' => $_POST['成交日期'],
									'股票名稱' => $_POST['股票名稱'],
									'買賣' => '1',
									'業務' => $_POST['客戶主買'],
									'張數' => $_POST['主買張數'],
									'主要' => '1',);
					$this->orders_model->insert_add_quene($array);
				}
			} elseif($_POST['副賣張數']==null && $_POST['副買張數']!=null) {
				// echo "1:2";
				if (isset($_POST['ID'])) {
					$array = array(
						'ID' => $_POST['ID'],
						'媒合' => $_POST['媒合編號'],
						'轉讓會員' => $_POST['客戶主買'],
						'備註' => '從庫存出',);
					$this->orders_model->edit($array);
				} else {
					$array = array('媒合編號' => $_POST['媒合編號'],
									'成交日期' => $_POST['成交日期'],
									'股票名稱' => $_POST['股票名稱'],
									'買賣' => '0',
									'業務' => $_POST['客戶主賣'],
									'張數' => $_POST['主賣張數']-$買賣張數差,
									'主要' => '1',);
					$this->orders_model->insert_add_quene($array);
				}
				$array = array('媒合編號' => '',
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '0',
								'業務' => $_POST['客戶主賣'],
								'張數' => $買賣張數差,
								'主要' => '2',);
				$this->orders_model->insert_add_quene($array);
				$array = array('媒合編號' => $_POST['媒合編號'],
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '1',
								'業務' => $_POST['客戶主買'],
								'張數' => $_POST['主買張數'],
								'主要' => '1',);
				$this->orders_model->insert_add_quene($array);
				$array = array('媒合編號' => $_POST['媒合編號'],
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '1',
								'業務' => $_POST['客戶副買'],
								'張數' => $_POST['副買張數'],
								'主要' => '0',);
				$this->orders_model->insert_add_quene($array);
			} elseif($_POST['副賣張數']!=null && $_POST['副買張數']==null) {
				// echo "2:1";
				if (isset($_POST['ID'])) {
					$array = array(
						'ID' => $_POST['ID'],
						'媒合' => $_POST['媒合編號'],
						'轉讓會員' => $_POST['客戶主買'],
						'備註' => '從庫存出',);
					$this->orders_model->edit($array);
				} else {
					$array = array('媒合編號' => $_POST['媒合編號'],
									'成交日期' => $_POST['成交日期'],
									'股票名稱' => $_POST['股票名稱'],
									'買賣' => '0',
									'業務' => $_POST['客戶主賣'],
									'張數' => $_POST['主賣張數'],
									'主要' => '1',);
					$this->orders_model->insert_add_quene($array);
				}
				$array = array('媒合編號' => $_POST['媒合編號'],
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '0',
								'業務' => $_POST['客戶副賣'],
								'張數' => $_POST['副賣張數'] - $買賣張數差,
								'主要' => '0',);
				$this->orders_model->insert_add_quene($array);
				$array = array('媒合編號' => '',
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '0',
								'業務' => $_POST['客戶副賣'],
								'張數' => $買賣張數差,
								'主要' => '2',);
				$this->orders_model->insert_add_quene($array);
				$array = array('媒合編號' => $_POST['媒合編號'],
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '1',
								'業務' => $_POST['客戶主買'],
								'張數' => $_POST['主買張數'],
								'主要' => '1',);
				$this->orders_model->insert_add_quene($array);
			} elseif($_POST['副賣張數']!=null && $_POST['副買張數']!=null) {
				// echo "2:2";
				if (isset($_POST['ID'])) {
					$array = array(
						'ID' => $_POST['ID'],
						'媒合' => $_POST['媒合編號'],
						'轉讓會員' => $_POST['客戶主買'],
						'備註' => '從庫存出',);
					$this->orders_model->edit($array);
				} else {
					$array = array('媒合編號' => $_POST['媒合編號'],
									'成交日期' => $_POST['成交日期'],
									'股票名稱' => $_POST['股票名稱'],
									'買賣' => '0',
									'業務' => $_POST['客戶主賣'],
									'張數' => $_POST['主賣張數'],
									'主要' => '1',);
					$this->orders_model->insert_add_quene($array);
				}
				$array = array('媒合編號' => $_POST['媒合編號'],
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '0',
								'業務' => $_POST['客戶副賣'],
								'張數' => ($_POST['主買張數'] - $_POST['主賣張數'])+$_POST['副買張數'],
								'主要' => '0',);
				$this->orders_model->insert_add_quene($array);
				$array = array('媒合編號' => '',
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '0',
								'業務' => $_POST['客戶副賣'],
								'張數' => $買賣張數差,
								'主要' => '2',);
				$this->orders_model->insert_add_quene($array);
				$array = array('媒合編號' => $_POST['媒合編號'],
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '1',
								'業務' => $_POST['客戶主買'],
								'張數' => $_POST['主買張數'],
								'主要' => '1',);
				$this->orders_model->insert_add_quene($array);
				$array = array('媒合編號' => $_POST['媒合編號'],
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '1',
								'業務' => $_POST['客戶副買'],
								'張數' => $_POST['副買張數'],
								'主要' => '0',);
				$this->orders_model->insert_add_quene($array);
			}
			

		//買賣張數相等or主賣=主買
		} else {
			if (isset($_POST['ID'])) {
				$array = array(
							'ID' => $_POST['ID'],
							'媒合' => $_POST['媒合編號'],
							'轉讓會員' => $_POST['客戶主買'],
							'備註' => '從庫存出',);
				$this->orders_model->edit($array);
			} else {
				$array = array('媒合編號' => $_POST['媒合編號'],
							'成交日期' => $_POST['成交日期'],
							'股票名稱' => $_POST['股票名稱'],
							'買賣' => '0',
							'業務' => $_POST['客戶主賣'],
							'張數' => $_POST['主賣張數'],
							'主要' => '1',);
				$this->orders_model->insert_add_quene($array);
			}
			if ($_POST['副賣張數']>0) {
				$array = array('媒合編號' => $_POST['媒合編號'],
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '0',
								'業務' => $_POST['客戶副賣'],
								'張數' => $_POST['副賣張數'],
								'主要' => '0',);
				$this->orders_model->insert_add_quene($array);
			}
			$array = array('媒合編號' => $_POST['媒合編號'],
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '1',
								'業務' => $_POST['客戶主買'],
								'張數' => $_POST['主買張數'],
								'主要' => '1',);
			$this->orders_model->insert_add_quene($array);
			if ($_POST['副買張數']>0) {
				$array = array('媒合編號' => $_POST['媒合編號'],
								'成交日期' => $_POST['成交日期'],
								'股票名稱' => $_POST['股票名稱'],
								'買賣' => '1',
								'業務' => $_POST['客戶副買'],
								'張數' => $_POST['副買張數'],
								'主要' => '0',);
				$this->orders_model->insert_add_quene($array);
			}
		}


		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), 'admin新增成交單', '媒合編號'.$_POST['媒合編號'], null);

		$this->go_orders();
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
                        '媒合' => '',
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
                        // '盤價' => $_POST['盤價'],
                        '匯款金額應收帳款' => $_POST['匯款金額應收帳款'],
                        '匯款日期' => $_POST['匯款日期'],
                        '匯款銀行' => $_POST['匯款銀行'],
                        '匯款分行' => $_POST['匯款分行'],
                        '匯款戶名' => $_POST['匯款戶名'],
                        '匯款帳號' => $_POST['匯款帳號'],
                        '轉讓會員' => $_POST['轉讓會員'],
                        '轉讓會員2'=> empty($_POST['轉讓會員2']) ? '' : $_POST['轉讓會員2'],
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


		if ($_POST['轉讓會員']=='null') {
            header('Location: '.'new_order?code=2');

        } elseif ($_POST['業務']=='null') {
            header('Location: '.'new_order?code=1');

        } else {
    	
	    	//新增進orders
			$insert_id = $this -> orders_model -> add($data);
			//動作紀錄
			$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '新增', $insert_id, null);

			//大姊的單直接通知查帳
			if ($data['買賣'] == 1 && ($data['業務'] == 'JOY')) {
				$this->orders_model->inform_check_money_model($data['ID'], '匯款', $data['匯款日期'], $data['客戶姓名'], null, $data['匯款金額應收帳款'], date('Y-m-d H:i:s'));
			}

            header('Location: '.'go_orders');
		}
	}

	public function record_info($data) {
        $稅金 = $data['盤價']*$data['張數']*1000*0.003;
        $差額 = abs($data['成交價'] - $data['盤價'])*$data['張數']*1000 - $稅金 - $data['過戶費'] - $data['刻印']; // 無論買賣，取絕對值
        $個人實得 = $差額*$_SESSION['趴數'] - $data['自行應付'];
        $公司 = $差額 - $個人實得;

		$result = array( 'ID' => $data['ID'],
						'媒合' => $data['媒合'],
						'日期' => $data['成交日期'],
						'姓名' => $data['客戶姓名'],
						'買賣' => $data['買賣'],
						'業務' => $data['業務'],
						'標的名稱' => $data['股票'],
						'張數' => $data['張數'],
						'成交價' => $data['成交價'],
						'盤價' => $data['盤價'],
						'價差' => abs($data['成交價'] - $data['盤價']),
						'稅金' => $稅金,
                        '刻印' => $data['刻印'],
						'過戶費' => $data['過戶費'],
						'金額' => $data['匯款金額應收帳款'],
						'差額' => $差額,
						'自得比率' => $_SESSION['趴數'],
						'自行應付' => $data['自行應付'],
						'個人實得' => $個人實得,
						 '公司' => $公司,
						'匯款日期' => $data['匯款日期'],
						'轉讓會員' => $data['轉讓會員'],
						'轉讓會員2' => $data['轉讓會員2'],
						'備註' => $data['備註'],
						'最後動作時間' => date('Y-m-d H:i:s'));
		return $result;
	}

	public function copy() {
		$result = $this->orders_model->get($_POST['id'],null,null);
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
						'轉讓會員2' => $result[0]['轉讓會員2'],
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
		//成交單、應收帳款、轉讓紀錄一併刪除
		$this->orders_model->delete($id);
		$myJSON = json_encode('Done!');
		print_r($myJSON);
	}

	public function go_deleted() {
		$orders = $this->orders_model->go_deleted_model();
		$this->load->view('templates/header');
		$this->load->view('pages/deleted_view', array('orders'=>$orders));
		$this->load->view('templates/footer');
	}

	// 非最高權限的 應收帳款
	public function checkbill() {
		if (isset($_GET['股票'])) {
			$orders = $this->orders_model->get_checkbill('in','股票',$_GET['股票']);
		} else if (isset($_GET['業務'])) {
			$orders = $this->orders_model->get_checkbill('in','業務',$_GET['業務']);
		} else if (isset($_GET['客戶姓名'])) {
			$orders = $this->orders_model->get_checkbill('in','客戶姓名',$_GET['客戶姓名']);
		} else if (isset($_GET['聯絡電話'])) {
			$orders = $this->orders_model->get_checkbill('in','聯絡電話',$_GET['聯絡電話']);
		} else {
			$orders = $this->orders_model->get_checkbill('in',null,null);
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

		$bank_data = $this->orders_model->show_bank_model();
		$first_dateofdata = $bank_data[count($bank_data)-1]['日期'];
		$last_dateofdata = $bank_data[0]['日期'];

		$arrayName = array('orders' => $orders,
							'employees' => $employees,
							'total_info' => $total_info,
							'first_dateofdata' => $first_dateofdata,
							'last_dateofdata' => $last_dateofdata,);

		$this->load->view('templates/header');
		$this->load->view('templates/receivable_header');
		$this->load->view('pages/receivable_view', $arrayName);
		$this->load->view('templates/footer');
	}

	// public function pushinto_checkbill() {
	// 	$this->orders_model->pushinto_checkbill($_POST['成交單編號'], date('Y-m-d H:i:s'));
	// 	$this->index();
	// }

    // 應匯帳款
	public function checkbillout() {
		if (isset($_GET['股票'])) {
			$orders = $this->orders_model->get_checkbill('out','股票',$_GET['股票']);
		} else if (isset($_GET['業務'])) {
			$orders = $this->orders_model->get_checkbill('out','業務',$_GET['業務']);
		} else if (isset($_GET['客戶姓名'])) {
			$orders = $this->orders_model->get_checkbill('out','客戶姓名',$_GET['客戶姓名']);
		} else if (isset($_GET['聯絡電話'])) {
			$orders = $this->orders_model->get_checkbill('out','聯絡電話',$_GET['聯絡電話']);
		} else {
			$orders = $this->orders_model->get_checkbill('out',null,null);
		}
		$total_transferable = 0;
		$total_transfered = 0;
		for ($i=0; $i < count($orders); $i++) {
			$total_transferable = $total_transferable + $orders[$i]['匯款金額應收帳款'];
			$total_transfered = $total_transfered + $orders[$i]['已匯金額已收金額'];
		}
		$total_left = $total_transferable - $total_transfered;
		$total_info = array('total_transferable' => $total_transferable,
							'total_transfered' => $total_transfered,
							'total_left' => $total_left,);

		$employees = $this->orders_model->get_employee(null);

		$bank_data = $this->orders_model->show_bank_model();
		$first_dateofdata = $bank_data[count($bank_data)-1]['日期'];
		$last_dateofdata = $bank_data[0]['日期'];

		$return = array('orders' => $orders,
							'employees' => $employees,
							'total_info' => $total_info,
							'first_dateofdata' => $first_dateofdata,
							'last_dateofdata' => $last_dateofdata,);

		$this->load->view('templates/header');
		$this->load->view('templates/transferable_header',array('total_info' => $total_info, 'first_dateofdata' => $first_dateofdata, 'last_dateofdata' => $last_dateofdata,));
		$this->load->view('pages/transferable_view', $return);
		$this->load->view('templates/footer');
	}

    public function upload_view(){
        $image_url = './uploadstest/20.jpg';
        $this->load->view('pages/upload_form',array('error' => '','image_url'=>$image_url));
    }

    public function upload_work($workid="file"){
        $config['upload_path'] = './uploads/work/';
        $config['allowed_types'] = 'gif|jpg|png|xls|xlsx|csv|pdf|doc|docx';
        $config['file_name'] = $workid;

        $this->load->library('upload',$config);

        if (!file_exists('./uploads/work')) {
            mkdir('./uploads/work', 0777, true);
        }

        if ( ! $this->upload->do_upload())
        {
            $res = array('error' => $this->upload->display_errors());
        }
        else
        {
            $res = array('upload_data' => $this->upload->data());
        }
        return $res;
    }

	public function upload_document() {
		$dir_info = scandir('uploads/document');
		$dir_count = count($dir_info);
		$next_dir_index = $dir_count + 1;
		if ($_FILES["file"]["error"] > 0){
			// echo "Error: " . $_FILES["file"]["error"];
			// show_404($dir_info, TRUE);
			$message = "請先選擇欲上傳檔案";
			show_error($message, null, $heading = 'An Error Was Encountered');
		} else {
			$name = iconv("UTF-8", "BIG5", $_FILES["file"]["name"]);
			if (file_exists("uploads/document/" . $name)){
				echo "<h2><font color='red'>檔案已經存在，請勿重覆上傳相同檔案。</font></h2><br>";
				$this->document_download_view();
			} else {
				$target_path = "uploads/document/";
				$target_path .= $_FILES['file']['name']; //上傳檔案名稱
				move_uploaded_file($_FILES['file']['tmp_name'], $target_path);
				$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '上傳文件', $_FILES['file']['name'], null);
				echo "<h2><font color='red'>檔案".$_FILES["file"]["name"]."上傳成功</font></h2><br>";
				$this->document_download_view();
			}
		}
	}

	public function upload_attachment() {
        $id = $_POST['id'];
        $res = $this->upload_work($id);
        if (empty($res['error'])){
            $msg = "上傳成功";
            $this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '工單中上傳附件', $id, null);
        } else {
            $msg = $res['error'];
        }
        $this->index($msg);
	}

	public function upload_contact() {
		$id = $_POST['id'];
		$filename = $id.".jpg";
		if ($_FILES["file"]["error"] > 0){
			echo "Error: " . $_FILES["file"]["error"];
		} else {
            if (!file_exists('./uploads/contact')) {
                mkdir('./uploads/contact', 0777, true);
            }
            $this->orders_model->edit_fields($id, array('contact'=>$filename, '最後動作時間'=>date('Y-m-d H:i:s')));
            move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/contact/".$filename);
            $data = $this->orders_model->get($id);
            $this->orders_model->update_samequene_movetime($data[0]['媒合'], date('Y-m-d H:i:s'));
            $this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '上傳契約', $id, null);
            $this->go_orders();
		}
	}

	public function upload_tax() {
		$id = $_POST['id'];
        $filename = $id.".jpg";
        if ($_FILES["file"]["error"] > 0){
			echo "Error: " . $_FILES["file"]["error"];
		} else {
            if (!file_exists('./uploads/tax')) {
                mkdir('./uploads/tax', 0777, true);
            }
            $this->orders_model->edit_fields($id, array('tax'=>$filename, '最後動作時間'=>date('Y-m-d H:i:s')));
            move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/tax/".$filename);
            $data = $this->orders_model->get($id);
            $this->orders_model->update_samequene_movetime($data[0]['媒合'], date('Y-m-d H:i:s'));
            $this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '上傳稅單', $id, null);
            $this->admin_finish_order($id);
		}
	}

	public function upload_water() {
		$id = $_POST['id'];
        $filename = $id.".jpg";
        if ($_FILES["file"]["error"] > 0){
			echo "Error: " . $_FILES["file"]["error"];
		} else {
            if (!file_exists('./uploads/water')) {
                mkdir('./uploads/water', 0777, true);
            }
            $this->orders_model->edit_fields($id, array('water'=>$filename, '最後動作時間'=>date('Y-m-d H:i:s')));
            move_uploaded_file($_FILES["file"]["tmp_name"],"uploads/water/".$filename);
            $data = $this->orders_model->get($id);
            $this->orders_model->update_samequene_movetime($data[0]['媒合'], date('Y-m-d H:i:s'));
            $this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '上傳水單', $id, null);
            $this->go_orders();
		}
	}

    public function upload_idpic() {
        $id = $_POST['id'];
        $filenames = '';
        $time = time();

        if (!file_exists('./uploads/id_pic')) {
            mkdir('./uploads/id_pic', 0777, true);
        }
        if (!file_exists('./uploads/id_pic/'.$id)) {
            mkdir('./uploads/id_pic/'.$id, 0777, true);
        }

        foreach ($_FILES['file']['error'] as $key => $value) {
            if ($value > 0) {
                echo $_FILES['file']['name'][$key] . " 上傳失敗。 Error code: " . $value;
            }
        }
        foreach ($_FILES['file']['tmp_name'] as $key => $value){
            $filename = $time.$key.'.jpg';
            $filenames = $filenames.$filename.',';
            move_uploaded_file($value, "uploads/id_pic/".$id."/" . $filename);
        }

        // save filename as combined-string to db
        $this->orders_model->edit_fields($id, array('id_pic'=>$filenames, '最後動作時間'=>date('Y-m-d H:i:s')));

        $this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '上傳身分證', $id, null);

        $this->go_orders();
    }

	public function admin_finish_order($id = '') {
	    $orderID = empty($id) ? $_POST['id'] : $id;
		$this->orders_model->finish_order($orderID);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '結案', $_POST['id'], null);
		$this->go_orders();
	}

	//大姊最終確認 應匯帳款
	public function transferable_order_end() {
		$arrayName = array('ID' => $_POST['id'],
							'通知查帳' => date('Y-m-d'),);
		$this->orders_model->edit($arrayName);
        $this->orders_model->finish_pass_record($_POST['id']);
        $this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '確定轉出', $_POST['id'], null);
		$this->checkbillout();
	}

    /**
     * 刪除功能
     */
	public function match() {
		$this -> orders_model -> match($_POST['欲媒合自身ID'], $_POST['欲媒合對方ID']);
		$this->go_orders();
	}

	//修改成交單資料
	public function go_edit() {
        $result = $this->orders_model->get($_GET['id'], null, $_SESSION['NAME']);
        $employees = $this->orders_model->get_employee(null);
        $this->load->view('templates/header');
        $this->load->view('pages/order_edit/edit_order_view', array('result' => $result[0], 'employees' => $employees,));
        $this->load->view('templates/footer');
	}

    /**
     * 棄用
     */
	//管理者修改成交單資料
	public function admin_go_edit() {
		$result = $this -> orders_model -> get($_GET['id'],null,null);
		$old_date_timestamp = strtotime($result[0]['成交日期']);
		$new_date = date('Y/m/d', $old_date_timestamp);
		$result[0]['日期'] = $new_date;
		$employees = $this->orders_model->get_employee(null);
		$this->load->view('templates/header');
		$this->load->view('pages/order_edit/edit_order_view',array('result' => $result,'employees' => $employees,));
		$this->load->view('templates/footer');
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
				// '轉讓會員2' => $_POST['轉讓會員2'],
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
				'轉讓會員2' => $_POST['轉讓會員2'],
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
		$original = $this->orders_model->get($_POST['id'], $_SESSION['權限名稱'], $_SESSION['NAME']);
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
	                        20 => '轉讓會員2',
	                        21 => '完稅人',
	                        22 => '新舊',
	                        23 => '自行應付',
	                        24 => '刻印',
	                        25 => '過戶日期',
	                        26 => '過戶費',
	                    	27 => '媒合',
	                        // 31 => '匯款日期',
	                        28 => '通知查帳',
	                        29 => '成交單狀態',
	                    	30 => '二審',
	                    	31 => '已結案',
                            32 => '備註',);
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
	                        19 => '轉讓會員2',
	                        20 => '完稅人',
	                        21 => '新舊',
	                        22 => '自行應付',
	                        23 => '刻印',
	                        24 => '過戶費',
                            25 => '備註',);
		}
		return $title;
	}

	// 修改成交單內容: 部分修改
    public function edit_order_fields(){
        $id     = $_POST['id'];
        $action     = $_POST['action'];
        $fields = $_POST['fields'];
	    $value  = $_POST['value'];
	    $effect = "[".$fields."]修改為".$value;
        $this ->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), $action, $id, $effect);
        $this -> orders_model -> edit_fields($id, array($fields=>$value));
        $this->go_orders();
    }

	// 修改成交單內容: 整筆修改
	public function edit_order() {
		$title = $this->get_title('非admin');
		$original = $this->orders_model->get($_POST['ID'], $_SESSION['權限名稱'], $_SESSION['NAME']);
		$data = array('成交日期' => $_POST['成交日期'],
						'ID' => $_POST['ID'],
						'媒合' => $_POST['媒合'],
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
						'轉讓會員2' => $_POST['轉讓會員2'],
						'完稅人' => $_POST['完稅人'],
						'新舊' => $_POST['新舊'],
						'自行應付' => $_POST['自行應付'],
						'刻印' => $_POST['刻印'],
						'過戶費' => $_POST['過戶費'],
						'備註' => $_POST['備註'],
						'最後動作時間' => date('Y-m-d H:i:s'),);
		$effect = '';
		for ($i=0; $i < count($title); $i++) {
			if ($original[0][$title[$i]] != $data[$title[$i]]) {
				$effect = $effect."[".$title[$i]."]"."=>".$original[0][$title[$i]]."改為".$data[$title[$i]]."  ";
			}
		}
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '修改', $_POST['ID'], $effect);
		$this->orders_model->update_samequene_movetime($data['媒合'], $data['最後動作時間']);
		$this -> orders_model -> edit($data);
		$this->go_orders();
	}

	//單純修改成交單內容admin(全部欄位都能修改)
	public function admin_edit_order() {
		$title = $this->get_title('admin');
		$original = $this->orders_model->get($_POST['ID'], $_SESSION['權限名稱'], $_SESSION['NAME']);
		$data = array(
						'ID' => $_POST['ID'],
						'媒合' => $_POST['媒合'],
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
						'轉讓會員2' => $_POST['轉讓會員2'],
						'完稅人' => $_POST['完稅人'],
						'新舊' => $_POST['新舊'],
						'自行應付' => $_POST['自行應付'],
						'刻印' => $_POST['刻印'],
						'過戶日期' => $_POST['過戶日期'],
						'過戶費' => $_POST['過戶費'],
						// '媒合' => $_POST['媒合'],
						// '匯款日期' => $_POST['匯款日期'],
//						'通知查帳' => $_POST['通知查帳'],
//						'成交單狀態' => $_POST['成交單狀態'],
						'二審' => $_POST['二審'],
						'已結案' => $_POST['已結案'],
						'備註' => $_POST['備註'],
						'最後動作時間' => date('Y-m-d H:i:s'),);
		$effect = '';
		for ($i=0; $i < count($title); $i++) {
			if ($original[0][$title[$i]] != $data[$title[$i]]) {
				$effect = $effect."[".$title[$i]."]"."=>".$original[0][$title[$i]]."改為".$data[$title[$i]]."  ";
			}
		}
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), 'admin修改', $_POST['ID'], $effect);
		$this->orders_model->update_samequene_movetime($data['媒合'], $data['最後動作時間']);
		$this -> orders_model -> edit($data);
		$this->go_orders();
	}

	//自動填入客戶資料
	public function autofill() {
		$cus_info = $this -> orders_model -> get_cus_info($_POST['name']);
		return json_encode($cus_info);
	}

	//二審頁面
	public function go_edit2() {
	    $orderid = $_GET['id'];
	    $name = $_SESSION['NAME'];
		$result = $this -> orders_model -> get($orderid,null,$name);
		$old_date_timestamp = strtotime($result[0]['成交日期']);
		$new_date = date('Y/m/d', $old_date_timestamp);
		$result[0]['日期'] = $new_date;
		$employees = $this->orders_model->get_employee(null);
		$this->load->view('templates/header');
		$this->load->view('pages/order_edit/edit2_order_view',array('result' => $result,'employees' => $employees));
		$this->load->view('templates/footer');
	}

	//二審送出
	public function edit2_order() {
		if ($_POST['成交單狀態'] == '審核完成') {
//			if ($_POST['二審確認'] == 1){
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
				$this -> orders_model -> edit($data);// push test
				$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '二審', $_POST['ID'], null);
				$origin_data = $this->orders_model->get($data['ID'], $_SESSION['權限名稱'], $_SESSION['NAME']);
				/** record_info 是算盤價 稅收等等的function */
				$pass_record_info = $this -> record_info($origin_data[0]);
				$this->orders_model->add_passrecord($pass_record_info);

				$this->go_orders();
//			} else {
//				$this->go_orders('稅單、契約未上傳');
//			}

		} else {
				$this->go_orders('一審未完成');
		}
	}

	public function export_data($employee='', $startDate='', $endDate=''){
        $employee  = $_REQUEST['業務'];
        $startDate = empty($_REQUEST['date1']) ? '1970-01-01' : $_REQUEST['date1'];
        $endDate   = empty($_REQUEST['date2']) ? date('Y-m-d', time()) : $_REQUEST['date2'];
        $data = $this->orders_model->get_export($employee, $startDate, $endDate);
        if (count($data) < 1) {
            echo 'false';
        }
        return $data;
    }

	public function export() {
		// 引入函式庫
		require_once APPPATH."third_party\PHPExcel.php";

		if ($_POST['Export'] == 1) {

            $data = $this->export_data();

            if ($data){
                $title = array('ID', '成交日期', '業務', '客戶姓名', '身分證字號', '聯絡電話', '聯絡人', '聯絡地址', '買賣', '股票',
                    '張數', '成交價', '盤價', '匯款金額應收帳款', '已匯金額已收金額', '匯款銀行', '匯款分行', '匯款帳號',
                    '匯款戶名', '轉讓會員', '轉讓會員2', '完稅人', '新舊', '自行應付', '刻印', '收送', '匯款日期',
                    '過戶日期', '過戶費', '媒合', '通知查帳', '成交單狀態', '二審', '備註', '開發者', '已結案', '最後動作時間');

                //建立EXCEL暫存檔並將資料重新寫入
                $objPHPExcel = new PHPExcel();
                $objPHPExcel->setActiveSheetIndex(0);
                $sheet = $objPHPExcel->getActiveSheet();
                $row = 1;
                //填入標頭行
                for ($col = 1; $col <= count($title); $col++) {
                    if ($col <= 26) {
                        $sheet->setCellValue(chr($col + 64) . $row, $title[$col - 1]);
                    } else {
                        $sheet->setCellValue('A' . chr($col + 64 - 26) . $row, $title[$col - 1]);
                    }
                }
                //填入符合條件之成交單資料
                $row = 2;
                for ($num = 0; $num < count($data); $num++) {
                    if ($_POST['業務'] == '所有業務' || $_POST['業務'] == $data[$num]['業務']) {
                        if (!$isSelected || $isSelected && strtotime($date1) <= strtotime($data[$num]['成交日期']) && strtotime($date2) >= strtotime($data[$num]['成交日期'])) {
                            for ($col = 1; $col <= count($title); $col++) {
                                if ($col <= 26) {
                                    $sheet->setCellValue(chr($col + 64) . $row, $data[$num][$title[$col - 1]]);
                                } else {
                                    $sheet->setCellValue('A' . chr($col + 64 - 26) . $row, $data[$num][$title[$col - 1]]);
                                }
                            }
                            $row++;
                        }
                    }
                }
                $PHPExcelWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//匯出成xls檔
                //$PHPExcelWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, "Excel2007"); //匯出成xlsx檔
//                $PHPExcelWriter->save($file);//建立暫存

                //下載EXCEL檔
                header("Content-type: application/force-download");
                header("Content-Disposition: attachment; filename=\"" . time() . ".xls\"");
                $PHPExcelWriter->save('php://output');
            }
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
    	$orders_sell = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME']);	//2018.5.23 更新此處只處理賣
    	$orders_buy = $this->orders_model->get_check_record(null, '未查帳'); //2018.5.23 更新買從已通知查帳處理
    	$datas = $this->orders_model->get_bills();

    	//對帳通知未查帳
    	if ($orders_buy != null && $datas != NULL) {
	    	for ($i = 0; $i < count($orders_buy); $i++) {
	    		$time = $orders_buy[$i]['轉出日期轉入日期'];
	    		$money = $orders_buy[$i]['待查帳金額'];

				for ($j = 0; $j < count($datas); $j++) {
					if ($datas[$j]['是否已對帳'] != '1') { //檢查明細是否對過
			    		//if (($datas[$j]['帳號'] == null && abs(strtotime($time) - strtotime($datas[$j]['日期'])) <= 3600*24*7 ||
			    		//	substr($datas[$j]['帳號'], -5) == $orders_buy[$i]['匯款帳號末5碼']) && $money == $datas[$j]['轉入']) { //一周內\

			    		if (abs(strtotime($time) - strtotime($datas[$j]['日期'])) <= 3600*24*7 && $money == $datas[$j]['轉入']) { //一周內
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
			    				if (!$isCheckExported && abs(strtotime($time) - strtotime($datas[$j]['日期'])) <= 3600*24*3 && ($money/0.997) == $datas[$j]['轉出']) { //3天內轉出
			    					//對帳完成
			    					echo "交易日期".$datas[$j]['日期']." 轉出 ".$money." ".$orders_sell[$i]['ID'].'<br>';
			    					$this->orders_model->check_money_exported($orders_sell[$i]['ID'], $money, date('Y-m-d'));
			    					$this->orders_model->check_bill_reconciled($datas[$j]['id']);
			    					$isCheckExported = true;
			    					$error_id = $datas[$j]['id'];
			    				} else if (abs(strtotime($time) - strtotime($datas[$j]['日期'])) <= 3600*24*3 && ($money/0.997) == $datas[$j]['轉出']) { //3天內重複
			    					// echo $datas[$j]['轉出']." 金額重複 <br>";
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

    	$this->boss_check_money();
    }

	//進入庫存頁面
	public function go_inventory() {
		$orders = $this->orders_model->get_inventory(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
		if ($orders != null) {
			foreach ($orders as $key => $value) {
				if (isset($_GET['股票']) && $_GET['股票'] != $value['股票']) {
					unset($orders[$key]);
				}
				if (isset($_GET['業務']) && $_GET['業務'] != $value['業務']) {
					unset($orders[$key]);
				}
				if (isset($_GET['客戶姓名']) && $_GET['客戶姓名'] != $value['客戶姓名']) {
					unset($orders[$key]);
				}
				if (isset($_GET['聯絡電話']) && $_GET['聯絡電話'] != $value['聯絡電話']) {
					unset($orders[$key]);
				}
			}
			$orders = array_values($orders);
		}
		if ($_SESSION['權限名稱'] == '業務') {
			$add_quene = $this->orders_model->get_add_quene(1, $_SESSION['NAME']);
		} else {
			$add_quene = [];
		}
		
		$all_orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
		$employees = $this->orders_model->get_employee(null);
		$arrayName = array('orders' => $orders,
							'all_orders' => $all_orders,
							'employees' => $employees,
							'add_quene' => $add_quene,);
		$this->show($arrayName);
	}

	//進入庫存頁面
	public function go_inventory_before0701() {
		if (isset($_GET['股票'])) {
			$orders = $this->orders_model->get_inventory_before0701(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'股票',$_GET['股票']);
		} else if (isset($_GET['業務'])) {
			$orders = $this->orders_model->get_inventory_before0701(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'業務',$_GET['業務']);
		} else if (isset($_GET['客戶姓名'])) {
			$orders = $this->orders_model->get_inventory_before0701(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'客戶姓名',$_GET['客戶姓名']);
		} else if (isset($_GET['聯絡電話'])) {
			$orders = $this->orders_model->get_inventory_before0701(null,$_SESSION['權限名稱'],$_SESSION['NAME'],'聯絡電話',$_GET['聯絡電話']);
		} else {
			$orders = $this->orders_model->get_inventory_before0701(null,$_SESSION['權限名稱'],$_SESSION['NAME'],null,null);
		}
		$all_orders = $this->orders_model->get_before0701(null,$_SESSION['權限名稱'],$_SESSION['NAME'],null,null);
		$employees = $this->orders_model->get_employee(null);
		$arrayName = array('orders' => $orders,
							'all_orders' => $all_orders,
							'employees' => $employees,);
		$this->show_before0701($arrayName);
	}

	//進入KO頁面
	public function go_ko() {
		$orders = $this->orders_model->get_ko(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
		if ($orders != null) {
			foreach ($orders as $key => $value) {
				if (isset($_GET['股票']) && $_GET['股票'] != $value['股票']) {
					unset($orders[$key]);
				}
				if (isset($_GET['業務']) && $_GET['業務'] != $value['業務']) {
					unset($orders[$key]);
				}
				if (isset($_GET['客戶姓名']) && $_GET['客戶姓名'] != $value['客戶姓名']) {
					unset($orders[$key]);
				}
				if (isset($_GET['聯絡電話']) && $_GET['聯絡電話'] != $value['聯絡電話']) {
					unset($orders[$key]);
				}
			}
			$orders = array_values($orders);
		}

		if ($_SESSION['權限名稱'] == '業務') {
			$add_quene = $this->orders_model->get_add_quene(1, $_SESSION['NAME']);
		} else {
			$add_quene = [];
		}
		
		$all_orders = $this->orders_model->get(null,$_SESSION['權限名稱'],$_SESSION['NAME']);
		$employees = $this->orders_model->get_employee(null);
		$arrayName = array('orders' => $orders,
							'all_orders' => $all_orders,
							'employees' => $employees,
							'add_quene' => $add_quene,);
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
		$info = $this->orders_model->get($_GET['order_id'],null,null);
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
		$order = $this->orders_model->get($_GET['ID'],$_SESSION['權限名稱'], $_SESSION['NAME']);
		if ($order[0]['買賣'] == 1) {
			$array = array('order' => $order);
			$this->load->view('templates/header');
			$this->load->view('pages/money/inform_check_money_view',$array);
		} else {
			$array = array('ID' => $order[0]['ID'], '通知查帳' => '待對帳');
			$this->orders_model->edit($array);
			$this->go_orders();
		}
		$this->load->view('templates/footer');
	}

	//更改通知查帳 => 此時才產生 應收/應匯 資料
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
		$this->load->view('templates/footer');
	}

	//大姊最終確認 應收帳款
	public function check_end() {
		$this->orders_model->check_end_model($_POST['id'], $_POST['成交單編號'], $_POST['money'], $_POST['確認日期'], date('Y-m-d H:i:s'));
        $this->orders_model->finish_pass_record($_POST['成交單編號']);
		$this->boss_check_money();
	}

	//查看匯款紀錄
	public function check_record() {
		$data = $this->orders_model->get_check_record(null, '已查帳');
		$this->load->view('templates/header');
		$this->load->view('templates/receivable_header');
		$this->load->view('pages/money/check_record', array('data'=>$data));
		$this->load->view('templates/footer');
	}

	//查看動作紀錄
	public function move_record() {
		$data = $this->orders_model->get_move_record();
		$this->load->view('templates/header');
		$this->load->view('pages/admin/move_record', array('data'=>$data));
		$this->load->view('templates/footer');
	}

	//進入傳真資料
	public function fax_info() {
		$this->load->view('templates/header');
		$this->load->view('pages/fax/fax_info');
		$this->load->view('templates/footer');
	}

	//進入盤商資料
	public function go_dealer() {
		$data = $this->orders_model->get_dealer_info(1, NULL);
		$this->load->view('templates/header');
		$this->load->view('pages/fax/dealer_info', array('data'=>$data));
		$this->load->view('templates/footer');
	}

	//進入完稅人資料
	public function go_taxer() {
		$data = $this->orders_model->get_taxer_info(1, NULL);
		$this->load->view('templates/header');
		$this->load->view('pages/fax/taxer_info', array('data'=>$data));
		$this->load->view('templates/footer');
	}

	//新增盤商頁面
	public function go_add_dealer() {
		$this->load->view('templates/header');
		$this->load->view('pages/fax/add_dealer_view');
		$this->load->view('templates/footer');
	}

	//新增完稅人頁面
	public function go_add_taxer() {
		$this->load->view('templates/header');
		$this->load->view('pages/fax/add_taxer_view');
		$this->load->view('templates/footer');
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
		$this->load->view('templates/footer');
	}

	//編輯完稅人頁面
	public function go_edit_taxer() {
		$taxer_id = $_GET['taxer_id'];
		$data = $this->orders_model->get_taxer_info(2, $taxer_id); //撈欲編輯資料
		$this->load->view('templates/header');
		$this->load->view('pages/fax/edit_taxer_view', array('data' => $data,));
		$this->load->view('templates/footer');
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
		$dir_info = scandir('uploads/document');
		foreach ($dir_info as $k => $v){
		    if ($v === '.' || $v === '..'){
		        unset($dir_info[$k]);
            }
        }
        $dir_info = array_values($dir_info);
		$this->load->view('templates/header');
		$this->load->view('pages/download/document_view', array('file_info' => $dir_info));
		$this->load->view('templates/footer');
	}

	public function document_download() {
		$this->load->helper('download');
		$type = $_POST['type'];
		$filename = $_POST['filename'];
		if ($type == 'document'){
            force_download('uploads/document/'.$_POST['file'], NULL);
        } else {
            force_download('uploads/'.$type.'/'.$filename, NULL);
        }
	}

	public function document_delete() {
		$this->load->helper('file');
		unlink('./uploads/document/'.$_POST['file']);
		echo "成功刪除";
		$this->document_download_view();
	}

	public function pay_error() {
		$data = $this->orders_model->get_bills_out();
		$this->load->view('templates/header');
		$this->load->view('templates/receivable_header');
		$this->load->view('pages/money/error_view', array('data'=>$data));
		//echo "轉出異常的成交單會出現在這(EX大姊匯了兩次)";
		$this->load->view('templates/footer');
	}

	public function passrecord() {
	    $employee = empty($_GET['employee']) ? '' : $_GET['employee'];
        $month = empty($_GET['month']) ? '' : $_GET['month'];
		$data = $this->orders_model->get_pass_record($employee, $month);
        $employees = $this->orders_model->get_employee(null);
        $search_condition = array('employee'=>$employee, 'month'=>$month);
        $this->load->view('templates/header');
		$this->load->view('pages/money/passrecord_view', array('data'=>$data, 'employees'=>$employees,
            'search_condition'=>$search_condition));
		$this->load->view('templates/footer');
	}

	public function passrecord_edit() {
		$arrayName = array('ID' => $_POST['id'],
            $_POST['type'] => $_POST['data'],
            );
		$this->orders_model->passrecord_edit_model($arrayName);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '修改轉讓紀錄', $arrayName['ID'], $_POST['type'].': '.$_POST['original_data'].'=>'.$arrayName[$_POST['type']]);
		$myJSON = json_encode('Done!');
		print_r($myJSON);
	}

	public function passrecord_export() {
        $employee = $_POST['employee'];
        $month = $_POST['month'];
        $data = $this->orders_model->get_pass_record($employee, $month ,'export');
        $this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '匯出轉讓紀錄', $employee.', '.$month);

        if ($data){

            $title = array('ID','日期','姓名','買賣','業務','標的名稱',
                '張數', '成交價', '盤價', '價差', '稅金','過戶費','刻印','金額','差額','自得比率','自行應付',
                '個人實得','公司','匯款日期', '狀態', '轉讓會員', '備註','最後動作時間');

            // 引入函式庫
            require_once APPPATH."third_party\PHPExcel.php";

            //建立EXCEL暫存檔並將資料重新寫入
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $sheet = $objPHPExcel->getActiveSheet();

            //填入標頭行
            foreach ($title as $k => $v) {
                $sheet->setCellValueByColumnAndRow($k,1, $title[$k]);
            }

            //填入符合條件之成交單資料
            foreach ($data as $k => $v) {
                $col = 0;
                foreach ($v as $key => $value) {
                    if ($key == '買賣'){
                        $value = $value == 1 ? '買' : '賣';
                    }
                    $sheet->setCellValueByColumnAndRow($col,$k+2,$value);
                    $col++;
                }
            }

            $PHPExcelWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');//匯出成xls檔

            //下載EXCEL檔
            header("Content-type: application/force-download");
            header("Content-Disposition: attachment; filename=\"" . $employee.$month . ".xls\"");
            $PHPExcelWriter->save('php://output');
        }
    }

	public function add_need() {
		// echo "string"+$_POST['議價'];
		$議價 = null;
		if (isset($_POST['議價'])) {
			$議價 = 1;
		}
		$data = array('需求者'=>$_POST['需求者'],
						'股名'=>$_POST['股名'],
						'買賣'=>$_POST['買賣'],
						'價格'=>$_POST['價格'],
						'張數'=>$_POST['張數'],
						'議價'=>$議價,
						'客戶姓名'=>$_POST['客戶姓名'],
						'手機'=>$_POST['手機'],
						'委託到期日'=>$_POST['委託到期日'],
						'把握度'=>$_POST['把握度'],
						'進度'=>$_POST['進度'],
						'建立日期'=>date('Y-m-d'),
						'最後動作時間'=>date('Y-m-d H:i:s'));
		$new = $this->orders_model->add_need_model($data);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '新增需求', $new , '');
		$this->index();
	}

	public function delete_need() {
		$data = $this->orders_model->get_need_model($_GET['id']);
		// print_r($data);。
		$this->orders_model->backup_need_model($data[0]);
		$this->orders_model->delete_need_model($_GET['id']);
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '刪除需求',
			'需求ID:'.$_GET['id'].', 需求者:'.$data[0]['需求者'].', 股名:'.$data[0]['股名'].', 買賣:'.$data[0]['買賣'].', 價格:'.$data[0]['價格'].', 張數:'.$data[0]['張數'].', 客戶姓名:'.$data[0]['客戶姓名'].', 手機:'.$data[0]['手機'].', 委託到期日:'.$data[0]['委託到期日'], '' );
		$this->index();
	}

	public function get_employee_byname() {
		$data = $this->orders_model->get_employee($_POST['$name']);
		return json_encode($data);
	}

	public function edit_note() {
		$original_data = $this->orders_model->get($_POST['note_id'],null,null);
		$diff = "[更改前]".$original_data[0]['備註']."[更改後]".$_POST['edit_備註'];
		$this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '修改備註', $_POST['note_id'], $diff);

		$this->orders_model->edit_note_model($_POST['note_id'] , $_POST['edit_備註']);

		$this->go_orders();
	}

	public function go_assign($msg="") {
        $employees = $this->orders_model->get_employee(null);
		$this->load->view('templates/header');
		$this->load->view('pages/assign_view', array('employees'=>$employees,'msg'=>$msg));
		$this->load->view('templates/footer');
	}

	public function add_assign() {
		$data = array('工單對象'=>$_POST['工單對象'],
            '工單屬性'=>$_POST['工單屬性'],
            '工單內容'=>$_POST['工單內容'],
            '等級'=>$_POST['等級'],);
        $data['工單內容'] = str_replace(" ", "<br/>",addslashes($data['工單內容']));
		$id = $this->orders_model->add_assign_model($data);
        $str = implode(", ", $id);
        $this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '建立工單', $str, null);
		$this->index();
	}

	public function delete_assign() {
		$this->orders_model->delete_assign_model($_GET['id']);
		$this->index();
	}

	public function assign_reply() {
		$data = array('parent_id'=>$_POST['pid'],
            '工單對象'=>$_POST['toid'],
            '工單屬性'=>'',
            '工單內容'=>$_POST['回覆內容'],
            '等級'   =>'',
            '建立者'  =>$_SESSION['NAME']);
		$id = $this->orders_model->add_assign_reply_model($data);
        $this->orders_model->move_record($_SESSION['NAME'], date('Y-m-d H:i:s'), '回覆工單', $id, null);
		$this->index();
	}

	// 自動補齊對帳
	public function turn_passrecord() {
		$data = $this->orders_model->turn_passrecord_model();
		for ($i=0; $i < count($data); $i++) {
			$insert_data[$i]['日期'] = $data[$i]['成交日期'];
			$insert_data[$i]['姓名'] = $data[$i]['客戶姓名'];
			$insert_data[$i]['買賣'] = $data[$i]['買賣'];
			$insert_data[$i]['業務'] = $data[$i]['業務'];
			$insert_data[$i]['標的名稱'] = $data[$i]['股票'];
			$insert_data[$i]['張數'] = $data[$i]['張數'];
			$insert_data[$i]['成交價'] = $data[$i]['成交價'];
			$insert_data[$i]['盤價'] = $data[$i]['盤價'];
			if ($data[$i]['買賣']==1) {
				$insert_data[$i]['價差'] = $data[$i]['成交價'] - $data[$i]['盤價'];
				$insert_data[$i]['稅金'] = $data[$i]['成交價'] * $data[$i]['張數']*1000*0.003;
			} else {
				$insert_data[$i]['價差'] = $data[$i]['盤價'] - $data[$i]['成交價'];
				$insert_data[$i]['稅金'] = $data[$i]['盤價'] * $data[$i]['張數']*1000*0.003;
			}
			$insert_data[$i]['過戶費'] = $data[$i]['過戶費'];
			$insert_data[$i]['金額'] = $data[$i]['匯款金額應收帳款'];
			$employees = $this->orders_model->get_employee($data[$i]['業務']);
			$insert_data[$i]['自得比率'] = $employees[0]['趴數'];
			$insert_data[$i]['自行應付'] = $data[$i]['自行應付'];
			// $insert_data[$i]['扣款利息'] = $data[$i]['客戶姓名'];
			$insert_data[$i]['個人實得'] = ($insert_data[$i]['價差'] * $insert_data[$i]['張數'] * 1000 - $insert_data[$i]['稅金'] - $insert_data[$i]['過戶費']) * $insert_data[$i]['自得比率'];
			// $insert_data[$i]['營業'] = $data[$i]['客戶姓名'];
			// $insert_data[$i]['公司'] = $data[$i]['客戶姓名'];
			$insert_data[$i]['匯款日期'] = $data[$i]['匯款日期'];
			$insert_data[$i]['狀態'] = '未完成';
			$insert_data[$i]['轉讓會員'] = $data[$i]['轉讓會員'];
			$insert_data[$i]['轉讓會員2'] = $data[$i]['轉讓會員2'];
			$insert_data[$i]['備註'] = $data[$i]['備註'];
			$insert_data[$i]['最後動作時間'] = date('Y-m-d H:i:s');
			$this->orders_model->add_passrecord($insert_data[$i]);
		}
		$this->passrecord();
	}

	public function show_bank() {
		$data = $this->orders_model->show_bank_model();
		$this->load->view('templates/header');
		$this->load->view('templates/receivable_header');
		$this->load->view('pages/money/show_bank_view', array('data'=>$data));
		$this->load->view('templates/footer');
	}

	public function show_test() {
		$this->load->view('pages/money/testing');

	}

}






