<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidatos — SinalDev</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

    <?php require __DIR__ . "/../partials/topbar.php"; ?>

    <div class="wrap">
        <div class="acoes-topo">
            <h1>Candidatos</h1>
            <?php if ($_SESSION['tipo'] === 'admin'): ?>
                <a href="index.php?recurso=candidatos&acao=novo" class="btn primary">+ Novo candidato</a>
            <?php endif; ?>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Nome</th><th>Email</th><th>Local</th><th>País</th><th>Ações</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($candidatos as $c): ?>
                        <tr>
                            <td><?= htmlspecialchars($c['nome']) ?></td>
                            <td><?= htmlspecialchars($c['email']) ?></td>
                            <td><?= htmlspecialchars($c['cidade'] ?? '') ?><?= $c['estado'] ? '/' . htmlspecialchars($c['estado']) : '' ?></td>
                            <td><?= htmlspecialchars($c['pais']) ?></td>
                            <td>
                                <?php if ($_SESSION['tipo'] === 'admin'): ?>
                                    <div class="acoes">
                                        <a href="index.php?recurso=candidatos&acao=editar&id=<?= $c['id'] ?>" class="btn">Editar</a>
                                        <form method="POST" action="index.php?recurso=candidatos&acao=excluir&id=<?= $c['id'] ?>" onsubmit="return confirm('Excluir este candidato?');">
                                            <button type="submit" class="btn btn-perigo">Excluir</button>
                                        </form>
                                    </div>
                                <?php else: ?>
                                    <span class="subtitulo" style="margin:0;">Somente leitura</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
