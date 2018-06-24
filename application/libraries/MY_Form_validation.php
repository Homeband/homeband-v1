<?php
/** 
 * @author Vivek kumar Tripathi <vkt005@gmail..com> 
**/
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    private $format = 'd-m-Y H:i:s';
    private $my_error_messages = array();

    function __construct($config = array()) {
        parent::__construct($config);
        $this->my_error_messages['form_validation_datetime'] = 'The {field} field must have format(' . $this->format . ').';
    }

    function error_array() {
        if (count($this->_error_array) === 0)
            return FALSE;
        else
            return $this->_error_array;
    }

    public function datetime($date, $val) {
        $s = array("-", "/");
        $date = str_replace($s, "-", $date);
        $date_time = explode(' ', $date);

        if (date($val, strtotime($date)) == $date)
            return true;
        $this->format = $val;

        return FALSE;
    }

}
