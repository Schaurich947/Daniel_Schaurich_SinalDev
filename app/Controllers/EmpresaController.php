<?php
require_once __DIR__ . "/../Models/EmpresaModel.php";

class EmpresaController
{
    public function listar($pdo)
    {
        $model = new EmpresaModel($pdo);
        $empresas = $model->buscarTodos();
        require __DIR__ . "/../Views/empresas/listar.php";
    }

    public function novo($pdo)
    {
        require __DIR__ . "/../Views/empresas/form.php";
    }

    public function editar($pdo, $id)
    {
        $model = new EmpresaModel($pdo);
        $empresa = $model->buscarPorId($id);
        require __DIR__ . "/../Views/empresas/form.php";
    }

    public function cadastrar($pdo)
    {
        $model = new EmpresaModel($pdo);
        $model->criar($_POST);
        header("Location: index.php?recurso=empresas&acao=listar");
        exit;
    }

    public function atualizar($pdo, $id)
    {
        $model = new EmpresaModel($pdo);
        $model->atualizar($id, $_POST);
        header("Location: index.php?recurso=empresas&acao=listar");
        exit;
    }

    public function excluir($pdo, $id)
    {
        $model = new EmpresaModel($pdo);
        $model->excluir($id);
        header("Location: index.php?recurso=empresas&acao=listar");
        exit;
    }
}