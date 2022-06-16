<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solution extends MY_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model("solutionmodel");
	}

	function index()
	{
		if ( !$this->hasLogin() ) redirect("site/login");

		$this->fragment['header'] = 'solution';
		$this->fragment['breadcumb'] = 'Solution';
		$this->fragment['js']		= [
			base_url('assets/js/pages/solution.js')
		];

		$this->fragment['pagename'] = 'pages/view_solution';
		$this->load->view('layout/main_site', $this->fragment);
	}

	function view_solution()
	{
		$data = array();
		$res = $this->solutionmodel->get_applicant();
		$temp = $this->db->last_query();
		$no = 1;
		// echo $temp;die;

		foreach ($res as $row) {
			$col = array();
			$col[] = $no;
			$col[] = $row->category_name;
			$col[] = $row->ticket_description;
			$col[] = $row->solution_desc;
			$col[] = $row->create_by.' - '.$row->create_name;
			$data[] = $col;
			$no++;
		}
		$output = array(
			"draw" 				=> $_POST['draw'],
			"recordsTotal" 		=> $this->solutionmodel->get_applicant_count_all(),
			"recordsFiltered" 	=> $this->solutionmodel->get_applicant_count_filtered(),
			"data" 				=> $data,
			"q"					=> $temp

		);
		echo json_encode($output);
		exit;
	}
}
