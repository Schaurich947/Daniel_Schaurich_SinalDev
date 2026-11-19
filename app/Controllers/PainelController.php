<?php
require_once __DIR__ . "/../Models/CandidatoModel.php";
require_once __DIR__ . "/../Models/CandidaturaModel.php";
require_once __DIR__ . "/../Models/VagaModel.php";
require_once __DIR__ . "/../Models/EmpresaModel.php";

class PainelController
{
    public function candidato($pdo)
    {
        if ($_SESSION['tipo'] !== 'candidato') {
            header("Location: index.php");
            exit;
        }

        $candidato = (new CandidatoModel($pdo))->buscarPorId($_SESSION['id']);

        $rotulos = [
            'telefone' => 'Telefone',
            'data_nascimento' => 'Data de nascimento',
            'estado' => 'Estado',
            'cidade' => 'Cidade',
            'disponibilidade_id' => 'Disponibilidade',
        ];
        $preenchidos = 0;
        $camposFaltando = [];
        foreach ($rotulos as $campo => $rotulo) {
            if (!empty($candidato[$campo])) {
                $preenchidos++;
            } else {
                $camposFaltando[] = $rotulo;
            }
        }
        $percentualPerfil = (int) round((2 + $preenchidos) / (2 + count($rotulos)) * 100);

        $candidaturas = (new CandidaturaModel($pdo))->buscarPorCandidato($_SESSION['id']);
        $totalCandidaturas = count($candidaturas);
        $porStatus = [];
        foreach ($candidaturas as $c) {
            $porStatus[$c['status']] = ($porStatus[$c['status']] ?? 0) + 1;
        }

        $vagasAtivas = 0;
        foreach ((new VagaModel($pdo))->buscarTodos() as $v) {
            if ($v['ativa']) {
                $vagasAtivas++;
            }
        }

        require __DIR__ . "/../Views/painel/candidato.php";
    }

    public function empresa($pdo)
    {
        if ($_SESSION['tipo'] !== 'empresa') {
            header("Location: index.php");
            exit;
        }

        $vagaModel = new VagaModel($pdo);
        $minhasVagas = $vagaModel->buscarPorEmpresa($_SESSION['id']);

        $vagasAtivas = 0;
        foreach ($minhasVagas as $v) {
            if ($v['ativa']) {
                $vagasAtivas++;
            }
        }

        $candidaturaModel = new CandidaturaModel($pdo);
        $pendentes = 0;
        foreach ($minhasVagas as $v) {
            foreach ($candidaturaModel->buscarPorVaga($v['id']) as $c) {
                if ((int) $c['status_candidatura_id'] === 1) {
                    $pendentes++;
                }
            }
        }

        $totalCandidatos = count((new CandidatoModel($pdo))->buscarTodos());

        require __DIR__ . "/../Views/painel/empresa.php";
    }
}