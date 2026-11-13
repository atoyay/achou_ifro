<?php
session_start();

require_once __DIR__ . '/conexao.php';

$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $matricula = trim($_POST['matricula'] ?? '');
    $senha = $_POST['senha'] ?? '';

    try {

        if ($matricula === '' || $senha === '') {
            throw new RuntimeException(
                'Informe sua matrícula e senha.'
            );
        }

        // Procura aluno
        $sqlAluno = $pdo->prepare("
            SELECT
                u.usua_id,
                u.usua_nome,
                u.usua_email,
                u.usua_senha,
                u.usua_tipo_usuario,
                a.alun_matricula AS matricula
            FROM usuario u
            INNER JOIN aluno a ON a.usua_id = u.usua_id
            WHERE a.alun_matricula = :matricula
            LIMIT 1
        ");

        $sqlAluno->execute([
            'matricula' => $matricula
        ]);

        $usuario = $sqlAluno->fetch(PDO::FETCH_ASSOC);

        // Se não encontrar aluno, procura professor
        if (!$usuario) {

            $sqlProfessor = $pdo->prepare("
                SELECT
                    u.usua_id,
                    u.usua_nome,
                    u.usua_email,
                    u.usua_senha,
                    u.usua_tipo_usuario,
                    p.prof_siap AS matricula
                FROM usuario u
                INNER JOIN professor p ON p.usua_id = u.usua_id
                WHERE p.prof_siap = :matricula
                LIMIT 1
            ");

            $sqlProfessor->execute([
                'matricula' => $matricula
            ]);

            $usuario = $sqlProfessor->fetch(PDO::FETCH_ASSOC);
        }

        // Verifica senha
        if (
            !$usuario ||
            !password_verify($senha, $usuario['usua_senha'])
        ) {
            throw new RuntimeException(
                'Matrícula ou senha incorreta.'
            );
        }

        // Proteção da sessão
        session_regenerate_id(true);

        $_SESSION['usuario_id'] = $usuario['usua_id'];
        $_SESSION['usuario_nome'] = $usuario['usua_nome'];
        $_SESSION['usuario_email'] = $usuario['usua_email'];
        $_SESSION['usuario_tipo'] = $usuario['usua_tipo_usuario'];
        $_SESSION['matricula'] = $usuario['matricula'];

        // Redirecionamento após entrar
        header('Location: ' . URL . '/paginas/inicio');
        exit;

    } catch (RuntimeException $e) {

        $mensagem = $e->getMessage();

    } catch (PDOException $e) {

        error_log('Erro no login: ' . $e->getMessage());

        $mensagem = 'Não foi possível realizar o login.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Login - Achou.IFRO</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<style>

* {
    box-sizing: border-box;
}

body {
    margin: 0;
    min-height: 100vh;
    font-family: Arial, sans-serif;
    background: #f6f7e9;
}

/* CONTAINER PRINCIPAL */

.login-page {
    min-height: 100vh;
    display: flex;
}

/* LADO ESQUERDO */

.login-esquerdo {
    width: 48%;
    background: #e8ed76;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 40px;
    text-align: center;
}

.login-esquerdo img {
    width: 300px;
    max-width: 90%;
    margin-bottom: 25px;
}

.login-esquerdo h1 {
    font-size: 35px;
    font-weight: bold;
    color: #30351c;
}

.login-esquerdo p {
    color: #53583a;
    max-width: 350px;
}

/* LADO DIREITO */

.login-direito {
    width: 52%;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 30px;
}

.login-conteudo {
    width: 100%;
    max-width: 440px;
}

/* TÍTULO */

.titulo {
    font-size: 32px;
    font-weight: bold;
    color: #252525;
}

.subtitulo {
    color: #777;
    margin-bottom: 30px;
}

/* FORMULÁRIO */

.login-card {
    background: white;
    padding: 32px;
    border-radius: 14px;
    box-shadow: 0 5px 25px rgba(0,0,0,.07);
}

.form-label {
    font-weight: bold;
    font-size: 14px;
}

.form-control {
    height: 48px;
    border-radius: 8px;
}

.form-control:focus {
    border-color: #d5b52f;
    box-shadow: 0 0 0 3px #f8edbb;
}

/* SENHA */

.senha-box {
    position: relative;
}

.senha-box input {
    padding-right: 45px;
}

.senha-box button {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    border: none;
    background: none;
    font-size: 18px;
}

/* LINKS */

.link {
    color: #a38712;
    text-decoration: none;
    font-size: 13px;
    font-weight: bold;
}

/* BOTÕES */

.btn-entrar {
    width: 100%;
    height: 48px;
    background: #e7c94f;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    font-weight: bold;
    margin-top: 15px;
}

.btn-entrar:hover {
    background: #d4b333;
}

.btn-cadastrar {
    display: block;
    width: 100%;
    padding: 12px;
    border: 1px solid #d5b52f;
    border-radius: 8px;
    color: #77610d;
    text-decoration: none;
    text-align: center;
    font-weight: bold;
    transition: .2s;
}

.btn-cadastrar:hover {
    background: #fff9dc;
}

/* DIVISOR */

.divisor {
    display: flex;
    align-items: center;
    gap: 15px;
    margin: 23px 0;
    color: #888;
}

.divisor::before,
.divisor::after {
    content: "";
    height: 1px;
    background: #ddd;
    flex: 1;
}

/* RESPONSIVIDADE */

@media(max-width: 768px) {

    .login-page {
        flex-direction: column;
    }

    .login-esquerdo {
        width: 100%;
        min-height: 220px;
        padding: 25px;
    }

    .login-esquerdo img {
        width: 110px;
        margin-bottom: 10px;
    }

    .login-esquerdo h1 {
        font-size: 25px;
    }

    .login-direito {
        width: 100%;
        padding: 25px 15px;
    }

    .login-card {
        padding: 24px 18px;
    }

}

</style>

</head>

<body>

<div class="login-page">

    <!-- LADO ESQUERDO -->

    <section class="login-esquerdo">

        <img src="../public/img/logo.png" alt="Logo Achou.IFRO">

    </section>

    <!-- LADO DIREITO -->

    <section class="login-direito">

        <div class="login-conteudo">

            <h2 class="titulo">
                Bem-vindo de volta!
            </h2>

            <p class="subtitulo">
                Faça login para acessar o sistema de Achado e Perdido
            </p>

            <div class="login-card">

                <?php if ($mensagem !== ''): ?>

                    <div class="alert alert-danger">
                        <?= htmlspecialchars(
                            $mensagem,
                            ENT_QUOTES,
                            'UTF-8'
                        ) ?>
                    </div>

                <?php endif; ?>

                <form method="POST">

                    <div class="mb-4">

                        <label class="form-label">
                            Matrícula 
                        </label>

                        <input
                            type="text"
                            name="matricula"
                            class="form-control"
                            placeholder="Digite sua matrícula"
                            required
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Senha
                        </label>

                        <div class="senha-box">

                            <input
                                type="password"
                                name="senha"
                                id="senha"
                                class="form-control"
                                placeholder="Digite sua senha"
                                required
                            >

                            <button
                                type="button"
                                onclick="mostrarSenha()">

                                <i class="bi bi-eye"
                                   id="iconeSenha"></i>

                            </button>

                        </div>

                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <div class="form-check">

                            <input
                                type="checkbox"
                                class="form-check-input"
                                name="lembrar"
                                id="lembrar"
                            >

                            <label
                                class="form-check-label small"
                                for="lembrar">

                                Lembrar-me

                            </label>

                        </div>

                        <a href="<?= URL ?>/paginas/recuperar"
                           class="link">

                            Esqueceu a senha?

                        </a>

                    </div>

                    <button type="submit"
                            class="btn-entrar">

                        <i class="bi bi-box-arrow-in-right"></i>
                        Entrar

                    </button>

                </form>

                <div class="divisor">
                    ou
                </div>

                <a href="<?= URL ?>/paginas/cadastrar"
                   class="btn-cadastrar">

                    <i class="bi bi-person-plus"></i>
                    Criar minha conta

                </a>

            </div>

            <p class="text-center small text-secondary mt-4">

                <i class="bi bi-shield-check"></i>

                Seus dados estão protegidos conosco.

            </p>

        </div>

    </section>

</div>

<script>

function mostrarSenha() {

    const senha = document.getElementById("senha");
    const icone = document.getElementById("iconeSenha");

    if (senha.type === "password") {

        senha.type = "text";
        icone.className = "bi bi-eye-slash";

    } else {

        senha.type = "password";
        icone.className = "bi bi-eye";

    }

}

</script>

</body>
</html>
