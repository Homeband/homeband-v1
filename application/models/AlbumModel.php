<?php
/**
 * Created by PhpStorm.
 * User: Bertin
 * Date: 05-06-18
 * Time: 00:27
 */

class AlbumModel extends CI_Model
{
    public function __construct(){
        parent::__construct();

        // Ajout des libraires
        $this->load->library('homeband');

        // Initialisation de l'api REST (Homeband)
        $this->rest->initialize(array('server' => $this->config->item('homeband_api')));
    }

    public function get($id){
        $url = "albums/$id";
        $this->homeband->sign();
        $this->rest->get($url);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                return new Album($result->album);
            }
        }

        return NULL;
    }

    public function getList($id){
        $url = "groupes/$id/albums";
        $this->homeband->sign();
        $result = $this->rest->get($url);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
                $array = array();
                foreach($result->albums as $album){
                    $array[] = new Album($album);
                }

                return $array;
            }
        }

        return array();
    }

    public function add($id,$obj){
        $url = "groupes/$id/albums";
        $this->homeband->sign();
        $params = array(
            "album" => $obj
        );
        $result = $this->rest->post($url, $params);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
               return $result->album;
            }
        }

        return null;
    }

    public function update($id, $obj, $id_groupes){
        $url = "groupes/$id_groupes/albums/$id";
        $this->homeband->sign();
        $params = array(
            "album" => $obj
        );

        $result = $this->rest->put($url, $params);

        if(isset($result) && !empty($result) && is_object($result)){
            if(isset($result->status) && $result->status == TRUE){
               return $result->album;
            }
        }

        return null;
    }

    public function delete($id) {

    }
}