<?php
require_once __DIR__ . "/../Models/VagaModel.php";
require_once __DIR__ . "/../Models/DisponibilidadeModel.php";
require_once __DIR__ . "/../Models/EmpresaModel.php";
require_once __DIR__ . "/../Models/CandidaturaModel.php";

class VagaController
{
    private function podeGerenciar($pdo, $vagaId)
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

    public function listar($pdo)
    {
        $model = new VagaModel($pdo);

        if ($_SESSION['tipo'] === 'empresa') {
            $vagas = $model->buscarPorEmpresa($_SESSION['id']);
        } else {
            $vagas = $model->buscarTodos();
        }

        $statusPorVaga = [];
        if ($_SESSION['tipo'] === 'candidato') {
            $candidaturaModel = new CandidaturaModel($pdo);
            foreach ($candidaturaModel->buscarPorCandidato($_SESSION['id']) as $c) {
                $statusPorVaga[$c['vaga_id']] = $c['status'];
            }
        }

        require __DIR__ . "/../Views/vagas/listar.php";
    }

    public function novo($pdo)
    {
        if ($_SESSION['tipo'] === 'candidato') {
            header("Location: index.php?recurso=vagas&acao=listar");
            exit;
        }
        $disponibilidades = (new DisponibilidadeModel($pdo))->listarTodos();
        $empresas = (new EmpresaModel($pdo))->buscarTodos();
        require __DIR__ . "/../Views/vagas/form.php";
    }

    public function editar($pdo, $id)
    {
        if (!$this->podeGerenciar($pdo, $id)) {
            header("Location: index.php?recurso=vagas&acao=listar");
            exit;
        }
        $model = new VagaModel($pdo);
        $vaga = $model->buscarPorId($id);
        $disponibilidades = (new DisponibilidadeModel($pdo))->listarTodos();
        require __DIR__ . "/../Views/vagas/form.php";
    }

    public function cadastrar($pdo)
    {
        if ($_SESSION['tipo'] === 'candidato') {
            header("Location: index.php?recurso=vagas&acao=listar");
            exit;
        }

        $dados = $_POST;
        if ($_SESSION['tipo'] === 'empresa') {
            $dados['empresa_id'] = $_SESSION['id'];
        }

        (new VagaModel($pdo))->criar($dados);
        header("Location: index.php?recurso=vagas&acao=listar");
        exit;
    }

    public function atualizar($pdo, $id)
    {
        if (!$this->podeGerenciar($pdo, $id)) {
            header("Location: index.php?recurso=vagas&acao=listar");
            exit;
        }
        (new VagaModel($pdo))->atualizar($id, $_POST);
        header("Location: index.php?recurso=vagas&acao=listar");
        exit;
    }

    public function excluir($pdo, $id)
    {
        if (!$this->podeGerenciar($pdo, $id)) {
            header("Location: index.php?recurso=vagas&acao=listar");
            exit;
        }
        (new VagaModel($pdo))->excluir($id);
        header("Location: index.php?recurso=vagas&acao=listar");
        exit;
    }
}