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
   				$data['projectid'] = $row->col_projectid; 
   				
			}
		}

		if($user_query->num_rows() > 0){
			foreach ($user_query->result() as $row){
   				$data['userid'] = $row->col_userid;
			}
		}
		echo "USER ID".$data['userid'];
		echo "PROJECT ID".$data['projectid'];
		$this->db->set('col_userid',$data['userid']);
		$this->db->set('col_projectid',$data['projectid']);
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
			$query = $this->db->query("select col_projectname from tbl_project where col_projectid in (select col_projectid from tbl_projectuserassign where col_userid in (select col_userid from tbl_userregistration where col_username='".$this->db->escape_str($col_username)."'))");    
			return $query->result_array();
		/*	if($project_query->num_rows() > 0){
				foreach ($project_query->result() as $value) {
				  echo $value->col_projectname;
				}	  
			}*/

		//	return project_query->result();
			//return $project_query->result_array();
	}

	function get_tasks_by_project($data=array()){
		
		$taskname = $data['taskname'];
		$startdate = $data['startdate'];
		$enddate = $data['enddate'];
		$status = $data['status'];
		$projectname = $data['projecthiddenid'];
		$percentage = $data['percentage'];
		
		//echo $compileddate = STR_TO_DATE($startdate, '%d-%m-%Y');
		$getprojectid = $this->db->query("select col_projectid from tbl_project where col_projectname='$projectname'");
		
		$query = $this->db->query("Insert into tbl_projecttasks (col_projectid, col_taskname, col_startdate, col_enddate, col_statustasks, col_percentage_complete) VALUES ('".$this->db->escape_str($getprojectid->row()->col_projectid)."', '$taskname', '$startdate', '$enddate', '$status', '$percentage')");

		//echo $getprojectid;
		$gettasksname = $this->db->query("Select col_taskname from tbl_projecttasks where col_projectid='".$this->db->escape_str($getprojectid->row()->col_projectid)."'");

		return $gettasksname->result_array();
		//$query = $this->db->query("Insert into col_projecttasks (col_projectid, col_taskname, col_startdate, col_enddate, col_statustasks, col_percentage_complete) VALUES (col_projectid, $taskname, $startdate, $enddate, $status, $percentage) select col_projectid from tbl_project where col_projectname='$projectname'")
		/*$this->db->set('name', $name);
		$this->db->set('title', $title);
		$this->db->set('status', $status);*/
	}

	function list_tasks_for_project($projectname=array()){
		$project = $projectname['projectname'];
		$getprojectid = $this->db->query("select col_projectid from tbl_project where col_projectname='$project'");

		$gettasksname = $this->db->query("Select * from tbl_projecttasks where col_projectid='".$this->db->escape_str($getprojectid->row()->col_projectid)."'");

		return $gettasksname->result_array();

	}
}