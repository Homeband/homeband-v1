<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groupes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('utilisateur_model');
        $this->load->model('groupe_model');
        $this->load->model('ville_model');

        $this->rest->initialize(array('server' => 'http://localhost/homeband-api/api/'));
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        // Affichage d'une page d'index en fonction d'un visiteur ou utilisateur connecté
        if($this->session->is_connected == TRUE){
            $this->load->view('templates/header_group');
            $this->load->view('groupes/index_connecter',array("group_name"=>"leslielouise"));
            $this->load->view('templates/footer_group');
        } else {
            $this->load->view('templates/header_group_not_connected');
            $this->load->view('groupes/index_not_connected');
            $this->load->view('templates/footer_group');
        }
    }
    public function monGroupe(){
        if($this->session->is_connected == TRUE){
            $this->load->view('templates/header_group');
            $this->load->view('groupes/MonGroupe_connecter');
            $this->load->view('templates/footer_group');
        } else {
            $this->load->view('templates/header_group_not_connected');
            $this->load->view('groupes/index_not_connected');
            $this->load->view('templates/footer_group');
        }
    }
    public function evenements(){
        if($this->session->is_connected == TRUE){
            $this->load->view('templates/header_group');
            $this->load->view('groupes/evenements_connecter');
            $this->load->view('templates/footer_group');
        } else {
            $this->load->view('templates/header_group_not_connected');
            $this->load->view('groupes/index_not_connected');
            $this->load->view('templates/footer_group');
        }
    }
    public function profil(){
    if($this->session->is_connected == TRUE){
        $this->load->view('templates/header_group');
        $this->load->view('groupes/profil_connecter');
        $this->load->view('templates/footer_group');
    } else {
        $this->load->view('templates/header_group_not_connected');
        $this->load->view('groupes/index_not_connected');
        $this->load->view('templates/footer_group');
    }
}
    public function commentaires(){
        if($this->session->is_connected == TRUE){
            $this->load->view('templates/header_group');
            $this->load->view('groupes/commentaires_connecter');
            $this->load->view('templates/footer_group');
        } else {
            $this->load->view('templates/header_group_not_connected');
            $this->load->view('groupes/index_not_connected');
            $this->load->view('templates/footer_group');
        }
    }
    public function newsletter(){
        if($this->session->is_connected == TRUE){
            $this->load->view('templates/header_group');
            $this->load->view('groupes/newsletter_connecter');
            $this->load->view('templates/footer_group');
        } else {
            $this->load->view('templates/header_group_not_connected');
            $this->load->view('groupes/index_not_connected');
            $this->load->view('templates/footer_group');
        }
    }
    public function inscription(){

        if($this->session->is_connected == TRUE){
            //redirection d'adresse ( ex : homeband/form/connexion en homeband/ )
            header("location:". base_url());

        } else {

            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[2]|max_length[12]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('passconf', 'Password Confirm', 'trim|required|matches[password]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('band', 'Band Name', 'trim|required|min_length[2]|max_length[45]');
            $this->form_validation->set_rules('villes', 'Ville', 'trim|required');
            if($this->form_validation->run() == FALSE){

                form_error_flash();

                // Affichage de la page de connexion
                $this->load->view('templates/header_group_not_connected');
                $this->load->view('groupes/inscription');
                $this->load->view('templates/footer_group');
            } else {
                //Instance classe utilisateur_model dans variable $user ($user = $this dans utilisateur_model)
                $group = new Groupe_model();
                //Met à jour les données de l'objet user
                //set($key,$value) { $this-> $key = $value}
                //set('login','chris') { $user -> 'login'='Chris'}
                $group->login=$this->input->post('username');
                $group->mot_de_passe=$this->input->post('password');
                $group->email=$this->input->post('email');
                $group->nom=$this->input->post('band');
                $group->id_villes=$this->input->post('villes');

                $result = $this->rest->post('groupes', array("group" => $group));

                if($result->status){

                    // Si connecter=vrai
                    //if($group->inscrire()){
                    $this->flash->setMessage("Vous êtes bien inscrit",$this->flash->getSuccessType());
                    header("location:". base_url('groupes/connexion'));
                } else {
                    // Affichage de la page de connexion
                    $this->load->view('templates/header_group_not_connected');
                    $this->load->view('groupes/inscription');
                    $this->load->view('templates/footer_group');
                }

            }
        }
    }

    public function connexion(){

        if($this->session->is_connected == TRUE){
            //redirection d'adresse ( ex : homeband/form/connexion en homeband/ )
            header("location:". base_url('groupes'));
        } else {

            // Validation des champs
            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');

            if($this->form_validation->run() == FALSE) {

                // Ajout des erreurs du formulaire
                form_error_flash();

                // Affichage de la page de connexion
                $this->load->view('templates/header_group_not_connected');
                $this->load->view('groupes/connexion');
                $this->load->view('templates/footer_group');
            } else {

                // Paramètres d'appel à l'API
                $params = array(
                    'login' => $this->input->post('username'),
                    'mot_de_passe' => $this->input->post('password')
                );

                // Appel à l'API
                $results = $this->rest->post('groupes/login', $params);

                // Traitement du résultat
                if(isset($results) && $results->status == TRUE){
                    // Le résultat n'est pas vide et l'attribut 'status' a la valeur TRUE => L'opération a réussi
                    $this->session->is_connected = TRUE;
                    $this->session->user_connected = $results->group;
                    header("location:". base_url('groupes'));
                } else {

                    $this->session->is_connected = FALSE;

                    if(isset($results)){
                        $this->flash->setMessage($results->message, $this->flash->getErrorType());
                    } else {
                        $this->flash->setMessage("Erreur lors de la tentative de connexion.", $this->flash->getErrorType());
                    }

                    // Affichage de la page de connexion
                    $this->load->view('templates/header_group_not_connected');
                    $this->load->view('groupes/connexion');
                    $this->load->view('templates/footer_group');
                }
            }
        }
    }

    public function deconnexion(){
        $this->session->is_connected = FALSE;
        header("location:". base_url('groupes/connexion'));
    }
}