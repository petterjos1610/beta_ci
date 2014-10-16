<?php
class School extends CI_Model {
	
	public function __construct() {

		parent::__construct();

	}

	public function getSchools() {

		$result = $this->db->get('Schools');
		if ($result->num_rows() > 0) {

			$schools = array();
			foreach ($result->result() as $row) {

				$schools[] = $row;

			}
			return $schools;

		}
		return false;

	}

	public function getSchool($urn) {

		$result = $this->db->get_where('Schools', array('urn' => $urn));
		if ($result->num_rows() == 1) {

			$schools = array();
			foreach ($result->result() as $row) {

				$schools[] = $row;

			}
			return $schools;

		}
		return false;

	}

	public function getSchoolsAndStaff($urn = 0) {

		if ($urn == 0)
			$schools = self::getSchools();
		else
			$schools = self::getSchool($urn);
		$schoolsAndStaff = array();
		foreach ($schools as $school) {
			
			$result = $this->db->query("SELECT * FROM SchoolStaff LEFT JOIN (SELECT * FROM Users) AS tb ON tb.id=SchoolStaff.s_userId WHERE s_schoolId=" . $school->urn);
			if ($result->num_rows() > 0) {

				$schoolsAndStaff[][] = $school;
				foreach ($result->result() as $row) {

					$schoolsAndStaff[sizeof($schoolsAndStaff)-1][] = $row;

				}

			}

		}
		return $schoolsAndStaff;

	}

	public function getStaff($id) {

		$result = $this->db->query("SELECT * FROM SchoolStaff LEFT JOIN (SELECT * FROM Users) AS tb ON tb.id=SchoolStaff.s_userId WHERE s_userId=" . $id);
		if ($result->num_rows() == 1) {

			foreach ($result->result() as $row) {

				$staff = $row;

			}
			return $staff;

		}
		return false;

	}

}