<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><title><?= isset($candidato) ? 'Editar candidato' : 'Novo candidato' ?></title></head>
    <link rel="stylesheet" href="../public/style.css">

<body>
    <h1><?= isset($candidato) ? 'Editar candidato' : 'Novo candidato' ?></h1>

    <form method="POST" action="index.php?recurso=candidatos&acao=<?= isset($candidato) ? 'atualizar&id=' . $candidato['id'] : 'cadastrar' ?>">

        <label>Nome</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($candidato['nome'] ?? '') ?>" required><br><br>

        <label>Email</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($candidato['email'] ?? '') ?>" required><br><br>

        <?php if (!isset($candidato)): ?>
            <label>Senha</label><br>
            <input type="password" name="senha" required><br><br>
        <?php endif; ?>

        <label>Telefone</label><br>
        <input type="text" name="telefone" value="<?= htmlspecialchars($candidato['telefone'] ?? '') ?>"><br><br>

        <label>Data de nascimento</label><br>
        <input type="date" name="data_nascimento" value="<?= htmlspecialchars($candidato['data_nascimento'] ?? '') ?>"><br><br>

        <label>País</label><br>
        <input type="text" name="pais" value="<?= htmlspecialchars($candidato['pais'] ?? 'Brasil') ?>"><br><br>

        <label>Estado</label><br>
        <select name="estado">
            <option value="">— não se aplica —</option>
            <?php foreach (['AC','AL','AP','AM','BA','CE','DF','ES','GO','MA','MT','MS','MG','PA','PB','PR','PE','PI','RJ','RN','RS','RO','RR','SC','SP','SE','TO'] as $uf): ?>
                <option value="<?= $uf ?>" <?= (($candidato['estado'] ?? '') === $uf) ? 'selected' : '' ?>><?= $uf ?></option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Cidade</label><br>
        <input type="text" name="cidade" value="<?= htmlspecialchars($candidato['cidade'] ?? '') ?>"><br><br>

        <label>Disponibilidade</label><br>
        <select name="disponibilidade_id">
            <option value="">Selecione...</option>
            <?php foreach ($disponibilidades as $d): ?>
                <option value="<?= $d['id'] ?>" <?= (($candidato['disponibilidade_id'] ?? null) == $d['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($d['descricao']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Salvar</button>
    </form>

    <p><a href="index.php?recurso=candidatos&acao=listar">Voltar</a></p>
</body>
</html>