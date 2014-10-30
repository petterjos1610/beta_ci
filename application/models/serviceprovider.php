<?php
class Serviceprovider extends CI_Model {
	
	public function getServiceProviders() {

		$this->db->order_by('name','asc');
		$result = $this->db->get('serviceproviders');
		$serviceproviders = array();
		foreach ($result->result() as $row) {

			$serviceproviders[] = $row;

		}
		return $serviceproviders;

	}

	public function getServiceProvider($id) {

		$this->db->order_by('name','asc');
		$result = $this->db->get_where('serviceproviders', array('id' => $id));
		$serviceproviders = array();
		foreach ($result->result() as $row) {

			$serviceproviders[] = $row;

		}
		return $serviceproviders;

	}

}