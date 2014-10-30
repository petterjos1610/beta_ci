<?php

class Tickets extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ticket');
        $this->load->library('form_validation');
    }

    public function index()
    {



    }

    public function ticket_subject()
    {

        $dogadjaji = $this->ticket->getTicketSubjects();
   


        $data = array('tkt' => $dogadjaji, 'view' => 'tickets/ticketsubject.list.php');

        $this->load->view('templates/auth', $data);

    }



    public function ticket_subject_create()
    {

        if ($this->session->userdata('user')) {


            $userTypes = $this->ticket->getFromTable('UserTypes');
            $data = array('userTypes' => $userTypes, 'view' => 'tickets/ticketsubject.form.php');

            $this->load->view('templates/auth', $data);


        }

    }

    public function ticket_subject_create_action($id)
    {



        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('userTypeId', 'User Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('enabled', 'Enabled', 'trim|required|xss_clean');


        if ($this->form_validation->run()) {
            $subject = array(
                'subject' => $this->input->post('subject'),
                'userTypeId' => $this->input->post('userTypeId'),
                'enabled' => $this->input->post('enabled')

            );
            $id_subjekt = $this->ticket->create('ticketsubjects', $subject);

            if ($id_subjekt > 0) {

                $this->session->set_flashdata('msg', 'created');

                redirect(site_url() . "/tickets/ticket_subject_edit/$id_subjekt");
            } else {
                $this->session->set_flashdata('msg', 'there has been an error');
                redirect(site_url() . "/tickets/ticket_subject_create/");
            }


        } else {
            echo 'dsfgs';
            $this->session->set_flashdata('msg', validation_errors());
            redirect(site_url() . "/tickets/ticket_subject_create/$id");
        }


    }


































    public function ticket_subject_edit($id)
    {

        if ($this->session->userdata('user')) {


            $ticketSubject = $this->ticket->getById('ticketsubjects', 'id', $id);
            $userTypes = $this->ticket->getFromTable('UserTypes');
            $data = array('ticketSubject' => $ticketSubject, 'userTypes' => $userTypes, 'view' => 'tickets/ticketsubject.form.php');

            $this->load->view('templates/auth', $data);


        }

    }

    public function ticket_subject_edit_action($id)
    {



        $this->form_validation->set_rules('subject', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('userTypeId', 'User Type', 'trim|required|xss_clean');
        $this->form_validation->set_rules('enabled', 'Enabled', 'trim|required|xss_clean');


        if ($this->form_validation->run()) {
            $subject = array(
                'subject' => $this->input->post('subject'),
                'userTypeId' => $this->input->post('userTypeId'),
                'enabled' => $this->input->post('enabled')

            );

            $id_subjekt = $this->ticket->update('ticketsubjects', 'id', $id, $subject);


            if ($id_subjekt > 0) {

                $this->session->set_flashdata('msg', 'updated');

                redirect(site_url() . "/tickets/ticket_subject_edit/$id");
            } else {
                $this->session->set_flashdata('msg', 'there has been an error');
                redirect(site_url() . "/tickets/ticket_subject_edit/$id");
            }


        } else {

            $this->session->set_flashdata('msg', validation_errors());
            redirect(site_url() . "/tickets/ticket_subject_edit/$id");
        }


    }


}