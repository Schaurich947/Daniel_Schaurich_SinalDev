<?php $modo = $modo ?? 'gestao'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $modo === 'candidato' ? 'Minhas candidaturas' : 'Candidaturas' ?> — SinalDev</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

    <?php require __DIR__ . "/../partials/topbar.php"; ?>

    <div class="wrap">
        <div class="acoes-topo">
            <h1><?= $modo === 'candidato' ? 'Minhas candidaturas' : 'Candidaturas' ?></h1>
            <a href="index.php?recurso=vagas&acao=listar" class="btn">&larr; Voltar pra vagas</a>
        </div>

        <div class="table-wrap">
            <?php if ($modo === 'candidato'): ?>
                <table>
                    <thead>
                        <tr><th>Vaga</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($candidaturas as $c): ?>
                            <tr>
                                <td><?= htmlspecialchars($c['vaga_titulo']) ?></td>
                                <td><span class="pill"><?= htmlspecialchars($c['status']) ?></span></td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($candidaturas)): ?>
                            <tr><td colspan="2">Você ainda não se candidatou a nenhuma vaga.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <table>
                    <thead>
                        <tr><th>Candidato</th><th>Email</th><th>Status</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($candidaturas as $c): ?>
                            <tr>
                                <td><?= htmlspecialchars($c['nome']) ?></td>
                                <td><?= htmlspecialchars($c['email']) ?></td>
                                <td>
                                    <form method="POST" action="index.php?recurso=candidaturas&acao=atualizarStatus&id=<?= $c['id'] ?>" class="acoes">
                                        <input type="hidden" name="vaga_id" value="<?= $c['vaga_id'] ?>">
                                        <select name="status_candidatura_id">
                                            <?php foreach ($statusList as $s): ?>
                                                <option value="<?= $s['id'] ?>" <?= ($c['status_candidatura_id'] == $s['id']) ? 'selected' : '' ?>>
                                                    <?= htmlspecialchars($s['descricao']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                        <button type="submit" class="btn primary">Atualizar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($candidaturas)): ?>
                            <tr><td colspan="3">Nenhuma candidatura recebida ainda pra essa vaga.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>

</body>
</html>
