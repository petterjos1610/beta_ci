<?php

class Religions extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('religion');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $religions = $this->religion->getReligions();

        $data = array('religions' => $religions, 'view' => 'religion/religion.list.php');

        $this->load->view('templates/auth', $data);

    }




    public function religion_create()
    {
        if ($this->session->userdata('user')) {



            $data = array('view' => 'religion/religion.form.php');

            $this->load->view('templates/auth', $data);


        }

    }

    public function religion_create_action()
    {



        $this->form_validation->set_rules('code', 'Code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('religion', 'Religion', 'trim|required|xss_clean');
        $this->form_validation->set_rules('enabled', 'Enabled', 'trim|xss_clean');


        if ($this->form_validation->run()) {

            $id_religion = $this->religion->createreligion($this->input->post('code'),$this->input->post('religion'), $this->input->post('enabled'));

            if ($id_religion >0) {

                $this->session->set_flashdata('msg', 'created');

                redirect(site_url() . "/religions/religion_edit/$id_religion");
            } else {
                $this->session->set_flashdata('msg', 'there has been an error');
                redirect(site_url() . "/religions/religion_create/");
            }


        } else {

            $this->session->set_flashdata('msg', validation_errors());
            redirect(site_url() . "/religions/religion_create/");
        }


    }











    public function religion_edit($id)
    {

        if ($this->session->userdata('user')) {


            $religion = $this->religion->getReligionById($id);

            $data = array('religion'=>$religion, 'view' => 'religion/religion.form.php');

            $this->load->view('templates/auth', $data);


        }

    }

    public function religion_edit_action($id)
    {
        $this->form_validation->set_rules('code', 'Code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('religion', 'Religion', 'trim|required|xss_clean');
        $this->form_validation->set_rules('enabled', 'Enabled', 'trim|xss_clean');


        if ($this->form_validation->run()) {
            $id_religion = $this->religion->updateReligion($this->input->post('code'),$this->input->post('religion'), $this->input->post('enabled'),$id);




            if ($id_religion > 0) {

                $this->session->set_flashdata('msg', 'updated');

                redirect(site_url() . "/religions/religion_edit/$id");
            } else {
                $this->session->set_flashdata('msg', 'there has been an error');
                redirect(site_url() . "/religions/religion_edit/$id");
            }


        } else {

            $this->session->set_flashdata('msg', validation_errors());
            redirect(site_url() . "/religions/religion_edit/$id");
        }


    }


}