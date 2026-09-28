<?php

class Usuario_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function buscar_por_usuario($usuario)
    {
        $this->db->where('usuario', $usuario);
        return $this->db->get('usuarios')->row();
    }
}