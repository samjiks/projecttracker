<?php

class Project extends CI_Controller{
	
	function __construct(){
		parent::__construct();

	}

	public function list_project(){

	     $this->load->view('templates/header');	
	     $this->load->model('project/project_model');
		 $result =  $this->project_model->list_projects();

		 if(count($result) > 0){
		 	$i =0;
		  foreach ($result as $value){
		 	 echo  $value[$i];
		 	 $i++;
		 
		 }
		 }


		 $this->load->view('templates/footer');
	}

	public function create_project(){

	     $this->load->view('templates/header');	
	     $data['col_username'] = "admin";
	     $this->load->view('user/home', $data);
	     $this->load->view('templates/adminsidebar');
	     $this->load->view('project/create');
		 $this->load->view('templates/footer');

	}

	public function create_project_submit(){

		

	     $this->load->view('templates/header');	
	     $this->load->view('templates/adminsidebar');
	     if($this->input->post('submit') == TRUE){

	     	 $data =  array('col_projectname' => $this->input->post('projectname'),
	     	 				'col_projectdescription' => $this->input->post('projectdescription'));

		 	 $this->load->model('project/project_model');
		 	 $result =  $this->project_model->create($data);
		 
		 	 if($result == 1){
		 		$send['result'] = "Project Successfully created";
		 		$this->load->view('project/create', $send);
			 }
		 }
		 $this->load->view('templates/footer');

	}

	public function assign_project(){

 		 $this->load->view('templates/header');	
		 $this->load->view('templates/footer');
	}

	public function create_task(){

		 $this->load->view('templates/header');	
		 $this->load->view('templates/footer');

	}

	public function create_activity(){

		 $this->load->view('templates/header');	
		 $this->load->view('templates/footer');

	}
}