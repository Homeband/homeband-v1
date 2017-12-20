<?php
/**
 * Created by PhpStorm.
 * User: Nicolas
 * Date: 20-12-17
 * Time: 14:58
 */

class Homeband
{
    protected $AK = "zXcD3WS21G0300mqxNaecHvnmy37W4rw";
    protected $AS = "LcBaMofTEoPqBHPwqOJHHOPQ0n9vP6cGxf2PnpbNQW3gELs";
    protected $CK = "";

    public function __construct(){
        $ci = &get_instance();

        $CK = $ci->session->CK;
        if(isset($CK)){
            $this->CK = $CK;
        }

        $AK = $ci->config->item('AK');
        if(isset($AK)){
            $this->AK = $AK;
        }
    }

    /**
     * Sign the requests to Homeband API
     */
    public function sign(){
        $ci = &get_instance();

        $now = time();
        $signature = "$1$" . hash("sha256", $this->AS . '+' . $this->CK . '+' . $now);

        $ci->rest->http_header("X-Homeband-AK", $this->AK);
        $ci->rest->http_header("X-Homeband-TS", $now);
        $ci->rest->http_header("X-Homeband-SIGN", $signature);

        if(!empty($this->CK)){
            $ci->rest->http_header("X-Homeband-CK", $this->CK);
        }
    }

}