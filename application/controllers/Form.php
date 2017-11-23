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

        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[2]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('passconf', 'Password Confirm', 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('band', 'Band Name', 'trim|required|min_length[2]|max_length[45]');
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