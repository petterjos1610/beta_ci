<?php
class Register_sp extends CI_Controller {
	
	public function index() {

		$data['view'] = 'serviceproviders/serviceprovider.application.form.php';
		$this->load->view('templates/unauth', $data);

	}

	public function findme() {

		$this->load->view('serviceproviders/serviceprovider.application.form.process.php');

	}

	public function checklist() {

		$this->load->view('serviceproviders/serviceprovider.application.form.process.step2.php');

	}

	public function submit() {

		$this->load->view('serviceproviders/serviceprovider.application.form.process.step3.php');

	}

}