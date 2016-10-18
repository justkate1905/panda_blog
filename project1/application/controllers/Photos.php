<?php 
class Photos extends MY_Controller{
	function __construct(){
		parent::__construct();
		$this->check();
	}
	function index(){
 		$config['hostname'] = 'enisey5.beget.ru';
 		$config['username'] = 'g911021a_root';
 		$config['password'] = 'root123';
		$config['debug']    = TRUE;
		$this->ftp->connect($config);
		
		$this->ftp->chmod('/files/', 0777);
        $user = $this->profile_mod->getUser($this->getActUser()); 
        $actId = $this->getActUser();
		$data['login'] = $user->login;
        $data['user_id'] = $user->id;
        $data['actId'] = $actId;
        $data['error']='';
        $data['prof_photo'] = $user->profile_photo;

        $path = array();
		$result = $this->photos_mod->allPhotos($actId);
		// foreach($result as $photo){
		// 	$path[] = $photo->path;
		// }
		$data['path'] = $result;

		$list = $this->ftp->list_files('/files/');
		// print_r($list);
		if(!in_array('/files/'.$actId, $list)){
			$this->ftp->mkdir('/files/'.$actId, 0777);
            $this->ftp->mkdir('/files/'.$actId.'/prof/', 0777);
		}
		else{
			$list1 = $this->ftp->list_files('/files/'.$actId.'/');
			if(!in_array('/files/'.$actId.'/prof', $list1)){
            	$this->ftp->mkdir('/files/'.$actId.'/prof/', 0777);
			}
		}
		if(isset($_FILES['userfile']['name'])){	
			if(isset($_FILES['userfile']['tmp_name'])){
				$file = $_FILES['userfile']['tmp_name'];
				$original_name = $_FILES['userfile']['name'];
				$name_array = explode(".", $original_name);
				$new_name = sha1("!#$".$original_name."&#$");
				$my_name = $new_name.'.'.end($name_array);	
				foreach($result as $photo){
					if($my_name==$photo->new_name){
						$data['error'] = 'exist';
						break;
					}
				}
				if(!($data['error']=='exist')){
		        	$this->ftp->upload($file, '/files/'.$actId.'/'.$my_name, 'auto', 0775);
					$this->photos_mod->upload($original_name, $my_name, $actId, '/files/'.$actId.'/'.$my_name);
				}
			}
		}
		$this->ftp->close();
        $this->load->view('head');
        $this->load->view('nav');
        $this->load->view('aside',$data);
        $this->load->view('photos', $data);
        $this->load->view('footer');
    } 

    function setphoto(){
        $actId = $this->getActUser();
        $user = $this->profile_mod->getUser($this->getActUser()); 
    	$config['hostname'] = 'enisey5.beget.ru';
 		$config['username'] = 'g911021a_root';
 		$config['password'] = 'root123';
		$config['debug']    = TRUE;
		$this->ftp->connect($config);
		// $this->ftp->chmod('/files/prof', 0777);
		$this->ftp->chmod('/files/', 0777);
		if(($user->profile_photo) != '/img/panda-icon.png' ){
			$this->ftp->delete_file($user->profile_photo);
		}

		$file = $_FILES['userfile']['tmp_name'];
		$original_name = $_FILES['userfile']['name'];
		$name_array = explode(".", $original_name);
		$new_name = sha1("!#$".$original_name."&#$");
		$my_name = $new_name.'.'.end($name_array);	
		$this->ftp->upload($file,'/files/'.$actId.'/prof/'.$my_name, 'auto', 0775);
		// $this->photos_mod->upload($original_name, $my_name, $actId, '/files/prof/'.$my_name);
		$this->photos_mod->setphoto($actId, '/files/'.$actId.'/prof/'.$my_name);
		$data['file'] = $file;
		
		$this->ftp->close();
		redirect('/settings/photo');
    }  

    function delete(){
    	$config['hostname'] = 'enisey5.beget.ru';
 		$config['username'] = 'g911021a_root';
 		$config['password'] = 'root123';
		$config['debug']    = TRUE;
		$this->ftp->connect($config);
        $actId = $this->getActUser();

		$path = '';
    	$actId = $this->getActUser();
    	$id_photo = $this->input->get('id');
		$this->ftp->chmod('/files/', 0777);
		$result = $this->photos_mod->allPhotos($actId);

		foreach($result as $photo){
			if($id_photo==$photo->id){
				$path = $photo->path;
				$this->ftp->delete_file($path);
				break;
			}
		}
    	$this->photos_mod->delete($id_photo);
		$this->ftp->close();
		redirect('/photos'); 
    }  
}
?>