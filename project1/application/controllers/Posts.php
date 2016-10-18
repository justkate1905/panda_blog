<?php 
class Posts extends MY_Controller{
	function __construct()
    {
        parent::__construct();
        $this->check();
    }
    /*
    Удаление поста 

    */
    function deletePost(){
    	$id_post = $this->input->post('id_post');
    	$type = $this->input->post('type');
    	$numRow = $this->post_mod->deletePost($id_post, $this->getActUser(), $type);
    
    	if ($numRow > 0){
    		echo json_encode(array('result'=>'ok'));
    	}
    	else
    		echo json_encode(array('result'=>'error'));
    }
    function setFavourite(){
    	$id_post = $this->input->post('id_post');
    	$this->post_mod->setFavourite($id_post, $this->getActUser());
    	echo json_encode(array('result'=>'ok'));
    }
    function unsetFavourite(){
    	$id_post = $this->input->post('id_post');
    	$this->post_mod->unsetFavourite($id_post, $this->getActUser());
    	echo json_encode(array('result'=>'ok'));
    }

}
?>