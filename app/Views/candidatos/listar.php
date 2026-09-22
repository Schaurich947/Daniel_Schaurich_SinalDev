<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><title>Candidatos</title></head>
    <link rel="stylesheet" href="../public/style.css">

<body>
    <h1>Candidatos</h1>
    <p><a href="index.php?recurso=candidatos&acao=novo">Novo candidato</a></p>

    <table border="1" cellpadding="6">
        <tr><th>Nome</th><th>Email</th><th>Local</th><th>País</th><th>Ações</th></tr>
        <?php foreach ($candidatos as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['nome']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td><?= htmlspecialchars($c['cidade'] ?? '') ?><?= $c['estado'] ? '/' . htmlspecialchars($c['estado']) : '' ?></td>
                <td><?= htmlspecialchars($c['pais']) ?></td>
                <td>
                    <a href="index.php?recurso=candidatos&acao=editar&id=<?= $c['id'] ?>">Editar</a>
                    <form method="POST" action="index.php?recurso=candidatos&acao=excluir&id=<?= $c['id'] ?>" style="display:inline;" onsubmit="return confirm('Excluir este candidato?');">
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>