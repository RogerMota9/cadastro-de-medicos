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
        $this->db->order_by('id', 'ASC');
        return $this->db->get('medicos')->result();
    }

    public function cadastrar_medico($dados){
        


        $this->db->insert('medicos', $dados);
        $ultimo_id = $this->db->insert_id();
        

        $auditoria = [
            'acao' => 'create',
            'id_medico' => $ultimo_id,
            'dados_antes' => null,
            'dados_depois' => json_encode($dados)
        ];
        
        $this->db->insert('auditoria', $auditoria);

        return $ultimo_id;
    }

    public function crm_existe($crm){
        $this->db->where('crm', $crm);

        $query = $this->db->get('medicos');

        if($query->num_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function buscar_por_id($id){
        $this->db->where('id', $id);

        return $this->db->get('medicos')->row();
    }

    public function atualizar_medico($id,$dados){
        $medicoAntes = $this->buscar_por_id($id);

        $this->db->where('id', $id);
        $this->db->update('medicos', $dados);

        $auditoria = [
        'acao' => 'update',
        'id_medico' => $id,
        'dados_antes' => json_encode($medicoAntes),
        'dados_depois' => json_encode($dados)
        ];
        
        $this->db->insert('auditoria', $auditoria);
    }

    public function excluir_por_id($id){

        $medicoAntes = $this->buscar_por_id($id);

        $this->db->where('id', $id);
        $this->db->delete('medicos');

        $auditoria = [
        'acao' => 'delete',
        'id_medico' => $id,
        'dados_antes' => json_encode($medicoAntes),
        'dados_depois' => null
        ];

        $this->db->insert('auditoria', $auditoria);

    }

    public function listar_auditoria(){
        $this->db->order_by('data_acao', 'DESC');
        return $this->db->get('auditoria')->result();
    }

}