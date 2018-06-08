<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class groupes extends CI_Controller
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
        $this->load->model("VilleModel", "villes");
        $this->load->model("StyleModel", "styles");

        $this->load->helper('file');

        // CSS & JS
        add_css(array('style', 'form_inscription', 'group_space', 'Informations'));
    }

    /**
     * Index Page for this controller.
     */
    public function index()
    {

        // Affichage d'une page d'index en fonction d'un visiteur ou utilisateur connecté
        if($this->session->is_connected == TRUE){

            $data = array();

            $id = $this->session->group_connected->id_groupes;
            $group = $this->groupes->get($id);
            if(isset($group)) {
                $data['groupe'] = $group;
            }

            $this->load->view('templates/header_group', array("groupe" => $this->session->group_connected));
            $this->load->view('groupes/index', $data);
            $this->load->view('templates/footer_group');
        } else {
            $this->load->view('templates/header_group_not_connected');
            $this->load->view('offline/index');
            $this->load->view('templates/footer_group');
        }
    }

    public function informations(){

        $config['upload_path']          = FCPATH . 'assets/images/ressources/groups';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['overwrite']            = TRUE;
        $config['file_name']            = $this->session->group_connected->id_groupes;

        $this->load->library('upload', $config);

        add_js('informations');
        check_connexion();

        $id = $this->session->group_connected->id_groupes;
        $group = $this->groupes->get($id);
        if(isset($group)) {

            $data['groupe'] = $group;

            // Ville
            $ville = $this->villes->get($group->id_villes);
            if(isset($ville)){
                $data["ville"] = $ville;
            }

            $this->_check_form_information();
            if($this->form_validation->run() == FALSE) {

                // Ajout des erreurs du formulaire
                form_error_flash();
            } else {

                // Modification des attributs du formulaire sur l'objet récupéré précédemment
                foreach($this->input->post() as $att => $val){
                    if(property_exists($group, $att)){
                        $group->$att = $val;
                    }
                }

                if($this->upload->do_upload('illustration')){
                    $old = $group->illustration;
                    $new = $this->upload->data("file_name");


                    if($old != $new){
                        $file = FCPATH . 'assets/images/ressources/groups/' . $old;
                        if(file_exists($file)){
                            unlink($file);
                        }
                    }
                    $group->illustration = $this->upload->data("file_name");
                }

                $group->id_styles = $this->input->post("style");
                $group->id_villes = $this->input->post("ville");

                if($this->groupes->update($group)){
                    $group = $this->groupes->get($id);
                    $ville = $this->villes->get($group->id_villes);

                    $this->session->group_connected = $group;
                    $data['groupe'] = $group;
                    $data["ville"] = $ville;
                }
            }

            $data['styles'] = $this->styles->getList();

            //$avatar =

            $this->load->view('templates/header_group', array("groupe" => $this->session->group_connected));
            $this->load->view('groupes/online/informations', $data);
            $this->load->view('templates/footer_group');
        } else {

        }
    }

    public function profil(){
    if($this->session->is_connected == TRUE){
        $this->load->view('templates/header_group', array("groupe" => $this->session->group_connected));
        $this->load->view('groupes/profil');
        $this->load->view('templates/footer_group');
    } else {
        $this->load->view('templates/header_group_not_connected');
        $this->load->view('groupes/index_not_connected');
        $this->load->view('templates/footer_group');
    }
}

    public function avis(){

        $this->load->helper('date');

        add_js('Commentaires');
        check_connexion();

        $header["groupe"] = $this->session->group_connected;
        $data["erreur_api"] = false;

        // Requête vers l'API
        $id = $this->session->group_connected->id_groupes;
        $this->homeband->sign();
        $result = $this->rest->get("groupes/$id/avis");

        // Traitement du résultat
        if(isset($result) && !empty($result) && is_object($result) && $result->status == TRUE){
            $comments = $result->comments;
            $data['commentaires'] = $comments;

        } else {
            $data["erreur_api"] = true;
        }

        $this->load->view('templates/header_group', $header);
        $this->load->view('groupes/online/avis', $data);
        $this->load->view('templates/footer_group');
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
                $this->load->view('offline/inscription', $data);
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
                    $this->load->view('offline/inscription', $data);
                    $this->load->view('templates/footer_group');
                }
            }
        }
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