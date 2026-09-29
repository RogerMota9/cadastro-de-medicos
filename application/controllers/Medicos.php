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
        $busca = $this->input->get('busca');

        $dados['medicos'] = $this->Medico_model->listar($busca);
        $dados['busca'] = $busca;

        $this->load->view('medicos/lista', $dados);
    }


    public function novo_medico()
    {
        $this->load->view('medicos/formulario');
    }


    public function salvar_medico()
    {
        $this->form_validation->set_rules(
            'nome',
            'Nome',
            'required|regex_match[/^[a-zA-ZÀ-ÿ\s]+$/]',
            array(
                'required' => 'O campo Nome é obrigatório.',
                'regex_match' => 'O Nome deve conter apenas letras e espaços.'
            )
        );

        $this->form_validation->set_rules(
            'crm',
            'CRM',
            'required|regex_match[/^[0-9]{6}$/]',
            array(
                'required' => 'O campo CRM é obrigatório.',
                'regex_match' => 'O CRM deve conter exatamente 6 números.'
            )
        );

        $this->form_validation->set_rules(
            'especialidade',
            'Especialidade',
            'required|regex_match[/^[a-zA-ZÀ-ÿ\s]+$/]',
            array(
                'required' => 'O campo Especialidade é obrigatório.',
                'regex_match' => 'A Especialidade deve conter apenas letras e espaços.'
            )
        );

        $this->form_validation->set_rules(
            'telefone',
            'Telefone',
            'required|regex_match[/^[0-9]{11}$/]',
            array(
                'required' => 'O campo Telefone é obrigatório.',
                'regex_match' => 'O Telefone deve conter exatamente 11 números.'
            )
        );

        $this->form_validation->set_rules(
            'email',
            'E-mail',
            'valid_email',
            array(
                'valid_email' => 'Digite um E-mail válido.'
            )
        );


        if ($this->form_validation->run() == FALSE) {

            $this->load->view('medicos/formulario');

            return;
        }


        $crm = $this->input->post('crm');


        if ($this->Medico_model->crm_existe($crm)) {

            $dados['erro'] = 'Este CRM já está cadastrado.';

            $this->load->view('medicos/formulario', $dados);

            return;
        }


        $dados = array(
            'nome' => $this->input->post('nome'),
            'crm' => $crm,
            'especialidade' => $this->input->post('especialidade'),
            'telefone' => $this->input->post('telefone'),
            'email' => $this->input->post('email'),

            'situacao' => true
        );


        $this->Medico_model->cadastrar_medico(
            $dados,
            $this->session->userdata('usuario_id')
        );


        redirect('medicos');
    }


    public function editar($id)
    {
        $dados['medico'] = $this->Medico_model->buscar_por_id($id);


        if (!$dados['medico']) {
            show_404();
        }


        $this->load->view('medicos/editar', $dados);
    }


    public function atualizar($id)
    {
        $this->form_validation->set_rules(
            'nome',
            'Nome',
            'required|regex_match[/^[a-zA-ZÀ-ÿ\s]+$/]',
            array(
                'required' => 'O campo Nome é obrigatório.',
                'regex_match' => 'O Nome deve conter apenas letras e espaços.'
            )
        );

        $this->form_validation->set_rules(
            'crm',
            'CRM',
            'required|regex_match[/^[0-9]{6}$/]',
            array(
                'required' => 'O campo CRM é obrigatório.',
                'regex_match' => 'O CRM deve conter exatamente 6 números.'
            )
        );

        $this->form_validation->set_rules(
            'especialidade',
            'Especialidade',
            'required|regex_match[/^[a-zA-ZÀ-ÿ\s]+$/]',
            array(
                'required' => 'O campo Especialidade é obrigatório.',
                'regex_match' => 'A Especialidade deve conter apenas letras e espaços.'
            )
        );

        $this->form_validation->set_rules(
            'telefone',
            'Telefone',
            'required|regex_match[/^[0-9]{11}$/]',
            array(
                'required' => 'O campo Telefone é obrigatório.',
                'regex_match' => 'O Telefone deve conter exatamente 11 números.'
            )
        );

        $this->form_validation->set_rules(
            'email',
            'E-mail',
            'valid_email',
            array(
                'valid_email' => 'Digite um E-mail válido.'
            )
        );


        if ($this->form_validation->run() == FALSE) {

            $dados['medico'] = $this->Medico_model->buscar_por_id($id);

            $this->load->view('medicos/editar', $dados);

            return;
        }


        $crm = $this->input->post('crm');


        if ($this->Medico_model->crm_existe($crm, $id)) {

            $dados['medico'] = $this->Medico_model->buscar_por_id($id);

            $dados['erro'] = 'Este CRM já está cadastrado.';

            $this->load->view('medicos/editar', $dados);

            return;
        }


        $dados = array(
            'nome' => $this->input->post('nome'),
            'crm' => $crm,
            'especialidade' => $this->input->post('especialidade'),
            'telefone' => $this->input->post('telefone'),
            'email' => $this->input->post('email')
        );


        $this->Medico_model->atualizar_medico(
            $id,
            $dados,
            $this->session->userdata('usuario_id')
        );


        redirect('medicos');
    }


    public function excluir($id)
    {
        $this->Medico_model->inativar_medico(
            $id,
            $this->session->userdata('usuario_id')
        );

        redirect('medicos');
    }


    public function ativar($id)
    {
        $this->Medico_model->ativar_medico(
            $id,
            $this->session->userdata('usuario_id')
        );

        redirect('medicos');
    }


    public function auditoria()
    {
        $busca = $this->input->get('busca');

        $dados['auditorias'] = $this->Medico_model->listar_auditoria($busca);
        $dados['busca'] = $busca;

        $this->load->view('medicos/auditoria', $dados);
    }
}