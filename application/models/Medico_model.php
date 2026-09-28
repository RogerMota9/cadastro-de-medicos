<?php
class Medico_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function listar()
    {
        return $this->db
            ->order_by('id', 'ASC')
            ->get('medicos')
            ->result();
    }

    public function cadastrar_medico($dados)
    {
        $this->db->insert('medicos', $dados);
    }

    public function crm_existe($crm, $id = null)
    {
        $this->db->where('crm', $crm);

        if ($id !== null) {
            $this->db->where('id !=', $id);
        }

        return $this->db
            ->get('medicos')
            ->num_rows() > 0;
    }

    public function buscar_por_id($id)
    {
        return $this->db
            ->where('id', $id)
            ->get('medicos')
            ->row();
    }

    public function atualizar_medico($id, $dados)
    {
        $this->db
            ->where('id', $id)
            ->update('medicos', $dados);
    }
}