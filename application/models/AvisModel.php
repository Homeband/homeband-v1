<?php
/**
 * Created by PhpStorm.
 * User: Bertin
 * Date: 05-06-18
 * Time: 00:28
 */

class AvisModel extends CI_Model
{
    public function __construct(){
        parent::__construct();

        // Ajout des libraires
        $this->load->library('homeband');

        // Initialisation de l'api REST (Homeband)
        $this->rest->initialize(array('server' => $this->config->item('homeband_api')));
    }

    public function get($id){
        $url = "aviss/$id";
        $this->homeband->sign();
        $this->rest->get($url);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                return new Avis($result->avis);
            }
        }

        return NULL;
    }

    public function getList(){
        $url = "aviss";
        $this->homeband->sign();
        $this->rest->get($url);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                $array = array();
                foreach($result->aviss as $avis){
                    $array[] = new Avis($avis);
                }

                return $array;
            }
        }

        return array();
    }

    public function add($obj){

    }

    public function update($obj){

    }

    public function delete($id) {

    }
}