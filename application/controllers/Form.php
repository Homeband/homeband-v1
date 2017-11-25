<?php

class Form extends CI_Controller
{

    public function index(){
        $this->load->view('templates/header_admin_not_connected');
        $this->load->view('Form/group_space');
        $this->load->view('templates/footer');
    }
    public function connexions(){

        $this->load->view('templates/header_admin_not_connected');
        $this->load->view('Form/connexions');
        $this->load->view('templates/footer');
    }
    public function inscription(){


        if ($this->form_validation->run() == FALSE)
        {
            $this->load->view('templates/header_admin_not_connected');
            $this->load->view('Form/inscription');
            $this->load->view('templates/footer');
        }
        else
        {
            $this->load->view('templates/header_admin_not_connected');
            $this->load->view('Form/formsuccess');
            $this->load->view('templates/footer');
        }

    }


}