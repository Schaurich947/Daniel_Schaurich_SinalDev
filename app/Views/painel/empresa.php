<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel — SinalDev</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

    <?php require __DIR__ . "/../partials/topbar.php"; ?>

    <div class="wrap">
        <h1>Olá, <?= htmlspecialchars($_SESSION['nome']) ?> 👋</h1>
        <p class="subtitulo" style="margin-bottom:24px;">Aqui está o resumo da sua conta no SinalDev.</p>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;">
            <div class="card" style="<?= $pendentes > 0 ? 'border-left:4px solid var(--danger);' : '' ?>">
                <div class="pill" style="margin-bottom:10px;<?= $pendentes > 0 ? 'color:var(--danger);border-color:var(--danger);' : '' ?>">Aguardando você</div>
                <div style="font-family:'Archivo',sans-serif;font-weight:800;font-size:1.6rem;"><?= $pendentes ?> candidatura<?= $pendentes === 1 ? '' : 's' ?></div>
                <p class="subtitulo">Ainda sem avaliação</p>
                <a href="index.php?recurso=vagas&acao=listar" class="btn primary" style="margin-top:10px;">Avaliar agora</a>
            </div>

            <div class="card">
                <div class="pill" style="margin-bottom:10px;">Suas vagas</div>
                <div style="font-family:'Archivo',sans-serif;font-weight:800;font-size:1.6rem;"><?= $vagasAtivas ?> ativa<?= $vagasAtivas === 1 ? '' : 's' ?></div>
                <p class="subtitulo"><?= count($minhasVagas) - $vagasAtivas ?> inativa(s)</p>
                <a href="index.php?recurso=vagas&acao=listar" class="btn" style="margin-top:10px;">Gerenciar vagas</a>
            </div>

            <div class="card">
                <div class="pill" style="margin-bottom:10px;">Base de talentos</div>
                <div style="font-family:'Archivo',sans-serif;font-weight:800;font-size:1.6rem;"><?= $totalCandidatos ?> candidatos</div>
                <p class="subtitulo">Cadastrados no PJP</p>
                <a href="index.php?recurso=candidatos&acao=listar" class="btn" style="margin-top:10px;">Ver candidatos</a>
            </div>
        </div>

        <a href="index.php?recurso=vagas&acao=novo" class="btn primary" style="margin-top:24px;">+ Publicar nova vaga</a>
    </div>

</body>
</html>