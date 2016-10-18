<?php
class Auth_mod extends CI_Model
{ 
    function __construct()
    {
        parent::__construct();
        // Загружаем библиотеку для работы с БД
        $this->load->database();
        $this->load->helper('url');
    }
    function getUsers(){
        //получение всех пользователей из базы
    	$result  = $this->db->select("id,login,password,activity_date")->from("users")->get();
    	return $result->result();	
    }
    function setdate($time, $id_user){
        $this->db->where('id',$id_user)->update('users', array('activity_date'=>$time));
    }
}
?>