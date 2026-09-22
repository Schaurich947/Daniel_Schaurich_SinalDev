<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><title>Candidaturas</title></head>
    <link rel="stylesheet" href="../public/style.css">

<body>
    <h1>Candidaturas</h1>

    <table border="1" cellpadding="6">
        <tr><th>Candidato</th><th>Email</th><th>Status</th></tr>
        <?php foreach ($candidaturas as $c): ?>
            <tr>
                <td><?= htmlspecialchars($c['nome']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td>
                    <form method="POST" action="index.php?recurso=candidaturas&acao=atualizarStatus&id=<?= $c['id'] ?>">
                        <input type="hidden" name="vaga_id" value="<?= $c['vaga_id'] ?>">
                        <select name="status_candidatura_id">
                            <?php foreach ($statusList as $s): ?>
                                <option value="<?= $s['id'] ?>" <?= ($c['status_candidatura_id'] == $s['id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($s['descricao']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit">Atualizar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p><a href="index.php?recurso=vagas&acao=listar">Voltar pra vagas</a></p>
</body>
</html>