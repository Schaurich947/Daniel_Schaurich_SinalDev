<?php
session_start();
require_once __DIR__ . "/../conexao.php";
require_once __DIR__ . "/../app/Controllers/AuthController.php";
require_once __DIR__ . "/../app/Controllers/CandidatoController.php";
require_once __DIR__ . "/../app/Controllers/EmpresaController.php";
require_once __DIR__ . "/../app/Controllers/VagaController.php";
require_once __DIR__ . "/../app/Controllers/CandidaturaController.php";

$recurso = $_GET['recurso'] ?? null;
$acao = $_GET['acao'] ?? 'listar';
$id = $_GET['id'] ?? null;

// Rotas públicas: login/sair, e criar conta nova (candidato ou empresa)
$ehLogin = ($recurso === 'auth');
$ehCadastroPublico = in_array($recurso, ['candidatos', 'empresas']) && in_array($acao, ['novo', 'cadastrar']);

if ($ehLogin || $ehCadastroPublico) {
    switch ($recurso) {
        case 'auth':       $controller = new AuthController();     break;
        case 'candidatos': $controller = new CandidatoController(); break;
        case 'empresas':   $controller = new EmpresaController();   break;
    }
    $controller->$acao($pdo);
    exit;
}

$logado = isset($_SESSION['tipo']);

if (!$logado) {
    $erro = null;
    require __DIR__ . "/../app/Views/auth/login.php";
    exit;
}

if ($recurso === null) {
    switch ($_SESSION['tipo']) {
        case 'candidato': $destino = 'candidatos'; break;
        case 'empresa':   $destino = 'vagas';       break;
        default:          $destino = 'candidatos';  // admin
    }
    header("Location: index.php?recurso=$destino&acao=listar");
    exit;
}

switch ($recurso) {
    case 'candidatos':   $controller = new CandidatoController();   break;
    case 'empresas':     $controller = new EmpresaController();     break;
    case 'vagas':        $controller = new VagaController();        break;
    case 'candidaturas': $controller = new CandidaturaController(); break;
    default:             die("Recurso não encontrado.");
}

if (!method_exists($controller, $acao)) {
    die("Ação não encontrada.");
}

if ($id !== null) {
    $controller->$acao($pdo, $id);
} else {
    $controller->$acao($pdo);
}