<?php
/**
 * Created by PhpStorm.
 * User: Bertin
 * Date: 05-06-18
 * Time: 00:27
 */

class EvenementModel extends CI_Model
{
    public function __construct(){
        parent::__construct();

        // Ajout des libraires
        $this->load->library('homeband');

        // Initialisation de l'api REST (Homeband)
        $this->rest->initialize(array('server' => $this->config->item('homeband_api')));
    }

    public function get($id_groupes, $id_evenements){
        $url = "groupes/$id_groupes/evenements/$id_evenements";
        $this->homeband->sign();
        $result = $this->rest->get($url);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                return new Evenement($result->event);
            }
        }

        return NULL;
    }

    public function getList(){
        $url = "evenements";
        $this->homeband->sign();
        $result = $this->rest->get($url);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                $array = array();
                foreach($result->events as $evenement){
                    $array[] = new Evenement($evenement);
                }

                return $array;
            }
        }

        return array();
    }

    public function add($id, $obj, $adresse){
        $url = "groupes/$id/evenements";
        $this->homeband->sign();
        $params = array(
            "event" => $obj,
            "address" => $adresse
        );

        $result = $this->rest->post($url, $params);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                return $result->event;
            }
        }

        return null;
    }

    public function update($id, $obj){
        $url = "groupes/$id/evenements/$obj->id_evenements";
        $this->homeband->sign();
        $params = array(
            "event" => $obj
        );

        $result = $this->rest->put($url, $params);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                return $result->event;
            }
        }

        return null;
    }

    public function delete($id) {

    }
}