<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uac extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('uacmodel');
	}

	function index()
	{
		if ( !$this->hasLogin() ) redirect("site/login");

		$this->fragment['header'] = 'user_access';
		$this->fragment['breadcumb'] = 'Uac';
		$this->fragment['js']		= [
			base_url('assets/js/pages/uac.js')
		];

		$this->fragment['pagename'] = 'pages/view_user_access';
		$this->load->view('layout/main_site', $this->fragment);
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
			$col[] = $row->role_name;
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

	function save()
	{
		// echo json_encode($this->input->post());die;
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		// PARAMS
		$dept_id;
		$dept_name;
		$nip = $this->input->post('nip');
		$name = $this->input->post('name');
		
		$post = [
			'nip' => strtoupper($nip),
		];
		$this->load->library('guzzle');
		$emp = $this->guzzle->guzzle_HRIS('employee/get', $post);
		$data_emp = json_decode($emp);

		if ( $data_emp->type == "success" ) {
			$dept_id = $data_emp->data[0]->DEPT_ID;
			$dept_name = $data_emp->data[0]->DEPARTMENT;
		}

		$check = $this->sitemodel->view('tab_admin', '*', ['nip'=>$nip]);
		if ( $check ) {
			$this->response['msg'] = 'Data already exists';
			echo json_encode($this->response);
			exit;
		}

		$data = [
			'role_id'		=> 2,
			'dept_id'		=> $dept_id,
			'dept_name'		=> $dept_name,
			'nip'			=> $nip,
			'name'			=> $name,
			'create_by'		=> $this->log_user,
			'create_name'	=> $this->log_name,
			'create_date'	=> date('Y-m-d H:i:s')
		];

		$uac = $this->sitemodel->insert('tab_admin', $data);

		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully add admin.";

		echo json_encode($this->response);
		exit;
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
