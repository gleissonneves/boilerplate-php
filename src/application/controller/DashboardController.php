<?php

namespace src\application\controller;

use src\_core\controller\FrontController;

class DashboardController extends FrontController
{
    public function index()
    {
      $data = [
        'title' => 'Página Inicial',
        'content' => 'Este é o conteúdo da página inicial.'
      ];
      $this->view('portal/dashboard', $data);
    }

    public function show($id)
    {
        echo "Detalhes do usuário com ID: $id";
    }

    public function create()
    {
        echo "Formulário de criação de usuário";
    }

    public function store()
    {
        echo "Salvando novo usuário";
    }

    public function edit($id)
    {
        echo "Formulário de edição do usuário com ID: $id";
    }

    public function update($id)
    {
        echo "Atualizando usuário com ID: $id";
    }

    public function delete($id)
    {
        echo "Excluindo usuário com ID: $id";
    }
}
