<?php
class Usuario_model extends CI_Model {

    public $nombre;
    public $edad;
    public $genero;
    public $email;
    public $password;

    function __construct(){
        parent::__construct();
    }


    public function registrar_usuario($user){
        $query="SELECT count(*) as existe FROM usuario where email= '{$user['email']}'";
        $validate=$this->db->query($query);
        if($validate->result()[0]->existe>0){
            return false;
        }else{
            $this->db->insert('usuario',$user);
            return true;
        }
    }

    public function login($user_autenticate){
        $query="SELECT * from usuario where email='{$user_autenticate['email']}'";
        $validate=$this->db->query($query);
        if(sizeof($validate->result())>0){
            if($validate->result()[0]->password == $user_autenticate['password']){
                $user = [
                    "id_usuario"=>$validate->result()[0]->id,
                    "nombre"=> $validate->result()[0]->nombre,
                    "edad"  => $validate->result()[0]->edad,
                    "genero"=> $validate->result()[0]->genero,
                    "email" => $validate->result()[0]->email
                ];
                $response = [
                    "request"=>true,
                    "user"=>$user
                ];
                return $response;
                
            }else{
                $response = [
                    "request"=>false,
                    "message"=>"Contraseña incorrecta"
                ];
                return $response;
                
            }
        }else {
            $response = [
                "request"=>false,
                "message"=>"Usuario incorrecto o no existe"
            ];
            return $response;

        }
    }
}