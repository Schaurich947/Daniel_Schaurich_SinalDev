<?php
require_once __DIR__ . "/../Models/CandidatoModel.php";
require_once __DIR__ . "/../Models/EmpresaModel.php";
require_once __DIR__ . "/../Models/AdministradorModel.php";

class AuthController
{
    public function login($pdo)
    {
        $erro = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $senha = $_POST['senha'] ?? '';

            $candidato = (new CandidatoModel($pdo))->buscarPorEmail($email);
            $empresa   = (new EmpresaModel($pdo))->buscarPorEmail($email);
            $admin     = (new AdministradorModel($pdo))->buscarPorEmail($email);

            if ($candidato && password_verify($senha, $candidato['senha'])) {
                $_SESSION['tipo'] = 'candidato';
                $_SESSION['id'] = $candidato['id'];
                $_SESSION['nome'] = $candidato['nome'];
                header("Location: index.php?recurso=vagas&acao=listar");
                exit;
            }

            if ($empresa && password_verify($senha, $empresa['senha'])) {
                $_SESSION['tipo'] = 'empresa';
                $_SESSION['id'] = $empresa['id'];
                $_SESSION['nome'] = $empresa['nome_fantasia'];
                header("Location: index.php?recurso=vagas&acao=listar");
                exit;
            }

            if ($admin && password_verify($senha, $admin['senha'])) {
                $_SESSION['tipo'] = 'admin';
                $_SESSION['id'] = $admin['id'];
                $_SESSION['nome'] = $admin['nome'];
                header("Location: index.php?recurso=candidatos&acao=listar");
                exit;
            }

            $erro = "Email ou senha incorretos.";
        }

        require __DIR__ . "/../Views/auth/login.php";
    }

    public function sair($pdo)
    {
        session_destroy();
        header("Location: index.php");
        exit;
    }
}