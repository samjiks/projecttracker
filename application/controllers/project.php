<?php

class Project extends CI_Controller{
	
	function __construct(){
		parent::__construct();
	}

	public function list_project(){

	     $this->load->view('templates/header');	
		 $this->load->view('templates/footer');
	}

	public function create_project(){

	     $this->load->view('templates/header');	
	     $this->load->view('project/create');
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