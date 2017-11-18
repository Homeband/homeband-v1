<?php

class Form extends CI_Controller
{

    public function index(){

        $this->load->view('templates/header_others');
        $this->load->view('Form/inscription');
        $this->load->view('templates/footer');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('passconf', 'Password Confirm', 'trim|required|matches[password]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('band', 'Band Name', 'trim|required|min_length[2]|max_length[45]');

    }
    public function connexions(){
        $this->load->view('templates/header_others');
        $this->load->view('Form/connexions');
        $this->load->view('templates/footer');


    }
}