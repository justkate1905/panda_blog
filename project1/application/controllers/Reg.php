<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Reg extends MY_Controller{
	function __construct()
    {
        parent::__construct();
    }
    public function index(){
    	$data=[];
        if($this->input->post('login')){
		$login = mb_strtolower($this->input->post('login'));
		$email = $this->input->post('email'); 
		$password = $this->input->post('pass');
		if(!empty($login)&&!empty($email)&&!empty($password)){
            $result = $this->auth_mod->getUsers();
            $check = true;
            foreach($result as $user){
                if(mb_strtolower($user->login)==$login){
                    $check = false;
                    break;
                }
            }
            if(!$check){
                $data['error'] = 'match'; 
            }
            else {
    			$password = sha1("^TY".$password."D%^&Y");
        		$this->reg_mod->setUser($login, $email, $password);
                $this->session->set_userdata('myuser', $this->db->insert_id());
       			redirect("/main");
            }
  		} 
  		else{
    		$data['error'] = 'empty';
    	}
    }
        $this->load->view('head');
        $this->load->view('registration_form', $data);
        $this->load->view('footer');
}
}
?>