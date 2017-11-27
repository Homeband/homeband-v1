<?php
/**
 * Created by PhpStorm.
 * User: christopher
 * Date: 25/11/2017
 * Time: 16:12
 */

class Groupe_model extends CI_Model
{
    private $biographie;
    private $contacts;
    private $email;
    private $est_actif;
    private $id_groupes;
    private $id_styles;
    private $id_villes;
    private $lien_bandcamp;
    private $lien_facebook;
    private $lien_instagram;
    private $lien_itunes;
    private $lien_souncloud;
    private $lien_spotify;
    private $lien_twitter;
    private $lien_youtube;
    private $login;
    private $mot_de_passe;
    private $nom;

    public function inscrire(){
        $test=$this->toArray();
        die(var_dump($test));
        $this->db->insert('groupes', (array)$this);
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