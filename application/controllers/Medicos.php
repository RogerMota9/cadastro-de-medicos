<?php

class Medicos extends CI_Controller
{   
    public function index(){   
        $this->load->database();
        $this->load->model('Medico_model');
        $dados['medicos'] = $this->Medico_model->listar();
        $this->load->view('medicos/lista', $dados);
    }

    public function novo_medico(){
        $this->load->helper('form');
        $this->load->view('medicos/formulario');
    }

    public function salvar_medico(){
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('Medico_model');

        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('crm', 'CRM', 'required|callb ack_crm_valido');
        $this->form_validation->set_rules('especialidade', 'Especialidade', 'required');
        $this->form_validation->set_rules('telefone', 'Telefone', 'required|callback_telefone_valido');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');

        $dados = [
            'nome' => $this->input->post('nome'),
            'crm' => $this->input->post('crm'),
            'especialidade' => $this->input->post('especialidade'),
            'telefone' => $this->input->post('telefone'),
            'email' => $this->input->post('email')
        ];

        if ($this->form_validation->run()) {
            if ($this->Medico_model->crm_existe($dados['crm'])) {
                $dados['erro'] = 'Esse CRM já existe.';
                $this->load->view('medicos/formulario', $dados);
                return;
            }
            $this->Medico_model->cadastrar_medico($dados);
            redirect('medicos');
        } else {
            $this->load->view('medicos/formulario', $dados);
        }
}

    public function crm_valido($str) {
        if (!preg_match('/^\d{6}$/', $str)) {
            $this->form_validation->set_message('crm_valido', 'O CRM deve ter exatamente 6 dígitos.');
            return false;
        }
        return true;
    }

    public function telefone_valido($str) {
        if (!preg_match('/^\d{11}$/', $str)) {
            $this->form_validation->set_message('telefone_valido', 'O telefone deve ter exatamente 11 dígitos.');
            return false;
        }
        return true;
    }

    public function editar($id){
        $this->load->helper('form');
        $this->load->database();
        $this->load->model('Medico_model');

        $editarMedico['medicos'] = $this->Medico_model->buscar_por_id($id);

    $this->load->view('medicos/editar', $editarMedico);
    }

    public function atualizar(){
        $this->load->helper('url');   
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->model('Medico_model');     
        $this->form_validation->set_rules('nome', 'Nome', 'required');
        $this->form_validation->set_rules('crm', 'Crm', 'required');
        $this->form_validation->set_rules('especialidade', 'Especialidade', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        

        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $crm = $_POST['crm'];
        $especialidade = $_POST['especialidade'];
        $telefone = $_POST['telefone'];
        $email = $_POST['email'];
        $situacao = $_POST['situacao'];
        $situacao = filter_var($situacao, FILTER_VALIDATE_BOOLEAN);

        

        if (preg_match('/^\d{6}$/', $crm) && preg_match('/^\d{11}$/', $telefone) && $this->form_validation->run() == true) {
            $dados = [
            'nome' => $nome,
            'crm' => $crm,
            'especialidade' => $especialidade,
            'telefone' => $telefone,
            'email' => $email,
            'situacao' => $situacao
        ];
            $this->Medico_model->atualizar_medico($id, $dados); 
            redirect('medicos');

        }else {
            $dados['medicos'] = $this->Medico_model->buscar_por_id($id);
            $dados['erros'] = [];

            if (!preg_match('/^\d{6}$/', $crm)) {
            $dados['erros'][] = 'O CRM deve ter exatamente 6 dígitos.';
            }
            if (!preg_match('/^\d{11}$/', $telefone)) {
                $dados['erros'][] = 'O telefone deve ter exatamente 11 dígitos.';
            }

            $this->load->helper('form');
            $this->load->view('medicos/editar', $dados);
            return;
            }
    }

    public function excluir($id){
        $this->load->database();
        $this->load->model('Medico_model');
        $this->Medico_model->excluir_por_id($id);
        $excluirMedico ['medicos']= $this->Medico_model->listar();
        $this->load->view('medicos/lista', $excluirMedico);
    }

    public function auditoria(){

    $this->load->database();
    $this->load->model('Medico_model');
    $dados['auditorias'] = $this->Medico_model->listar_auditoria();
    $this->load->view('medicos/auditoria', $dados);
}
}
