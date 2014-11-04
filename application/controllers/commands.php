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
	
	

     
   
  $commands = $this->command->getCommands();

        $data = array('cmd' => $commands, 'view' => 'commands/commands.list.php');

        $this->load->view('templates/auth', $data);

    }
	
	  public function command_subject_create()
    {
	
	
	   if ($this->session->userdata('user')) {


          //  $userTypes = $this->ticket->getFromTable('UserTypes');
		  
            $data = array( 'view' => 'commands/command.form.php');

            $this->load->view('templates/auth', $data);


        }

	

   

    }
	
	  public function command_subject_create_action()
    {
	
	  $this->form_validation->set_rules('command', 'command', 'trim|required|xss_clean');
        $this->form_validation->set_rules('outputString', 'outputString', 'trim|required|xss_clean');
        $this->form_validation->set_rules('enabled', 'Enabled', 'trim|required|xss_clean');

	 
	  if ($this->form_validation->run()) {
            $subject = array(
                'command' => $this->input->post('command'),
                'outputString' => $this->input->post('outputString'),
                'enabled' => $this->input->post('enabled')

            );
            $id_subjekt = $this->command->create('commands', $subject);

            if ($id_subjekt > 0) {

                $this->session->set_flashdata('msg', 'created');

                redirect(site_url() . "/commands/command_subject_edit/$id_subjekt");
            } else {
                $this->session->set_flashdata('msg', 'there has been an error');
                redirect(site_url() . "/commands/command_subject_create_action/");
            }


        } else {
            echo 'dsfgs';
            $this->session->set_flashdata('msg', validation_errors());
            redirect(site_url() . "/commands/command_subject_create_action/$id");
        }
		
		
		

    }
	
	
	
		//////////////////////////////////////////////////////////////////////////////////
		
	
	  public function command_subject_edit($id)
    {

        if ($this->session->userdata('user')) {


           // $ticketSubject = $this->ticket->getById('commands', 'id', $id);
            $cmd = $this->command->getById('commands', 'id', $id);
            $data = array('cmd' => $cmd,  'view' => 'commands/command.form.php');

            $this->load->view('templates/auth', $data);


        }

    }

		
	
	 public function command_subject_edit_action($id)
    {



        $this->form_validation->set_rules('command', 'Command Code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('outputString', 'Command Description', 'trim|required|xss_clean');
        $this->form_validation->set_rules('enabled', 'Enabled', 'trim|required|xss_clean');


        if ($this->form_validation->run()) {
            $subject = array(
                'command' => $this->input->post('command'),
                'outputString' => $this->input->post('outputString'),
                'enabled' => $this->input->post('enabled')

            );

            $id_subjekt = $this->command->update('commands', 'id', $id, $subject);


            if ($id_subjekt > 0) {

                $this->session->set_flashdata('msg', 'updated');

                redirect(site_url() . "/commands/command_subject_edit/$id");
            } else {
                $this->session->set_flashdata('msg', 'there has been an error');
                redirect(site_url() . "/commands/command_subject_edit/$id");
            }


        } else {

            $this->session->set_flashdata('msg', validation_errors());
            redirect(site_url() . "/commands/command_subject_edit/$id");
        }


    }
	
	
	
	
	
	
	}