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

        $this->load->library('homeband');


        // Initialisation de l'api REST (Homeband)
        $this->rest->initialize(array('server' => 'http://localhost/homeband-api/api/'));

        //var_dump($ci->config->item('header_css'));
        add_css(array('style', 'form_inscription', 'group_space', 'Informations'));

        //var_dump($ci->config->item('header_css'));
        //add_js('inscription');
    }


    public function index(){
        check_connexion();

        $header["groupe"] = $this->session->group_connected;
        $data["erreur_api"] = false;

        // Requête vers l'API
        $id = $this->session->group_connected->id_groupes;
        $this->homeband->sign();

        $result = $this->rest->get("groupes/$id/evenements");
        if($result->status){
            $data["events"] = $result->events;
        } else {
            $data["erreur_api"] = true;
        }

        $this->load->view('templates/header_group', $header);
        $this->load->view('evenements/index', $data);
        $this->load->view('templates/footer_group');
    }

    public function ajouter(){
        check_connexion();

        $header["groupe"] = $this->session->group_connected;
        $data["erreur_api"] = false;

        $this->load->view('templates/header_group', $header);
        $this->load->view('evenements/ficheEvenement', $data);
        $this->load->view('templates/footer_group');
    }
}