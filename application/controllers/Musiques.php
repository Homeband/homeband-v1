<?php

class Musiques extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('homeband');

        // Initialisation de l'api REST (Homeband)
        $this->rest->initialize(array('server' => $this->config->item('homeband_api')));

        //load les modèles
        $this->load->model("GroupeModel", "groupes");
        $this->load->model("AlbumModel", "albums");

        add_css(array('style', 'form_inscription', 'group_space', 'Informations'));
        add_js('album');
    }


    public function index(){
        check_connexion();

        $header["groupe"] = $this->session->group_connected;
        $data["erreur_api"] = false;

        $id = $this->session->group_connected->id_groupes;
        $albums = $this->albums->getList($id);
        if(!empty($albums)){
            $data["albums"] = $albums;
        } else {
            $data["erreur_api"] = true;
        }

        $this->load->view('templates/header_group', $header);
        $this->load->view('musiques/index', $data);
        $this->load->view('templates/footer_group');
    }

    public function ajouter(){
        check_connexion();

        $header["groupe"] = $this->session->group_connected;
        $data["erreur_api"] = false;

        $this->load->view('templates/header_group', $header);
        $this->load->view('musiques/ficheAlbum', $data);
        $this->load->view('templates/footer_group');
    }
}