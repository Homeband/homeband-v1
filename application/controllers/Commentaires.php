<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 19-04-18
 * Time: 14:13
 */

class Commentaires extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->library('homeband');

        // Initialisation de l'api REST (Homeband)
        $this->rest->initialize(array('server' => $this->config->item('homeband_api')));

        //load les modèles
        $this->load->model("AvisModel", "avis");

        add_css(array('style', 'form_inscription', 'group_space', 'Informations'));
    }

    public function index(){

        check_connexion();

        $header["groupe"] = $this->session->group_connected;
        $data["erreur_api"] = false;

        $id = $this->session->group_connected->id_groupes;
        $this->homeband->sign();
        $comments = $this->avis->getList($id);
        if(!empty($comments)){
            $data["comments"] = $comments;
        } else {
            $data["erreur_api"] = true;
        }

        $this->load->view('templates/header_group');
        $this->load->view('avis/index');
        $this->load->view('templates/footer_group');
    }


}