<?php
class Glucosa_model extends CI_Model {

    public $nivel;
    public $hora;
    public $fecha;
    public $id_usuario;

    function __construct(){
        parent::__construct();
    }

    public function getAll($id_usuario){
    $query="SELECT * FROM glucosa where id_usuario={$id_usuario}";
    $glucosa=$this->db->query($query);
    return $glucosa->result();
    }

    public function crear_glucosa($glucosa){
        $this->db->insert('glucosa',$glucosa);
        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
}