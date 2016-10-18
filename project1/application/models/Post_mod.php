<?php 
class Post_mod extends CI_Model{
	    function __construct()
    {
        parent::__construct();
        // Загружаем библиотеку для работы с БД
        $this->load->database();
        $this->load->helper('url');
    }
    function deletePost($id_post, $id_user, $type){    
        $result = $this->db->select('id')->from('users')->where('privileges',1)->get()->result();
        $admins = array();
        foreach($result as $admin){
            $admins[] = $admin->id;
        }
        if(in_array($id_user, $admins)){
            if ($type == 'post') {
            $this->db->where('id_post', $id_post)->delete('comments'); 
            $this->db->where('id',$id_post)->delete('users_blog');

            // Если пост наш - удаляем комментарии к посту            
            }
            else $this->db->where('id',$id_post)->delete('comments');
            }
        else{
    	if ($type == 'post') {
    		// Если пост наш - удаляем комментарии к посту
    		if ($this->db->from("users_blog")->where('id',$id_post)->where('id_author', $id_user)->get()->result()) {
    			$this->db->where('id_post', $id_post)->delete('comments'); 
   			}
    		$this->db->where('id',$id_post)->where('id_author', $id_user)->delete('users_blog');
    		
    	}
    	else $this->db->where('id',$id_post)->where('id_user', $id_user)->delete('comments');
    }
    	// echo $this->db->last_query();
    	return $this->db->affected_rows();
    }
    function setFavourite($id_post, $id_user){
    	$data = array(
            'id_post' => $id_post,
            'id_user' => $id_user
            );
    	$this->db->insert('users_fav',$data);
    }

    function unsetFavourite($id_post, $id_user){
    	$this->db->where('id_post',$id_post)->where('id_user', $id_user)->delete('users_fav');
    }

}
?>