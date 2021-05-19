<?php defined('BASEPATH') OR exit('No direct script access allowed');
require_once("application/core/MY_controller.php");


class registerclient_api  extends JwtAPI_Controller { 
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

    public function registerclient_post() {

        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Authorization: Bearer");

        if ($this->auth_request()){
            $jwt = $this->renewJWT();

            //DADES
            $username = $this->post("user"); 
            $password = $this->post("password");
            $email = $this->post("email");
            $additional_data = array(
                        'first_name' => $this->post("firstName"),
                        'last_name' => $this->post("lastName"),
                        'company' => $this->post("company"),
                        'phone' => $this->post("phone"),
                        );
            $group = array('2'); // Sets user to client.

            if ($this->ion_auth->register($username, $password, $email, $additional_data, $group) != null){
                $message = [
                    'status' => true,
                    'message' => 'Perfil editat correctament'
                ];
                $this->set_response($message, 200);
            } else {
                $message = [
                    'status' => false,
                    'message' => 'Error. Torna-ho a intentar'
                ];
                $this->set_response($message, 401);
            }
            //DADES

        } else {
            $message = [
                'status' => $this->auth_code,
                'token' => "",
                'message' => 'Bad auth information. ' . $this->error_message
            ];
            $this->set_response($message, $this->auth_code); // 400 / 401 / 419 / 500
        }
    }
    

    public function registerworker_options() {
        $this->output->set_header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
        $this->output->set_header("Access-Control-Allow-Methods: GET, POST, PUT, OPTIONS");
        $this->output->set_header("Access-Control-Allow-Origin: *");
        $this->output->set_header("Authorization: Bearer ");

        $this->response(null,200); // OK (200) being the HTTP response code
    }

}
