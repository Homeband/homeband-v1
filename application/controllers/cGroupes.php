<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class cGroupes extends CI_Controller
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

            $this->load->view('templates/header_group', array("groupe" => $this->session->group_connected));
            $this->load->view('groupes/index_connecter', $data);
            $this->load->view('templates/footer_group');
        } else {
            $this->load->view('templates/header_group_not_connected');
            $this->load->view('groupes/index_not_connected');
            $this->load->view('templates/footer_group');
        }
    }

    public function informations(){
        add_js('informations');

        if(!isset($this->session->is_connected) || $this->session->is_connected == FALSE || !isset($this->session->group_connected) || $this->session->group_connected == NULL) {
            header('location:', base_url());
        }

        $id = $this->session->group_connected->id_groupes;
        $result = $this->rest->get("groupes/$id");
        if(isset($result) && !empty($result) && $result->status == TRUE){
            $groupe = $result->group;
            $data['groupe'] = $groupe;

            // Ville
            $result = $this->rest->get('villes/'. $groupe->id_villes);
            if(isset($result) && !empty($result) && $result->status == TRUE){
                $data["ville"] = $result->ville;
            }

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

                $groupe->id_styles = $this->input->post("style");
                $groupe->id_villes = $this->input->post("ville");

                $id_groupes = $this->session->group_connected->id_groupes;
                $url = "groupes/$id_groupes";
                $params = array(
                    'group' => $groupe
                );

                $result = $this->rest->put($url, $params);
                if(isset($result) && $result->status == TRUE){
                    $message = "Les informations ont été modifées avec succès.";
                    $this->flash->setMessage($message, $this->flash->getSuccessType());
                    $data['groupe'] = $result->group;
                    $this->session->group_connected = $result->group;

                    // Ville
                    $result = $this->rest->get('villes/'. $result->group->id_villes);
                    if(isset($result) && !empty($result) && $result->status == TRUE){
                        $data["ville"] = $result->ville;
                    }

                } else {
                    $message = (isset($result->message)) ? $result->message : "Erreur lors du traitement des informations.";
                    $this->flash->setMessage($message, $this->flash->getErrorType());
                }

                ;
            }

            $style_json = $this->rest->get("styles");
            if(isset($style_json) && !empty($style_json) && is_object($style_json)){
                $data['styles'] = $style_json->styles;
            }

            $this->load->view('templates/header_group', array("groupe" => $this->session->group_connected));
            $this->load->view('groupes/online/informations', $data);
            $this->load->view('templates/footer_group');
        } else {

        }
    }

    public function evenements(){
        if($this->session->is_connected == TRUE){
            $this->load->view('templates/header_group', array("groupe" => $this->session->group_connected));
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
        $this->load->view('templates/header_group', array("groupe" => $this->session->group_connected));
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
            $this->load->view('templates/header_group', array("groupe" => $this->session->group_connected));
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
            $this->load->view('templates/header_group', array("groupe" => $this->session->group_connected));
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

            add_js('inscription');
            $this->form_validation->set_rules('login', 'Nom d\'utilisateur', 'trim|required|min_length[2]|max_length[12]');
            $this->form_validation->set_rules('mot_de_passe', 'Mot de passe', 'trim|required|min_length[8]');
            $this->form_validation->set_rules('passconf', 'Confirmation du mot de passe', 'trim|required|matches[mot_de_passe]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('nom', 'Nom du groupe', 'trim|required|min_length[2]|max_length[45]');
            $this->form_validation->set_rules('code_postal', 'Code postal', 'trim|required|min_length[4]|max_length[5]');
            $this->form_validation->set_rules('ville', 'Ville', 'trim|required');
            $this->form_validation->set_rules('style', 'Style de musique', 'trim|required');

            if($this->form_validation->run() == FALSE){

                form_error_flash();

                // Affichage de la page d'inscription
                $style_json = $this->rest->get("styles");
                if(isset($style_json) && !empty($style_json) && is_object($style_json)){
                    $data['styles'] = $style_json->styles;
                }

                $this->load->view('templates/header_group_not_connected');
                $this->load->view('groupes/inscription', $data);
                $this->load->view('templates/footer_group');
            } else {
                // Création d'une instance de groupe avec les informations du formulaire
                $group = new Groupe($this->input->post());
                $group->id_villes = $this->input->post('ville');
                $group->id_styles = $this->input->post('style');


                $result = $this->rest->post('groupes', array("group" => $group));

                // Si le resultat est un objet (réponse OK) et que le statut de la réponse est TRUE
                if(is_object($result) && $result->status){
                    $this->flash->setMessage("Vous êtes bien inscrit",$this->flash->getSuccessType());
                    header("location:". base_url('groupes/connexion'));
                } else {

                    // Message d'erreur
                    $message = (is_object($result) && isset($result->message)) ? $result->message : strip_tags($result);//"Erreur lors du traitement des informations.";
                    $this->flash->setMessage($message, $this->flash->getErrorType());

                    // Affichage de la page de connexion
                    $style_json = $this->rest->get("styles");
                    if(isset($style_json) && !empty($style_json) && is_object($style_json)){
                        $data['styles'] = $style_json->styles;
                    }

                    $this->load->view('templates/header_group_not_connected');
                    $this->load->view('groupes/inscription', $data);
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
                    'mot_de_passe' => $this->input->post('password'),
                    'type' => 2
                );

                // Appel à l'API
                $this->homeband->sign();
                $results = $this->rest->post('sessions', $params);

                if($this->curl->info["http_code"] == 401) {
                    $this->session->is_connected = FALSE;
                    $this->flash->setMessage("Erreur lors de la tentative de connexion (API).", $this->flash->getErrorType());

                    // Affichage de la page de connexion
                    $this->load->view('templates/header_group_not_connected');
                    $this->load->view('groupes/connexion');
                    $this->load->view('templates/footer_group');
                } else {
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