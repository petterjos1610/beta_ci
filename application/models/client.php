<?php
class Client extends User {

	protected $spId, $userId, $displayName, $enabled, $spName;
	
	public function __construct() {

		parent::__construct();
		self::load($this->session->userdata('user'));

	}

	public function load($id) {

		$result = $this->db->query('SELECT * FROM Users LEFT JOIN (SELECT * FROM SPStaff LEFT JOIN (SELECT id AS serviceId, name FROM ServiceProviders) as tb1 on tb1.serviceId = SPStaff.spId) as tb2 on tb2.userId = Users.id where id="'.$id.'"');
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
				$this->spId = $row->spId;
				$this->userId = $row->userId;
				$this->displayName = $row->displayName;
				$this->enabled = $row->enabled;
				$this->spName = $row->name;
				self::queryPrivileges();
				self::setUserType();
				return true;

			}

		}
		return false;

	}

	public function getSpId() { return $this->spId; }
	public function getUserId() { return $this->userId; }
	public function getDisplayName() { return $this->displayName; }
	public function isEnabled() { return $this->enabled; }
	public function getSpName() { return $this->spName; }
	public function getUserType() { return $this->userType; }

}