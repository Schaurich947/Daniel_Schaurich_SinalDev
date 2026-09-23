<?php
require_once __DIR__ . "/conexao.php";

$nome = "Suporte SinalDev";
$email = "suporte@sinaldev.com";
$senha = password_hash("admin123", PASSWORD_DEFAULT);

try {
    $existente = $pdo->prepare("SELECT id FROM administradores WHERE email = :email");
    $existente->execute(['email' => $email]);
    if ($existente->fetch()) {
        die("Já existe um administrador com o email $email — não precisa rodar de novo. Faça login com esse email e a senha admin123.");
    }

    $stmt = $pdo->prepare("INSERT INTO administradores (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $email, $senha]);

    echo "Administrador criado com id " . $pdo->lastInsertId() . ". Login: $email / senha: admin123";
} catch (PDOException $e) {
    echo "Erro ao criar administrador: " . $e->getMessage() . "<br>";
    echo "Isso geralmente significa que a tabela 'administradores' não existe ainda no seu banco, ou tem colunas diferentes de (id, nome, email, senha). Confira no phpMyAdmin.";
}