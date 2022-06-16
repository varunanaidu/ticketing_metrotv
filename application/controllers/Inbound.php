<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbound extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("inboundmodel");
		$this->load->model("history_inboundmodel");
		$this->load->model("approvalmodel");
		$this->load->model("inboundallmodel");
	}

	function index()
	{
		if ( !$this->hasLogin() ) redirect("site/login");

		$this->fragment['header'] = 'inbound';
		$this->fragment['breadcumb'] = 'Inbound';
		$this->fragment['js']		= [
			base_url('assets/js/pages/inbound.js')
		];

		$this->fragment['pagename'] = 'pages/view_inbound';
		$this->load->view('layout/main_site', $this->fragment);
	}

	function inbound_all()
	{
		if ( !$this->hasLogin() ) redirect("site/login");

		$this->fragment['header'] = 'inboundAll';
		$this->fragment['breadcumb'] = 'Inbound All';
		$this->fragment['js']		= [
			base_url('assets/js/pages/inbound.js')
		];

		$this->fragment['pagename'] = 'pages/view_inbound_all';
		$this->load->view('layout/main_site', $this->fragment);
	}

	function history_inbound()
	{
		if ( !$this->hasLogin() ) redirect("site/login");
		
		$this->fragment['header'] = 'history_inbound';
		$this->fragment['breadcumb'] = 'History Inbound';
		$this->fragment['js']		= [
			base_url('assets/js/pages/inbound.js')
		];

		$this->fragment['pagename'] = 'pages/view_history_inbound';
		$this->load->view('layout/main_site', $this->fragment);

	}

	function approval()
	{
		if ( !$this->hasLogin() ) redirect("site/login");
		
		$this->fragment['header'] = 'approval';
		$this->fragment['breadcumb'] = 'Approval';
		$this->fragment['js']		= [
			base_url('assets/js/pages/inbound.js')
		];

		$this->fragment['pagename'] = 'pages/view_approval';
		$this->load->view('layout/main_site', $this->fragment);

	}

	function detail($tr_id)
	{
		if ( !$this->hasLogin() ) redirect("site/login");
		$this->fragment['header'] = 'inbound';
		$this->fragment['breadcumb'] = 'Inbound';

		$this->fragment['js']		= [
			base_url('assets/js/pages/ticket.js')
		];

		$temp_data = $this->sitemodel->view("vw_ticket", "*", ['tr_id'=>$tr_id]);
		$this->fragment['data'] = $temp_data;

		if ($temp_data) {
			foreach ($temp_data as $td) {
				$this->fragment['data_message'] = $this->sitemodel->view('tab_message', '*', ['ticket_id' => $td->ticket_id]);
			}
		}

		$this->fragment['priority'] = $this->sitemodel->view('tab_priority', '*', ['priority_id !='=>'1']);

		
		$this->fragment['pagename'] = 'pages/view_ticket';
		$this->load->view('layout/main_site', $this->fragment);
	}

	function view_inbound()
	{
		$data = array();
		$color;
		$res = $this->inboundmodel->get_applicant();
		$temp = $this->db->last_query();
		// echo $temp;die;

		foreach ($res as $row) {
			$col = array();
			switch ($row->priority_id) {
				case '1':
				$color = '';
				break;
				case '2':
				$color = '<span class="green_dot"></span>';
				break;
				case '3':
				$color = '<span class="yellow_dot"></span>';
				break;
				case '4':
				$color = '<span class="red_dot"></span>';
				break;
				default:
				$color = '';
				break;
			}
			$url = base_url('inbound/detail/') . $row->tr_id;
			$datetime1 = new DateTime();
			$datetime2 = new DateTime($row->create_date);
			$interval = $datetime1->diff($datetime2);
			$elapsed = $interval->format('%a days %h hours %i minutes');

			$col[] = $elapsed;
			$col[] = $row->ticket_id;
			$col[] = $row->ticket_description;
			$col[] = $row->issued_by . '-' . $row->issued_name . ' (' . $row->sender_name . ')';
			$col[] = $color;
			$col[] = '<a href="'.$url.'" class="actionButton" title="View"><i class="fa fa-cogs"></i></a>';
			$data[] = $col;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->inboundmodel->get_applicant_count_all(),
			"recordsFiltered" 	=> $this->inboundmodel->get_applicant_count_filtered(),
			"data" 				=> $data,
			"q"					=> $temp

		);
		echo json_encode($output);
		exit;
	}

	function view_history_inbound()
	{
		$data = array();
		$is_active = 1;
		$status;
		$endDate;
		$requestBy;
		$closedBy;
		$res = $this->inboundmodel->get_applicant($is_active);
		$temp = $this->db->last_query();
		// echo $temp;die;
		
		foreach ($res as $row) {
			$col = array();
			switch ($row->status_id) {
				case '5':
				$status = 'Solved';
				$endDate = date('d M Y H:i:s', strtotime($row->solved_date));
				$closedBy = $row->solved . ' - ' . $row->solved_by;
				break;
				case '6':
				$status = 'Rejected';
				$endDate = '-';
				$closedBy = '-';
				break;
			}
			$col[] = date('d M Y H:i:s', strtotime($row->issued_date));
			$col[] = $endDate;
			$col[] = $row->ticket_id;
			$col[] = $row->ticket_description;
			$col[] = $row->issued_by . ' - ' . $row->issued_name.' ('.$row->sender_name.')';
			$col[] = $status;
			$col[] = $closedBy;
			$col[] = '<a href="javascript:void(0)" title="View Detail" id="detailBtn" data-id="'.$row->tr_id.'"><i class="fa fa-eye"></i></a>';
			$data[] = $col;
		}

		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->inboundmodel->get_applicant_count_all(),
			"recordsFiltered" 	=> $this->inboundmodel->get_applicant_count_filtered($is_active),
			"data" 				=> $data,
			"q"					=> $temp

		);
		echo json_encode($output);
		exit;
	}

	function view_approval()
	{
		$data = array();
		$res = $this->approvalmodel->get_applicant();
		$temp = $this->db->last_query();
		// echo $temp;die;

		foreach ($res as $row) {
			$col = array();
			$url 		= base_url('inbound/detail/') . $row->tr_id;
			$datetime1 	= new DateTime();
			$datetime2 	= new DateTime($row->create_date);
			$interval 	= $datetime1->diff($datetime2);
			$elapsed 	= $interval->format('%a days %h hours %i minutes');
			$temp 		= ( $row->status_id == 3 ? 'Request Solved By : '.$row->request.' - '.$row->request_by : 'In Progress' );

			$col[] = $elapsed;
			$col[] = $row->ticket_id;
			$col[] = $row->ticket_description;
			$col[] = $row->issued_by . '-' .$row->issued_name . ' (' . $row->sender_name . ')';
			$col[] = ($row->status_id == 1 ? '' : ($row->priority_id == 2 ? '<span class="green_dot"></span>' : ( $row->priority_id == 3 ? '<span class="yellow_dot"></span>' : '<span class="red_dot"></span>' )));
			$col[] = $temp;
			$col[] = '<a href="'.$url.'" class="actionButton" title="View"><i class="fa fa-cogs"></i></a>';
			$data[] = $col;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->approvalmodel->get_applicant_count_all(),
			"recordsFiltered" 	=> $this->approvalmodel->get_applicant_count_filtered(),
			"data" 				=> $data,
			"q"					=> $temp

		);
		echo json_encode($output);
		exit;
	}

	function view_all_inbound()
	{
		$data = array();
		$res = $this->inboundallmodel->get_applicant();
		$temp = $this->db->last_query();
		// echo $temp;die;

		foreach ($res as $row) {
			$col 		= array();
			$url 		= base_url('inbound/detail/') . $row->tr_id;
			$datetime1 	= new DateTime();
			$datetime2 	= new DateTime($row->create_date);
			$interval 	= $datetime1->diff($datetime2);
			$elapsed 	= $interval->format('%a days %h hours %i minutes');
			$col[] 		= $elapsed;
			$col[] 		= $row->ticket_id;
			$col[] 		= $row->ticket_description;
			$col[] = $row->issued_by . '-' . $row->issued_name . ' (' . $row->sender_name . ')';
			$col[] = ($row->status_id == 1 ? '' : ($row->priority_id == 2 ? '<span class="green_dot"></span>' : ( $row->priority_id == 3 ? '<span class="yellow_dot"></span>' : '<span class="red_dot"></span>' )));
			$col[] = '<a href="'.$url.'" class="actionButton" title="View"><i class="fa fa-cogs"></i></a>';
			$data[] = $col;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->inboundallmodel->get_applicant_count_all(),
			"recordsFiltered" 	=> $this->inboundallmodel->get_applicant_count_filtered(),
			"data" 				=> $data,
			"q"					=> $temp

		);
		echo json_encode($output);
		exit;
	}

	function view_detail(){

		$msg = array();

		$msg['data'] = $this->sitemodel->view('vw_last_ticket', '*', ['tr_id' => $this->input->post('tr_id')]);
		$msg['type'] = 'done';
		$msg['msg'] = "Successfully add ticket.";
		echo json_encode($msg);
	}
}
