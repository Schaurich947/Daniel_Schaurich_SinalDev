<?php
require_once __DIR__ . "/../Models/EmpresaModel.php";

class EmpresaController
{
    // Admin gerencia qualquer empresa; uma empresa só gerencia o próprio cadastro.
    private function podeGerenciar($id)
    {
        return $_SESSION['tipo'] === 'admin'
            || ($_SESSION['tipo'] === 'empresa' && (int)$_SESSION['id'] === (int)$id);
    }

    public function listar($pdo)
    {
        $model = new EmpresaModel($pdo);

        if ($_SESSION['tipo'] === 'empresa') {
            $propria = $model->buscarPorId($_SESSION['id']);
            $empresas = $propria ? [$propria] : [];
        } else {
            $empresas = $model->buscarTodos();
        }

        require __DIR__ . "/../Views/empresas/listar.php";
    }

    public function novo($pdo)
    {
        require __DIR__ . "/../Views/empresas/form.php";
    }

    public function editar($pdo, $id)
    {
        if (!$this->podeGerenciar($id)) {
            header("Location: index.php?recurso=empresas&acao=listar");
            exit;
        }
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
        if (!$this->podeGerenciar($id)) {
            header("Location: index.php?recurso=empresas&acao=listar");
            exit;
        }
        $model = new EmpresaModel($pdo);
        $model->atualizar($id, $_POST);
        header("Location: index.php?recurso=empresas&acao=listar");
        exit;
    }

    public function excluir($pdo, $id)
    {
        if (!$this->podeGerenciar($id)) {
            header("Location: index.php?recurso=empresas&acao=listar");
            exit;
        }
        $model = new EmpresaModel($pdo);
        $model->excluir($id);
        header("Location: index.php?recurso=empresas&acao=listar");
        exit;
    }
}
