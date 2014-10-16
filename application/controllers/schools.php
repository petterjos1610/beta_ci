<?php
class Schools extends CI_Controller {
	
	public function index() {

		self::view();

	}

	public function view($ignore = NULL, $urn = 0) {

		if ($this->session->userdata('user')) {

			$this->load->model('school');
			if ($urn == 0) {

				// View all Schools
				$schools = $this->school->getSchools();
				$data = array(
					'schools' => $schools,
					'view' => 'schools/list.php'
				);
				$this->load->view('templates/auth', $data);

			} else {

				// View school where id = $id
				if ($school = $this->school->getSchool($urn)) {

					$data = array(
						'school' => $school,
						'view' => 'schools/edit.php',
						'p' => $this->uri->segment(1)
					);
					$this->load->view('templates/auth', $data);

				}

			}

		}

	}

	public function create() {

		$data = array(
			'view' => 'schools/edit.php',
			'p' => $this->uri->segment(1)
		);
		$this->load->view('templates/auth', $data);

	}

}