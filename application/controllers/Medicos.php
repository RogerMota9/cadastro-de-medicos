<?php
class Medicos extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!$this->session->userdata('usuario_id')) {
            redirect('login');
        }

        $this->load->model('Medico_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $dados['medicos'] = $this->Medico_model->listar();
        $this->load->view('medicos/lista', $dados);
    }

    public function novo_medico()
    {
        $this->load->view('medicos/formulario');
    }

    public function salvar_medico()
    {
        $this->definir_regras();

        if ($this->form_validation->run() == false) {
            $this->load->view('medicos/formulario');
            return;
        }

        $crm = trim($this->input->post('crm', true));

        if ($this->Medico_model->crm_existe($crm)) {
            $dados['erro_crm'] = 'CRM já cadastrado.';
            $this->load->view('medicos/formulario', $dados);
            return;
        }

        $dados = array(
            'nome' => trim($this->input->post('nome', true)),
            'crm' => $crm,
            'especialidade' => trim($this->input->post('especialidade', true)),
            'telefone' => trim($this->input->post('telefone', true)),
            'email' => trim($this->input->post('email', true)),
            'situacao' => $this->input->post('situacao') === 'true'
        );

        $this->Medico_model->cadastrar_medico($dados);

        redirect('medicos');
    }

    public function editar($id)
    {
        $dados['medico'] = $this->Medico_model->buscar_por_id($id);

        if (!$dados['medico']) {
            show_404();
        }

        $this->load->view('medicos/formulario', $dados);
    }

    public function atualizar($id)
    {
        $this->definir_regras();

        if ($this->form_validation->run() == false) {
            $dados['medico'] = $this->Medico_model->buscar_por_id($id);
            $this->load->view('medicos/formulario', $dados);
            return;
        }

        $crm = trim($this->input->post('crm', true));

        if ($this->Medico_model->crm_existe($crm, $id)) {
            $dados['medico'] = $this->Medico_model->buscar_por_id($id);
            $dados['erro_crm'] = 'CRM já cadastrado.';
            $this->load->view('medicos/formulario', $dados);
            return;
        }

        $dados = array(
            'nome' => trim($this->input->post('nome', true)),
            'crm' => $crm,
            'especialidade' => trim($this->input->post('especialidade', true)),
            'telefone' => trim($this->input->post('telefone', true)),
            'email' => trim($this->input->post('email', true)),
            'situacao' => $this->input->post('situacao') === 'true'
        );

        $this->Medico_model->atualizar_medico($id, $dados);

        redirect('medicos');
    }

    private function definir_regras()
    {
        $this->form_validation->set_error_delimiters(
            '<div>',
            '</div>'
        );

        $this->form_validation->set_rules(
            'nome',
            'Nome',
            'required|regex_match[/^[\p{L}\s]+$/u]',
            array(
                'required' => 'O campo Nome é obrigatório.',
                'regex_match' => 'O Nome deve conter apenas letras e espaços.'
            )
        );

        $this->form_validation->set_rules(
            'crm',
            'CRM',
            'required|numeric',
            array(
                'required' => 'O campo CRM é obrigatório.',
                'numeric' => 'O CRM deve conter apenas números.'
            )
        );

        $this->form_validation->set_rules(
            'especialidade',
            'Especialidade',
            'required|regex_match[/^[\p{L}\s]+$/u]',
            array(
                'required' => 'O campo Especialidade é obrigatório.',
                'regex_match' => 'A Especialidade deve conter apenas letras e espaços.'
            )
        );

        $this->form_validation->set_rules(
            'telefone',
            'Telefone',
            'regex_match[/^[0-9]{10,11}$/]',
            array(
                'regex_match' => 'O Telefone deve conter 10 ou 11 números.'
            )
        );

        $this->form_validation->set_rules(
            'email',
            'E-mail',
            'valid_email',
            array(
                'valid_email' => 'Informe um E-mail válido.'
            )
        );

        $this->form_validation->set_rules(
            'situacao',
            'Situação',
            'required|in_list[true,false]',
            array(
                'required' => 'O campo Situação é obrigatório.',
                'in_list' => 'Selecione uma Situação válida.'
            )
        );
    }
}