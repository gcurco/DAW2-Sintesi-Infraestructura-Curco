<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/core/MY_controller.php");

class Getusers_api extends JwtAPI_Controller { 
    
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

    public function getclients_get() {
        $clients = $this->ion_auth->users('clients')->result(); // get users from 'clients' group
        var_dump($clients);
    }

    public function gettecnics_get() {
        $tecnics = $this->ion_auth->users('tecnic')->result(); // get users from 'tecnics' group
        var_dump($tecnics);
    }
}