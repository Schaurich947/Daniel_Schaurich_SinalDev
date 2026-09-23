<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empresas — SinalDev</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

    <?php require __DIR__ . "/../partials/topbar.php"; ?>

    <div class="wrap">
        <div class="acoes-topo">
            <h1><?= $_SESSION['tipo'] === 'empresa' ? 'Minha empresa' : 'Empresas patrocinadoras' ?></h1>
            <?php if ($_SESSION['tipo'] === 'admin'): ?>
                <a href="index.php?recurso=empresas&acao=novo" class="btn primary">+ Nova empresa</a>
            <?php endif; ?>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr><th>Nome</th><th>Email</th><th>CNPJ</th><th>Site</th><th>Ações</th></tr>
                </thead>
                <tbody>
                    <?php foreach ($empresas as $e): ?>
                        <tr>
                            <td><?= htmlspecialchars($e['nome_fantasia']) ?></td>
                            <td><?= htmlspecialchars($e['email']) ?></td>
                            <td><?= htmlspecialchars($e['cnpj'] ?? '') ?></td>
                            <td><?= htmlspecialchars($e['site'] ?? '') ?></td>
                            <td>
                                <div class="acoes">
                                    <a href="index.php?recurso=empresas&acao=editar&id=<?= $e['id'] ?>" class="btn">Editar</a>
                                    <?php if ($_SESSION['tipo'] === 'admin'): ?>
                                        <form method="POST" action="index.php?recurso=empresas&acao=excluir&id=<?= $e['id'] ?>" onsubmit="return confirm('Excluir esta empresa?');">
                                            <button type="submit" class="btn btn-perigo">Excluir</button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>
