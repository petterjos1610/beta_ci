<?php
class Myaccount extends CI_Controller {

	public function view() {

		print_r($this->session->userdata);
		if ($this->session->userdata('user'))
			echo $this->uri->segment(3);
		else echo "not logged in";

	}

	public function logout() {

		$this->session->unset_userdata('user');
		$data['view'] = "login";
		$this->load->view('templates/unauth', $data);

	}

}