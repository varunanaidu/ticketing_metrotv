<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."libraries/Libcurl.php";

class Site extends MY_Controller {

	protected $__SUPERADMIN = [
		'sa',
		'sa2',
		'1173394', /*** Andi Putra ***/
	];

	function index()
	{
		if ( !$this->hasLogin() ) redirect("site/login");

		$this->fragment['header'] = 'inbound';
		$this->fragment['breadcumb'] = 'Inbound';
		$this->fragment['js']		= [
			base_url('assets/js/pages/inbound.js')
		];

		$this->fragment['category'] = $this->sitemodel->view('tab_category', '*');
		
		$this->fragment['pagename'] = 'pages/view_inbound';
		// echo json_encode($this->fragment);die;
		$this->load->view('layout/main_site', $this->fragment);
	}

	function search_emp()
	{
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		$term = $this->input->get("term");
		$post = [
			"src"	=> strtoupper($term),
		];
		$curl = new Libcurl("employee", "search-admin");
		$data = $curl->__pages($post);
		echo json_encode($data);
		exit;
	}

	function get_dept()
	{
		$res = [];
		$term = $this->input->get("term");
		$post = [
			'dept_name' => strtoupper($term),
		];
		$this->load->library('guzzle');
		$department = $this->guzzle->guzzle_HRIS('department/get', $post);
		$data_department = json_decode($department);

		if ( $data_department->status == 'success' ) {

			for ( $i = 0 ; $i < sizeof($data_department->result); $i++) { 
				$temp = [];
				$temp['id'] = $data_department->result[$i]->DEPT_ID;
				$temp['text'] = $data_department->result[$i]->DEPT_NAME;
				$temp['recipient_name'] = $data_department->result[$i]->DEPT_NAME;
				$res[] = $temp;
			}

		}

		echo json_encode($res);
		exit;
	}

	function ajax_validation()
	{
		// echo json_encode($this->input->post());die;
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		// PARAMS
		$category_id 		= $this->input->post('category_id');
		$ticket_description = $this->input->post('ticket_description');
		$sender_dept 		= $this->input->post('sender_dept');
		$sender_name 		= strtoupper($this->input->post('sender_name'));
		$recipient_dept 	= $this->input->post('recipient_dept');
		$recipient_name 	= strtoupper($this->input->post('recipient_name'));
		$fileUpload 		= '';

		if ( isset($_FILES['ticket_att']['name']) ) {
			$file = $_FILES['ticket_att']['name'];
			$exp = explode(".", $file);
			$end = strtolower(end($exp));
			$fileUpload = md5($file.date("YmdHis")).".".$end;

			$allowed = array("png", "jpg", "jpeg");

			if ( !in_array($end, $allowed) ) {
				$this->response['msg'] = "Invalid image extension.";
				echo json_encode($this->response);exit;
			}

			if ( $_FILES['ticket_att']['size'] > 5000000 ){
				$this->response['msg'] = 'Maximum image can be upload is 5 MB.';
				echo json_encode($this->response);exit;
			}

			$this->compress_image($_FILES['ticket_att']['tmp_name'], "assets/img/outbound/".$fileUpload, 100);
		}

		$data_ticket = [
			"category_id" 			=> $category_id,
			"ticket_description"	=> $ticket_description,
			"ticket_att" 			=> $fileUpload,
			'create_by'				=> strtoupper($this->log_user),
			'create_name'			=> strtoupper($this->log_name),
			'create_date'			=> date('Y-m-d H:i:s'),
		];

		$ticket_id = $this->sitemodel->insert("tab_ticket", $data_ticket);

		$data_tr = [
			'ticket_id'			=> $ticket_id,
			'status_id'			=> 1,
			'priority_id'		=> 1,
			'sender_dept'		=> $sender_dept,
			'sender_name'		=> $sender_name,
			'recipient_dept'	=> $recipient_dept,
			'recipient_name'	=> $recipient_name,
			'create_by'			=> strtoupper($this->log_user),
			'create_name'		=> strtoupper($this->log_name),
			'create_date'		=> date('Y-m-d H:i:s'),
			'request_by'		=> '',
		];

		$tr_id = $this->sitemodel->insert("tr_ticketing", $data_tr);

		$this->response['url']	 = base_url('outbound');
		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully add ticket.";

		echo json_encode($this->response);
		exit;
	}

