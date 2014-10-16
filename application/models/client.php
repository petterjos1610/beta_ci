<?php
class Client extends User {
	
	public function __construct() {

		parent::__construct();
		self::load($this->session->userdata('user'));

	}

	public function load($id) {

		$result = $this->db->get_where('Users', array('id' => $id));
		if (is_numeric($id) && $id > 0 && $result->num_rows() == 1) {
			
			foreach ($result->result() as $row) {

				$this->id = $row->id;
				$this->userTypeId = $row->userTypeId;
				$this->email = $row->email;
				$this->email_confirm = $row->email_confirm;
				$this->password = $row->password;
				$this->fname = $row->fname;
				$this->lname = $row->lname;
				$this->enabled = $row->enabled;
				self::queryPrivileges();
				self::setUserType();
				return true;

			}

		}
		return false;

	}

}