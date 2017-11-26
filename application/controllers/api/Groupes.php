<?php

class Groupes extends CI_Controller
{
    public function lister(){
        $content = array(
            array("Groupe 1", "Nom", "Login"),
            array("Groupe 2", "Nom 2", "Login 2")
        );

        echo json_encode($content);
    }
}