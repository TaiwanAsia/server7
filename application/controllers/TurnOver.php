<?php
session_start();
defined('BASEPATH') OR exit('No direct script access allowed');

class TurnOver extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
		date_default_timezone_set('Asia/Taipei');
		$this->load->helper(array('form', 'url', 'array'));
		$this->load->library('form_validation');
		$this->load->model('turnover_model');
	}

	public function get() {
		$data = $this->turnover_model->get_turnover();
		for ($i=0; $i < count($data); $i++) { 
			echo "<br>";
			print_r($data[$i]);
			echo "<br>";
			$this->turnover_model->insert_to_orders($data[$i]);
		}

	}

}
