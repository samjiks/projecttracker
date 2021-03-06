<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class User extends CI_Controller{
    public $USER;
    public function __construct(){
    	parent::__construct();
    	$this->load->library('session');
    	$array = array(
		   'project/project_model' => 'project_model',
		   'user/user_model' => 'user_model'
		);

		foreach($array as $key => $value){
			$this->load->model($key, $value);
		}
	$this->form_validation->set_error_delimiters('<p class="alert">', '</p>');
    }

    public function admin(){

	     $this->load->view('templates/header');	
	     $this->load->view('login');
		 $this->load->view('templates/footer');

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
		//GLOBAL $USER;

	    $data = array(
	    	    'col_username' => $this->input->post('username'), 
	    	    'col_firstname' => $this->input->post('firstname'), 
	    	    'col_lastname' => $this->input->post('lastname'),
	    	    'col_emailaddress' => $this->input->post('emailaddress'),
	    	    'col_password' => $this->input->post('password'),
	    	    'role' => 'user');


		$this->form_validation->set_rules('username', 'User name', 'required|callback_username_exists');
		$this->form_validation->set_rules('firstname', 'First name', 'required');
		$this->form_validation->set_rules('lastname', 'Last name', 'required');
		$this->form_validation->set_rules('emailaddress', 'Email Address', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required|matches[cpassword]');
		$this->form_validation->set_rules('cpassword', 'Confirm Password', 'required|matches[password]');

		if ($this->form_validation->run() == FALSE){
				$this->load->view('templates/header');	
				$this->load->view('user/registration');
				$this->load->view('templates/footer');
		}else{
			$this->load->view('templates/header');	
			$this->load->model("user/user_model");
			$result = $this->user_model->register($data);
			
			 if($result == 1){
			 	$send['result'] = "User successfully registered";
			 	$this->load->view('login', $send);
			}
			$this->load->view('templates/footer');
		}


    	//echo "Signing up!";
	}
	public function login_page(){
		  
		  $this->load->view('templates/header');	
		  $this->load->view('login');
		  $this->load->view('templates/footer');

	}

	public function logout_page(){

		  $this->load->view('templates/header');
		 // echo $session =  $this->input->post('session_id';	

		  $this->load->view('login');
  		  $this->session->unset_userdata('session_id');
		  $this->load->view('templates/footer');

	}


	public function login(){

		 $this->load->view('templates/header');	
		 
		 if($this->input->post('submit')==TRUE){

			 $data['username'] = $this->input->post('username');
			 $data['password'] = $this->input->post('password');

				 $this->load->model("user/user_model");

				 $result = $this->user_model->login($data);
				 
				 $role = $result[0]->role;
		
			 if(count($result) > 0 && $role == 'user'){
			 	//print_r($result[0]->col_username);
				 $USER['col_username'] = $result[0]->col_username;

				 $USER['projectlist'] = $this->get_project_username($result[0]->col_username);
		
				 $this->session->set_userdata('username', $USER);
    			 $this->load->view('templates/usersidebar');
		    	 $this->load->view('user/home', $USER);
		    	// print_r($this->session->all_userdata());
			}else if(count($result) > 0 && $role == 'admin'){
				 $USER['col_username'] = $result[0]->col_username;
				 $USER['projectlist'] = $this->get_project_username($result[0]->col_username);
				 $this->session->set_userdata('username', $USER);
    			 $this->load->view('templates/adminsidebar');
    			 $this->load->view('admin/admin', $USER);
		    	

		     }else{
		        	$data['result'] = "No such username or password";
			   		 $this->load->view('login', $data);

		     }
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

	public function create_task(){
		
		  $this->load->view('templates/header');	
		  $this->load->view('templates/usersidebar');
		  $this->load->view('user/home');
		  $this->load->view('templates/footer');	
		 
		 
	}

	function get_project_username($username){

	 	 $result = $this->project_model->get_project_by_username($username);
	 	 return $result;
	 	/* header('Content-Type: application/json');
   		 echo json_encode( $result );*/
	 	 //return json_encode($result);
	//	 $this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	function username_exists($username){
		$exists = $this->user_model->check_username_exists($username);
		if($exists > 0){
			
		}
	}


}