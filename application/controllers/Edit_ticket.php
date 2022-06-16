<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_ticket extends MY_Controller {

	function __construct(){
		parent::__construct();
	}

	function index()
	{
		if ( !$this->hasLogin() ) redirect("site/login");

		if ($this->input->get('v')) {
			$this->fragment['data'] = $this->sitemodel->view("vw_ticket", "*", ['ticket_id' => $this->input->get('v')] );
			$this->fragment['data_message'] = $this->sitemodel->view('tab_message', '*', ['ticket_id' => $this->input->get('v')]);
		}


		if ($this->input->get('page')) {
			if ($this->input->get('page') == 'inbound') {
				$this->fragment['header'] = 'inbound';
				$this->fragment['breadcumb'] = 'Inbound';
			}else{
				$this->fragment['header'] = 'outbound';
				$this->fragment['breadcumb'] = 'Outbound';
			}
		}

		$this->fragment['js']		= [
			base_url('assets/js/pages/ticket.js')
		];

		$this->fragment['priority'] = $this->sitemodel->view('tab_priority', '*', ['priority_id !='=>'1']);

		
		$this->fragment['pagename'] = 'pages/view_edit_ticket';
		$this->load->view('layout/main_site', $this->fragment);
	}

	function submit_priority()
	{
		// echo json_encode($this->input->post());die;
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}

		$id;
		$tr_id = $this->input->post('tr_id');
		$priority_id = $this->input->post('priority_id');
		
		$check = $this->sitemodel->view('vw_last_ticket', '*', ['tr_id'=>$tr_id]);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}

		foreach ($check as $row) {
			
			$data = array(
				"ticket_id" 		=> $row->ticket_id,
				"status_id" 		=> 2,
				"priority_id" 		=> $priority_id,
				"sender_dept"		=> $row->sender_dept,
				"sender_name"		=> $row->sender_name,
				"recipient_dept"	=> $row->recipient_dept,
				"recipient_name"	=> $row->recipient_name,
				"create_by"			=> $this->log_user,
				"create_name"		=> $this->log_name,
				"create_date"		=> date('Y-m-d H:i:s'),
				"request"			=> '',
				"request_by"		=> '',
			);
			
			$id = $this->sitemodel->insert("tr_ticketing", $data);
		}

		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully Update Priority.";
		$this->response['url'] = base_url() . 'inbound/detail/' . $id;
		echo json_encode($this->response);
	}

	function send_responses() {

		// echo json_encode($this->input->post());die;
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}

		$tr_id = $this->input->post('tr_id');
		
		$check = $this->sitemodel->view('vw_last_ticket', '*', ['tr_id'=>$tr_id]);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}

		foreach ($check as $row) {
			$data = array(
				"ticket_id" 	 		=> $row->ticket_id,
				"message_sender" 		=> $this->log_name,
				"message_content"		=> $this->input->post('message_content'),
				"message_date"			=> date("Y-m-d H:i:s")
			);

			$this->sitemodel->insert("tab_message", $data);
		}

		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully add response.";
		echo json_encode($this->response);
		exit;
	}

	function request_solved()
	{
		// echo json_encode($this->input->post());die;
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		$id;
		$tr_id = $this->input->post('tr_id');
		
		$check = $this->sitemodel->view('vw_last_ticket', '*', ['tr_id'=>$tr_id]);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}

		foreach ($check as $row) {
			
			$data = array(
				"ticket_id" 			=> $row->ticket_id,
				"status_id" 			=> 3,
				"priority_id" 			=> $row->priority_id,
				"sender_dept"			=> $row->sender_dept,
				"sender_name"			=> $row->sender_name,
				"recipient_dept"		=> $row->recipient_dept,
				"recipient_name"		=> $row->recipient_name,
				"create_by"				=> $this->log_user,
				"create_name"			=> $this->log_name,
				"create_date"			=> date('Y-m-d H:i:s'),
				"request"				=> $this->log_user,
				"request_by"			=> $this->log_name,
				"request_solved_date"	=> date('Y-m-d H:i:s'),
			);
			
			$id = $this->sitemodel->insert("tr_ticketing", $data);
		}

		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully Request Close Ticket.";
		$this->response['url'] = base_url() . 'inbound/detail/' . $id;
		echo json_encode($this->response);
	}

	function send_close()
	{
		// echo json_encode($this->input->post());die;
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		$id;
		$solution_desc = $this->input->post('solution_desc');
		$tr_id = $this->input->post('tr_id_2');
		
		$check = $this->sitemodel->view('vw_last_ticket', '*', ['tr_id'=>$tr_id]);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}

		foreach ($check as $row) {
			
			$data = array(
				"ticket_id" 			=> $row->ticket_id,
				"status_id" 			=> 4,
				"priority_id" 			=> $row->priority_id,
				"sender_dept"			=> $row->sender_dept,
				"sender_name"			=> $row->sender_name,
				"recipient_dept"		=> $row->recipient_dept,
				"recipient_name"		=> $row->recipient_name,
				"create_by"				=> $this->log_user,
				"create_name"			=> $this->log_name,
				"create_date"			=> date('Y-m-d H:i:s'),
				"request"				=> $row->request,
				"request_by"			=> $row->request_by,
				"request_solved_date"	=> $row->request_solved_date,
			);
			
			$id = $this->sitemodel->insert("tr_ticketing", $data);

			$data_solution = [
				'ticket_id'		=> $row->ticket_id,
				'solution_desc'	=> $solution_desc,
				"create_by"		=> $this->log_user,
				"create_name"	=> $this->log_name,
				"create_date"	=> date('Y-m-d H:i:s'),
			];

			$solution = $this->sitemodel->insert("tab_solution", $data_solution);
		}

		$this->response['type'] = 'done';
		$this->response['msg'] = "Successfully Send Ticket.";
		$this->response['url'] = base_url() . 'inbound/detail/' . $id;
		echo json_encode($this->response);
	}

	function solve_ticket()
	{
		// echo json_encode($this->input->post());die;
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		$id;
		$tr_id = $this->input->post('tr_id');
		
		$check = $this->sitemodel->view('vw_last_ticket', '*', ['tr_id'=>$tr_id]);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}

		foreach ($check as $row) {
			
			$data = array(
				"ticket_id" 			=> $row->ticket_id,
				"status_id" 			=> 5,
				"priority_id" 			=> $row->priority_id,
				"sender_dept"			=> $row->sender_dept,
				"sender_name"			=> $row->sender_name,
				"recipient_dept"		=> $row->recipient_dept,
				"recipient_name"		=> $row->recipient_name,
				"create_by"				=> $this->log_user,
				"create_name"			=> $this->log_name,
				"create_date"			=> date('Y-m-d H:i:s'),
				"request"				=> $row->request,
				"request_by"			=> $row->request_by,
				"request_solved_date"	=> $row->request_solved_date,
				"solved"				=> $row->request,
				"solved_by"				=> $row->request_by,
				"solved_date"			=> $row->request_solved_date,
			);
			
			$id = $this->sitemodel->insert("tr_ticketing", $data);
		}


		$this->response['type'] = 'done';
		$this->response['msg'] = "Ticket has been solved.";
		$this->response['url'] = base_url() . 'outbound/history_outbound';
		echo json_encode($this->response);
	}

	function reject_ticket(){
		// echo json_encode($this->input->post());die;
		/*** Check Session ***/
		if ( !$this->hasLogin() ){$this->response['msg'] = "Session expired, Please refresh your browser.";echo json_encode($this->response);exit;}
		/*** Check POST or GET ***/
		if ( !$_POST ){$this->response['msg'] = "Invalid parameters.";echo json_encode($this->response);exit;}
		$id;
		$tr_id 				= $this->input->post('tr_id');
		$reason_rejected 	= $this->input->post('reason_rejected');
		
		$check = $this->sitemodel->view('vw_last_ticket', '*', ['tr_id'=>$tr_id]);
		if (!$check) {$this->response['msg'] = "No data found.";echo json_encode($this->response);exit;}

		foreach ($check as $row) {
			
			$data = array(
				"ticket_id" 			=> $row->ticket_id,
				"status_id" 			=> 6,
				"priority_id" 			=> $row->priority_id,
				"sender_dept"			=> $row->sender_dept,
				"sender_name"			=> $row->sender_name,
				"recipient_dept"		=> $row->recipient_dept,
				"recipient_name"		=> $row->recipient_name,
				"create_by"				=> $this->log_user,
				"create_name"			=> $this->log_name,
				"create_date"			=> date('Y-m-d H:i:s'),
				"request"				=> $row->request,
				"request_by"			=> $row->request_by,
				"request_solved_date"	=> $row->request_solved_date,
				"solved"				=> $row->request,
				"solved_by"				=> $row->request_by,
				"solved_date"			=> $row->request_solved_date,
				"reason_rejected"		=> $reason_rejected,
			);
			
			$id = $this->sitemodel->insert("tr_ticketing", $data);
		}

		$this->response['type'] = 'done';
		$this->response['msg'] = "Ticket has been rejected.";
		$this->response['url'] = base_url() . 'inbound/history_inbound';
		echo json_encode($this->response);
	}
}
