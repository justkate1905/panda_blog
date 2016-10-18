<?php 
class MY_Controller extends CI_Controller {
	function __construct(){
		parent::__construct();
        $this->load->library('session');
        $this->load->library('ftp');
        $this->load->library('upload');
        $this->load->helper(array('url', 'form','cookie')); 
        $this->load->library('form_validation');
		$this->load->model('add_mod');
		$this->load->model('auth_mod');
		$this->load->model('follows_mod');
		$this->load->model('profile_mod');
		$this->load->model('reg_mod');
		$this->load->model('post_mod');
		$this->load->model('settings_mod');
		$this->load->model('admin_mod');
		$this->load->model('main_mod');
		$this->load->model('photos_mod');
	}

	public	function check(){
		// if($this->input->cookie('myuser'))
		// 	$this->session->set_userdata('myuser', $this->input->cookie('myuser'));
		if(!($this->session->userdata('myuser'))){
			echo ($this->session->userdata('myuser'));
			redirect("/auth");
		}
	}
	public function checkAuth(){
		// if($this->input->cookie('myuser'))
		// 	$this->session->set_userdata('myuser', $this->input->cookie('myuser'));
		if(($this->session->userdata('myuser'))){
			redirect("/profile");
		}
	}
	public function getActUser(){
		return $this->session->userdata('myuser');
	}
	public function getDateTime(){
		date_default_timezone_set("Europe/Moscow");
		return time();
	}
	public function getUser(){
        if (!($this->uri->segment(2)=='')&&!($this->uri->segment(3))) {
            $user = $this->uri->segment(2);
        }
        else
        {
            $user =$this->session->userdata('myuser');
        }
        return $user;
    }
}
?>