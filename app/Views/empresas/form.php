<?php $empresa = $empresa ?? null; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($empresa) ? 'Editar empresa' : 'Cadastrar minha empresa' ?> — SinalDev</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

    <header class="topbar">
        <a href="index.php" class="brand">
            <span class="mark">SD</span>
            <span>SinalDev</span>
        </a>
        <?php if (!isset($empresa)): ?>
            <a href="index.php" class="btn">Já tem conta? Entrar</a>
        <?php else: ?>
            <a href="index.php?recurso=empresas&acao=listar" class="btn">Voltar para a lista</a>
        <?php endif; ?>
    </header>

    <div class="wrap" style="padding-top:40px;">
        <h1><?= isset($empresa) ? 'Editar empresa' : 'Cadastrar minha empresa' ?></h1>
        <p class="subtitulo">
            <?= isset($empresa)
                ? 'Atualize os dados da sua empresa.'
                : 'Empresas patrocinadoras do PJP têm acesso gratuito à base de talentos formados pelo programa.' ?>
        </p>

        <form class="formulario" method="POST"
              action="index.php?recurso=empresas&acao=<?= isset($empresa) ? 'atualizar&id=' . $empresa['id'] : 'cadastrar' ?>">

            <label>Nome fantasia</label>
            <input type="text" name="nome_fantasia" value="<?= htmlspecialchars($empresa['nome_fantasia'] ?? '') ?>" required>

            <label>CNPJ</label>
            <input type="text" name="cnpj" value="<?= htmlspecialchars($empresa['cnpj'] ?? '') ?>">

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($empresa['email'] ?? '') ?>" required>

            <?php if (!isset($empresa)): ?>
                <label>Senha</label>
                <input type="password" name="senha" required>
            <?php endif; ?>

            <label>Site</label>
            <input type="text" name="site" value="<?= htmlspecialchars($empresa['site'] ?? '') ?>" placeholder="https://">

            <button type="submit" class="btn primary" style="width:100%;margin-top:20px;border:none;cursor:pointer;">
                Salvar
            </button>
        </form>

        <a class="voltar" href="index.php">&larr; Voltar para a página inicial</a>
    </div>

</body>
</html>