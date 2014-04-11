<?php

define('PROJECT_TABLE', 'tbl_project');
class Project_model extends CI_Model{

	function __construct(){
		parent::__construct();
	}

	public function create($data=array()){

	    return $this->db->insert(PROJECT_TABLE, $data);

	}

	public function list_projects(){
		$query =  $this->db->get(PROJECT_TABLE);
		return $query->result();
	}
}