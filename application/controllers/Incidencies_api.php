<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/core/MY_controller.php");

class Incidencies_api extends JwtAPI_Controller { 
    
    public function __construct () 
    { 
        parent::__construct ();
        $this->load->database();
        $this->load->model("incidencies_model");

        $config=[
            "sub" => "secure.jwt.bitbit", // subject of token
            "jti" => $this->uuid->v5('secure.jwt.bitbit')// Json Token Id
        ];
        $this->init($config,300); // configuration + auth timeout
    }

    public function incidencia_post() {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Authorization: Bearer");

        $jwt = $this->renewJWT();
        
        //DADES
        $marca_equip = $this->post("marca_equip");
        $taller = $this->post("taller");
        $tecnic = $this->post("tecnic");
        $client = $this->post("client");
        $estat = $this->post("estat");
        $descripcio = $this->post("descripcio");

        if ($this->incidencies_model->incidencia($marca_equip, $taller, $tecnic, $client, $estat, $descripcio) != null){
            $message = [
                'status' => true,
                'message' => 'Incidencia afegida correctament'
            ];
            $this->set_response($message, 200);
        }
    }

    public function getincidencia_get($id) {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Authorization: Bearer");

        $unicInc = $this->incidencies_model->getincidencia($id);
        $this->set_response($unicInc, 200);
    }

    public function getincidencies_get() {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Authorization: Bearer");

        $inc = $this->incidencies_model->getincidencies();
        $this->set_response($inc, 200);
    }

    public function deleteincidencies_delete($id) {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->output->set_header("Access-Control-Allow-Methods: GET, DELETE, POST, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Authorization: Bearer");

        $inc = $this->incidencies_model->deleteincidencies($id);
        $this->set_response($inc, 200);
    }

    public function editincidencia_put($id) {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->output->set_header("Access-Control-Allow-Methods: GET, DELETE, POST, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Authorization: Bearer");

        $inc = $this->incidencies_model->editincidencia($id);
        $this->set_response($inc, 200);
    }

    public function incidencia_options() {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Authorization: Bearer ");

        $this->response(null,200); // OK (200) being the HTTP response code
    }

    public function getincidencia_options() {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Authorization: Bearer ");

        $this->response(null,200); // OK (200) being the HTTP response code
    }

    public function getincidencies_options() {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Authorization: Bearer ");

        $this->response(null,200); // OK (200) being the HTTP response code
    }

    public function deleteincidencies_options() {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, DELETE, POST, PUT, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Authorization: Bearer ");

        $this->response(null,200); // OK (200) being the HTTP response code
    }
}