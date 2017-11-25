<?php

class Utilisateur_model extends CI_Model
{
    //Classe private car pas besoin d'être accessible ailleurs + get et set creer dans cette classe
    private static $db;

    private $id_utilisateurs;
    private $email;
    private $login;
    private $mot_de_passe;
    private $nom;
    private $prenom;
    private $est_actif;

    public function __construct()
    {
        parent::__construct();
        //self:: = $this sauf qu'on fait référence à l'objet courrant déclarer en static donc pas utilisation this mais self
        // Propre à codeigniter c'est pour loader librairies db en static
        self::$db = &get_instance()->db;
    }

    private function peupler($data){
        $result = get_class_vars('Utilisateur_model');
        foreach($result as $key => $value){
            if(isset($data[$key])) {
                $this->$key = $data[$key];
            }
        }
    }

    public static function lister(){
        $query = self::$db->get('UTILISATEURS');
        foreach ($query->result('Utilisateur_model') as $user){
           $users[] = $user;
        }

        return $users;
    }

    public function connecter(){
        // requête de type where 'login' = 'Chris'
        $this->db->where('login', $this->login);
        $this->db->where('mot_de_passe', $this->mot_de_passe);
        $this->db->where('est_actif', TRUE);
        // Select * from
        $query = $this->db->get("UTILISATEURS");
        //selectionne la première ligne
        $row = $query->row(0, 'Utilisateur_model');

        // Si variable row = à quelque chose
        if(isset($row)) {
            // Connexion réussie
            $this->id_utilisateurs =$row->id_utilisateurs;
            $this->nom = $row->nom;
            $this->prenom = $row->prenom;
            $this->email = $row->email;
            $this->est_actif = $row->est_actif;
            //Objet courant va comprendre tout ça donc $user dans controller Welcome sera = à ça
            return TRUE;

        } else{
            // Echec de la connexion

            return FALSE;
        }

    }

    public function get($key){
        return $this->$key;
    }

    public function set($key, $value){
        $this->$key = $value;
    }
}