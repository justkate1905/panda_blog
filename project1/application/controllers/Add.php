<?php 
class Add extends MY_Controller{
	
		function __construct(){
			parent::__construct();
		}
		
		function index(){
			switch($this->input->get('type')) {
				case 'post': $this->addPost();
				case 'comment': $this->addComment();
				default: echo '404';exit();
			}
		}
		
		/**
		 * Добавляет пост
		 * 
		 */
		 public function addPost() {
			 	$this->check();
				$this->load->model('add_mod');
				if($this->input->post('blog')){ //Проверка, пришла форма или нет
					$blog = $this->input->post('blog'); 
					if(!empty($blog)){ //Если форма не пуста - добавить в базу новую запись
						$user_id = $this->session->userdata('myuser');
						$this->add_mod->addPost($user_id, $blog);
					}
					redirect("/profile");
				}
		 }
		
		/**
		 * Получает комментарий и добавляет его в БД
		 * 
		 */
		 public function addComment() {
		 		$this->check();
		 		$this->load->model('add_mod');
		 		
		 		if ($this->input->post('comment')) {
					$comment = $this->input->post('comment');
					$postID = $this->input->post('post_id');
					
					if ($comment) {
						$userID = $this->session->userdata('myuser');
						$this->add_mod->addComment($userID, $postID, $comment);
					}
					redirect('/profile');
				}
		 }
	}


?>