<?php

class Careers extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('career');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $careers = $this->career->getCareers();



        $data = array('careers' => $careers, 'view' => 'career/career.list.php');

        $this->load->view('templates/auth', $data);

    }




    public function career_create()
    {

        if ($this->session->userdata('user')) {



            $data = array('view' => 'career/career.form.php');

            $this->load->view('templates/auth', $data);


        }

    }

    public function career_create_action()
    {



        $this->form_validation->set_rules('name', 'Career', 'trim|required|xss_clean');
        $this->form_validation->set_rules('enabled', 'Enabled', 'trim|xss_clean');


        if ($this->form_validation->run()) {

            $id_career = $this->career->createCareer($this->input->post('name'), $this->input->post('enabled'));

            if ($id_career >0) {

                $this->session->set_flashdata('msg', 'created');

                redirect(site_url() . "/careers/career_edit/$id_career");
            } else {
                $this->session->set_flashdata('msg', 'there has been an error');
                redirect(site_url() . "/careers/career_create/");
            }


        } else {

            $this->session->set_flashdata('msg', validation_errors());
            redirect(site_url() . "/careers/career_create/");
        }


    }











    public function career_edit($id)
    {

        if ($this->session->userdata('user')) {


            $career = $this->career->getCareerById($id);

            $data = array('career' => $career, 'view' => 'career/career.form.php');

            $this->load->view('templates/auth', $data);


        }

    }

    public function career_edit_action($id)
    {
        $this->form_validation->set_rules('name', 'Career', 'trim|required|xss_clean');
        $this->form_validation->set_rules('enabled', 'Enabled', 'trim|xss_clean');


        if ($this->form_validation->run()) {
            $id_career = $this->career->updateCareer($this->input->post('name'), $this->input->post('enabled'),$id);




            if ($id_career > 0) {

                $this->session->set_flashdata('msg', 'updated');

                redirect(site_url() . "/careers/career_edit/$id");
            } else {
                $this->session->set_flashdata('msg', 'there has been an error');
                redirect(site_url() . "/careers/career_edit/$id");
            }


        } else {

            $this->session->set_flashdata('msg', validation_errors());
            redirect(site_url() . "/careers/career_edit/$id");
        }


    }


}