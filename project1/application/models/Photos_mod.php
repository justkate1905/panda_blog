<?php 
class Photos_mod extends CI_Model{
	function __construct()
    {
        parent::__construct();
        // Загружаем библиотеку для работы с БД
        $this->load->database();
        $this->load->helper('url');
    }
    function upload($original_name, $my_name, $id_user, $path){
        $data = array(
            'id_user'=> $id_user,
            'path'=> $path,
            'original_name'=> $original_name,
            'new_name'=> $my_name
            );
    	$result = $this->db->insert('files', $data);
    	// return $result->result();
    }
    function allPhotos($id_user){
        $result = $this->db->select('id,new_name, path')->from('files')->where('id_user',$id_user)->get();
        return $result->result();
    }
    function setphoto($id_user, $path){
        $data = array(
            'profile_photo' => $path,
            );
        $this->db->where('id',$id_user)->update('users', $data);   
    }
    function delete($id){
        $this->db->where('id',$id)->delete('files');
    }
}
?>