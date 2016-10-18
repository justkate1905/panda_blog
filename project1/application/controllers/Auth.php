<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {
	function __construct()
    {
    	parent::__construct();
    	$this->checkAuth();
    }
	public function index()
	{
		$data=[];
		if($this->input->post('login')){
			$login = $this->input->post('login');
			$login = mb_strtolower($login);
			$password = $this->input->post('pass');
			$remember = $this->input->post('remember');
			if(!empty($login)&&!empty($password)){
				$password = sha1("^TY".$password."D%^&Y");
				$check = false;
				$result = $this->auth_mod->getUsers();
				foreach($result as $user){
					if(mb_strtolower($user->login)==$login){
						if($user->password==$password){
							$this->session->set_userdata('myuser', $user->id);
							if(($this->getDateTime() - strtotime($user->activity_date))<365*24*3600){
								$this->auth_mod->setdate(date('Y-m-d H:i:s'),$user->id);
								$check=true;
							}
							else{
								// $this->settings_mod->deleteUser($user->id);
								redirect("/deleted/deleteact");
							}
							break;
						}
					}
				}
				if ($check) {
					redirect("/main");
				}
				else{
					$data['error'] = 'match';
				}
			}
			else 
				$data['error'] = 'empty';
		}
		$this->load->view('head');
		$this->load->view('auth', $data);
		$this->load->view('footer');
	}

}