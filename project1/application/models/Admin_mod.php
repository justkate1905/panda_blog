<?php 
class Admin_mod extends CI_Model{
	function __construct()
    {
        parent::__construct();
        // Загружаем библиотеку для работы с БД
        $this->load->database();
        $this->load->helper('url');
    }
    function getUsers(){
    	$result = $this->db->select('*')->from('users')->order_by('activity_date','asc')->get();
    	return $result->result();
    }
}
?>