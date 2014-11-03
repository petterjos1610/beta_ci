<?php
class Commands extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('command');
        $this->load->library('form_validation');
    }

    public function index()
    {



    }

    public function command_subject()
    {
	
	

     
   
  $commands = $this->command->getCommands();;

        $data = array('cmd' => $commands, 'view' => 'commands/commands.list.php');

        $this->load->view('templates/auth', $data);

    }
	
	
	}