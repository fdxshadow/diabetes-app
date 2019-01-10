<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once( APPPATH.'/libraries/REST_Controller.php' );
use Restserver\Libraries\REST_Controller;

class Recordatorio extends REST_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('recordatorio_model');
    }

    //Obetener todos los recordatorios
    public function obtener_get($id_usuario){
        $recordatorios=$this->recordatorio_model->obtener_recordatorios($id_usuario);
        $this->response($recordatorios);
    }
    //Obetener un recordatorio por Id
    public function getById($id){
        $recordatorio=$this->recordatorio_model->obtener_recordatorio($id);
        header('Content-Type: application/json');
        echo json_encode($recordatorio);
    }
    //Modificar recordatorio en base al id
    public function setById($id){
        $recordatorio = [
            "titulo"=>$this->input->post('titulo'),
            "hora"=>$this->input->post('hora'),
            "desde"=>$this->input->post('desde'),
            "hasta"=>$this->input->post('hasta'),
            "estado"=>$this->input->post('estado'),
            "id_usuario"=>$this->input->post('id_usuario')
        ];

        $update=$this->recordatorio_model->actualizar_recordatorio($id,$recordatorio);
        if($update){
            $response = [
                "request"=>true,
                "message"=>"Recordatorio se actualizo con exito"
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }else{
            $response = [
                "request"=>false,
                "message"=>"No se puedo actualizar su recordatorio, intentelo mas tarde"
            ];
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
    
    //Crear recordatorio
    public function crear_post(){
        $recordatorio = [
            "titulo"=>$this->post('titulo'),
            "hora"=>$this->post('hora'),
            "desde"=>$this->post('desde'),
            "hasta"=>$this->post('hasta'),
            "estado"=>$this->post('estado'),
            "id_usuario"=>$this->post('id_usuario')
        ];
        $create=$this->recordatorio_model->create_recordatorio($recordatorio);
        if($create){
            $response = [
               "request"=>true,
               "message"=>"Recordatorio credo con exito"
             ];
             $this->response($response);
        }else{
            $response = [
                "request"=>true,
                "message"=>"Recordatorio no pudo ser creado, intentelo mas tarde"
            ];
            $this->response($response);
        }
    }
        

}