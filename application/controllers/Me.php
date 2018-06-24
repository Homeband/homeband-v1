<?php
/**
 * Created by PhpStorm.
 * User: Administrateur
 * Date: 19-04-18
 * Time: 14:09
 */

class Me extends CI_Controller
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

        $this->load->helper('file');

        // CSS & JS
        add_css(array('style', 'form_inscription', 'group_space', 'Informations'));
    }

    public function index(){
        check_connexion();

        $group = $this->session->group_connected;
        $data['group'] = $group;

        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

        if($this->form_validation->run() == TRUE){
            $group->email = $this->input->post("email");
            $endpoint = "groupes/$group->id_groupes";
            $params = array(
                "group" => $group
            );

            $this->homeband->sign();
            $result = $this->rest->put($endpoint, $params);
            if(isset($result) && is_object($result) && isset($result->status)){
                if($result->status){
                    $group = $result->group;
                    $this->session->group_connected = $group;

                    $this->flash->setMessage("Modification effectuée !", $this->flash->getSuccessType());
                } else {

                    $this->flash->setMessage($result->message, $this->flash->getErrorType());
                }
            } else {
                $this->flash->setMessage("Une erreur s'est produite lors de la modification !", $this->flash->getErrorType());
            }
        }

        $this->load->view('templates/header_group', array("groupe" => $this->session->group_connected));
        $this->load->view('me/index', $data);
        $this->load->view('templates/footer_group');

    }

    public function password(){
        check_connexion();

        $group = $this->session->group_connected;
        $data['group'] = $group;

        $this->form_validation->set_rules('password', 'Nouveau mot de passe', 'trim|required|min_length[8]');
        $this->form_validation->set_rules('confirm', 'Confirmation ', 'trim|required|matches[password]');


        if($this->form_validation->run() == TRUE){
            $group->mot_de_passe = $this->input->post("password");
            $endpoint = "groupes/$group->id_groupes";
            $params = array(
                "group" => $group
            );
            $this->homeband->sign();
            $result = $this->rest->put($endpoint, $params);
            if(isset($result) && is_object($result) && isset($result->status)){
                if($result->status){
                    $group = $result->group;
                    $this->session->group_connected = $group;
                    $this->flash->setMessage("Modification effectuée !", $this->flash->getSuccessType());

                } else {

                    $this->flash->setMessage($result->message, $this->flash->getErrorType());
                }
            } else {
                $this->flash->setMessage("Une erreur s'est produite lors de la modification !", $this->flash->getErrorType());
            }
        } else {
            form_error_flash();
        }

        $this->index();

    }
}