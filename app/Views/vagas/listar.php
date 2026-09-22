<!DOCTYPE html>
<html lang="pt-br">
<head><meta charset="UTF-8"><title>Vagas</title></head>
    <link rel="stylesheet" href="../public/style.css">

<body>
    <h1>Vagas</h1>
    <p><a href="index.php?recurso=vagas&acao=novo">Nova vaga</a></p>

    <table border="1" cellpadding="6">
        <tr><th>Título</th><th>Empresa</th><th>Local</th><th>Ativa</th><th>Candidatar</th><th>Ações</th></tr>
        <?php foreach ($vagas as $v): ?>
            <tr>
                <td><?= htmlspecialchars($v['titulo']) ?></td>
                <td><?= htmlspecialchars($v['nome_fantasia']) ?></td>
                <td><?= htmlspecialchars($v['cidade'] ?? '') ?><?= $v['estado'] ? '/' . htmlspecialchars($v['estado']) : '' ?></td>
                <td><?= $v['ativa'] ? 'Sim' : 'Não' ?></td>
                <td>
                    <form method="POST" action="index.php?recurso=candidaturas&acao=candidatar" style="display:inline;">
                        <input type="hidden" name="vaga_id" value="<?= $v['id'] ?>">
                        <select name="candidato_id" required>
                            <?php foreach ($candidatos as $cand): ?>
                                <option value="<?= $cand['id'] ?>"><?= htmlspecialchars($cand['nome']) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <button type="submit">Candidatar</button>
                    </form>
                </td>
                <td>
                    <a href="index.php?recurso=vagas&acao=editar&id=<?= $v['id'] ?>">Editar</a>
                    <a href="index.php?recurso=candidaturas&acao=listarPorVaga&id=<?= $v['id'] ?>">Ver candidaturas</a>
                    <form method="POST" action="index.php?recurso=vagas&acao=excluir&id=<?= $v['id'] ?>" style="display:inline;" onsubmit="return confirm('Excluir esta vaga?');">
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>