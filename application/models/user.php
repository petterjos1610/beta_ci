<?php
class User extends CI_Model {
	
	protected $id, $userTypeId, $email, $email_confirm, $password, $fname, $lname, $enabled, $privileges, $userType;

	public function __construct() {

		parent::__construct();
		$this->id = 0;
		$this->userTypeId = 0;
		$this->email = "";
		$this->email_confirm = 0;
		$this->password = "";
		$this->fname = "";
		$this->lname = "";
		$this->enabled = 0;
		$this->privileges = array();
		$this->userType = "";

	}

	public function init(array $data) {

		if (isset($data['id']))
			if (!self::setId($data['id'])) return false;

		if (isset($data['userTypeId'],$data['email'],$data['email_confirm'],$data['password'],$data['fname'],$data['lname'],$data['enabled'],$data['privileges'])) {
			
			if (self::setUserTypeId($data['userTypeId']) &&
				self::setEmail($data['email']) &&
				self::setEmailConfirm($data['email_confirm']) &&
				self::setPassword($data['password']) &&
				self::setFname($data['fname']) &&
				self::setLname($data['lname']) &&
				self::setEnabled($data['enabled']) &&
				self::setPrivileges($data['privileges']) &&
				self::setUserType())
					return true;

		}
		return false;

	}

	public function setId($id) {

		$result = $this->db->get_where('Users', array('id' => $id));
		if (is_numeric($id) && $id > 0 && $result->num_rows() == 1) {
			
			$this->id = $id;
			return true;

		}
		return false;

	}

	public function setUserTypeId($userTypeId = "") {

		$result = $this->db->get_where('UserTypes', array('id' => $userTypeId));
		if (is_numeric($userTypeId) && $userTypeId > 0 && $result->num_rows() == 1) {

			$this->userTypeId = $userTypeId;
			return true;

		}
		return false;

	}

	public function setEmail($email) {

		$this->load->helper('email');
		if (valid_email($email)) {

			$this->email = $email;
			return true;

		}
		return false;

	}

	public function setEmailConfirm($email_confirm) {

		if ($email_confirm || !$email_confirm) {

			$this->email_confirm = $email_confirm;
			return true;

		}
		return false;

	}

	public function setPassword($password) {

		if ($password != "") {

			$this->password = md5($password);
			return true;

		}
		return false;

	}

	public function setFname($fname) {

		if ($fname != "") {

			$this->fname = $fname;
			return true;

		}
		return false;

	}

	public function setLname($lname) {

		if ($lname != "") {

			$this->lname = $lname;
			return true;

		}
		return false;

	}

	public function setEnabled($enabled) {

		if ($enabled || !$enabled) {

			$this->enabled = $enabled;
			return true;

		}
		return false;

	}

	public function setPrivileges(array $privileges) {

		if (is_array($privileges)) {

			foreach ($privileges as $privilege) {

				$result = $this->db->get_where('Commands', array('command' => $privilege));
				if ($result->num_rows() == 1) {

					$this->privileges[] = $privilege;

				}

			}

		}
		return false;

	}

	public function setUserType() {

		if (self::getUserTypeId() > 0) {
			
			$result = $this->db->get_where('UserTypes', array('id' => self::getUserTypeId()));
			if ($result->num_rows() == 1) {

				foreach ($result->result() as $row) {

					$this->userType = $row->name;

				}
				return true;

			}

		}
		return false;

	}

	public function getId() { return $this->id; }
	public function getUserTypeId() { return $this->userTypeId; }
	public function getEmail() { return $this->email; }
	public function isEmailConfirm() { return $this->email_confirm; }
	public function getPassword() { return $this->password; }
	public function getFname() { return $this->fname; }
	public function getLname() { return $this->lname; }
	public function isEnabled() { return $this->enabled; }
	public function getPrivileges() { return $this->privileges; }
	public function getUserType() { return $this->userType; }

	protected function queryPrivileges() {

		$result = $this->db->query("SELECT id,command FROM Commands RIGHT JOIN (SELECT commandId,userTypeId FROM UserPrivileges where userTypeId=" . self::getUserTypeId() . ") as tb on tb.commandId = Commands.id");
		if ($result->num_rows() > 0) {

			$privileges = array();
			foreach ($result->result() as $row) {

				$privileges[] = $row->command;

			}
			$this->privileges = $privileges;
			return true;
			
		}
		return false;

	}

	public function save() {

		$this->load->helper('email');
		if (self::getUserTypeId() > 0 && valid_email(self::getEmail()) && (self::isEmailConfirm() || !self::isEmailConfirm() && self::getPassword() != "" && self::getFname() != "" && self::getLname() != "" && self::isEnabled())) {

			if (self::getId() > 0) {
				
				// Edit existing
				$data = array(
					'userTypeId' => self::getUserTypeId(),
					'email' => self::getEmail(),
					'email_confirm' => self::isEmailConfirm(),
					'password' => self::getPassword(),
					'fname' => self::getFname(),
					'lname' => self::getLname(),
					'enabled' => self::isEnabled()
				);
				$this->db->where('id', self::getId());
				$this->db->update('users', $data);
				if (self::queryPrivileges()) return true;

			} else {

				// Create new
				$data = array(
					'userTypeId' => self::getUserTypeId(),
					'email' => self::getEmail(),
					'email_confirm' => self::isEmailConfirm(),
					'password' => self::getPassword(),
					'fname' => self::getFname(),
					'lname' => self::getLname(),
					'enabled' => self::isEnabled()
				);
				$this->db->insert('users', $data);
				if (self::setId($this->db->insert_id()) && self::queryPrivileges()) return true;

			}

		}
		return false;

	}

	public function login(array $data) {

		if (isset($data['user'],$data['password'])) {

			$user = $data['user'];
			$password = $data['password'];
			$result = $this->db->get_where('users', array('email' => $user, 'password' => md5($password)));
			if ($result->num_rows() == 1) {

				foreach ($result->result() as $row) {

					if (self::setId((int) $row->id) &&
						self::setUserTypeId((int) $row->userTypeId) &&
						self::setEmail((string) $row->email) &&
						self::setEmailConfirm((string) $row->email_confirm) &&
						self::setFname((string) $row->fname) &&
						self::setLname((string) $row->lname) &&
						self::setEnabled((string) $row->enabled) &&
						self::setUserType()) {
							
							$this->password = $row->password;
							if (self::queryPrivileges()) return true;

					} else return false;

				}

			}

		}
		return false;

	}

}