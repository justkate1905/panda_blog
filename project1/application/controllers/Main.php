<?php
class Main extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->check();  
    }
    function index(){
        $posts = $this->main_mod->getAllPosts(); 
        $data['about'] = $posts;
        $this->load->view('head');
        $this->load->view('nav');
        $this->load->view('main', $data);
        $this->load->view('footer');
    }
}

?>