<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once( APPPATH.'/libraries/REST_Controller.php' );
use Restserver\Libraries\REST_Controller;

class Usuario extends REST_Controller {
    
    public function __construct()
    {
    header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
    header("Access-Control-Allow-Origin: *");
        parent::__construct();
        $this->load->model('usuario_model');
    }


    public function registrar_post() {
        //obtener campos para registrar
        $user = [
            "nombre" => $this->post('nombre'),
            "edad" => $this->post('edad'),
            "genero"=> $this->post('genero'),
            "email" => $this->post('email'),
            "password"=> $this->post('password')
        ];
        $user_register=$this->usuario_model->registrar_usuario($user);
        if($user_register){
            $response = [
                "request"=>true,
                "message"=>"Usuario creo con exito"
            ];
            $this->response($response);
        }else{
            $response = [
                "request"=>false,
                "message"=>"Email ya existe"
            ];
            $this->response($response);
        }
        return ;
    }

    public function login_post() {
        $user_autenticate = [
            "email"=>$this->post("email"),
            "password"=>$this->post("password")
        ];
        $user_loggin = $this->usuario_model->login($user_autenticate);

        $this->response($user_loggin);
    }
}
