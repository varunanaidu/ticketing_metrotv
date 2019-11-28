<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inbound extends CI_Controller {

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

	function inbound_all()
	{
		if ( !$this->hasLogin() ) redirect("site/login");

		$data['header'] = 'inboundAll';
		$data['breadcumb'] = 'Inbound All';
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
		$data['pagename'] = 'pages/view_inbound_all';
		$this->load->view('layout/main_site', $data);
	}

	function history_inbound()
	{
		if ( !$this->hasLogin() ) redirect("site/login");
		
		$data['header'] = 'history_inbound';
		$data['breadcumb'] = 'History Inbound';
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
		$data['pagename'] = 'pages/view_history_inbound';
		$this->load->view('layout/main_site', $data);

	}

	function approval()
	{
		if ( !$this->hasLogin() ) redirect("site/login");
		
		$data['header'] = 'approval';
		$data['breadcumb'] = 'Approval';
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
		$data['pagename'] = 'pages/view_approval';
		$this->load->view('layout/main_site', $data);

	}

	function view_inbound()
	{
		$data = array();
		$res = $this->inboundmodel->get_applicant();
		$temp = $this->db->last_query();
		// echo $temp;die;

		foreach ($res as $row) {
			$col = array();
			$url = base_url('edit_ticket?page=inbound&v=').$row->ticket_id;
			$datetime1 = new DateTime();
			$datetime2 = new DateTime($row->create_date);
			$interval = $datetime1->diff($datetime2);
			$elapsed = $interval->format('%a days %h hours %i minutes %s seconds');
			$col[] = $elapsed;
			$col[] = $row->ticket_id;
			$col[] = $row->ticket_description;
			$col[] = $row->sender . ' (' . $row->create_name . ')';
			$col[] = ($row->ticket_status == 0 ? '' : ($row->ticket_priority == 1 ? '<span class="green_dot"></span>' : ( $row->ticket_priority == 2 ? '<span class="yellow_dot"></span>' : '<span class="red_dot"></span>' )));
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
		$res = $this->history_inboundmodel->get_applicant();
		$temp = $this->db->last_query();

		foreach ($res as $row) {
			$col = array();
			$col[] = date('d M Y H:i:s', strtotime($row->create_date));
			$col[] = date('d M Y H:i:s', strtotime($row->solved_date));
			$col[] = $row->ticket_id;
			$col[] = $row->ticket_description;
			$col[] = $row->sender . ' - ' . $row->create_name;
			$col[] = $row->recipient . ' - ' . $row->solved_by;
			$data[] = $col;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->history_inboundmodel->get_applicant_count_all(),
			"recordsFiltered" 	=> $this->history_inboundmodel->get_applicant_count_filtered(),
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
			$url = base_url('edit_ticket?page=inbound&v=').$row->ticket_id;
			$datetime1 = new DateTime();
			$datetime2 = new DateTime($row->create_date);
			$interval = $datetime1->diff($datetime2);
			$elapsed = $interval->format('%a days %h hours %i minutes %s seconds');
			$col[] = $elapsed;
			$col[] = $row->ticket_id;
			$col[] = $row->ticket_description;
			$col[] = $row->sender . ' (' . $row->create_name . ')';
			$col[] = ($row->ticket_status == 0 ? '' : ($row->ticket_priority == 1 ? '<span class="green_dot"></span>' : ( $row->ticket_priority == 2 ? '<span class="yellow_dot"></span>' : '<span class="red_dot"></span>' )));
			$col[] = ($row->request_solved == 1 ? 'Request Solved By '. $row->request_by : 'In Progress' );
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
			$col = array();
			$url = base_url('edit_ticket?page=inbound&v=').$row->ticket_id;
			$datetime1 = new DateTime();
			$datetime2 = new DateTime($row->create_date);
			$interval = $datetime1->diff($datetime2);
			$elapsed = $interval->format('%a days %h hours %i minutes %s seconds');
			$col[] = $elapsed;
			$col[] = $row->ticket_id;
			$col[] = $row->ticket_description;
			$col[] = $row->sender . ' (' . $row->create_name . ')';
			$col[] = ($row->ticket_status == 0 ? '' : ($row->ticket_priority == 1 ? '<span class="green_dot"></span>' : ( $row->ticket_priority == 2 ? '<span class="yellow_dot"></span>' : '<span class="red_dot"></span>' )));
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
}
