<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uac extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('uacmodel');
	}

	function index()
	{
		if ( !$this->hasLogin() ) redirect("site/login");

		$data['header'] = 'user_access';
		$data['breadcumb'] = 'Uac';
		$data['js']		= [
			base_url('assets/js/pages/uac.js')
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
		$employee = $this->guzzle->guzzle_HRIS('employee/get');
		$data_employee = json_decode($employee);
		$data['emp'] = $data_employee->data;
		
		$data['log_dept'] = $log->log_dept;
		$data['log_user'] = $log->log_user;
		$data['log_name'] = $log->log_name;
		$data['pagename'] = 'pages/view_user_access';
		$this->load->view('layout/main_site', $data);
	}

	function view_uac()
	{
		$data = array();
		$res = $this->uacmodel->get_applicant();
		$temp = $this->db->last_query();

		foreach ($res as $row) {
			$col = array();
			$col[] = $row->nip;
			$col[] = $row->name;
			$col[] = $row->dept_name;
			$col[] = $row->level_name;
			$col[] = '<button class="btn btn-sm btn-danger btn-delete" title="Delete" data-id="'.$row->id.'>" data-name="'.$row->name.'"><i class="fa fa-trash"></i></button>';
			$data[] = $col;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->uacmodel->get_applicant_count_all(),
			"recordsFiltered" 	=> $this->uacmodel->get_applicant_count_filtered(),
			"data" 				=> $data,
			"q"					=> $temp

		);
		echo json_encode($output);
		exit;
	}

	function ajax_validation()
	{
		$msg = array();
		if ($_POST) {
			$nip = $this->input->post('nip');
			$name = $this->input->post('name');
			$dept_id = $this->input->post('dept_id');
			$dept_name = $this->input->post('dept_name');

			$data = array(
				'nip'			=> $nip,
				'name'			=> $name,
				'dept_id'		=> $dept_id,
				'dept_name'		=> $dept_name,
				'level'			=> '1',
				'level_name'	=> 'Admin '.$dept_name,
				"create_date"	=> date("Y-m-d H:i:s")
			);
			$this->sitemodel->insert("tab_admin", $data);

			$msg['type'] = 'done';
			$msg['msg'] = "Successfully add ticket.";

		}
		else{
			$msg['type'] = 'failed';
			$msg['msg'] = 'Invalid parameter';
		}

		echo json_encode($msg);
	}

    function ajax_remove(){
        $msg = array();
            if ( $_POST ){
                $key = $this->input->post("key");
                if ( empty($key) ){
                    $msg['type'] = 'failed';
                    $msg['msg'] = 'Invalid parameter.';
                }
                else{
                    $cek = $this->sitemodel->view("tab_admin", "*", array("id"=>$key));
                    if ( $cek == '0' ){
                        $msg['type'] = 'failed';
                        $msg['msg'] = "No user found.";
                    }
                    else{
                        $this->sitemodel->delete("tab_admin", array("id"=>$key));
                        $msg['type'] = 'done';
                        $msg['msg'] = "Successfully remove user.";
                    }
                }
            }
            else{
                $msg['type'] = 'failed';
                $msg['msg'] = 'Invalid parameter.';
            }
        echo json_encode($msg);
    }
}
