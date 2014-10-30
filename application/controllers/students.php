<?php
class Students extends CI_Controller {
	
	public function index() {

		self::view();

	}

	public function view($ignore = NULL, $id = 0) {

		if ($this->session->userdata('user')) {
			
			$this->load->model('student');
			if ($id === 0) {

				$data = array(
					'students' => $this->student->getStudents(),
					'view' => 'students/list.php'
				);
				$this->load->view('templates/auth', $data);

			} else {

				$data = array(
					'student' => $this->student->getStudent($id),
					'view' => 'students/profile.php',
					'client' => $this->client
				);
				$this->load->view('templates/auth', $data);

			}

		} else redirect(base_url(), 'location');

	}

	public function edit($ignore = NULL, $id) {

		if ($this->session->userdata('user')) {

			if (isset($id)) {

				$this->load->model('student');
				$data = array(
					'student' => $this->student->getStudent($id),
					'view' => 'students/edit.php'
				);
				$this->load->view('templates/auth', $data);

			}

		} else redirect(base_url(), 'location');

	}

	public function create($ignore = NULL) {

		if ($this->session->userdata('user')) {

			$data = array(
				'view' => 'students/edit.php'
			);
			$this->load->view('templates/auth', $data);

		} else redirect(base_url(), 'location');

	}

}