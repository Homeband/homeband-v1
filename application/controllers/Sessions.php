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

        $this->load->library('homeband');

        // Initialisation de l'api REST (Homeband)
        $this->rest->initialize(array('server' => 'http://localhost/homeband-api/api/'));

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
                    if(isset($results) && is_object($results) && $results->status == TRUE){
                        $groupe = new Groupe($results->group);
                        // Le résultat n'est pas vide et l'attribut 'status' a la valeur TRUE => L'opération a réussi
                        $this->session->is_connected = TRUE;
                        $this->session->group_connected = $groupe;
                        $this->session->CK = $groupe->api_ck;
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
                        $this->load->view('sessions/index');
                        $this->load->view('templates/footer_group');
                    }
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
}