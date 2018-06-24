<?php

// ------------------------------------------------------------------------
/**
 * Forms Errors
 *
 * Add Forms Errors
 *
 * @access  public
 * @return  string
 */
if ( ! function_exists('form_error_flash'))
{
    function form_error_flash()
    {
        $CI =& get_instance();

        $errors = $CI->form_validation->error_array();

        if (isset($errors) && is_array($errors)) {
            foreach ($errors as $error) {
                $CI->flash->setMessage($error, $CI->flash->getErrorType());
            }
        }
    }
}