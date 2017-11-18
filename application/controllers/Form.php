<?php
/**
 * Created by PhpStorm.
 * User: christopher
 * Date: 18/11/2017
 * Time: 13:20
 */

class Form extends CI_Controller
{
    public function index(){
        $this->load->view('templates/header_others');
        $this->load->view('Form/inscription');
        $this->load->view('templates/footer');

        /* Load form helper */
        $this->load->helper(array('form', 'url'));




    }
}