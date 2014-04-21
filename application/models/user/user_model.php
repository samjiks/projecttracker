<?php

define('REGISTRATION_TABLE', 'tbl_userregistration');

class User_model extends CI_MODEL{
/*	var username = '';
	var firstname = '';
	var lastname = '';
	var emailaddress = '';
	var password = '';*/

	function __construct(){
		parent::__construct();
	}

	public function register($data=array()){
		
        return $this->db->insert(REGISTRATION_TABLE, $data);
	}

	public function login($data=array()){

        $username = $data['username'];
        $password =  $data['password'];
  		// $this->db->select('*');
        $this->db->select('col_username, col_password, role');
		$this->db->from(REGISTRATION_TABLE);
		$this->db->where('col_username', $username);
		$this->db->where('col_password', $password);
	
		$query = $this->db->get();
		return $query->result();
	
	}

	public function list_users(){
		$this->db->select('col_username');
		$this->db->from(REGISTRATION_TABLE);
		$query = $this->db->get();
		return $query->result_array();
	}

	function check_username_exists($username){
		$query = $this->db->query("select exists (select 1 from tbl_userregistration WHERE col_username = '".$username."')");
		//print_r($query->result());
		echo $result = $query->num_rows();

		if($query->num_rows() > 0){
			return $result;
		}
	    /*$this->db->select('col_username');
		$this->db->from(REGISTRATION_TABLE);
		$this->db->where('col_username', $username);
		
		$query = $this->db->get();
		
		return $query->result_array();*/
	}
}