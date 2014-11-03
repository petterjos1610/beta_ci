<?php

class Ethnicities extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ethnicity');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $eth = $this->ethnicity->getEthnicities();

        $data = array('eth' => $eth, 'view' => 'ethnicity/ethnicity.list.php');

        $this->load->view('templates/auth', $data);

    }




    public function ethnicity_create()
    {
        if ($this->session->userdata('user')) {



            $data = array('view' => 'ethnicity/ethnicity.form.php');

            $this->load->view('templates/auth', $data);


        }

    }

    public function ethnicity_create_action()
    {



        $this->form_validation->set_rules('code', 'Code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'Ethnicity', 'trim|required|xss_clean');
        $this->form_validation->set_rules('enabled', 'Enabled', 'trim|xss_clean');


        if ($this->form_validation->run()) {

            $id_ethnicity = $this->ethnicity->createEthnicity($this->input->post('code'),$this->input->post('name'), $this->input->post('enabled'));

            if ($id_ethnicity >0) {

                $this->session->set_flashdata('msg', 'created');

                redirect(site_url() . "/ethnicities/ethnicity_edit/$id_ethnicity");
            } else {
                $this->session->set_flashdata('msg', 'there has been an error');
                redirect(site_url() . "/ethnicities/ethnicity_create/");
            }


        } else {

            $this->session->set_flashdata('msg', validation_errors());
            redirect(site_url() . "/ethnicities/ethnicity_create/");
        }


    }











    public function ethnicity_edit($id)
    {

        if ($this->session->userdata('user')) {


            $ethnicity = $this->ethnicity->getEthnicityById($id);

            $data = array('ethnicity'=>$ethnicity, 'view' => 'ethnicity/ethnicity.form.php');

            $this->load->view('templates/auth', $data);


        }

    }

    public function ethnicity_edit_action($id)
    {
        $this->form_validation->set_rules('code', 'Code', 'trim|required|xss_clean');
        $this->form_validation->set_rules('name', 'Ethnicity', 'trim|required|xss_clean');
        $this->form_validation->set_rules('enabled', 'Enabled', 'trim|xss_clean');


        if ($this->form_validation->run()) {
            $id_ethnicity = $this->ethnicity->updateEthnicity($this->input->post('code'),$this->input->post('name'), $this->input->post('enabled'),$id);




            if ($id_ethnicity > 0) {

                $this->session->set_flashdata('msg', 'updated');

                redirect(site_url() . "/ethnicities/ethnicity_edit/$id");
            } else {
                $this->session->set_flashdata('msg', 'there has been an error');
                redirect(site_url() . "/ethnicities/ethnicity_edit/$id");
            }


        } else {

            $this->session->set_flashdata('msg', validation_errors());
            redirect(site_url() . "/ethnicities/ethnicity_edit/$id");
        }


    }


}