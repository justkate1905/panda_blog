<?php 
class About extends MY_Controller{
    function __construct(){
        parent::__construct();
        $this->check();
    }

    function index(){
        $user = $this->profile_mod->getUser($this->input->get('url')); 
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
            'id'=>$this->input->get('url'),
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
            'countries'=>$countries,
            'values'=>$values,
            'city_name'=>$city,
            'id_city'=>$id_city,
            'city_country'=>$city_country,
            'prof_photo'=> $user->profile_photo

            ); 
        $this->load->view('head');
        $this->load->view('nav');
        $this->load->view('aside',$data);
        $this->load->view('aboutuser',$data);
        $this->load->view('footer');
    }
    }

?>