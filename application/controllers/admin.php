<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller{

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
	public function index(){

	}
}