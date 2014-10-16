<?php
class Controller extends CI_Controller {
	
	public function index() {

		$this->load->library('session');
		if ($this->session->userdata('user')) {
			
			$data = array(
				'userTypeId' => $this->client->getUserTypeId(),
				'view' => 'dashboard/edukit.php'
			);
			$this->load->view('templates/auth', $data);

		} else {

			if ($this->input->post('function') && $this->input->post('function') == "userLogin") {

				$data = array(
					'user' => $this->input->post('user'),
					'password' => $this->input->post('pass')
				);
				if ($this->user->login($data)) {

					$session_data = array(
						'user' => $this->user->getId()
					);
					$this->session->set_userdata($session_data);
					$this->client->load($this->user->getId());
					self::index();

				}

			}

			$data['view'] = 'login';
			$this->load->view('templates/unauth', $data);

		}

	}

}