	function login(){
		/*** Check Session ***/
		if ( $this->hasLogin() ) redirect();
		/*** Area for adding data from DB ***/
		$this->fragment['url'] = urldecode($this->input->get("url"));
		/*** View ***/
		$this->load->view("login_page", $this->fragment);
	}

	function signin(){
		/*** Check Session ***/
		if ( $this->hasLogin() ) redirect();
		/*** Check POST or GET ***/
		if ( !$_POST ){
			$this->response['msg'] = "Invalid parameters.";
			echo json_encode($this->response);
			exit;
		}
		/*** Params ***/
		$server = $this->input->post("server") ?? $_SERVER['REMOTE_ADDR'];
		$temp = explode(".", $server);
		$server = ($temp[0] == "103") ? $_SERVER['REMOTE_ADDR'] : $server;
		$browser = $_SERVER['HTTP_USER_AGENT'];
		/*** Required Area ***/
		$username = trim($this->input->post("username"));
		$password = $this->input->post("password");
		$ckbox = $this->input->post("ckbox");
		/*** Optional Area ***/
		/*** Validate Area ***/
		if ( empty($username) or empty($password) ){
			$this->response['msg'] = "Input username or password.";
			echo json_encode($this->response);
			exit;
		}
		$ckbox = isset($ckbox) ? "on" : "off";
		/*** Accessing DB Area ***/
		$post = [
			"username"	=> $username,
			"password"	=> $password,
			"onlines"	=> $ckbox,
			"server"	=> $server,
		];
		$curl = new Libcurl("employee", "login");
		$data = $curl->__pages($post);
		if ( $data == null ){
			$this->response['msg'] = "Failed to fetch from servers.";
			echo json_encode($this->response);
			exit;
		}

		if ( $data->type == "failed" ){
			$this->response["msg"] = $data->msg;
			echo json_encode($this->response);
			exit;
		}
		$items = $data->rest[0];
		$logger = [
			"cempnip"	=> $username,
			"ip_address"=> $server,
			"browser"	=> $browser,
			"log_login"	=> date("Y-m-d H:i:s")
		];
		$this->sitemodel->insert("loglogin", $logger);
		$__isSPECIALLOGIN = ($items->IS_SPECIALLOGIN == '1');
		$__isSUPERADMIN = in_array($username, $this->__SUPERADMIN);
		if ($__isSPECIALLOGIN == FALSE){
			/*** NOT SPECIAL LOGIN (ORDINARY USER EMPLOYEE) ***/
			$sess = [
				"log_user"		=> $items->CEMPNIP,
				"log_name"		=> proper_lang($items->CEMPNAME, false),
				"log_join"		=> $items->DATE_JOINGROUP,
				"log_prs"		=> '1',									/*** Company [TEMPORARY - PLEASE UPDATE IF CHANGED] ***/
				"log_cdpt"		=> proper_lang($items->CDPTNO), 		/*** Direktorat ***/         
				"log_dir"		=> proper_lang($items->CDPTDESC), 		/*** Direktorat Name ***/
				"log_cdic"		=> proper_lang($items->CDICNO), 		/*** Division ***/
				"log_div"		=> proper_lang($items->CDICDESC), 		/*** Division Name ***/
				"log_csdp"		=> proper_lang($items->CSDPNO), 		/*** Departemen ***/
				"log_dept"		=> proper_lang($items->CSDPDESC), 		/*** Departemen Name ***/
				"log_cdac"		=> proper_lang($items->CDACNO), 		/*** Section ***/
				"log_sect"		=> proper_lang($items->CDACDESC), 		/*** Section Name ***/
				"log_post"		=> proper_lang($items->CJBTDESC), 		/*** Jabatan / Posisi ***/
				"log_email"		=> strtolower($items->CEMPEMAILADDR), 	/*** Email ***/
				"log_gender"	=> $items->CEMPGENDER, 					/*** Gender ***/
				"log_dob"		=> $items->DATE_BIRTH, 					/*** DOB (Added 2019-06-24) ***/
				"log_gold"		=> proper_lang($items->CGOLNO),			//! NEW APPROVAL LEVEL => UNTUK SISTEM APPROVAL CUTI/ABSEN, ETC
				"log_level"		=> proper_lang($items->APPROVELEVEL),	//! OLD APPROVAL LEVEL
				"log_update"	=> empty($items->BIO_APPROVAL_REQ) ? FALSE : TRUE,
			];
		}
		else {
			/*** SPECIAL LOGIN (SPECIAL USER WITHOUT EMPLOYEE DATA) ***/
			$sess = [
				"log_user"		=> $username,
				"log_name"		=> isset($items->CEMPNAME) ? proper_lang($items->CEMPNAME, false) : $username,
				"log_join"		=> isset($items->DATE_JOINGROUP) ? $items->DATE_JOINGROUP : date('d F Y'),
				"log_prs"		=> '1',																		/*** Company [TEMPORARY - PLEASE UPDATE IF CHANGED] ***/
				"log_cdpt"		=> isset($items->CDPTNO) ? proper_lang($items->CDPTNO) : '', 				/*** Direktorat ***/         
				"log_dir"		=> isset($items->CDPTDESC) ? proper_lang($items->CDPTDESC) : '', 			/*** Direktorat Name ***/
				"log_cdic"		=> isset($items->CDICNO) ? proper_lang($items->CDICNO) : '', 				/*** Division ***/
				"log_div"		=> isset($items->CDICDESC) ? proper_lang($items->CDICDESC) : '', 			/*** Division Name ***/
				"log_csdp"		=> isset($items->CSDPNO) ? proper_lang($items->CSDPNO) : '', 				/*** Departemen ***/
				"log_dept"		=> isset($items->CSDPDESC) ? proper_lang($items->CSDPDESC) : '', 			/*** Departemen Name ***/
				"log_cdac"		=> isset($items->CDACNO) ? proper_lang($items->CDACNO) : '', 				/*** Section ***/
				"log_sect"		=> isset($items->CDACDESC) ? proper_lang($items->CDACDESC) : '', 			/*** Section Name ***/
				"log_post"		=> isset($items->CJBTDESC) ? proper_lang($items->CJBTDESC) : '', 			/*** Jabatan / Posisi ***/
				"log_email"		=> isset($items->CEMPEMAILADDR) ? strtolower($items->CEMPEMAILADDR) : '', 	/*** Email ***/
				"log_gender"	=> isset($items->CEMPGENDER) ? $items->CEMPGENDER : 'L', 					/*** Gender ***/
				"log_dob"		=> isset($items->DATE_BIRTH) ? $items->DATE_BIRTH : '', 					/*** DOB (Added 2019-06-24) ***/
				"log_gold"		=> isset($items->CGOLNO) ? proper_lang($items->CGOLNO) : '',
				"log_level"		=> isset($items->APPROVELEVEL) ? proper_lang($items->APPROVELEVEL) : '',
				"log_update"	=> TRUE
			];
		}
		if ($__isSUPERADMIN){
			$sess['__nimdarepus'] = '1';
		}
		$this->session->set_userdata(SESS, (object)$sess);
		/*** Result Area ***/
		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully login.";
		$this->response['url'] = $this->input->post('url');
		echo json_encode($this->response);
		// echo json_encode($sess);die;
		exit;
	}

	function signout(){
		$post = [
			"user"	=> $this->user->getNip(),
		];
		$curl = new Libcurl("employee", "logout");
		$curl->__pages($post);
		$this->session->sess_destroy();
		redirect ( base_url("site/login") );
	}
}
