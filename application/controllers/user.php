<?php

class User extends CI_Controller{

    public function __construct(){
    	parent::__construct();
    	$this->load->library('javascript');
    }
	
	public function registration(){
		$this->load->view('templates/header');		
		$this->load->view('user/registration');
		$this->load->view('templates/footer');
	}

	public function index(){
		$this->load->view('templates/header');	
		$this->load->view('templates/footer');	
	}

	public function signup() {

	    $data = array(
	    	    'col_username' => $this->input->post('username'), 
	    	    'col_firstname' => $this->input->post('firstname'), 
	    	    'col_lastname' => $this->input->post('lastname'),
	    	    'col_emailaddress' => $this->input->post('emailaddress'),
	    	    'col_password' => $this->input->post('password'));

        $this->load->view('templates/header');	
		$this->load->model("user/user_model");
		$result = $this->user_model->register($data);
		 if($result == 1){
		 	$send['result'] = "User successfully registered";
		 	$this->load->view('login', $send);
		 }
		$this->load->view('templates/footer');
    	//echo "Signing up!";
	}
		public function login_page(){

		  $this->load->view('templates/header');	
		  $this->load->view('login');
		  $this->load->view('templates/footer');

	}

	public function login(){

		 $this->load->view('templates/header');	
		 
		 if($this->input->post('submit')==TRUE){

			 $data['username'] = $this->input->post('username');
			 $data['password'] = $this->input->post('password');

			 $this->load->model("user/user_model");

			 $result = $this->user_model->login($data);
	
		     $this->load->view('user/home', $result[0]);
		     $this->load->view('templates/usersidebar');
		    
			
		 }
		 $this->load->view('templates/footer');
	
	/*    if ($this->input->post('submit')==true) {
	    	echo "Received submit";
	    }
		  $this->load->view('templates/header');	
		  $this->load->model("user/user_model");
		 $result = $this->user_model->login($data);
		 $this->load->view('templates/footer');
*/
	}
}