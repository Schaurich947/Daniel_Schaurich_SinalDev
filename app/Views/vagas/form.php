<?php $vaga = $vaga ?? null; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($vaga) ? 'Editar vaga' : 'Nova vaga' ?> — SinalDev</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

    <?php require __DIR__ . "/../partials/topbar.php"; ?>

    <div class="wrap">
        <h1><?= isset($vaga) ? 'Editar vaga' : 'Nova vaga' ?></h1>

        <form class="formulario" method="POST"
              action="index.php?recurso=vagas&acao=<?= isset($vaga) ? 'atualizar&id=' . $vaga['id'] : 'cadastrar' ?>">

            <?php if (!isset($vaga) && $_SESSION['tipo'] === 'admin'): ?>
                <label>Empresa</label>
                <select name="empresa_id" required>
                    <option value="">Selecione...</option>
                    <?php foreach ($empresas as $e): ?>
                        <option value="<?= $e['id'] ?>"><?= htmlspecialchars($e['nome_fantasia']) ?></option>
                    <?php endforeach; ?>
                </select>
            <?php endif; ?>

            <label>Título</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($vaga['titulo'] ?? '') ?>" required>

            <label>Descrição</label>
            <textarea name="descricao" rows="5"><?= htmlspecialchars($vaga['descricao'] ?? '') ?></textarea>

            <label>Disponibilidade</label>
            <select name="disponibilidade_id">
                <option value="">Selecione...</option>
                <?php foreach ($disponibilidades as $d): ?>
                    <option value="<?= $d['id'] ?>" <?= (($vaga['disponibilidade_id'] ?? null) == $d['id']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($d['descricao']) ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label>Estado</label>
            <input type="text" name="estado" maxlength="2" value="<?= htmlspecialchars($vaga['estado'] ?? '') ?>">

            <label>Cidade</label>
            <input type="text" name="cidade" value="<?= htmlspecialchars($vaga['cidade'] ?? '') ?>">

            <?php if (isset($vaga)): ?>
                <label>Ativa</label>
                <select name="ativa">
                    <option value="1" <?= $vaga['ativa'] ? 'selected' : '' ?>>Sim</option>
                    <option value="0" <?= !$vaga['ativa'] ? 'selected' : '' ?>>Não</option>
                </select>
            <?php endif; ?>

            <button type="submit" class="btn primary" style="width:100%;margin-top:20px;border:none;cursor:pointer;">
                Salvar
            </button>
        </form>

        <a class="voltar" href="index.php?recurso=vagas&acao=listar">&larr; Voltar</a>
    </div>

</body>
</html>
