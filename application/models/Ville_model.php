<?php

class Ville_model extends CI_Model
{
    private $code_postal;
    private $est_actif;
    private $id_villes;
    private $nom;

    public function ajouter(){
        $this->db->insert('villes', $this);
    }

    public function recuperer_nom(){
       $this->db->where('nom',$this->nom);
        $this->db->where('est_actif',true);
       $query = $this->db->get('villes');
       $row = $query->row(0, 'Ville_model');
       if(isset($row)){
           $this->code_postal =$row->code_postal;
           $this->est_actif = $row->est_actif;
           $this->id_villes = $row->id_villes;
           return true;
       }
       else{
           return false;
       }

    }

    public function get($key){
        return $this->$key;
    }

    public function set($key,$value){
        $this->$key=$value;
    }
}