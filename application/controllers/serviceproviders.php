<?php
class Serviceproviders extends CI_Controller {
	
	public function index() {

		self::view();

	}

	public function view($ignore = NULL, $id = 0) {

		if ($this->session->userdata('user')) {

			$this->load->model('serviceprovider');
			if ($id === 0) {

				$data = array(
					'serviceproviders' => $this->serviceprovider->getServiceProviders(),
					'view' => 'serviceproviders/list.php'
				);
				$this->load->view('templates/auth', $data);

			} else {

				$data = array(
					'serviceproviders' => $this->serviceprovider->getServiceProvider($id),
					'view' => 'serviceproviders/edit.php'
				);
				$this->load->view('templates/auth', $data);

			}

		} else redirect(base_url(), 'location');

	}

}