<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once( APPPATH.'/libraries/REST_Controller.php' );
use Restserver\Libraries\REST_Controller;

class Glucosa extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('glucosa_model');
    }

    public function obtener_get($id_usuario){
        $niveles_glucosa=$this->glucosa_model->getAll($id_usuario);
        $this->response($niveles_glucosa);
    }

    public function crear_post(){
        $glucosa = [
            "nivel"=> $this->post('nivel'),
            "hora"=> $this->post('hora'),
            "fecha"=> $this->post('fecha'),
            "id_usuario"=>$this->post('id_usuario')
        ];

        $glucosa_creada = $this->glucosa_model->crear_glucosa($glucosa);
        if($glucosa_creada){
            $response = [
               "request"=>true,
               "message"=>"Nivel de glucosa ingresada con exito"
             ];
             $this->response($response);
        }else{
            $response = [
                "request"=>false,
                "message"=>"Nivel de glucosa no pudo ser ingresado, intentelo mas tarde"
            ];
            $this->response($response);
        }
    }
}