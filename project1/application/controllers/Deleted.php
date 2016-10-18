<?php 
class Deleted extends MY_Controller{
	function __construct(){
		parent::__construct();
	}
	function index(){
		$this->load->view('head');
		$this->load->view('deleted');
		$this->load->view('footer');
	}
	function deleteact(){
		$this->settings_mod->deleteUser($this->getActUser());
		$this->session->unset_userdata('myuser');
		redirect("/deleted");
	}
	function delete(){
		$id = $this->input->post('id_user');
		$this->settings_mod->deleteUser($id);
		redirect("/deleted");
		
	}
}

?>