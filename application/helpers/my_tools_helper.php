<?php
/**
 * Created by PhpStorm.
 * User: nicolasgerard
 * Date: 12/01/18
 * Time: 11:57
 */
// ------------------------------------------------------------------------
/**
 * Check authentication
 *
 * Vérifie qu'un utilisateur est connecté.
 * Si ce n'est pas le cas, l'utilisateur est redirigé sur la page d'accueil du site
 *
 * @access  public
 */
if( ! function_exists('check_connexion')) {
    function check_connexion()
    {
        $ci = &get_instance();
        if(!isset($ci->session->is_connected) || $ci->session->is_connected == FALSE || !isset($ci->session->group_connected) || $ci->session->group_connected == NULL) {
            header('location:', base_url());
            exit;
        }
    }
}