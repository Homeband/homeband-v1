<?php
/**
 * Created by PhpStorm.
 * User: christopher
 * Date: 25/11/2017
 * Time: 16:12
 */

class Groupe extends CI_Model
{
    public $biographie = '';
    public $contacts = '';
    public $email = '';
    public $est_actif = 1;
    public $id_groupes = 0;
    public $id_style = 0;
    public $id_villes = 0;
    public $lien_bandcamp = '';
    public $lien_facebook = '';
    public $lien_instagram = '';
    public $lien_itunes = '';
    public $lien_soundcloud = '';
    public $lien_spotify = '';
    public $lien_twitter = '';
    public $lien_youtube = '';
    public $login = '';
    public $mot_de_passe = '';
    public $nom = '';

    public function __construct()
    {
        parent::__construct();
    }

}