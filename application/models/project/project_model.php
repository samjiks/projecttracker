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
		return $query->result_array();
	}

	public function assign_project($data=array()){
		$projectname =  $data['projectname'];
		$username = $data['username'];
		$project_query = $this->db->query("select col_projectid from tbl_project where col_projectname = '$projectname'");
		$user_query = $this->db->query("select col_userid from tbl_userregistration where col_username = '$username'");

		//$this->db->select('col_projectid')->from(PROJECT_TABLE)->where('col_projectname', $projectname);
		$data = array();
		if($project_query->num_rows() > 0){
			foreach ($project_query->result() as $row){
   				$data[] = $row->col_projectid; 
   				
			}
		}

		if($user_query->num_rows() > 0){
			foreach ($user_query->result() as $row){
   				$data[] = $row->col_userid;
			}
		}
		$this->db->set('col_userid',$data[1]);
		$this->db->set('col_projectid',$data[0]);
		$this->db->insert('tbl_projectuserassign'); 
		
		$num = $this->db->affected_rows();
		
		if($num > 0){
			return $num;
		}

    //	$insert_sql = "INSERT into tbl_projectuserassign (col_userid, col_projectid) VALUES (?,?)"; 
	//	$insert_query = $this->db->query($insert_sql, array($data[0], $data[1]);

		//$num_rows = $insert_query->affected_rows();

		//echo $num_rows; 

		//$query = $this->db->get();
        //echo $query->result_array();
	}

	function get_project_by_username($col_username){
			$project_query = $this->db->query("select col_projectname from tbl_project where col_projectid in (select col_projectid from tbl_projectuserassign where col_userid in (select col_userid from tbl_userregistration where col_username='samjiks'))");    
			
			if($project_query->num_rows() > 0){
			    echo $project_query->result();
			}

		//	return project_query->result();
			//return $project_query->result_array();
	}
}