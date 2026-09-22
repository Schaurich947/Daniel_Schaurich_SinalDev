<?php
require_once __DIR__ . "/conexao.php";

$nome = "Suporte SinalDev";
$email = "suporte@sinaldev.com";
$senha = password_hash("admin123", PASSWORD_DEFAULT);

$stmt = $pdo->prepare("INSERT INTO administradores (nome, email, senha) VALUES (?, ?, ?)");
$stmt->execute([$nome, $email, $senha]);

echo "Administrador criado com id " . $pdo->lastInsertId();