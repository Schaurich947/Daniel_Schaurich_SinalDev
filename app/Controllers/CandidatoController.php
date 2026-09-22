<?php
require_once __DIR__ . "/../Models/CandidatoModel.php";
require __DIR__ . "/../Models/DisponibilidadeModel.php";

class CandidatoController
{
    public function listar($pdo)
    {
        $model = new CandidatoModel($pdo);
        $candidatos = $model->buscarTodos();
        require __DIR__ . "/../Views/candidatos/listar.php";
    }

    public function novo($pdo)
    {
        $disponibilidades = (new DisponibilidadeModel($pdo))->listarTodos();
        require __DIR__ . "/../Views/candidatos/form.php";
    }

    public function editar($pdo, $id)
    {
        $model = new CandidatoModel($pdo);
        $candidato = $model->buscarPorId($id);
        $disponibilidades = (new DisponibilidadeModel($pdo))->listarTodos();
        require __DIR__ . "/../Views/candidatos/form.php";
    }

    public function cadastrar($pdo)
    {
        (new CandidatoModel($pdo))->criar($_POST);
        header("Location: index.php?recurso=candidatos&acao=listar");
        exit;
    }

    public function atualizar($pdo, $id)
    {
        (new CandidatoModel($pdo))->atualizar($id, $_POST);
        header("Location: index.php?recurso=candidatos&acao=listar");
        exit;
    }

    public function excluir($pdo, $id)
    {
        (new CandidatoModel($pdo))->excluir($id);
        header("Location: index.php?recurso=candidatos&acao=listar");
        exit;
    }
}