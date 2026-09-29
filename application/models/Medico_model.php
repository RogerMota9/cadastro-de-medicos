<?php

class Medico_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();

        $this->load->database();
    }


    public function listar($busca = '')
    {
        $this->db->order_by('id', 'ASC');


        if (!empty($busca)) {

            $this->db->group_start();

            $this->db->like('nome', $busca);
            $this->db->or_like('crm', $busca);

            $this->db->group_end();
        }


        return $this->db->get('medicos')->result();
    }


    public function cadastrar_medico($dados, $id_usuario)
    {
        $this->db->insert('medicos', $dados);

        $id_medico = $this->db->insert_id();

        $medico = $this->buscar_por_id($id_medico);


        $this->db->insert('auditoria', array(
            'acao' => 'criar',
            'id_medico' => $id_medico,
            'id_usuario' => $id_usuario,
            'dados_antes' => null,
            'dados_depois' => json_encode($medico)
        ));
    }


    public function crm_existe($crm, $id = null)
    {
        $this->db->where('crm', $crm);


        if ($id !== null) {
            $this->db->where('id !=', $id);
        }


        return $this->db->get('medicos')->num_rows() > 0;
    }


    public function buscar_por_id($id)
    {
        $this->db->where('id', $id);

        return $this->db->get('medicos')->row();
    }


    public function atualizar_medico($id, $dados, $id_usuario)
    {
        $antes = $this->buscar_por_id($id);


        $this->db->where('id', $id);

        $this->db->update('medicos', $dados);


        $depois = $this->buscar_por_id($id);


        $this->db->insert('auditoria', array(
            'acao' => 'editar',
            'id_medico' => $id,
            'id_usuario' => $id_usuario,
            'dados_antes' => json_encode($antes),
            'dados_depois' => json_encode($depois)
        ));
    }



    public function inativar_medico($id, $id_usuario)
    {
        $antes = $this->buscar_por_id($id);


        $this->db->where('id', $id);

        $this->db->update('medicos', array(
            'situacao' => false
        ));


        $depois = $this->buscar_por_id($id);


        $this->db->insert('auditoria', array(
            'acao' => 'inativar',
            'id_medico' => $id,
            'id_usuario' => $id_usuario,
            'dados_antes' => json_encode($antes),
            'dados_depois' => json_encode($depois)
        ));
    }


    public function ativar_medico($id, $id_usuario)
    {
        $antes = $this->buscar_por_id($id);


        $this->db->where('id', $id);

        $this->db->update('medicos', array(
            'situacao' => true
        ));


        $depois = $this->buscar_por_id($id);


        $this->db->insert('auditoria', array(
            'acao' => 'ativar',
            'id_medico' => $id,
            'id_usuario' => $id_usuario,
            'dados_antes' => json_encode($antes),
            'dados_depois' => json_encode($depois)
        ));
    }




    public function listar_auditoria($busca = '')
    {
        $this->db->select(
            'auditoria.*, medicos.nome, medicos.crm, usuarios.usuario'
        );

        $this->db->from('auditoria');


        $this->db->join(
            'medicos',
            'medicos.id = auditoria.id_medico',
            'left'
        );


        $this->db->join(
            'usuarios',
            'usuarios.id = auditoria.id_usuario',
            'left'
        );


        if (!empty($busca)) {

            $this->db->group_start();

            $this->db->like('medicos.nome', $busca);
            $this->db->or_like('medicos.crm', $busca);

            $this->db->group_end();
        }


        $this->db->order_by(
            'auditoria.data_acao',
            'DESC'
        );


        return $this->db->get()->result();
    }
}