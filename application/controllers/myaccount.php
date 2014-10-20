<?php
class Myaccount extends CI_Controller {

	public function index() {

		self::view();

	}

	public function view() {

		if ($this->session->userdata('user'))

			echo $this->uri->segment(3);

		else redirect(base_url(), 'location');

	}

	public function logout() {

		$this->session->unset_userdata('user');
		$data['view'] = "login";
		$this->load->view('templates/unauth', $data);

	}

}