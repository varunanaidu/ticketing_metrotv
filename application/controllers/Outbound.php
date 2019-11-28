<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Outbound extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("outboundmodel");
		$this->load->model("history_outboundmodel");
	}

	function index()
	{
		if ( !$this->hasLogin() ) redirect("site/login");

		$data['header'] = 'outbound';
		$data['breadcumb'] = 'Outbound';
		$data['js']		= [
			base_url('assets/js/pages/outbound.js')
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
		$data['pagename'] = 'pages/view_outbound';
		$this->load->view('layout/main_site', $data);
	}

	function history_outbound()
	{
		if ( !$this->hasLogin() ) redirect("site/login");

		$data['header'] = 'history_outbound';
		$data['breadcumb'] = 'History Outbound';
		$data['js']		= [
			base_url('assets/js/pages/outbound.js')
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
		$data['pagename'] = 'pages/view_history_outbound';
		$this->load->view('layout/main_site', $data);

	}

	function view_outbound()
	{
		$data = array();
		$res = $this->outboundmodel->get_applicant();
		$temp = $this->db->last_query();

		foreach ($res as $row) {
			$col = array();
			$url = base_url('edit_ticket/?page=outbound&v=').$row->ticket_id;
			$datetime1 = new DateTime();
			$datetime2 = new DateTime($row->create_date);
			$interval = $datetime1->diff($datetime2);
			$elapsed = $interval->format('%a days %h hours %i minutes %s seconds');
			$col[] = $elapsed;
			$col[] = $row->ticket_id;
			$col[] = $row->ticket_description;
			$col[] = $row->recipient;
			$col[] = ($row->ticket_status == 0 ? '' : ($row->ticket_priority == 1 ? '<span class="green_dot"></span>' : ( $row->ticket_priority == 2 ? '<span class="yellow_dot"></span>' : '<span class="red_dot"></span>' )));
			$col[] = '<a href="'.$url.'" class="actionButton" title="View"><i class="fa fa-cogs"></i></a> ' . ($row->request_solved == 2 ? '<a href="javascript:void(0)" class="actionButton" id="solvedBtn" title="Solved" data-id="'.$row->report_id.'" data-name="'.$row->request_by.'" data-ticket="'.$row->ticket_id.'" data-request="'.$row->request_solved_date.'"><i class="fa fa-check"></i></a>' : '');
			$data[] = $col;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->outboundmodel->get_applicant_count_all(),
			"recordsFiltered" 	=> $this->outboundmodel->get_applicant_count_filtered(),
			"data" 				=> $data,
			"q"					=> $temp

		);
		echo json_encode($output);
		exit;
	}

	function view_history_outbound()
	{
		$data = array();
		$res = $this->history_outboundmodel->get_applicant();
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
			"recordsTotal" 		=> $this->history_outboundmodel->get_applicant_count_all(),
			"recordsFiltered" 	=> $this->history_outboundmodel->get_applicant_count_filtered(),
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
			$ticket_description = $this->input->post('ticket_description');
			$sender = $this->input->post('sender');
			$recipient = $this->input->post('recipient');
			$create_user = $this->input->post('create_user');
			$create_name = $this->input->post('create_name');
			if (isset($_FILES['ticket_att']['name'])) {
				$file = $_FILES['ticket_att']['name'];
				$exp = explode(".", $file);
				$end = strtolower(end($exp));
				$allowed = array("png", "jpg", "jpeg");
				if ( in_array($end, $allowed) ){
					if ( $_FILES['ticket_att']['size'] > 5000000 ){
						$msg['type'] = 'failed';
						$msg['msg'] = 'Maximum image can be upload is 5 MB.';
					}
					else{
						$fileUpload = md5($file.date("YmdHis")).".".$end;
						$data = array(
							"ticket_att" 			=> $fileUpload,
							"ticket_description"	=> $ticket_description,
							"ticket_status"			=> 0
						);
						$this->compress_image($_FILES['ticket_att']['tmp_name'], "assets/img/outbound/".$fileUpload, 100);
						$this->sitemodel->insert("tab_ticket", $data);

						$data2 = array(
							'ticket_id' 	=> $this->db->insert_id(),
							'sender' 		=> $sender,
							'recipient' 	=> $recipient,
							"create_user"	=> $create_user,
							"create_name"	=> $create_name,
							"create_date"	=> date("Y-m-d H:i:s")	
						);
						$this->sitemodel->insert("tr_ticketing", $data2);

						$msg['type'] = 'done';
						$msg['msg'] = "Successfully add ticket.";
					}
				}
				else{
					$msg['type'] = 'failed';
					$msg['msg'] = "Invalid image extension.";
				}
			}else{
				$data = array(
					"ticket_description"	=> $ticket_description,
					"ticket_status"			=> 0
				);
				$this->sitemodel->insert("tab_ticket", $data);

				$data2 = array(
					'ticket_id' 	=> $this->db->insert_id(),
					'sender' 		=> $sender,
					'recipient' 	=> $recipient,
					"create_user"	=> $create_user,
					"create_name"	=> $create_name,
					"create_date"	=> date("Y-m-d H:i:s")	
				);
				$this->sitemodel->insert("tr_ticketing", $data2);

				$msg['type'] = 'done';
				$msg['msg'] = "Successfully add ticket.";
			}

		}
		else{
			$msg['type'] = 'failed';
			$msg['msg'] = 'Invalid parameter';
		}

		echo json_encode($msg);
	}

	function compress_image($source_url, $destination_url, $quality) {
		$info = getimagesize($source_url);

		if ($info['mime'] == 'image/jpeg')
			$image = imagecreatefromjpeg($source_url);
		elseif ($info['mime'] == 'image/gif')
			$image = imagecreatefromgif($source_url);
		elseif ($info['mime'] == 'image/png')
			$image = imagecreatefrompng($source_url);
		imagejpeg($image, $destination_url, $quality);

		return true;
	}
}
