<?php 
class Guest extends MY_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		$user = $this->profile_mod->getUser($this->input->get('url')); 
		$data['blog'] = $this->profile_mod->getPost($user->id); 
        $data['login'] = $user->login;
        $data['user_id'] = $user->id;
        $data['prof_photo'] = $user->profile_photo;

		$this->load->view('head');
        $this->load->view('aside',$data);
		$this->load->view('gaccess', $data);
		$this->load->view('footer');
	}
}

?>