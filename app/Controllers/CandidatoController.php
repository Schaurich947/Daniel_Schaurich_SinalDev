<?php
require_once __DIR__ . "/../Models/CandidatoModel.php";
require __DIR__ . "/../Models/DisponibilidadeModel.php";

class CandidatoController
{
    private function podeGerenciar($id)
    {
        return $_SESSION['tipo'] === 'admin'
            || ($_SESSION['tipo'] === 'candidato' && (int)$_SESSION['id'] === (int)$id);
    }

    public function listar($pdo)
    {
        if ($_SESSION['tipo'] === 'candidato') {
            header("Location: index.php?recurso=candidatos&acao=editar&id=" . $_SESSION['id']);
            exit;
        }
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
        if (!$this->podeGerenciar($id)) {
            header("Location: index.php");
            exit;
        }
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
        if (!$this->podeGerenciar($id)) {
            header("Location: index.php");
            exit;
        }
        (new CandidatoModel($pdo))->atualizar($id, $_POST);

        $destino = $_SESSION['tipo'] === 'candidato' ? 'vagas' : 'candidatos';
        header("Location: index.php?recurso=$destino&acao=listar");
        exit;
    }

    public function excluir($pdo, $id)
    {
        if ($_SESSION['tipo'] !== 'admin') {
            header("Location: index.php?recurso=candidatos&acao=listar");
            exit;
        }
        (new CandidatoModel($pdo))->excluir($id);
        header("Location: index.php?recurso=candidatos&acao=listar");
        exit;
    }
}