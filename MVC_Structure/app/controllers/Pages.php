<?php
class Pages extends Controller {
    public function __construct() {
        //$this->userModel = $this->model('User');
    }

    public function index() {
        $data = [
            'title' => 'Blood Donation Management System'
        ];

        $this->view('index', $data);
    }

    public function about() {
        $data = [
            'title' => 'About',
            'description'=>'CSE470 Project',
                        
        ];
       
       $this->view('pages/about',$data);
       # echo "About";
    }

    public function contact(){
        $data=['title' => 'Contact Information'
    ];

     $this->view('pages/contact',$data);


    }

    public function home(){
        $data=['title' => 'Welcome!'
    ];

     $this->view('home',$data);


    }

  /*  public function donorProfile(){
        $data=['title' => 'Your Profile'
    ];

     $this->view('pages/donorProfile',$data);


    }*/
}
?>