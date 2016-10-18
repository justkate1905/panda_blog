<?php
class Settings_mod extends CI_Model{
	function __construct()
    {
        parent::__construct();
        // Загружаем библиотеку для работы с БД
        $this->load->database();
        $this->load->helper('url');
    }
    function save($info, $id){
        // if(!isset($info['error'])){
        //     return 0;
        // }
    	$this->db->where('id',$id)->update('users', $info);
        // return $this->db->affected_rows();

    }
    function location(){
    	$result = $this->db->select('*')->from('countries')->order_by('country')->get();
    	return $result->result();
    }
    function cities(){
    	$result = $this->db->select('*')->from('cities')->order_by('name')->get();
    	return $result->result();
    }
    function deleteUser($id_user){
        $this->db->where('id',$id_user)->delete('users');
        $this->db->where('id_follower',$id_user)->delete('users_follow');
        $this->db->where('id_user',$id_user)->delete('users_fav');
        $this->db->where('id_author',$id_user)->delete('users_blog');
        $this->db->where('id_user',$id_user)->delete('comments');
    }
}
?>