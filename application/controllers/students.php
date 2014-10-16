<?php
class Students extends CI_Controller {
	
	public function index() {

		self::view();

	}

	public function view($ignore = NULL, $id = 0) {

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
				'view' => 'students/edit.php'
			);
			$this->load->view('templates/auth', $data);

		}

	}

}