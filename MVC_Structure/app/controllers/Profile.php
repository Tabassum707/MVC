<?php
class Profile extends Controller {

    private $dpprofileModel;
    public function __construct() {
       # private $userModel;
        #search for file name User
        $this->dprofileModel = $this->model('DProfile');
    }

    public function index () {
            
            $profile = $this->dprofileModel->info();

            #var_dump($profile);
            
            $data=[
                'profile' => $profile
            ];

            $this->view('Profile/index',$data);
    }
//update data

    public function history(){

    


        if(!isLoggedIn()){
            header("Location: ".URLROOT."/Profile");
        }
         $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        $data = [
            'user_id' => $_SESSION['user_id'],
            'Smoke'=> trim($_POST['Smoke']),
            'TakeDrugs'=> trim($_POST['TakeDrugs']),
            'SmokeError' => '',
            'DrugError'=>''
        ];
       

       /*  if($_SERVER['REQUEST_METHOD'] == 'POST'){
            die("It works!");
         }*/
         if(empty($data['Smoke'])){
            $data['SmokeError']="Something went wrong";
         }

         if(empty($data['TakeDrugs'])){
            $data['DrugError']="Something went wrong";
         }

         if (empty($data['DrugError']) && empty($data['SmokeError'])){
            if($this->dprofileModel->habit($data)){
                 header("Location: ".URLROOT."/Profile");
             } else{
                die("Something Went Wrong");
             }

         } else {
            $this->view('Profile/history',$data);
         }

        $this->view('Profile/history',$data);

    }
    

    
}