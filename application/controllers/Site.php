<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once APPPATH."libraries/Libcurl.php";

class Site extends CI_Controller {

	protected $__SUPERADMIN = [
		'sa',
		'sa2',
		'1173394', /*** Andi Putra ***/
	];

	function index()
	{
		if ( !$this->hasLogin() ) redirect("site/login");

		$data['header'] = 'inbound';
		$data['breadcumb'] = 'Inbound';
		$data['js']		= [
			base_url('assets/js/pages/inbound.js')
		];

		$log = $this->session->userdata('idocs-itdev');
		$log_user = $log->log_user;
		$check_is_admin = $this->sitemodel->view('tab_admin', '*', ['nip' => $log_user]);
		$data['is_admin'] = ($check_is_admin != '0') ? true : false;
		$check_is_superadmin = $this->sitemodel->view('tab_admin', '*', ['nip' => $log_user, 'level' => '2']);
		$data['is_superadmin'] = ($check_is_superadmin != '0') ? true : false;

        $this->load->library('guzzle');
		$department = $this->guzzle->guzzle_HRIS('department/get');
		$data_department = json_decode($department);
		$data['dept'] = $data_department->result;
		$data['log_dept'] = $log->log_dept;
		$data['log_user'] = $log->log_user;
		$data['log_name'] = $log->log_name;
		
		$data['pagename'] = 'pages/view_inbound';
		$this->load->view('layout/main_site', $data);
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
