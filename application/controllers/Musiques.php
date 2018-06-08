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

        $group = $this->session->group_connected;

        if($this->form_validation->run() == FALSE) {

            // Ajout des erreurs du formulaire
            form_error_flash();
        } else {

            // Modification des attributs du formulaire sur l'objet récupéré précédemment
            $album = new Album();
            foreach($this->input->post() as $att => $val){
                if(property_exists( $album, $att)){
                    $album->$att = $val;
                }
            }

            $album = $this->albums->add($group->id_groupes, $album);
            if($album != null){
                $config['upload_path']          = FCPATH . 'assets/images/ressources/albums';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['overwrite']            = TRUE;
                $config['file_name']            = $album->id_albums;

                $this->load->library('upload', $config);

                if($this->upload->do_upload('illustration')){
                    $album->image = $this->upload->data("file_name");
                    $album = $this->albums->update($album->id_albums, $album);
                }
            }

        }

        $this->load->view('templates/header_group', $header);
        $this->load->view('musiques/ficheAlbum', $data);
        $this->load->view('templates/footer_group');
    }
}