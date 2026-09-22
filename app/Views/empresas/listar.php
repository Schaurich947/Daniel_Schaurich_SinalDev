<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><title>Empresas</title></head>
    <link rel="stylesheet" href="../public/style.css">

<body>
    <h1>Empresas patrocinadoras</h1>
    <p><a href="index.php?recurso=empresas&acao=novo">Nova empresa</a></p>

    <table border="1" cellpadding="6">
        <tr><th>Nome</th><th>Email</th><th>CNPJ</th><th>Site</th><th>Ações</th></tr>
        <?php foreach ($empresas as $e): ?>
            <tr>
                <td><?= htmlspecialchars($e['nome_fantasia']) ?></td>
                <td><?= htmlspecialchars($e['email']) ?></td>
                <td><?= htmlspecialchars($e['cnpj'] ?? '') ?></td>
                <td><?= htmlspecialchars($e['site'] ?? '') ?></td>
                <td>
                    <a href="index.php?recurso=empresas&acao=editar&id=<?= $e['id'] ?>">Editar</a>
                    <form method="POST" action="index.php?recurso=empresas&acao=excluir&id=<?= $e['id'] ?>" style="display:inline;" onsubmit="return confirm('Excluir esta empresa?');">
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>