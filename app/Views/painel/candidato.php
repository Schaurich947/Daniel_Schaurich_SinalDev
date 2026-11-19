<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meu painel — SinalDev</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

    <?php require __DIR__ . "/../partials/topbar.php"; ?>

    <div class="wrap">
        <h1>Olá, <?= htmlspecialchars(explode(' ', $candidato['nome'])[0]) ?> 👋</h1>
        <p class="subtitulo" style="margin-bottom:24px;">Aqui está o resumo do seu perfil no SinalDev.</p>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(240px,1fr));gap:16px;">
            <div class="card">
                <div class="pill" style="margin-bottom:10px;">Seu perfil</div>
                <div style="font-family:'Archivo',sans-serif;font-weight:800;font-size:1.6rem;"><?= $percentualPerfil ?>% completo</div>
                <?php if ($camposFaltando): ?>
                    <p class="subtitulo">Falta: <?= htmlspecialchars(implode(', ', $camposFaltando)) ?></p>
                <?php else: ?>
                    <p class="subtitulo">Seu perfil está completo.</p>
                <?php endif; ?>
                <a href="index.php?recurso=candidatos&acao=editar&id=<?= (int)$_SESSION['id'] ?>" class="btn primary" style="margin-top:10px;">Completar perfil</a>
            </div>

            <div class="card">
                <div class="pill" style="margin-bottom:10px;">Suas candidaturas</div>
                <div style="font-family:'Archivo',sans-serif;font-weight:800;font-size:1.6rem;"><?= $totalCandidaturas ?> no total</div>
                <p class="subtitulo">
                    <?php if ($porStatus): ?>
                        <?php
                            $partes = [];
                            foreach ($porStatus as $status => $qtd) {
                                $partes[] = "$qtd $status";
                            }
                            echo htmlspecialchars(implode(' · ', $partes));
                        ?>
                    <?php else: ?>
                        Você ainda não se candidatou a nenhuma vaga.
                    <?php endif; ?>
                </p>
                <a href="index.php?recurso=candidaturas&acao=minhas" class="btn" style="margin-top:10px;">Ver minhas candidaturas</a>
            </div>

            <div class="card">
                <div class="pill" style="margin-bottom:10px;">Vagas abertas agora</div>
                <div style="font-family:'Archivo',sans-serif;font-weight:800;font-size:1.6rem;"><?= $vagasAtivas ?> vaga<?= $vagasAtivas === 1 ? '' : 's' ?></div>
                <p class="subtitulo">Em diversas empresas parceiras do PJP.</p>
                <a href="index.php?recurso=vagas&acao=listar" class="btn" style="margin-top:10px;">Ver todas as vagas</a>
            </div>
        </div>
    </div>

</body>
</html>