<?php
class Schoolstaff extends CI_Controller {
	
	public function index() {

		self::view();

	}

	public function view($ignore = NULL, $id = 0, $urn = 0) {

		if ($this->session->userdata('user')) {

			$this->load->model('school');
			if ($urn == 0) {

				$schoolsAndStaff = $this->school->getSchoolsAndStaff();
				$data = array(
					'schstaff' => $schoolsAndStaff,
					'view' => 'schools/stafflist.php'
				);
				$this->load->view('templates/auth', $data);

			} else {

				if ($id == 0) {

					$staff = $this->school->getSchoolsAndStaff($urn);
					$data = array(
						'schstaff' => $staff,
						'view' => 'schools/stafflist.php'
					);
					$this->load->view('templates/auth', $data);

				} else {

					$staff = $this->school->getStaff($id);
					$data = array(
						'schStaff' => $staff,
						'view' => 'schools/editstaff.php'
					);
					$this->load->view('templates/auth', $data);

				}

			}

		} else redirect(base_url(), 'location');

	}

	public function create($ignore = NULL, $urn = 0) {

		$data = array(
			'view' => 'schools/editstaff.php'
		);
		$this->load->view('templates/auth', $data);

	}

}