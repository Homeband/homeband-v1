<?php
/**
 * Created by PhpStorm.
 * User: christopher
 * Date: 25/11/2017
 * Time: 16:12
 */

class Groupe_model extends CI_Model implements JsonSerializable
{
    private $biographie = '';
    private $contacts = '';
    private $email = '';
    private $est_actif = 1;
    private $id_groupes = 0;
    private $id_style = 0;
    private $id_villes = 0;
    private $lien_bandcamp = '';
    private $lien_facebook = '';
    private $lien_instagram = '';
    private $lien_itunes = '';
    private $lien_soundcloud = '';
    private $lien_spotify = '';
    private $lien_twitter = '';
    private $lien_youtube = '';
    private $login = '';
    private $mot_de_passe = '';
    private $nom = '';

    public function inscrire(){
        $data = get_object_vars($this);
        return $this->db->insert('groupes', $data);
    }

    public function __set($key, $value){
        if(property_exists($this, $key)){
            $this->$key = $value;
        }
    }

    public function jsonSerialize() {
        return (object) get_object_vars($this);
    }


}