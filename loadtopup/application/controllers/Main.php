<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {

	public function index() {
		if($this->session->userdata('isLoggedIn') == true) {
			header("location:/Main/dashboard");
		}
		$this->load->view('login');
	}

	public function signup() {
		$this->load->view('signup');
	}

	public function login() {
		$email 	= sanitize($this->input->post('email'));
		$pass 	= sanitize($this->input->post('pass'));	

		$getLogin = $this->model->getLogin($email, $pass);

		if($getLogin->num_rows() == 1) { // logged in
			$userObj = $getLogin->row();
			$userData = array(
		        'email'  		=> $userObj->email,
		        'firstname'     => $userObj->firstname,
		        'lastname'     	=> $userObj->lastname,
		        'mobile'		=> $userObj->mobile,
		        'isLoggedIn' 	=> true
			);

			$this->session->set_userdata($userData);

			$data = array(
				'success' => 1
			);
		}else {
			$data = array(
				'success' => 0,
				'$email' => $email,
				'$pass' => $pass
			);
		}
		
		generate_json($data);
	}

	public function isLoggedIn() {
		if($this->session->userdata('isLoggedIn') == false) {
			header("location:/");
		}
	}

	public function dashboard() {
		$this->isLoggedIn();
		$data = array(
			'networks' => $this->model->getLoadAllNetwork()->result(),
			'amounts' => $this->model->getLoadAllAmounts()->result()
		);
		$this->load->view('dashboard', $data);
	}

	public function signupUser() {
		$email 		= sanitize($this->input->post('email'));
		$pass 		= sanitize($this->input->post('pass'));
		$fname 		= sanitize($this->input->post('fname'));
		$lname 		= sanitize($this->input->post('lname'));
		$mobile 	= sanitize($this->input->post('mobile'));
		$address 	= sanitize($this->input->post('address'));

		$checkEmailExist = $this->model->getCheckEmailExist($email);

		if($checkEmailExist->row()->emailCount) {
			$data = array(
				'success' => 0
			);
		}else {
			$getSignup = $this->model->getSignup($email, $pass, $fname, $lname, $mobile, $address);

			$data = array(
				'success' => 1
			);
		}

		generate_json($data);
	}

	public function logout() {
		$this->session->sess_destroy();

		$data = array(
			'success' => 1
		);

		generate_json($data);
	}

	public function networkPrefix() {
		$networkId = sanitize($this->input->post('networkId'));

		$getNetworkPrefix = $this->model->getNetworkPrefix($networkId);

		$data = array(
			'result' => $getNetworkPrefix->result()
		);

		generate_json($data);
	}
}
