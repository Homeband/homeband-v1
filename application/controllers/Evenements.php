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
        $this->load->model("EvenementModel", "evenements");

        add_css(array('style', 'form_inscription', 'group_space', 'Informations'));
        add_js('evenements');
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

        $header["groupe"] = $this->session->group_connected;
        $data["erreur_api"] = false;

        $group = $this->session->group_connected;

        $this->form_validation->set_rules('nom', 'Nom', 'trim|required');
        $this->form_validation->set_rules('date_heure', 'Date & Heure', 'trim|required|datetime[Y-m-d H:i:s]');
        $this->form_validation->set_rules('description', 'Description', 'trim');
        $this->form_validation->set_rules('rue', 'Adresse', 'trim|required');
        $this->form_validation->set_rules('numero', 'Adresse', 'trim|required|numeric');
        $this->form_validation->set_rules('boite', 'Boîte', 'trim');
        $this->form_validation->set_rules('code_postal', 'Code postal', 'trim|required');
        $this->form_validation->set_rules('ville', 'Ville', 'trim|required|numeric');

        if($this->form_validation->run() == FALSE) {

            // Ajout des erreurs du formulaire
            form_error_flash();
        } else {

            // Modification des attributs du formulaire sur l'objet récupéré précédemment
            $event = new Evenement();
            foreach($this->input->post() as $att => $val){
                if(property_exists($event, $att)){
                    $event->$att = $val;
                }
            }

            $adresse = new Adresse();
            $adresse->rue = $this->input->post('rue');
            $adresse->numero = $this->input->post('numero');
            $adresse->boite = $this->input->post('boite');
            $adresse->id_villes = $this->input->post('ville');

            $event = $this->evenements->add($group->id_groupes, $event, $adresse);
            if($event != null){

                $illustration = $this->input->post('illustration');
                if(isset($illustration)){
                    $config['upload_path']          = FCPATH . 'assets/images/ressources/evenements';
                    $config['allowed_types']        = 'gif|jpg|png';
                    $config['overwrite']            = TRUE;
                    $config['file_name']            = $event->id_evenements;

                    $this->load->library('upload', $config);

                    if($this->upload->do_upload('illustration')){
                        $event->illustration = $this->upload->data("file_name");
                        $this->evenements->update($group->id_groupes, $event);

                        header('location:' + base_url("groupes/evenements"));
                    }
                } else {
                    header('location:' + base_url("groupes/evenements"));
                }
            }
        }

        $this->load->view('templates/header_group', $header);
        $this->load->view('evenements/ficheEvenement', $data);
        $this->load->view('templates/footer_group');
    }
}