<?php

class Villes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
        $this->load->model('Ville_model');

    }
    public function getByCodePostal($code_postal){
        $ville = new Ville_model();
        $ville->code_postal=$code_postal;
        $villes = $ville->getByCodePostal();
        echo json_encode($villes);
    }
}