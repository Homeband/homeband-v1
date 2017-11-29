<?php

class Villes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        header('Content-Type: application/json');
        $this->load->model('Ville_model');

    }

    public function getByCodePostal(){

        $code_postal = $this->input->post('code_postal');

        $ville = new Ville_model();
        $ville->code_postal=$code_postal;
        $villes = $ville->getByCodePostal();

        $retour = array(
            'result' => true,
            'liste' => $villes
        );

        echo json_encode($retour);
    }
}