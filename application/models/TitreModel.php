<?php
/**
 * Created by PhpStorm.
 * User: Bertin
 * Date: 05-06-18
 * Time: 00:27
 */

class TitreModel extends CI_Model
{
    public function __construct(){
        parent::__construct();

        // Ajout des libraires
        $this->load->library('homeband');

        // Initialisation de l'api REST (Homeband)
        $this->rest->initialize(array('server' => $this->config->item('homeband_api')));
    }

    public function get($id){
        $url = "titres/$id";
        $this->homeband->sign();
        $this->rest->get($url);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                return new Titre($result->title);
            }
        }

        return NULL;
    }

    public function getList(){
        $url = "titres";
        $this->homeband->sign();
        $this->rest->get($url);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                $array = array();
                foreach($result->titles as $titre){
                    $array[] = new Titre($titre);
                }

                return $array;
            }
        }

        return array();
    }

    public function add($id, $obj){
        $url = "albums/$id/titres";
        $this->homeband->sign();
        $params = array(
            "titre" => $obj
        );

        $this->rest->post($url, $params);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                return $result->title;
            }
        }

        return null;
    }

    public function update($obj){

    }

    public function delete($id) {

    }
}