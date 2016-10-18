<?php 
class Settings extends MY_Controller{
	function __construct(){
		parent::__construct();
        $this->check();
	}
	function index(){
		$user = $this->profile_mod->getUser($this->getActUser()); 
        $data['login'] = $user->login;
        $data['status']=$user->privileges;
        $data['prof_photo'] = $user->profile_photo;

        $this->load->view('head');
        $this->load->view('nav');
        $this->load->view('aside',$data);
        $this->load->view('settings',$data);
        $this->load->view('footer');
	}
    function photo(){
        $config['hostname'] = 'enisey5.beget.ru';
        $config['username'] = 'g911021a_root';
        $config['password'] = 'root123';
        $config['debug']    = TRUE;
        $this->ftp->connect($config);
        $this->ftp->chmod('/files/', 0777);
        $user = $this->profile_mod->getUser($this->getActUser()); 
        $actId = $this->getActUser();

        $list = $this->ftp->list_files('/files/');
        // print_r($list);
        if(!in_array('/files/'.$actId, $list)){
            $this->ftp->mkdir('/files/'.$actId, 0777);
            $this->ftp->mkdir('/files/'.$actId.'/prof/', 0777);
        }
 
        $this->ftp->close();
        $user = $this->profile_mod->getUser($this->getActUser()); 
        $data['login'] = $user->login;
        $data['prof_photo'] = $user->profile_photo;

        $this->load->view('head');
        $this->load->view('nav');
        $this->load->view('aside',$data);

        $this->load->view('photo',$data);
        $this->load->view('footer');
    }
	function about(){
        $error ='noth'; 
        if($this->input->post('sendform')){
            if(!empty($this->input->post('password'))&&!empty($this->input->post('password-again'))){

                $pass = sha1("^TY".$this->input->post('password')."D%^&Y");
                $passconf = sha1("^TY".$this->input->post('password-again')."D%^&Y");

                if($pass != $passconf){
                    $error ='match'; 
                }
                else{
                    $info = array(
                        'first_name' => $this->input->post('firstname'),
                        'last_name' => $this->input->post('lastname'),
                        'middle_name' =>  $this->input->post('middlename'),
                        'birthday'=> $this->input->post('birthday'),
                        'email' =>$this->input->post('email'),
                        'gender' =>  $this->input->post('gender'),
                        'country' =>  $this->input->post('country'),
                        'education' => $this->input->post('education'),
                        'city' =>$this->input->post('city'),
                        'hobby' =>  $this->input->post('hobby'),
                        'about_user' => $this->input->post('about'),
                        'password'=> $pass
                        );
                    $this->settings_mod->save($info,$this->getActUser()); 
                    $error = 'hello';

                }
            }
        else{
                $info = array(
                    'first_name' => $this->input->post('firstname'),
                    'last_name' => $this->input->post('lastname'),
                    'middle_name' =>  $this->input->post('middlename'),
                    'birthday'=> $this->input->post('birthday'),
                    'email' =>$this->input->post('email'),
                    'gender' =>  $this->input->post('gender'),
                    'country' =>  $this->input->post('country'),
                    'education' => $this->input->post('education'),
                    'city' =>$this->input->post('city'),
                    'hobby' =>  $this->input->post('hobby'),
                    'about_user' => $this->input->post('about'),
                    );
                $this->settings_mod->save($info,$this->getActUser()); 
                $error = 'one';
            }
        }
        $user = $this->profile_mod->getUser($this->getActUser()); 
        $result = $this->settings_mod->location();
        $cities = $this->settings_mod->cities();
        $city = array();
        $id_city = array();
        $city_country = array();
        $countries = array();
        $values = array();
        foreach($result as $country){
            $values[] = $country->id;
            $countries[] = $country->country;
        }
        foreach($cities as $res){
            $city[] = $res->name;
            $id_city[] = $res->id;
            $city_country[] = $res->country;
        }
        $data = array(
            'login'=>$user->login,
            'firstname'=>$user->first_name,
            'lastname'=>$user->last_name,
            'middlename'=>$user->middle_name,
            'email'=>$user->email,
            'gender'=>$user->gender,
            'birthday'=>$user->birthday,
            'hobby'=>$user->hobby,
            'education'=>$user->education,
            'about'=>$user->about_user,
            'country'=>$user->country,
            'city'=>$user->city,
            'prof_photo' => $user->profile_photo,
            'countries'=>$countries,
            'values'=>$values,
            'city_name'=>$city,
            'id_city'=>$id_city,
            'city_country'=>$city_country,
            'error'=>$error
            );
        $this->load->view('head');
        $this->load->view('nav');
        $this->load->view('aside',$data);
        
        $this->load->view('about',$data);
        $this->load->view('footer');
    }

}

?>