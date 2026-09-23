<?php
/** @var array $vagas */
/** @var array $statusPorVaga */
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vagas — SinalDev</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

    <?php require __DIR__ . "/../partials/topbar.php"; ?>

    <div class="wrap">
        <div class="acoes-topo">
            <h1>Vagas</h1>
            <div class="acoes">
                <?php if ($_SESSION['tipo'] === 'candidato'): ?>
                    <a href="index.php?recurso=candidaturas&acao=minhas" class="btn">Minhas candidaturas</a>
                <?php else: ?>
                    <a href="index.php?recurso=vagas&acao=novo" class="btn primary">+ Nova vaga</a>
                <?php endif; ?>
            </div>
        </div>

        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Título</th><th>Empresa</th><th>Local</th><th>Ativa</th><th>Candidatar</th>
                        <?php if ($_SESSION['tipo'] !== 'candidato'): ?><th>Ações</th><?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($vagas as $v): ?>
                        <tr>
                            <td><?= htmlspecialchars($v['titulo']) ?></td>
                            <td><?= htmlspecialchars($v['nome_fantasia']) ?></td>
                            <td><?= htmlspecialchars($v['cidade'] ?? '') ?><?= $v['estado'] ? '/' . htmlspecialchars($v['estado']) : '' ?></td>
                            <td><span class="pill"><?= $v['ativa'] ? 'Sim' : 'Não' ?></span></td>
                            <td>
                                <?php if ($_SESSION['tipo'] === 'candidato'): ?>
                                    <?php if (isset($statusPorVaga[$v['id']])): ?>
                                        <span class="pill" style="color:var(--success);border-color:var(--success);">✓ <?= htmlspecialchars($statusPorVaga[$v['id']]) ?></span>
                                    <?php else: ?>
                                        <form method="POST" action="index.php?recurso=candidaturas&acao=candidatar">
                                            <input type="hidden" name="vaga_id" value="<?= $v['id'] ?>">
                                            <button type="submit" class="btn primary">Candidatar-se</button>
                                        </form>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="subtitulo" style="margin:0;">—</span>
                                <?php endif; ?>
                            </td>
                            <?php if ($_SESSION['tipo'] !== 'candidato'): ?>
                                <td>
                                    <?php $donoOuAdmin = $_SESSION['tipo'] === 'admin'
                                        || ($_SESSION['tipo'] === 'empresa' && (int)$v['empresa_id'] === (int)$_SESSION['id']); ?>
                                    <?php if ($donoOuAdmin): ?>
                                        <div class="acoes">
                                            <a href="index.php?recurso=vagas&acao=editar&id=<?= $v['id'] ?>" class="btn">Editar</a>
                                            <a href="index.php?recurso=candidaturas&acao=listarPorVaga&id=<?= $v['id'] ?>" class="btn">Ver candidaturas</a>
                                            <form method="POST" action="index.php?recurso=vagas&acao=excluir&id=<?= $v['id'] ?>" onsubmit="return confirm('Excluir esta vaga?');">
                                                <button type="submit" class="btn btn-perigo">Excluir</button>
                                            </form>
                                        </div>
                                    <?php else: ?>
                                        <span class="subtitulo" style="margin:0;">—</span>
                                    <?php endif; ?>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>