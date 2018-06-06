<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 19-04-18
 * Time: 13:56
 */

class Musiques extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('homeband');

        // Initialisation de l'api REST (Homeband)
        $this->rest->initialize(array('server' => $this->config->item('homeband_api')));

        add_css(array('style', 'form_inscription', 'group_space', 'Informations'));
    }


    public function index(){

        if($this->session->is_connected == FALSE) {
            //redirection d'adresse ( ex : homeband/form/connexion en homeband/ )
            header("location:" . base_url('groupes'));
        }

        $this->load->view('templates/header_group');
        $this->load->view('musiques/index');
        $this->load->view('templates/footer_group');
    }
}