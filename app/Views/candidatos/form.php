<?php $candidato = $candidato ?? null; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($candidato) ? 'Editar candidato' : 'Criar meu perfil' ?> — SinalDev</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

    <header class="topbar">
        <a href="index.php" class="brand">
            <span class="mark">SD</span>
            <span>SinalDev</span>
        </a>
        <?php if (!isset($candidato)): ?>
            <a href="index.php" class="btn">Já tem conta? Entrar</a>
        <?php elseif (($_SESSION['tipo'] ?? null) === 'candidato'): ?>
            <a href="index.php?recurso=vagas&acao=listar" class="btn">Voltar</a>
        <?php else: ?>
            <a href="index.php?recurso=candidatos&acao=listar" class="btn">Voltar para a lista</a>
        <?php endif; ?>
    </header>

    <div class="wrap" style="padding-top:40px;">
        <h1><?= isset($candidato) ? 'Editar candidato' : 'Criar meu perfil' ?></h1>
        <p class="subtitulo">
            <?= isset($candidato)
                ? 'Atualize seus dados de contato e disponibilidade.'
                : 'Cadastre suas informações — é gratuito e leva menos de dois minutos.' ?>
        </p>

        <form class="formulario" method="POST"
              action="index.php?recurso=candidatos&acao=<?= isset($candidato) ? 'atualizar&id=' . $candidato['id'] : 'cadastrar' ?>">

            <label>Nome</label>
            <input type="text" name="nome" value="<?= htmlspecialchars($candidato['nome'] ?? '') ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($candidato['email'] ?? '') ?>" required>

            <?php if (!isset($candidato)): ?>
                <label>Senha</label>
                <input type="password" name="senha" required>
            <?php endif; ?>

            <label>Telefone</label>
            <input type="text" name="telefone" value="<?= htmlspecialchars($candidato['telefone'] ?? '') ?>">

            <label>Data de nascimento</label>
            <input type="date" name="data_nascimento" value="<?= htmlspecialchars($candidato['data_nascimento'] ?? '') ?>">

            <label>País</label>
            <input type="text" name="pais" value="<?= htmlspecialchars($candidato['pais'] ?? 'Brasil') ?>">

            <label>Estado</label>
            <select name="estado">
                <option value="">— não se aplica —</option>
                <?php foreach (['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'] as $uf): ?>
                    <option value="<?= $uf ?>" <?= (($candidato['estado'] ?? '') === $uf) ? 'selected' : '' ?>><?= $uf ?></option>
                <?php endforeach; ?>
            </select>

            <label>Cidade</label>
            <input type="text" name="cidade" value="<?= htmlspecialchars($candidato['cidade'] ?? '') ?>">

            <label>Disponibilidade</label>
            <select name="disponibilidade_id">
                <option value="">Selecione...</option>
                <?php foreach ($disponibilidades as $d): ?>
                    <option value="<?= $d['id'] ?>" <?= (($candidato['disponibilidade_id'] ?? null) == $d['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($d['descricao']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="btn primary" style="width:100%;margin-top:20px;border:none;cursor:pointer;">
                Salvar
            </button>
        </form>

        <a class="voltar" href="index.php">&larr; Voltar para a página inicial</a>
    </div>

</body>
</html>