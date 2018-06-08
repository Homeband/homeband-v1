<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 19-04-18
 * Time: 13:41
 */

class Evenements extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        // Initialisation de l'api REST (Homeband)
        $this->rest->initialize(array('server' => $this->config->item('homeband_api')));

        // Librairies
        $this->load->library('homeband');

        // Modèles
        $this->load->model("GroupeModel", "groupes");

        //var_dump($ci->config->item('header_css'));
        add_css(array('style', 'form_inscription', 'group_space', 'Informations'));

        //var_dump($ci->config->item('header_css'));
        //add_js('inscription');
    }


    public function index(){
        check_connexion();

        $header["groupe"] = $this->session->group_connected;
        $data["erreur_api"] = false;

        $id = $this->session->group_connected->id_groupes;
        $events = $this->groupes->listEvents($id);
        if(!empty($events)){
            $data["events"] = $events;
        } else {
            $data["erreur_api"] = true;
        }

        $this->load->view('templates/header_group', $header);
        $this->load->view('evenements/index', $data);
        $this->load->view('templates/footer_group');
    }

    public function ajouter(){
        check_connexion();

        $config['upload_path']          = FCPATH . 'assets/images/ressources/groups';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['overwrite']            = TRUE;
        $config['file_name']            = $this->session->group_connected->id_groupes;

        $this->load->library('upload', $config);

        $header["groupe"] = $this->session->group_connected;
        $data["erreur_api"] = false;

        $this->load->view('templates/header_group', $header);
        $this->load->view('evenements/ficheEvenement', $data);
        $this->load->view('templates/footer_group');
    }
}