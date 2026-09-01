<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\CategoriaModel; // Certifique-se de importar seu Model de Categorias

class AdminCategoriasController extends BaseController
{
    protected $categoriaModel;

    public function __construct()
    {
        $this->categoriaModel = new CategoriaModel();
    }

    // Exibir lista de categorias
    public function index()
    {
        $data['categorias'] = $this->categoriaModel->findAll();
        return view('admin/categorias', $data);
    }

    // Salvar nova categoria ou atualizar existente
    public function salvar()
    {
        $id = $this->request->getPost('id');
        $nome = $this->request->getPost('nome');

        $dados = ['nome' => $nome];

        if (!empty($id)) {
            // Atualizar
            $this->categoriaModel->update($id, $dados);
        } else {
            // Criar nova
            $this->categoriaModel->insert($dados);
        }

        return redirect()->to('/admin/categorias');
    }

    // Excluir categoria
    public function excluir($id)
    {
        $this->categoriaModel->delete($id);
        return redirect()->to('/admin/categorias');
    }
}