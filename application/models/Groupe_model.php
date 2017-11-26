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
        $this->db->insert('groupes', $this);
    }

    public function get($key){
        return $this->$key;
    }

    public function set($key,$value){
        $this->$key=$value;
    }
}