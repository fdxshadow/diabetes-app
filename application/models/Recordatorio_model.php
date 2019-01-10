<?php
class Recordatorio_model extends CI_Model {

    public $titulo;
    public $hora;
    public $desde;
    public $hasta;
    public $estado;
    public $id_usuario;

    function __construct(){
        parent::__construct();
    }

    public function obtener_recordatorios($id_usuario){
    $recordatorios=$this->db->query("SELECT * FROM recordatorio where id_usuario={$id_usuario}");
        return $recordatorios->result();
    }

    public function obtener_recordatorio($id){
      $recordatorio=$this->db->query("SELECT * FROM recordatorio WHERE id={$id}");
      return $recordatorio->result();
    }
    public function actualizar_recordatorio($id,$recordatorio){
        $this->db->where('id', $id);
        $this->db->update('recordatorio', $recordatorio);
        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function create_recordatorio($recordatorio){
        $this->db->insert('recordatorio',$recordatorio);
        if ($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }

    }
}
