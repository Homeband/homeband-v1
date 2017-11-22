<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
        $this->load->view('templates/header');
		$this->load->view('Welcome/index');
        $this->load->view('templates/footer');

	}

    public function test(){
        $this->load->view('templates/header_admin');
        $this->load->view('Welcome/test');
        $this->load->view('templates/footer_admin');
    }

    public function session(){


    }

    public function Connexion(){


        if($this->session->isconnected == TRUE){
            $this->index();
        } else {

            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');

            if($this->form_validation->run() == FALSE){
                // Affichage de la page de connexion
                $this->load->view('templates/header_admin');
                $this->load->view('Welcome/connexion');
                $this->load->view('templates/footer_admin');
            } else {
                // Code de connexion
                $this->load->view('templates/header_admin');
                $this->load->view('Welcome/connexion');
                $this->load->view('templates/footer_admin');
            }
        }
    }

    public function Deconnexion(){

    }

}
