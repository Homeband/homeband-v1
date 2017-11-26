<?php

class API_Utilisateurs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('utilisateur_model');
    }

    public function lister(){
        echo json_encode(Utilisateur_model::lister());
    }
}