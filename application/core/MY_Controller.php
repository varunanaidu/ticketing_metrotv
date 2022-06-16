<?php if ( !defined('BASEPATH') )exit('No direct script access allowed');

class MY_Controller extends CI_Controller{

	protected $fragment  = [];
	protected $response  = [];

	protected $log_user  = '';
	protected $log_name  = '';
	
	function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		
		if ($this->hasLogin()) {
			$this->log_user = strtoupper($this->session->userdata(SESS)->log_user);
			$this->log_name = strtoupper($this->session->userdata(SESS)->log_name);
			$this->log_csdp = $this->session->userdata(SESS)->log_csdp;
			$this->log_dept = strtoupper($this->session->userdata(SESS)->log_dept);

			$check_is_admin = $this->sitemodel->view('tab_admin', '*', ['nip' => $this->log_user]);
			$this->fragment['is_admin'] = ($check_is_admin != '0') ? true : false;

			$check_is_superadmin = $this->sitemodel->view('tab_admin', '*', ['nip' => $this->log_user, 'role_id' => '1']);
			$this->fragment['is_superadmin'] = ($check_is_superadmin != '0') ? true : false;

			$this->fragment['log_user'] = $this->log_user;
			$this->fragment['log_name'] = $this->log_name;
			
			$this->fragment['log_dept'] = $this->log_csdp;
			$this->fragment['log_dept_name'] = $this->log_dept;
			
			// echo json_encode($this->fragment);die;
		}
	}
	
	function hasLogin() {
		return $this->session->userdata(SESS);
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