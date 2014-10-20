<?php
class Students extends CI_Controller {
	
	public function index() {

		self::view();

	}

	public function view($ignore = NULL, $id = 0) {

		if ($this->session->userdata('user')) {
			
			$this->load->model('student');
			if ($id === 0) {

				$students = $this->student->getStudents();
				$data = array(
					'students' => $students,
					'view' => 'students/list.php'
				);
				$this->load->view('templates/auth', $data);

			} else {

				$student = $this->student->getStudent($id);
				$data = array(
					'student' => $student,
					'view' => 'students/profile.php',
					'client' => $this->client
				);
				$this->load->view('templates/auth', $data);

			}

		} else redirect(base_url(), 'location');

	}

	public function edit($ignore = NULL) {

		if ($this->session->userdata('user')) {

			if (isset($id)) {

				$student = $this->student->getStudent($id);
				$data = array(
					'student' => $student,
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