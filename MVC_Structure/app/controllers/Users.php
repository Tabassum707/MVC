<?php
class Users extends Controller {
    private $userModel;
    public function __construct() {
       
        #search for file name User
        $this->userModel = $this->model('User');
    }

    

    public function register() {
        $data = [
            'username' => '',
            'email' => '',
            'password' => '',
            'confirmPassword' => '',
            'usernameError' => '',
            'emailError' => '',
            'passwordError' => '',
            'confirmPasswordError' => '',
            'contact' => '',
            'contactError' => '',
            'NID' => '',
            'NIDError' => '',
          //  'bloodtype' => '',
            //'Location' => ''
            //'Eligibility' => ''
            //'Religion' => ''
            'age' => '',
            'ageError' => '',
            'gender' => '',
            'genderError'=>''

        ];

      if($_SERVER['REQUEST_METHOD'] == 'POST'){
        // Process form
        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            #trim removes white space
              $data = [
                'username' => trim($_POST['username']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirmPassword' => trim($_POST['confirmPassword']),
                'NID' => trim($_POST['NID']),
                'contact' => trim($_POST['contact']),
                'age' => trim($_POST['age']),
                'gender' => trim($_POST['gender']),
                'usernameError' => '',
                'emailError' => '',
                'passwordError' => '',
                'confirmPasswordError' => '',
                'NIDError' => '',
                'contactError' => '',
                'ageError' => '',
                'genderError' =>''
            ];

            $nameValidation = "/^[a-zA-Z0-9]*$/";
            

            //Validate username on letters/numbers
            if (empty($data['username'])) {
                $data['usernameError'] = 'Please enter username.';
            } elseif (!preg_match($nameValidation, $data['username'])) {
                $data['usernameError'] = 'Name can only contain letters and numbers.';
            }

            //Validate email
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter email address.';
            } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $data['emailError'] = 'Please enter the correct format.';
            } else {
                //Check if email exists.
                if ($this->userModel->findUserByEmail($data['email'])) {
                $data['emailError'] = 'Email is already exists!';
                }
            }

           // Validate password on length, numeric values,
            if(empty($data['password'])){
              $data['passwordError'] = 'Please enter password.';
            } elseif(strlen($data['password']) < 6){
              $data['passwordError'] = 'Password must be at least 6 characters';
            }

            //validate NID
            if(empty($data['NID'])){
              $data['NIDError'] = 'Please enter NID.';
            } elseif(strlen($data['NID']) < 11){
              $data['NIDError'] = 'NID must be at least 11 characters';
            }

            //validate Contact
            if(empty($data['contact'])){
              $data['contactError'] = 'Please enter Contact.';
            } elseif(strlen($data['contact']) < 11){
              $data['contactError'] = 'Contact must be at least 11 characters';
            }

            //Validate confirm password
             if (empty($data['confirmPassword'])) {
                $data['confirmPasswordError'] = 'Please enter password.';
            } else {
                if ($data['password'] != $data['confirmPassword']) {
                $data['confirmPasswordError'] = 'Passwords do not match, please try again.';
                }
            }

            // Make sure that errors are empty
            if (empty($data['usernameError']) && empty($data['emailError']) && empty($data['passwordError']) && empty($data['confirmPasswordError']) && empty($data['NIDError']) && empty($data['contactError']) && empty($data['ageError'])) {

                // Hash password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register user from model function
                if ($this->userModel->register($data)) {
                    //Redirect to the login page
                    header('location: ' . URLROOT . '/users/login');
                } else {
                    die('Something went wrong.');
                }
            }
        }
        $this->view('users/register', $data);
    }

    public function login() {
        $data = [
            'title' => 'Login page',
            'email' => '',
            'password' => '',
            'emailError' => '',
            'passwordError' => ''
        ];
        //$this->view('users/login', $data);

        //Check for post
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            //Sanitize post data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'emailError' => '',
                'passwordError' => '',
            ];
            //Validate username
            if (empty($data['email'])) {
                $data['emailError'] = 'Please enter a email';
            }

            //Validate password
            if (empty($data['password'])) {
                $data['passwordError'] = 'Please enter a password.';
            }

            //Check if all errors are empty
            if (empty($data['emailError']) && empty($data['passwordError'])) {
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    $this->createUserSession($loggedInUser);
                } else {
                    $data['passwordError'] = 'Password or email is incorrect. Please try again.';

                    $this->view('users/login', $data);
                }
            }

        } else {
            $data = [
                'email' => '',
                'password' => '',
                'emailError' => '',
                'passwordError' => ''
            ];
        }
        $this->view('users/login', $data);
    }

    public function createUserSession($user) {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['username'] = $user->username;
        $_SESSION['email'] = $user->email;
        header('location:' . URLROOT . '/home');
        /*redirect('pages/homepage');*/
    }

    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['username']);
        unset($_SESSION['email']);
        header('location:' . URLROOT . '/users/login');
    }
}
