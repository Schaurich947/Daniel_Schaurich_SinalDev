<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><title><?= isset($empresa) ? 'Editar empresa' : 'Nova empresa' ?></title></head>
    <link rel="stylesheet" href="../public/style.css">

<body>
    <h1><?= isset($empresa) ? 'Editar empresa' : 'Nova empresa' ?></h1>

    <form method="POST" action="index.php?recurso=empresas&acao=<?= isset($empresa) ? 'atualizar&id=' . $empresa['id'] : 'cadastrar' ?>">

        <label>Nome fantasia</label><br>
        <input type="text" name="nome_fantasia" value="<?= htmlspecialchars($empresa['nome_fantasia'] ?? '') ?>" required><br><br>

        <label>CNPJ</label><br>
        <input type="text" name="cnpj" value="<?= htmlspecialchars($empresa['cnpj'] ?? '') ?>"><br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($empresa['email'] ?? '') ?>" required><br><br>

        <?php if (!isset($empresa)): ?>
            <label>Senha</label><br>
            <input type="password" name="senha" required><br><br>
        <?php endif; ?>

        <label>Site</label><br>
        <input type="text" name="site" value="<?= htmlspecialchars($empresa['site'] ?? '') ?>"><br><br>

        <button type="submit">Salvar</button>
    </form>

    <p><a href="index.php?recurso=empresas&acao=listar">Voltar</a></p>
</body>
</html>