<?php

namespace src\application\controller;

use src\_core\controller\FrontController;

class UsuarioController extends FrontController
{

    /**
     * Displays the main page for the application.
     *
     * @return void
     */
    public function index()
    {
      $this->view('auth/login');
    }

    /**
     * Displays the details of a user with the given ID.
     *
     * @param int $id The ID of the user to display.
     * @return void
     */
    public function show($id)
    {
        echo "Detalhes do usuário com ID: $id";
    }


    /**
     * Displays the form for creating a new user.
     *
     * @throws Some_Exception_Class description of exception
     * @return Some_Return_Value
     */
    public function create()
    {
        echo "Formulário de criação de usuário";
    }

    /**
     * Store a new user.
     *
     * This function is responsible for saving a new user to the database. It takes no parameters and does not return any value.
     *
     * @throws None
     * @return void
     */
    public function store()
    {
        echo "Salvando novo usuário";
    }


    /**
     * Displays the form for editing a user with the given ID.
     *
     * @param int $id The ID of the user to be edited.
     * @return void
     */
    public function edit($id)
    {
        echo "Formulário de edição do usuário com ID: $id";
    }

    /**
     * Updates a user with the given ID.
     *
     * @param int $id The ID of the user to be updated.
     * @return void
     */
    public function update($id)
    {
        echo "Atualizando usuário com ID: $id";
    }

    /**
     * Deletes a user with the given ID.
     *
     * @param int $id The ID of the user to be deleted.
     * @return void
     */
    public function delete($id)
    {
        echo "Excluindo usuário com ID: $id";
    }
}
