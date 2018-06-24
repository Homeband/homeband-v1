<?php
/**
 * Created by PhpStorm.
 * User: Bertin
 * Date: 05-06-18
 * Time: 00:00
 */

class GroupeModel extends CI_Model
{
    public function __construct(){
        parent::__construct();

        // Ajout des libraires
        $this->load->library('homeband');

        // Initialisation de l'api REST (Homeband)
        $this->rest->initialize(array('server' => $this->config->item('homeband_api')));
    }

    public function get($id_groupes){
        $url = "groupes/$id_groupes";
        $this->homeband->sign();
        $result = $this->rest->get($url);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                $groupe = new Groupe($result->group);
                $groupe->mot_de_passe = "";
                $groupe->api_ck = "";
                return $groupe;
            }
        }

        return NULL;
    }

    public function getList(){
        $url = "groupes";
        $this->homeband->sign();
        $result = $this->rest->get($url);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                $array = array();
                foreach($result->groups as $group){
                    $array[] = new Groupe($group);
                }

                return $array;
            }
        }

        return array();
    }

    public function add($groupe){

    }

    public function update($obj){
        $url = "groupes/$obj->id_groupes";
        $params = array(
            'group' => $obj
        );

        $this->homeband->sign();
        $result = $this->rest->put($url, $params);
        if(isset($result) && !empty($result) && is_object($result) && isset($result->status) && $result->status == TRUE){
            $message = "Les informations ont été modifées avec succès.";
            $this->flash->setMessage($message, $this->flash->getSuccessType());

            return TRUE;
        } else {
            $message = (isset($result->message)) ? $result->message : "Erreur lors du traitement des informations.";
            $this->flash->setMessage($message, $this->flash->getErrorType());

            return FALSE;
        }
    }

    public function delete($id_groupes){

    }

    public function connect($username, $password){

        // Appel à l'API
        // Paramètres d'appel à l'API

        $url = "sessions";
        $params = array(
            'login' => $username,
            'mot_de_passe' => $password,
            'type' => 2
        );

        $this->homeband->sign();
        $results = $this->rest->post($url, $params);

        if($this->curl->info["http_code"] == 401) {
            $this->session->is_connected = FALSE;
            $this->flash->setMessage("Vous n'êtes pas autorisés à accéder à cette page.", $this->flash->getErrorType());
        } else {
            // Traitement du résultat
            if(isset($results) && is_object($results) && isset($results->status) && $results->status == TRUE){
                $groupe = new Groupe($results->group);
                $this->session->is_connected = TRUE;
                $this->session->group_connected = $groupe;
                $this->session->CK = $groupe->api_ck;

                return TRUE;
            } else {
                $this->session->is_connected = FALSE;

                if(isset($results)){
                    $this->flash->setMessage($results->message, $this->flash->getErrorType());
                } else {
                    $this->flash->setMessage("Erreur lors de la tentative de connexion.", $this->flash->getErrorType());
                }
            }
        }

        return FALSE;
    }

    public function listEvents($id){
        $url = "groupes/$id/evenements";
        $this->homeband->sign();
        $result = $this->rest->get($url);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                $array = array();
                foreach($result->events as $event){
                    $array[] = new Evenement($event);
                }

                return $array;
            }
        }

        return array();
    }

    public function forgetPassword($email){
        $url = "groupes/forget";
        $this->homeband->sign();
        $params = array(
            "email" => $email
        );
        $result = $this->rest->post($url,$params);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                return true;
            }
        }

        return false;
    }


}