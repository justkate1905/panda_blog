<?php 
class Add_mod extends CI_Model{
	function __construct()
    {
        parent::__construct();
        // Загружаем библиотеку для работы с БД
        $this->load->database();
        $this->load->helper('url');
    }
    //Функция добавления записей
	function addPost($user_id, $post){
		$data = array(
               'post' => $post,
               'id_author' => $user_id
            );
		$this->db->insert('users_blog', $data);
	}
	
	/**
	 * Добавляет комментарий в базу
	 * 
	 * @param int $userID - id пользователя
	 * @param int $postID - id поста под которым комментарий
	 * @param string $comment - комментарий
	 */ 
	 public function addComment($userID, $postID, $comment) {
	 		$data = array(
	 			'id_post' => $postID,
	 			'id_user' => $userID,
	 			'comment' => $comment
			 
	 		);
	 		$this->db->insert('comments', $data);
	 }
}

?>