<?php
require_once __DIR__ . "/../Models/VagaModel.php";
require_once __DIR__ . "/../Models/DisponibilidadeModel.php";
require_once __DIR__ . "/../Models/EmpresaModel.php";
require_once __DIR__ . "/../Models/CandidatoModel.php";

class VagaController
{
    public function listar($pdo)
    {
        $model = new VagaModel($pdo);
        $vagas = $model->buscarTodos();
        $candidatos = (new CandidatoModel($pdo))->buscarTodos();
        require __DIR__ . "/../Views/vagas/listar.php";
    }

    public function novo($pdo)
    {
        $disponibilidades = (new DisponibilidadeModel($pdo))->listarTodos();
        $empresas = (new EmpresaModel($pdo))->buscarTodos();
        require __DIR__ . "/../Views/vagas/form.php";
    }

    public function editar($pdo, $id)
    {
        $model = new VagaModel($pdo);
        $vaga = $model->buscarPorId($id);
        $disponibilidades = (new DisponibilidadeModel($pdo))->listarTodos();
        require __DIR__ . "/../Views/vagas/form.php";
    }

    public function cadastrar($pdo)
    {
        (new VagaModel($pdo))->criar($_POST);
        header("Location: index.php?recurso=vagas&acao=listar");
        exit;
    }

    public function atualizar($pdo, $id)
    {
        (new VagaModel($pdo))->atualizar($id, $_POST);
        header("Location: index.php?recurso=vagas&acao=listar");
        exit;
    }

    public function excluir($pdo, $id)
    {
        (new VagaModel($pdo))->excluir($id);
        header("Location: index.php?recurso=vagas&acao=listar");
        exit;
    }
}