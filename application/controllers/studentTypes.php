<?php

class StudentTypes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('studenttype');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $stmt = $this->studenttype->getStudentType();



        $data = array('stmt' => $stmt, 'view' => 'studenttypes/studenttypes.list.php');

        $this->load->view('templates/auth', $data);

    }




    public function studenttypes_create()
    {

        if ($this->session->userdata('user')) {



            $data = array('view' => 'studenttypes/studenttypes.form.php');

            $this->load->view('templates/auth', $data);


        }

    }

    public function studenttypes_create_action()
    {



        $this->form_validation->set_rules('name', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('enabled', 'Enabled', 'trim|xss_clean');


        if ($this->form_validation->run()) {

            $id_studentType = $this->studenttype->createStudentType($this->input->post('name'), $this->input->post('enabled'));

            if ($id_studentType >0) {

                $this->session->set_flashdata('msg', 'created');

                redirect(site_url() . "/studenttypes/studenttypes_edit/$id_studentType");
            } else {
                $this->session->set_flashdata('msg', 'there has been an error');
                redirect(site_url() . "/studenttypes/studenttypes_create/");
            }


        } else {

            $this->session->set_flashdata('msg', validation_errors());
            redirect(site_url() . "/studenttypes/studenttypes_create/");
        }


    }











    public function studenttypes_edit($id)
    {

        if ($this->session->userdata('user')) {


            $studentType = $this->studenttype->getStudentTypeById($id);

            $data = array('studentType' => $studentType, 'view' => 'studenttypes/studenttypes.form.php');

            $this->load->view('templates/auth', $data);


        }

    }

    public function studenttypes_edit_action($id)
    {
        $this->form_validation->set_rules('name', 'Subject', 'trim|required|xss_clean');
        $this->form_validation->set_rules('enabled', 'Enabled', 'trim|xss_clean');


        if ($this->form_validation->run()) {
            $id_studentType = $this->studenttype->updateStudentType($this->input->post('name'), $this->input->post('enabled'),$id);




            if ($id_studentType > 0) {

                $this->session->set_flashdata('msg', 'updated');

                redirect(site_url() . "/studenttypes/studenttypes_edit/$id");
            } else {
                $this->session->set_flashdata('msg', 'there has been an error');
                redirect(site_url() . "/studenttypes/studenttypes_edit/$id");
            }


        } else {

            $this->session->set_flashdata('msg', validation_errors());
            redirect(site_url() . "/studenttypes/studenttypes_edit/$id");
        }


    }


}