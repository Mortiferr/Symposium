<?php

class Admin_panel extends CI_Controller {
	
	//for now empty constructor
	public function __construct() {
		parent::__construct();
	}
	
	//This function logs you in automatically - for testing purposes only.
	public function test_login() {
		$this->load->library('ion_auth');
		$user = 'admin@admin.com';
		$password = 'password';
		if (!$this->ion_auth->login($user, $password)) {
			echo 'failed to login';
		} else {
			$this->index();
		}
	}
	
	//This controller just displays the admin panel by default if the user is an admin.
	public function index() {
		$this->load->library('twig');
		$this->load->helper('security');
		$this->load->library('ion_auth');
		if ($this->ion_auth->in_group(1)) {
			$this->twig->display('admin_panel');
		} else {
			$page = array('back' => "http://localhost/symposium/index.php");
			$this->twig->display('no_rights', $page);
			echo $page['back'];
		}
	}
}