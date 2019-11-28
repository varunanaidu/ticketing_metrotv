<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_ticket extends CI_Controller {

	function __construct(){
		parent::__construct();
	}

	function index()
	{
		if ( !$this->hasLogin() ) redirect("site/login");

		if ($this->input->get('v')) {
			$data['data'] = $this->sitemodel->view("tab_ticket tt", "*", ['tt.ticket_id' => $this->input->get('v')],  array("tr_ticketing trt" => "trt.ticket_id=tt.ticket_id,"));
			$data['data_message'] = $this->sitemodel->view('tab_message', '*', ['ticket_id' => $this->input->get('v')]);
		}

		$log = $this->session->userdata('idocs-itdev');
		$log_user = $log->log_user;
		$check_is_admin = $this->sitemodel->view('tab_admin', '*', ['nip' => $log_user]);
		$data['is_admin'] = ($check_is_admin != '0') ? true : false;
		$check_is_superadmin = $this->sitemodel->view('tab_admin', '*', ['nip' => $log_user, 'level' => '2']);
		$data['is_superadmin'] = ($check_is_superadmin != '0') ? true : false;


		if ($this->input->get('page')) {
			if ($this->input->get('page') == 'inbound') {
				$data['header'] = 'inbound';
				$data['breadcumb'] = 'Inbound';
			}else{
				$data['header'] = 'outbound';
				$data['breadcumb'] = 'Outbound';
			}
		}

		$data['js']		= [
			base_url('assets/js/pages/ticket.js')
		];
		
		$this->load->library('guzzle');
		$department = $this->guzzle->guzzle_HRIS('department/get');
		$data_department = json_decode($department);
		$data['dept'] = $data_department->result;

		$data['log_dept'] = $log->log_dept;
		$data['log_user'] = $log->log_user;
		$data['log_name'] = $log->log_name;
		$data['pagename'] = 'pages/view_edit_ticket';
		$this->load->view('layout/main_site', $data);
	}

	function send_responses() {
		$data = array(
			"ticket_id" 	 		=> $this->input->post('ticket_id'),
			"message_sender" 		=> $this->input->post('message_sender'),
			"message_content"		=> $this->input->post('message_content'),
			"message_date"			=> date("Y-m-d H:i:s")
		);

		$this->sitemodel->insert("tab_message", $data);

		$msg['type'] = 'done';
		$msg['msg'] = "Successfully add response.";
		echo json_encode($msg);
	}

	function submit_priority()
	{
		$data = array(
			"ticket_status" 		=> '1',
			"ticket_priority" 		=> $this->input->post('ticket_priority'),
		);

		$this->sitemodel->update("tab_ticket", $data, ['ticket_id' => $this->input->post('ticket_id')]);

		$msg['type'] = 'done';
		$msg['msg'] = "Successfully Update Priority.";
		echo json_encode($msg);
	}

	function request_solved()
	{
		$data = array(
			"ticket_id" 	 		=> $this->input->post('ticket_id'),
			"request_solved" 		=> '1',
			"request_by"			=> $this->input->post('request_by')
		);

		$this->sitemodel->update("tr_ticketing", $data, ['report_id' => $this->input->post('report_id')]);

		$msg['type'] = 'done';
		$msg['msg'] = "Successfully Request.";
		echo json_encode($msg);
	}

	function send_close()
	{
		$data = array(
			"ticket_id"				=> $this->input->post('ticket_id'),
			"request_solved"		=> '2',
			"request_solved_date"	=> date("Y-m-d H:i:s")
		);

		$this->sitemodel->update("tr_ticketing", $data, ['report_id' => $this->input->post('report_id')]);

		$msg['type'] = 'done';
		$msg['msg'] = "Successfully Request.";
		echo json_encode($msg);
	}

	function solve_ticket()
	{
		$data = array(
			"solved_by"			=> $this->input->post('request_by'),
			"solved_date"		=> date("Y-m-d H:i:s")
		);

		$this->sitemodel->update("tr_ticketing", $data, ['report_id' => $this->input->post('report_id')]);

		$data2 = array(
			"ticket_status"	=> '2'
		);

		$this->sitemodel->update("tab_ticket", $data2, ['ticket_id' => $this->input->post('ticket_id')]);

		$msg['type'] = 'done';
		$msg['msg'] = "Successfully Request.";
		echo json_encode($msg);
	}
}
