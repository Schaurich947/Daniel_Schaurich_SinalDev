<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><title><?= isset($vaga) ? 'Editar vaga' : 'Nova vaga' ?></title></head>
    <link rel="stylesheet" href="../public/style.css">

<body>
    <h1><?= isset($vaga) ? 'Editar vaga' : 'Nova vaga' ?></h1>

    <form method="POST" action="index.php?recurso=vagas&acao=<?= isset($vaga) ? 'atualizar&id=' . $vaga['id'] : 'cadastrar' ?>">

        <?php if (!isset($vaga)): ?>
            <label>Empresa</label><br>
            <select name="empresa_id" required>
                <option value="">Selecione...</option>
                <?php foreach ($empresas as $e): ?>
                    <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['nome_fantasia']) ?></option>
                <?php endforeach; ?>
            </select><br><br>
        <?php endif; ?>

        <label>Título</label><br>
        <input type="text" name="titulo" value="<?= htmlspecialchars($vaga['titulo'] ?? '') ?>" required><br><br>

        <label>Descrição</label><br>
        <textarea name="descricao" rows="5" cols="40"><?= htmlspecialchars($vaga['descricao'] ?? '') ?></textarea><br><br>

        <label>Disponibilidade</label><br>
        <select name="disponibilidade_id">
            <option value="">Selecione...</option>
            <?php foreach ($disponibilidades as $d): ?>
                <option value="<?= $d['id'] ?>" <?= (($vaga['disponibilidade_id'] ?? null) == $d['id']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($d['descricao']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Estado</label><br>
        <input type="text" name="estado" maxlength="2" value="<?= htmlspecialchars($vaga['estado'] ?? '') ?>"><br><br>

        <label>Cidade</label><br>
        <input type="text" name="cidade" value="<?= htmlspecialchars($vaga['cidade'] ?? '') ?>"><br><br>

        <?php if (isset($vaga)): ?>
            <label>Ativa</label><br>
            <select name="ativa">
                <option value="1" <?= $vaga['ativa'] ? 'selected' : '' ?>>Sim</option>
                <option value="0" <?= !$vaga['ativa'] ? 'selected' : '' ?>>Não</option>
            </select><br><br>
        <?php endif; ?>

        <button type="submit">Salvar</button>
    </form>

    <p><a href="index.php?recurso=vagas&acao=listar">Voltar</a></p>
</body>
</html>