<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/core/MY_controller.php");

class Login_api extends JwtAPI_Controller { 
    
    public function __construct () 
    { 
        parent::__construct ();
        $this->load->database();

        $config=[
            "sub" => "secure.jwt.bitbit", // subject of token
            "jti" => $this->uuid->v5('secure.jwt.bitbit')// Json Token Id
        ];
        $this->init($config,300); // configuration + auth timeout
    }
    
    public function login_post()
    {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Authorization: Bearer");
        
        $user = $this->post("username");
        $pass = $this->post("password");
        if ($this->login($user, $pass)){
            $jwt = $this->renewJWT();
        }
    }

    public function login_options() {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Authorization: Bearer");

        $this->response(null,200); // OK (200) being the HTTP response code
    }

}