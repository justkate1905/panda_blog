<?php 
class Admin extends MY_Controller{
	function __construct()
	{
        parent::__construct();
        $this->check();
        $this->admincheck();
    }
    function index(){
    	$data = [];
    	$result = $this->admin_mod->getUsers();
        $actId = $this->getActUser();
    	$id = array();
    	$login = array();
    	$firstname = array();
    	$lastname = array();
    	$middlename = array();
    	$activity_date = array();
    	$period = array();
        $privileges = array();
    	foreach($result as $users){
    		$id[] = $users->id;
    		$login[] = $users->login;
    		$firstname[] = $users->first_name;
    		$lastname[] = $users->last_name;
    		$middlename[] = $users->middle_name;
    		$activity_date[] = $users->activity_date;
            $privileges[] = $users->privileges;
    		$period[] = time()-strtotime($users->activity_date);
    	}
    	$data = array(
    		'id'=>$id,
    		'login'=>$login,
    		'firstname'=>$firstname,
    		'lastname'=>$lastname,
    		'middlename'=>$middlename,
    		'activity_date'=>$activity_date,
    		'period'=>$period,
            'privileges'=>$privileges,
            'actid'=>$actId
    		);
    	$this->load->view('head');
    	$this->load->view('admin',$data);
    	$this->load->view('footer');
    }
    function admincheck(){
    	$result = $this->profile_mod->getUser($this->getActUser());
    	if($result->privileges ==0){
    	$this->load->view('head');
    	$this->load->view('deny');
    	$this->load->view('footer');
    	}
    }

}
?>