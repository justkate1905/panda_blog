<?php 
class Profile_mod extends CI_Model{
	    function __construct()
    {
        parent::__construct();
        // Загружаем библиотеку для работы с БД
        $this->load->database();
        $this->load->helper('url');
    }
    //Получение записей конкретного пользователя
	function getPost($user_id){
		$result  = $this->db->select("id, post,public_date")->from("users_blog")->where('id_author',$user_id)->order_by('id desc')->get();
		$arrPosts = $result->result();
		$arrFullInfo= array();
		foreach($arrPosts as $arrPost) {
			$arrFullInfo[] = array(
				'post' => $arrPost, 
				'comments' => $this
				->db
				->select("id, id_user, comment, public_date")
				->from("comments")
				->where('id_post', $arrPost->id)
				->get()->result()
			);
		}
		return $arrFullInfo;
	}
	//Получение пользователя по заданному id
	function getUser($user_id){
		$result = $this->db->select('*')->from('users')->where('id',$user_id)->get();
		return $result->row();
	}

	function isFollow($followerID, $userID){		
		//$userID = 
		$result = $this->db->select('id')->from('users_follow')->where('id_user', $userID)->where('id_follower', $followerID)->get()->result();
		//echo $this->db->last_query();
		return $result ? 1 : 0;
 	}
 	function favourites($id_user){
        $this->db->select('id_user, id_post,post,id_author,public_date,login, profile_photo');
        $this->db->from('users_fav');
        $this->db->join('users_blog','users_blog.id=users_fav.id_post')->join('users','users_blog.id_author=users.id');
        $this->db->where('users_fav.id_user',$id_user)->order_by("users_blog.id desc");
        $result = $this->db->get();
        return $result->result();
    }
    function followpost($id_user){
    	$this->db->select('id_user,post, public_date, login, profile_photo');
        $this->db->from('users_follow');
        $this->db->join('users_blog','users_blog.id_author=users_follow.id_user')->join('users','users_blog.id_author=users.id');
        $this->db->where('users_follow.id_follower',$id_user);
        $this->db->order_by('users_blog.id desc');
       	$result = $this->db->get();
        return $result->result();
    }
    function allusers(){
    	$result = $this->db->select('id')->from('users')->get();
    	return $result->result();
    
    }
}
?>