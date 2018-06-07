<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 19-04-18
 * Time: 13:42
 */

class Sessions extends CI_Controller
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

        // CSS & JS
        add_css(array('style', 'form_inscription', 'group_space', 'Informations'));
    }


    public function index(){

        if($this->session->is_connected == TRUE){
            //redirection d'adresse ( ex : homeband/form/connexion en homeband/ )
            header("location:". base_url('groupes'));
        } else {
            // Validation des champs
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

            if($this->form_validation->run() == FALSE) {

                // Ajout des erreurs du formulaire
                form_error_flash();

                // Affichage de la page de connexion
                $this->load->view('templates/header_group_not_connected');
                $this->load->view('sessions/index');
                $this->load->view('templates/footer_group');
            } else {

                $username = $this->input->post('username');
                $password = $this->input->post('password');

                $res = $this->groupes->connect($username, $password);

                if($res == TRUE){
                    header("location:". base_url('groupes'));
                } else {
                    // Affichage de la page de connexion
                    $this->load->view('templates/header_group_not_connected');
                    $this->load->view('sessions/index');
                    $this->load->view('templates/footer_group');
                }
            }
        }
    }

    public function deconnexion(){
        $this->session->is_connected = FALSE;
        $this->session->group_connected = NULL;
        $this->session->CK = NULL;
        header("location:". base_url('groupes'));
    }

    public function motdepasse_oublie(){

        //Validation des champs
        $this->form_validation->set_rules('email', 'Email', 'trim|required');

        // Affichage de la page de connexion
        $this->load->view('templates/header_group_not_connected');
        $this->load->view('sessions/password_forgotten');
        $this->load->view('templates/footer_group');

       /*  $res = $this->groupes->forgotten($email);

        if($res == TRUE){
            header("location:". base_url('groupes'));
        } else {
            // Affichage de la page de connexion
            $this->load->view('templates/header_group_not_connected');
            $this->load->view('sessions/index');
            $this->load->view('templates/footer_group');
        } */
        
    }
}