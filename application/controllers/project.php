<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Project extends CI_Controller{
	
	function __construct(){
		parent::__construct();

 		$array = array(
		   'project/project_model' => 'project_model',
		   'user/user_model' => 'user_model'
		);

		foreach($array as $key => $value){
			$this->load->model($key, $value);
		}


	}

	public function list_project(){

	     $this->load->view('templates/header');	
	     $this->load->view('templates/adminsidebar');	
	     $this->load->model('project/project_model');
		 $result['listproject'] =  $this->project_model->list_projects();

		 if(count($result) > 0){
		 //	print_r($result);
		    $this->load->view('project/listproject', $result);

		 }


		 $this->load->view('templates/footer');

		 return $result;
	}

	public function get_by_projectname($projectname){
			echo $projectname;
	}

	public function list_project_json(){

		 $result =  $this->project_model->list_projects();
		 header('Content-Type: application/json');
   		 echo json_encode( $result );
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
 		 $this->load->view('templates/adminsidebar');
		 


		$data['get_projects'] = $this->project_model->list_projects();
		$data['get_users'] = $this->user_model->list_users();

		$this->load->view('project/assignproject', $data);

		$this->load->view('templates/footer');
	}

	public function assign_project_save(){
		 
		$this->load->view('templates/header');	
 		$this->load->view('templates/adminsidebar');

		$data['projectname'] = $this->input->post('projects');
		$data['username'] = $this->input->post('users');

		$result = $this->project_model->assign_project($data);
		$message['result'] = "Project has been assigned to the user";

		if($result > 0){
		
			$this->load->view('project/assignproject', $message);
		}

		$this->load->view('templates/footer');
		}

		public function create_task(){
			
			$data['taskname'] = $this->input->post('taskname');
			$data['startdate'] = $this->input->post('startdate');
			$data['enddate'] = $this->input->post('enddate');
			$data['status'] = $this->input->post('status');
			$data['percentage'] = $this->input->post('percentage');
			$data['projecthiddenid'] = $this->input->post('projecthiddenid');
			
			$this->form_validation->set_rules('taskname', 'Task name', 'required');
			$this->form_validation->set_rules('startdate', 'Start date', 'required');
			$this->form_validation->set_rules('enddate', 'End date', 'required');
			$this->form_validation->set_rules('status', 'Status', 'required');
			$this->form_validation->set_rules('percentage', 'Percentage Completed', 'required');
			$this->form_validation->set_rules('projecthiddenid', 'ProjectID', 'required');

			if ($this->form_validation->run() == TRUE){
				$result = $this->project_model->get_tasks_by_project($data);
				echo json_encode($result);
			}else{
				$this->load->view('user/home');
				validation_errors(); 				
			}
		/*	
			if(empty($result)){
				$result['message'] = "No tasks for project created";
			}*/
			//header('Content-Type: application/json');
   		 	
			//$result = $this->project_model->assign_project($data);
		//	return json_encode($data);
		}

		public function list_tasks(){
			$data['projectname'] = $this->input->post('projectname');
			$result = $this->project_model->list_tasks_for_project($data);
			echo json_encode($result);
		}

		public function create_activity(){

		$data['taskid'] = $this->input->post('taskid');
		$data['projectid'] = $this->input->post('projectid');
		$data['ActivityDescription'] = $this->input->post('ActivityDescription');
		$data['completeddate'] = $this->input->post('completeddate');
		$data['durationworked'] = $this->input->post('durationworked');

		$result['message'] = $this->project_model->create_activity($data);
		if($result['message'] == 1){
			$result['message'] = "Successfully created Activity";
		}else{
			$result['message'] = "Did not successfully create a message";
		}
			echo json_encode($result);
		//echo json_encode($result);


			//$data['']
		//	 $this->load->view('templates/header');	
		//	 $this->load->view('templates/footer');

		}

		public function list_project_tasks(){
	
			$taskid  = $this->input->post('taskid');
			$result = $this->project_model->list_project_tasks_Activity($taskid);
			echo json_encode($result);
		}
	}