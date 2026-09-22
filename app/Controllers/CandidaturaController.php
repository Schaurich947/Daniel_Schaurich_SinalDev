<?php
require_once __DIR__ . "/../Models/CandidaturaModel.php";

class CandidaturaController
{
    public function listarPorVaga($pdo, $vagaId)
    {
        $model = new CandidaturaModel($pdo);
        $candidaturas = $model->buscarPorVaga($vagaId);
        $statusList = $model->listarStatus();
        require __DIR__ . "/../Views/candidaturas/listar.php";
    }

    public function candidatar($pdo)
    {
        (new CandidaturaModel($pdo))->criar($_POST['candidato_id'], $_POST['vaga_id']);
        header("Location: index.php?recurso=candidaturas&acao=listarPorVaga&id=" . $_POST['vaga_id']);
        exit;
    }

    public function atualizarStatus($pdo, $id)
    {
        (new CandidaturaModel($pdo))->atualizarStatus($id, $_POST['status_candidatura_id']);
        header("Location: index.php");
        exit;
    }
}