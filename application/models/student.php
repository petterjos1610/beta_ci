<?php
class Student extends CI_Model {
	
	public function __construct() {

		parent::__construct();

	}

	public function getStudents() {

		$result = $this->db->query("SELECT * FROM Students LEFT JOIN (SELECT * FROM Users) AS tb ON tb.id=Students.s_userId");
		$students = array();
		foreach ($result->result() as $row) {

			$students[] = $row;

		}
		return $students;

	}

	public function getStudent($upn) {

		$result = $this->db->query("SELECT * FROM Students LEFT JOIN (SELECT * FROM Users) AS tb ON tb.id=Students.s_userId WHERE s_upn = '" . $upn . "'");
		$students = array();
		if ($result->num_rows() == 1) {

			foreach ($result->result() as $row) {

				/*
				$ethnicity = $this->db->get_where('Ethnicities', array('id' => $row->s_ethnicityId));
				if ($ethnicity->num_rows() == 1) {
					
					foreach ($ethnicity->result()[0] as $key => $value) {

						if ($key == "ethnicity") {
							
							$row->$key = $value;

						}

					}

				}
				*/
				return $row;

			}

		}
		return false;

	}

}