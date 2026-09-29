<?php

class Login extends CI_Controller
{
    public function index()
    {
        $this->load->view('form_login');
    }

    public function entrar()
    {
        $this->load->model('Usuario_model');

        $usuario = $this->input->post('usuario');
        $senha = $this->input->post('senha');

        $dadosUsuario = $this->Usuario_model->buscar_por_usuario($usuario);

        if ($dadosUsuario && password_verify($senha, $dadosUsuario->senha)) {
            $this->session->set_userdata('usuario_id', $dadosUsuario->id);
            redirect('medicos');
        } else {
            $dados['erro'] = 'Usuário ou senha inválidos.';
            $this->load->view('form_login', $dados);
        }
    }

    public function sair()
    {
        $this->session->sess_destroy();
        redirect('login');
    }
}