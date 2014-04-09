<?php

class User extends CI_Controller{
	
	public function registration(){
		$this->load->view('templates/header');
		$this->load->view('user/registration');
		$this->load->view('templates/footer');
	}

	public function submit(){


	}
}