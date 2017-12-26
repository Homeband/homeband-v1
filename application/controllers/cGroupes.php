<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cGroupes extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('utilisateur_model');
        $this->load->model('groupe');
        $this->load->model('ville_model');
        $this->load->model('google_geo_model');

        $this->load->library('homeband');


        $this->rest->initialize(array('server' => 'http://localhost/homeband-api/api/'));

        $ci         = &get_instance();

        //var_dump($ci->config->item('header_css'));
        add_css(array('style', 'form_inscription', 'group_space', 'Informations'));

        //var_dump($ci->config->item('header_css'));
        add_js('inscription');
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {
        // Affichage d'une page d'index en fonction d'un visiteur ou utilisateur connecté
        if($this->session->is_connected == TRUE){

            $id = $this->session->group_connected->id_groupes;
            $result = $this->rest->get("groupes/$id");
            if(isset($result) && !empty($result) && $result->status == TRUE) {
                $data['groupe'] = $result->group;

            }

            $this->load->view('templates/header_group');
            $this->load->view('groupes/index_connecter', $data);
            $this->load->view('templates/footer_group');
        } else {
            $this->load->view('templates/header_group_not_connected');
            $this->load->view('groupes/index_not_connected');
            $this->load->view('templates/footer_group');
        }


    }

    public function informations(){

        if($this->session->is_connected == FALSE) {
            header('location:', base_url());
        }

        $id = $this->session->group_connected->id_groupes;
        $result = $this->rest->get("groupes/$id");
        if(isset($result) && !empty($result) && $result->status == TRUE){
            $data['groupe'] = $result->group;

            $this->_check_form_information();
            if($this->form_validation->run() == FALSE) {

                // Ajout des erreurs du formulaire
                form_error_flash();
            } else {
                // Récupération de la fiche du groupe connecté
                $groupe = $this->session->group_connected;

                // Modification des attributs du formulaire sur l'objet récupéré précédemment
                foreach($this->input->post() as $att => $val){
                    if(property_exists($groupe, $att)){
                        $groupe->$att = $val;
                    }
                }

                $id_groupes = $this->session->group_connected->id_groupes;
                $url = "groupes/$id_groupes";
                $params = array(
                    'group' => $groupe
                );

                $result = $this->rest->put($url, $params);
                if(isset($result) && $result->status == TRUE){
                    $message = "Les informations ont été modifées avec succès.";
                    $this->flash->setMessage($message, $this->flash->getSuccessType());

                    $this->session->group_connected = $result->group;
                } else {
                    $message = (isset($result->message)) ? $result->message : "Erreur lors du traitement des informations.";
                    $this->flash->setMessage($message, $this->flash->getErrorType());
                }

                $data['groupe'] = $result->group;
            }

            $this->load->view('templates/header_group');
            $this->load->view('groupes/online/informations', $data);
            $this->load->view('templates/footer_group');
        } else {

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

    public function newsletters(){
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
                $group = new Groupe();
                //Met à jour les données de l'objet user
                //set($key,$value) { $this-> $key = $value}
                //set('login','chris') { $user -> 'login'='Chris'}
                $group->login=$this->input->post('username');
                $group->mot_de_passe=$this->input->post('password');
                $group->email=$this->input->post('email');
                $group->nom=$this->input->post('band');
                $group->id_villes=$this->input->post('villes');

                $result = $this->rest->post('groupes', array("group" => $group));

                if(isset($result) && $result->status){

                    // Si connecter=vrai
                    //if($group->inscrire()){
                    $this->flash->setMessage("Vous êtes bien inscrit",$this->flash->getSuccessType());
                    header("location:". base_url('groupes/connexion'));
                } else {

                    // Message d'erreur
                    $message = (isset($result->message)) ? $result->message : "Erreur lors du traitement des informations.";
                    $this->flash->setMessage($message, $this->flash->getErrorType());

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
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');

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
                $results = $this->rest->post('sessions', $params);

                // Traitement du résultat
                if(isset($results) && $results->status == TRUE){
                    // Le résultat n'est pas vide et l'attribut 'status' a la valeur TRUE => L'opération a réussi
                    $this->session->is_connected = TRUE;
                    $this->session->group_connected = $results->group;
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

    private function _check_form_information(){

        // Informations générales
        $infos = array(
            array(
                'field' => 'nom',
                'label' => 'Nom du groupe',
                'rules' => 'trim|required'
            ),
            array(
                'field' => 'biographie',
                'label' => 'Biographie',
                'rules' => 'trim'
            ),
            array(
                'field' => 'contacts',
                'label' => 'Informations de contact',
                'rules' => 'trim'
            )
        );

        // Liens
        $liens = array(
            array(
                'field' => 'lien_facebook',
                'label' => 'Lien Facebook',
                'rules' => 'trim|valid_url'
            ),
            array(
                'field' => 'lien_twitter',
                'label' => 'Lien Twitter',
                'rules' => 'trim|valid_url'
            ),
            array(
                'field' => 'lien_youtube',
                'label' => 'Lien Youtube',
                'rules' => 'trim|valid_url'
            ),
            array(
                'field' => 'lien_instagram',
                'label' => 'Lien Instagram',
                'rules' => 'trim|valid_url'
            ),
            array(
                'field' => 'lien_spotify',
                'label' => 'Lien Spotify',
                'rules' => 'trim|valid_url'
            ),
            array(
                'field' => 'lien_itunes',
                'label' => 'Lien iTunes',
                'rules' => 'trim|valid_url'
            ),
            array(
                'field' => 'lien_soundcloud',
                'label' => 'Lien SoundCloud',
                'rules' => 'trim|valid_url'
            ),
            array(
                'field' => 'lien_bandcamp',
                'label' => 'Lien BandCamp',
                'rules' => 'trim|valid_url'
            ),
        );

        // Ajout des validations
        $this->form_validation->set_rules($infos);
        $this->form_validation->set_rules($liens);
    }
}