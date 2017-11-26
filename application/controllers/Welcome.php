<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {


    public function __construct()
    {
        parent::__construct();
        $this->load->model('utilisateur_model');
        $this->load->model('groupe_model');

    }

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

        if($this->session->is_connected == TRUE){
            //redirection d'adresse ( ex : homeband/form/connexion en homeband/ )
            header("location:". base_url('Welcome/acceuil'));

        } else {

            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[5]|max_length[12]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');

            if($this->form_validation->run() == FALSE){
                // Affichage de la page de connexion
                $this->load->view('templates/header_admin_not_connected');
                $this->load->view('Welcome/connexion');
                $this->load->view('templates/footer_admin');
            } else {
                //Instance classe utilisateur_model dans variable $user ($user = $this dans utilisateur_model)
                $user = new Utilisateur_model();
                //Met à jour les données de l'objet user
                //set($key,$value) { $this-> $key = $value}
                //set('login','chris') { $user -> 'login'='Chris'}
                $user->set('login', $this->input->post('username'));
                $user->set('mot_de_passe', $this->input->post('password'));
                // Si connecter=vrai
                if($user->connecter()){
                    $this->session->is_connected = TRUE;
                    $this->session->user_connected = $user;
                    header("location:". base_url('Welcome/acceuil'));
                } else {

                    $this->session->is_connected = FALSE;

                    $this->flash->setMessage('Login ou mot de passe incorrect', $this->flash->getErrorType());

                    // Affichage de la page de connexion
                    $this->load->view('templates/header_admin_not_connected');
                    $this->load->view('Welcome/connexion');
                    $this->load->view('templates/footer_admin');
                }

            }
        }
    }
    public function inscription(){


        if($this->session->is_connected == TRUE){
            //redirection d'adresse ( ex : homeband/form/connexion en homeband/ )
            header("location:". base_url());

        } else {

            $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[2]|max_length[12]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]');
            $this->form_validation->set_rules('passconf', 'Password Confirm', 'trim|required|matches[password]');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->form_validation->set_rules('band', 'Band Name', 'trim|required|min_length[2]|max_length[45]');
            $this->form_validation->set_rules('ville', 'Ville', 'trim|required|min_length[2]|max_length[45]');
            if($this->form_validation->run() == FALSE){
                // Affichage de la page de connexion
                $this->load->view('templates/header_admin_not_connected');
                $this->load->view('Welcome/inscription');
                $this->load->view('templates/footer_admin');
            } else {
                $ville = new Ville_model();
                $ville->set('nom', $this->input->post('ville'));
                if($ville->recuperer_nom()==false){
                    $ville->ajouter();
                }
                //Instance classe utilisateur_model dans variable $user ($user = $this dans utilisateur_model)
                $group = new Groupe_model();
                //Met à jour les données de l'objet user
                //set($key,$value) { $this-> $key = $value}
                //set('login','chris') { $user -> 'login'='Chris'}
                $group->set('login', $this->input->post('username'));
                $group->set('mot_de_passe', $this->input->post('password'));
                $group->set('email', $this->input->post('email'));
                $group->set('nom', $this->input->post('band'));

                // Si connecter=vrai
                if($group->inscrire()){
                    $this->session->is_connected = TRUE;
                    $this->session->user_connected = $group;
                    header("location:". base_url('Welcome/acceuil'));
                } else {

                    $this->session->is_connected = FALSE;

                    // Affichage de la page de connexion
                    $this->load->view('templates/header_admin_not_connected');
                    $this->load->view('Welcome/connexion');
                    $this->load->view('templates/footer_admin');
                }

            }
        }
    }

    public function Deconnexion(){
       $this->session->is_connected = FALSE;
       header("location:". base_url('Welcome/connexion'));
    }

    public function acceuil(){
        $this->load->view('templates/header_admin');
        $this->load->view('Welcome/index_connecter');
        $this->load->view('templates/footer_admin');
    }
    public function groups(){
        $this->load->view('templates/header_admin_not_connected');
        $this->load->view('Welcome/group_space');
        $this->load->view('templates/footer_admin');
    }

}
