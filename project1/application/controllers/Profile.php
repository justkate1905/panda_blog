<?php 
class Profile extends MY_Controller{
	function __construct()
    {
        parent::__construct();
        // $this->check();   
    }
    function index(){
        $this->checkguest();
        $data = [];
        $result = $this->auth_mod->getUsers();
        $user1 = $this->profile_mod->getUser($this->getActUser()); 
        $users = array();
        foreach($result as $us){
            $users[] = $us->id;
        }
        if ($this->getUser() == $this->uri->segment(2)) {
            if(!in_array($this->getUser(),$users))
                redirect('/deleted');
        }
        // else{
        //     if(!in_array($this->getUser(),$users)){
        //     $this->session->unset_userdata('myuser');
        //     show_404('page');
        // }
        // }
        $fav = array();
        $favourite = $this->profile_mod->favourites($this->getActUser());
        foreach($favourite as $f){
            $fav[] = $f->id_post;
        }
        $user = $this->profile_mod->getUser($this->getUser()); 
        $actId = $this->getActUser();
        $data['blog'] = $this->profile_mod->getPost($user->id); 
        $data['fav'] = $fav;
        $data['login'] = $user->login;
        $data['user_id'] = $user->id;
        $data['actId'] = $actId;
        $data['actdate'] = $user->activity_date;
        $data['is_follower'] = $this->profile_mod->isFollow( $this->session->userdata('myuser'),$this->getUser()); 
        $data['status'] = $user1->privileges;
        $data['prof_photo'] = $user->profile_photo;
        $this->load->view('head');
    	$this->load->view('profile',$data);
    	$this->load->view('footer');
    }

    function checkguest(){
        $exist = array();
        $users = $this->profile_mod->allusers();
        foreach($users as $user){
            $exist[] = $user->id;
        }
        if ($this->getUser()==$this->uri->segment(2)&&!($this->uri->segment(3))&&!isset($this->session->userdata['myuser'])) {
            if (!in_array($this->getUser(), $exist)) {
                redirect('/deleted');
            }
            if($this->uri->segment(2)!='follows'&& $this->uri->segment(2)!='favourites'&&$this->uri->segment(2)!='news'&&$this->uri->segment(2)!='photos')
            redirect('/guest?url='.$this->uri->segment(2));
        }
    }
    function follows(){
        $this->check();
        $data = [];
        $user = $this->profile_mod->getUser($this->getActUser()); 
        $data['login'] = $user->login;
        $result = $this->follows_mod->getFollow($this->getActUser());
        $follows = array();
        $follow_id = array();
        foreach($result as $follow){
            $follows[] = $follow->login;
            $follow_id[] = $follow->id_user;
        }
        $data['follows'] = $follows;
        $data['follows_id'] = $follow_id;
        $data['prof_photo'] = $user->profile_photo;
        //$data['follows'] = 
        $this->load->view('head');
        $this->load->view('nav');
        $this->load->view('aside',$data);

        $this->load->view('follows',$data);
        $this->load->view('footer');
    }
    function news(){
        $this->check();
        $news = $this->profile_mod->followpost($this->getActUser());
        $data['news'] = $news;
        //$data['follows'] = 
        $this->load->view('head');
        $this->load->view('nav');
        $this->load->view('news',$data);
        $this->load->view('footer');
    }

    function favourites(){
        $this->check();
        $fav = array();
        $favourite = $this->profile_mod->favourites($this->getActUser());
        foreach($favourite as $f){
            $fav[] = $f->id_post;
        }
        $user = $this->profile_mod->getUser($this->getActUser()); 
        $data['login'] = $user->login;
        $posts = $this->profile_mod->favourites($this->getActUser());
        $data['posts'] = $posts;
        $data['fav'] = $fav;
        $data['prof_photo'] = $user->profile_photo;

        $this->load->view('head');
        $this->load->view('nav');
        $this->load->view('aside',$data);
        
        $this->load->view('favourites',$data);
        $this->load->view('footer');
    }

    function logout(){
        $this->session->unset_userdata('myuser');
        redirect('/auth');
    }

    function addFollow() {          
            $followerID = $this->input->post('follower_id');            
            $this->follows_mod->addFollow($this->getActUser(), $followerID);            
    }   
}
?>