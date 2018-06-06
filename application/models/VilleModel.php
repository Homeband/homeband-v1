<?php
/**
 * Created by PhpStorm.
 * User: Bertin
 * Date: 05-06-18
 * Time: 00:26
 */

class VilleModel extends CI_Model
{
    public function __construct(){
        parent::__construct();

        // Ajout des libraires
        $this->load->library('homeband');

        // Initialisation de l'api REST (Homeband)
        $this->rest->initialize(array('server' => $this->config->item('homeband_api')));
    }

    public function get($id){
        $url = "villes/$id";
        $this->homeband->sign();
        $result = $this->rest->get($url);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                return new Ville($result->ville);
            }
        }

        return NULL;
    }

    public function getList(){
        $url = "villes";
        $this->homeband->sign();
        $result = $this->rest->get($url);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                $array = array();
                foreach($result->villes as $ville){
                    $array[] = new Ville($ville);
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