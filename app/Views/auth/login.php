<?php
$erro = $erro ?? null;
$apoiadoras = (new EmpresaModel($pdo))->buscarTodos();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SinalDev — Capte o sinal antes da concorrência</title>
    <link rel="stylesheet" href="../public/style.css">
</head>
<body>

    <header class="cover">
        <div class="cover-inner">
            <div>
                <span class="stamp mono"><span class="dot"></span> Programa Jovem Programador</span>
                <h1>Capte o sinal antes da <span class="accent">concorrência</span>.</h1>
                <p class="subtitle">O SinalDev conecta quem está aprendendo a programar no PJP com as empresas que apostam nesse talento.</p>
            </div>
            <div class="radar-box" aria-hidden="true">
                <svg viewBox="0 0 200 200">
                    <circle class="radar-ring" cx="100" cy="100" r="30"/>
                    <circle class="radar-ring" cx="100" cy="100" r="60"/>
                    <circle class="radar-ring" cx="100" cy="100" r="90"/>
                    <g class="radar-sweep">
                        <path d="M100,100 L100,10 A90,90 0 0,1 145,22 Z" fill="url(#sweepGrad)"/>
                    </g>
                    <defs>
                        <linearGradient id="sweepGrad" x1="100" y1="10" x2="145" y2="22" gradientUnits="userSpaceOnUse">
                            <stop offset="0" stop-color="#E6127D" stop-opacity="0.55"/>
                            <stop offset="1" stop-color="#E6127D" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    <circle class="radar-blip" cx="100" cy="70" r="3"/>
                    <circle class="radar-blip" cx="128" cy="118" r="3"/>
                    <circle class="radar-blip" cx="72" cy="128" r="3"/>
                </svg>
            </div>
        </div>
    </header>

    <div class="wrap">
        <h2 style="font-size:1.4rem;">Todo talento começa dando um sinal</h2>
        <p class="lead">A primeira linha de código que funciona. O primeiro problema resolvido sozinho. O SinalDev existe pra captar esse sinal cedo — transforma o cadastro de cada aluno e ex-aluno do PJP num perfil estruturado, filtrável por tecnologia, nível e disponibilidade, e coloca ele na frente de quem está pronto pra contratar.</p>

        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:20px;margin-top:36px;">
            <div>
                <div class="pill" style="margin-bottom:10px;">1</div>
                <h3 style="font-size:1rem;">Crie seu perfil</h3>
                <p class="subtitulo">Sem PDF de currículo — só tecnologias, disponibilidade e localização.</p>
            </div>
            <div>
                <div class="pill" style="margin-bottom:10px;">2</div>
                <h3 style="font-size:1rem;">Empresas filtram</h3>
                <p class="subtitulo">Empresas parceiras do PJP acessam o perfil estruturado, sem taxa.</p>
            </div>
            <div>
                <div class="pill" style="margin-bottom:10px;">3</div>
                <h3 style="font-size:1rem;">Contato direto</h3>
                <p class="subtitulo">Sem intermediário — a empresa fala com você assim que encontra seu perfil.</p>
            </div>
        </div>

        <div class="duo">
            <div class="duo-card">
                <div class="tag">Para alunos e ex-alunos do PJP</div>
                <h3>Seu perfil, sempre gratuito</h3>
                <p>Cadastre tecnologias, disponibilidade e localização — sem custo, sem PDF de currículo. Empresas encontram você pelo que você sabe fazer.</p>
                <a href="index.php?recurso=candidatos&acao=novo" class="btn primary">Criar meu perfil</a>
            </div>
            <div class="duo-card">
                <div class="tag">Para empresas patrocinadoras do PJP</div>
                <h3>Acesso livre, sem mensalidade</h3>
                <p>Enquanto apoiadoras do programa, empresas patrocinadoras acessam os talentos formados pelo PJP sem nenhum custo de assinatura.</p>
                <a href="index.php?recurso=empresas&acao=novo" class="btn">Cadastrar minha empresa</a>
            </div>
        </div>

        <?php if ($apoiadoras): ?>
            <div style="margin-top:48px;">
                <h3 style="font-size:1.1rem;margin-bottom:4px;">Empresas apoiadoras do PJP</h3>
                <p class="subtitulo" style="margin-bottom:16px;">Quem já patrocina o programa e recruta talentos por aqui.</p>
                <div style="display:flex;gap:12px;flex-wrap:wrap;">
                    <?php foreach ($apoiadoras as $apoiadora): ?>
                        <div class="card" style="padding:14px 20px;font-family:'Archivo',sans-serif;font-weight:700;">
                            <?= htmlspecialchars($apoiadora['nome_fantasia']) ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <section class="login-section">
        <div class="login-box">
            <h2>Já tem conta? Entrar</h2>

            <?php if ($erro): ?>
                <p class="erro"><?= htmlspecialchars($erro) ?></p>
            <?php endif; ?>

            <form method="POST" action="index.php?recurso=auth&acao=login">
                <label>Email</label>
                <input type="email" name="email" required>

                <label>Senha</label>
                <input type="password" name="senha" required>

                <button type="submit" class="btn primary" style="width:100%;margin-top:20px;border:none;cursor:pointer;">Entrar</button>
            </form>
        </div>
    </section>

</body>
</html>