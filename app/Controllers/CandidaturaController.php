<?php
require_once __DIR__ . "/../Models/CandidaturaModel.php";
require_once __DIR__ . "/../Models/VagaModel.php";

class CandidaturaController
{
    private function podeVerVaga($pdo, $vagaId)
    {
        if ($_SESSION['tipo'] === 'admin') {
            return true;
        }
        if ($_SESSION['tipo'] !== 'empresa') {
            return false;
        }
        $vaga = (new VagaModel($pdo))->buscarPorId($vagaId);
        return $vaga && (int)$vaga['empresa_id'] === (int)$_SESSION['id'];
    }

    public function listarPorVaga($pdo, $vagaId)
    {
        if (!$this->podeVerVaga($pdo, $vagaId)) {
            header("Location: index.php?recurso=vagas&acao=listar");
            exit;
        }

        $model = new CandidaturaModel($pdo);
        $candidaturas = $model->buscarPorVaga($vagaId);
        $statusList = $model->listarStatus();
        $modo = 'gestao';
        require __DIR__ . "/../Views/candidaturas/listar.php";
    }

    public function minhas($pdo)
    {
        if ($_SESSION['tipo'] !== 'candidato') {
            header("Location: index.php");
            exit;
        }

        $candidaturas = (new CandidaturaModel($pdo))->buscarPorCandidato($_SESSION['id']);
        $modo = 'candidato';
        require __DIR__ . "/../Views/candidaturas/listar.php";
    }

    public function candidatar($pdo)
    {
        if ($_SESSION['tipo'] !== 'candidato') {
            header("Location: index.php?recurso=vagas&acao=listar");
            exit;
        }

        $vagaId = $_POST['vaga_id'];
        $candidatoId = $_SESSION['id'];

        $model = new CandidaturaModel($pdo);
        if (!$model->jaCandidatou($candidatoId, $vagaId)) {
            $model->criar($candidatoId, $vagaId);
        }

        header("Location: index.php?recurso=candidaturas&acao=minhas");
        exit;
    }

    public function atualizarStatus($pdo, $id)
    {
        if (!$this->podeVerVaga($pdo, $_POST['vaga_id'])) {
            header("Location: index.php");
            exit;
        }
        (new CandidaturaModel($pdo))->atualizarStatus($id, $_POST['status_candidatura_id']);
        header("Location: index.php?recurso=candidaturas&acao=listarPorVaga&id=" . $_POST['vaga_id']);
        exit;
    }
}