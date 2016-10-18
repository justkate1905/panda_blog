<?php 
class Follows_mod extends CI_Model{
	function __construct()
    {
        parent::__construct();
        // Загружаем библиотеку для работы с БД
        $this->load->database();
        $this->load->helper('url');
    }
    function getFollow($user_id){
    	$result = $this->db->select('id_user,login')->from('users_follow')->join('users','users_follow.id_user=users.id')->where('id_follower', $user_id)->get();
    	// $result = $this->db->select('id_user')->from('users_follow')->where('id_follower', $user_id);
    	
    	// echo $this->db->last_query();
    	return $result->result();
    }
    
    /**
     * Подписаться
     */
     public function addFollow($userID, $followerID){
  		$data = array(
	 			'id_follower' => $userID,
	 			'id_user' => $followerID			 
	 		);
     	$result = $this->db->select('*')->from('users_follow')->where('id_follower',$userID )->where('id_user', $followerID)->get();
     	if ($result->result()) $this->db->delete('users_follow', $data);
			else return $this->db->insert('users_follow', $data);
    	
    }
}

?>