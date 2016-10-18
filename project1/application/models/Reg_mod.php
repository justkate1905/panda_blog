<?php 
class Reg_mod extends CI_Model
{
	function __construct()
    {
        parent::__construct();
        // Загружаем библиотеку для работы с БД
        $this->load->database();
        $this->load->helper('url');
    }
    //Занесение пользователя в базу
    function setUser($login, $email, $password){
    	$data = array(
               'login' => $login,
               'email' => $email ,
               'password' => $password
            );
		$this->db->insert('users', $data); 
    }
}
?>