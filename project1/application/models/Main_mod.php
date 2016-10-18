<?php 
class Main_mod extends CI_Model{
	function __construct()
    {
        parent::__construct();
        // Загружаем библиотеку для работы с БД
        $this->load->database();
        $this->load->helper('url');
    }
    function getAllPosts(){
    	$result = $this->db->select('users.id as user_id, users.profile_photo as profile_photo, users_blog.id, login, users_blog.id, post, public_date')->from('users')->join('users_blog', 'users_blog.id_author=users.id')->order_by('users_blog.id desc')->get();
    	return $result->result();
    }
}
?>