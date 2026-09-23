<?php $nomeUsuario = $_SESSION['nome'] ?? ''; ?>
<header class="topbar">
    <a href="index.php" class="brand">
        <span class="mark">SD</span>
        <span>SinalDev</span>
    </a>
    <div class="acoes">
        <span class="context-pill"><span class="dot"></span> <b><?= htmlspecialchars($nomeUsuario) ?></b></span>

        <?php if ($_SESSION['tipo'] === 'admin'): ?>
            <a href="index.php?recurso=candidatos&acao=listar" class="btn">Candidatos</a>
            <a href="index.php?recurso=empresas&acao=listar" class="btn">Empresas</a>
            <a href="index.php?recurso=vagas&acao=listar" class="btn">Vagas</a>
        <?php endif; ?>

        <?php if ($_SESSION['tipo'] === 'empresa'): ?>
            <a href="index.php?recurso=candidatos&acao=listar" class="btn">Candidatos</a>
            <a href="index.php?recurso=vagas&acao=listar" class="btn">Vagas</a>
            <a href="index.php?recurso=empresas&acao=editar&id=<?= (int)$_SESSION['id'] ?>" class="btn">Minha empresa</a>
        <?php endif; ?>

        <?php if ($_SESSION['tipo'] === 'candidato'): ?>
            <a href="index.php?recurso=vagas&acao=listar" class="btn">Vagas</a>
            <a href="index.php?recurso=candidatos&acao=editar&id=<?= (int)$_SESSION['id'] ?>" class="btn">Meu perfil</a>
        <?php endif; ?>

        <a href="index.php?recurso=auth&acao=sair" class="btn">Sair</a>
    </div>
</header>