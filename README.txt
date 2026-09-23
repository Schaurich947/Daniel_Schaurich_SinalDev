# SinalDev

Plataforma de recrutamento que conecta candidatos e empresas: candidatos criam um perfil gratuito e se candidatam a vagas; empresas publicam vagas e acompanham as candidaturas recebidas. Projeto em PHP puro com arquitetura MVC e banco MySQL.

## Requisitos

- PHP 8+ com extensão PDO MySQL habilitada
- MySQL (ou MariaDB)
- Um ambiente local tipo **Laragon** ou **XAMPP**

## Como rodar o projeto

1. **Coloque a pasta do projeto** dentro da pasta de sites do seu ambiente local (ex.: `C:\laragon\www\SinalDev`).

2. **Crie o banco de dados**:
   - Abra o phpMyAdmin (`http://localhost/phpmyadmin`).
   - Crie um banco chamado **`talenthub`** (esse é o nome que `conexao.php` espera).

3. **Importe a estrutura do banco**:
   - Ainda no phpMyAdmin, selecione o banco `talenthub` recém-criado.
   - Vá na aba **Importar**.
   - Escolha o arquivo `database/talenthub.sql` (que está dentro deste projeto).
   - Clique em **Executar/Ir**.
   - Isso cria todas as tabelas (`candidatos`, `empresas`, `vagas`, `candidaturas`, `disponibilidades`, `status_candidatura`, `administradores`) já com as colunas certas.

4. **Confira a conexão** em `conexao.php` (na raiz do projeto). Por padrão está configurado para o Laragon/XAMPP:
   ```php
   $host = "localhost";
   $db   = "talenthub";
   $user = "root";
   $pass = "";