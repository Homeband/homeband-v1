<?php

class API_Utilisateurs extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('utilisateur_model');

        header('Content-Type: application/json');
    }

    public function lister(){
        $users = Utilisateur_model::lister();
        $results = json_encode($users,JSON_UNESCAPED_UNICODE);

        echo $results;
    }
}