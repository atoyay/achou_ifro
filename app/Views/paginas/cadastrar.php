<?php
require_once __DIR__ . '/conexao.php';

$mensagem = '';
$tipoMensagem = 'danger';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tipo = $_POST['tipo'] ?? '';
    $nome = trim($_POST['nome'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $matricula = trim($_POST['matricula'] ?? '');
    $cursoSelecionado = trim($_POST['curso'] ?? '');
    $outroCurso = trim($_POST['outro_curso'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $confirmarSenha = $_POST['confirmar_senha'] ?? '';

    try {
        // Verifica o tipo de cadastro
        if (!in_array($tipo, ['aluno', 'professor'], true)) {
            throw new RuntimeException('Selecione um tipo de usuário válido.');
        }
        if ($nome === '' || !filter_var($email, FILTER_VALIDATE_EMAIL) || $matricula === '' || $cursoSelecionado === '') {
            throw new RuntimeException('Preencha corretamente todos os campos obrigatórios.');
        }
        if (mb_strlen($nome) > 100 || mb_strlen($email) > 150 || mb_strlen($matricula) > 30) {
            throw new RuntimeException('Um ou mais campos excedem o tamanho permitido.');
        }
        if ($cursoSelecionado === 'Outro' && $outroCurso === '') {
            throw new RuntimeException('Informe o nome do curso ou setor.');
        }
        if (strlen($senha) < 6) {
            throw new RuntimeException('A senha deve ter pelo menos 6 caracteres.');
        }
        if ($senha !== $confirmarSenha) {
            throw new RuntimeException('As senhas informadas não coincidem.');
        }
        if (!isset($_POST['termos'])) {
            throw new RuntimeException('É necessário concordar com os termos para criar a conta.');
        }

        $cursoOuSetor = $cursoSelecionado === 'Outro' ? $outroCurso : $cursoSelecionado;
        if (mb_strlen($cursoOuSetor) > 100) {
            throw new RuntimeException('O curso ou setor deve ter no máximo 100 caracteres.');
        }

        $pdo->beginTransaction();
        $verificaEmail = $pdo->prepare('SELECT usua_id FROM usuario WHERE usua_email = :email LIMIT 1');
        $verificaEmail->execute(['email' => $email]);
        if ($verificaEmail->fetch()) {
            throw new RuntimeException('Este e-mail já está cadastrado.');
        }

        // Convenção usada pelo formulário: 1 = aluno; 2 = professor.
        $tipoUsuario = $tipo === 'aluno' ? 1 : 2;
        $insereUsuario = $pdo->prepare(
            'INSERT INTO usuario (usua_nome, usua_email, usua_senha, usua_tipo_usuario) VALUES (:nome, :email, :senha, :tipo)'
        );
        $insereUsuario->execute([
            'nome' => $nome,
            'email' => $email,
            'senha' => password_hash($senha, PASSWORD_DEFAULT),
            'tipo' => $tipoUsuario,
        ]);
        $usuarioId = (int) $pdo->lastInsertId();

        if ($tipo === 'aluno') {
            $perfil = $pdo->prepare(
                'INSERT INTO aluno (usua_id, alun_matricula, alun_curso) VALUES (:usuario_id, :matricula, :curso)'
            );
            $perfil->execute(['usuario_id' => $usuarioId, 'matricula' => $matricula, 'curso' => $cursoOuSetor]);
        } else {
            $perfil = $pdo->prepare(
                'INSERT INTO professor (usua_id, prof_siap, prof_setor) VALUES (:usuario_id, :siap, :setor)'
            );
            $perfil->execute(['usuario_id' => $usuarioId, 'siap' => $matricula, 'setor' => $cursoOuSetor]);
        }

        $pdo->commit();
        $mensagem = 'Conta criada com sucesso. Você já pode entrar.';
        $tipoMensagem = 'success';
    } catch (RuntimeException $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        $mensagem = $e->getMessage();
    } catch (PDOException $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        error_log('Falha ao cadastrar usuário: ' . $e->getMessage());
        $mensagem = 'Não foi possível concluir o cadastro. Verifique os dados e tente novamente.';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Cadastro - Achou.IFRO</title>


    <!-- BOOTSTRAP -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">


    <!-- BOOTSTRAP ICONS -->

    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>

        /*CONFIGURAÇÕES GERAIS*/

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }


        body {
            font-family: Arial, Helvetica, sans-serif;

            background-color: #fffde7;

            min-height: 100vh;

            color: #222222;
        }

        /*ÁREA DO CADASTRO*/

        .cadastro-section {

            min-height: calc(100vh - 78px);

            padding: 45px 15px 60px;

            background-color: #fffde7;

        }


        /*TÍTULO*/

        .titulo-cadastro {

            text-align: center;

            margin-bottom: 30px;

        }


        .titulo-cadastro h1 {

            font-size: 36px;

            font-weight: bold;

            color: #222222;

            margin-bottom: 8px;

        }


        .titulo-cadastro h1 span {

            color: #14130c;

        }


        .titulo-cadastro p {

            color: #666666;

            font-size: 15px;

            margin: 0;

        }


        /*CARD*/

        .cadastro-card {

            max-width: 850px;

            margin: auto;

            background-color: #ffffff;

            border: 1px solid #eee3a2;

            border-radius: 12px;

            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);

            padding: 35px 45px;

        }


        /*TIPO DE USUÁRIO*/

        .tipo-titulo {

            text-align: center;

            font-size: 18px;

            font-weight: bold;

            margin-bottom: 18px;

        }


        .tipo-usuario {

            display: flex;

            justify-content: center;

            gap: 20px;

            margin-bottom: 30px;

        }


        .tipo-option {

            width: 200px;

            cursor: pointer;

        }


        .tipo-option input {

            display: none;

        }


        .tipo-box {

            border: 2px solid #dddddd;

            border-radius: 8px;

            padding: 17px;

            text-align: center;

            transition: 0.2s;

            background-color: #ffffff;

        }


        .tipo-box i {

            display: block;

            font-size: 30px;

            color: #b79a19;

            margin-bottom: 7px;

        }


        .tipo-box span {

            font-size: 15px;

            font-weight: bold;

            color: #333333;

        }


        /* QUANDO SELECIONADO */

        .tipo-option input:checked + .tipo-box {

            border-color: #e3c440;

            background-color: #fff9cc;

            box-shadow: 0 0 0 2px rgba(227, 196, 64, 0.15);

        }


        /* =====================================
           LABELS
        ===================================== */

        .form-label {

            font-size: 14px;

            font-weight: bold;

            color: #333333;

            margin-bottom: 7px;

        }


        /* =====================================
           INPUTS
        ===================================== */

        .form-control,
        .form-select {

            height: 45px;

            border: 1px solid #d8d8d8;

            border-radius: 7px;

            font-size: 14px;

            box-shadow: none;

        }


        .form-control:focus,
        .form-select:focus {

            border-color: #e1c13c;

            box-shadow: 0 0 0 0.2rem rgba(225, 193, 60, 0.20);

        }


        /* =====================================
           SENHA
        ===================================== */

        .senha-container {

            position: relative;

        }


        .senha-container .form-control {

            padding-right: 45px;

        }


        .mostrar-senha {

            position: absolute;

            right: 12px;

            top: 50%;

            transform: translateY(-50%);

            border: none;

            background: transparent;

            cursor: pointer;

            font-size: 19px;

            color: #555555;

        }


        /*TERMOS*/

        .termos {

            font-size: 13px;

            color: #555555;

            margin-top: 15px;

            margin-bottom: 20px;

        }


        .termos a {

            color: #a38712;

            font-weight: bold;

            text-decoration: none;

        }


        .termos a:hover {

            text-decoration: underline;

        }


        /* =====================================
           BOTÃO CADASTRAR
        ===================================== */

        .btn-cadastro {

            width: 100%;

            height: 48px;

            background-color: #e7c94f;

            border: none;

            border-radius: 7px;

            color: #222222;

            font-size: 16px;

            font-weight: bold;

            transition: 0.2s;

        }


        .btn-cadastro:hover {

            background-color: #d5b63a;

            color: #111111;

        }


        /* =====================================
           JÁ POSSUI CONTA
        ===================================== */

        .login-link {

            text-align: center;

            margin-top: 20px;

            font-size: 14px;

            color: #666666;

        }


        .login-link a {

            color: #a38712;

            font-weight: bold;

            text-decoration: none;

        }


        .login-link a:hover {

            text-decoration: underline;

        }


        /* =====================================
           RESPONSIVIDADE
        ===================================== */

        @media (max-width: 768px) {

            .cadastro-card {

                padding: 30px 25px;

            }


            .tipo-usuario {

                flex-direction: column;

                align-items: center;

            }


            .tipo-option {

                width: 100%;

                max-width: 300px;

            }


            .titulo-cadastro h1 {

                font-size: 30px;

            }

        }


        @media (max-width: 576px) {

            .cadastro-section {

                padding: 30px 15px;

            }


            .cadastro-card {

                padding: 25px 18px;

            }


            .titulo-cadastro h1 {

                font-size: 27px;

            }

        }

    </style>

</head>


<body>

            </a>

        </div>

    </div>

</nav>



<!-- =====================================
     CADASTRO
===================================== -->

<section class="cadastro-section">


    <div class="container">


        <!-- TÍTULO -->

        <div class="titulo-cadastro">

            <h1>

                Crie sua <span>conta</span>

            </h1>


            <p>

                Cadastre-se para acessar o Achou.IFRO

            </p>

        </div>



        <!-- CARD -->

        <div class="cadastro-card">


            <form action="" method="POST">


                <?php if ($mensagem !== ''): ?>
                    <div class="alert alert-<?= $tipoMensagem ?>" role="alert"><?= htmlspecialchars($mensagem, ENT_QUOTES, 'UTF-8') ?></div>
                <?php endif; ?>

                <!-- =================================
                     TIPO DE USUÁRIO
                ================================== -->

                <div class="tipo-titulo">

                    Você é:

                </div>


                <div class="tipo-usuario">


                    <!-- ALUNO -->

                    <label class="tipo-option">

                        <input
                            type="radio"
                            name="tipo"
                            value="aluno"
                            checked
                            onchange="alterarTipo()">


                        <div class="tipo-box">

                            <i class="bi bi-mortarboard-fill"></i>

                            <span>
                                Aluno
                            </span>

                        </div>

                    </label>



                    <!-- PROFESSOR -->

                    <label class="tipo-option">

                        <input
                            type="radio"
                            name="tipo"
                            value="professor"
                            onchange="alterarTipo()">


                        <div class="tipo-box">

                            <i class="bi bi-person-workspace"></i>

                            <span>
                                Professor
                            </span>

                        </div>

                    </label>


                </div>



                <!-- =================================
                     NOME
                ================================== -->

                <div class="row">


                    <div class="col-md-6 mb-3">

                        <label
                            for="nome"
                            class="form-label">

                            Nome completo

                        </label>


                        <input
                            type="text"
                            class="form-control"
                            id="nome"
                            name="nome"
                            maxlength="100"
                            placeholder="Digite seu nome completo"
                            required>

                    </div>



                    <!-- E-MAIL -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="email"
                            class="form-label">

                            E-mail

                        </label>


                        <input
                            type="email"
                            class="form-control"
                            id="email"
                            name="email"
                            maxlength="150"
                            placeholder="Digite seu e-mail"
                            required>

                    </div>

                </div>



                <!-- MATRÍCULA / SIAPE -->

                <div class="row">


                    <div class="col-md-6 mb-3">

                        <label
                            for="matricula"
                            class="form-label"
                            id="labelMatricula">

                            Matrícula

                        </label>


                        <input
                            type="text"
                            class="form-control"
                            id="matricula"
                            name="matricula"
                            maxlength="30"
                            placeholder="Digite sua matrícula"
                            required>

                    </div>



                    <!-- CURSO -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="curso"
                            class="form-label"
                            id="labelCurso">

                            Curso

                        </label>


                        <select
                            class="form-select"
                            id="curso"
                            name="curso"
                            required>

                            <option value="Informática" selected disabled>
                                Selecione seu curso
                            </option>

                            <option value="Informática">
                                Informática
                            </option>

                            <option value="Biotecnologia">
                                Biotecnologia
                            </option>

                            <option value="Administração">
                                Administração
                            </option>

                            <option value="Enfermagem">
                                Enfermagem
                            </option>

                            <option value="Análises Clínicas">
                                Análises Clínicas
                            </option>

                            <option value="Ciências Biológicas">
                                Ciências Biológicas
                            </option>

                            <option value="Outro">
                                Outro
                            </option>

                        </select>

                        <input
                            type="text"
                            class="form-control mt-2"
                            id="outroCurso"
                            name="outro_curso"
                            placeholder="Informe o curso ou setor"
                            maxlength="100"
                            hidden>

                    </div>

                </div>



                <!-- SENHAS -->

                <div class="row">


                    <!-- SENHA -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="senha"
                            class="form-label">

                            Senha

                        </label>


                        <div class="senha-container">

                            <input
                                type="password"
                                class="form-control"
                                id="senha"
                                name="senha"
                                placeholder="Crie uma senha"
                                minlength="6"
                                required>


                            <button
                                type="button"
                                class="mostrar-senha"
                                onclick="mostrarSenha('senha', 'iconeSenha')">

                                <i
                                    class="bi bi-eye-fill"
                                    id="iconeSenha">
                                </i>

                            </button>

                        </div>

                    </div>



                    <!-- CONFIRMAR SENHA -->

                    <div class="col-md-6 mb-3">

                        <label
                            for="confirmarSenha"
                            class="form-label">

                            Confirmar senha

                        </label>


                        <div class="senha-container">

                            <input
                                type="password"
                                class="form-control"
                                id="confirmarSenha"
                                name="confirmar_senha"
                                placeholder="Repita sua senha"
                                minlength="6"
                                required>


                            <button
                                type="button"
                                class="mostrar-senha"
                                onclick="mostrarSenha('confirmarSenha', 'iconeConfirmar')">

                                <i
                                    class="bi bi-eye-fill"
                                    id="iconeConfirmar">
                                </i>

                            </button>

                        </div>

                    </div>

                </div>



                <!-- TERMOS -->

                <div class="form-check termos">

                    <input
                        class="form-check-input"
                        type="checkbox"
                        id="termos"
                        name="termos"
                        required>


                    <label
                        class="form-check-label"
                        for="termos">

                        Concordo com os
                        <a href="#">
                            termos de uso
                        </a>
                        e a
                        <a href="#">
                            política de privacidade
                        </a>.

                    </label>

                </div>



                <!-- =================================
                     BOTÃO
                ================================== -->

                <button
                    type="submit"
                    class="btn btn-cadastro">

                    <i class="bi bi-person-plus-fill"></i>

                    Criar minha conta

                </button>


            </form>



            <!-- =================================
                 LOGIN
            ================================== -->

            <div class="login-link">

                Já possui uma conta?

                <a href="<?=URL?>/paginas/login">

                    Entrar

                </a>

            </div>


        </div>

    </div>

</section>



<!-- =====================================
     JAVASCRIPT
===================================== -->

<script>


/* MOSTRAR SENHA */

function mostrarSenha(idSenha, idIcone) {

    const senha =
        document.getElementById(idSenha);

    const icone =
        document.getElementById(idIcone);


    if (senha.type === "password") {

        senha.type = "text";

        icone.classList.remove("bi-eye-fill");

        icone.classList.add("bi-eye-slash-fill");

    } else {

        senha.type = "password";

        icone.classList.remove("bi-eye-slash-fill");

        icone.classList.add("bi-eye-fill");

    }

}



/* ALTERAR CAMPOS DE ALUNO / PROFESSOR */

function alterarTipo() {

    const tipo =
        document.querySelector(
            'input[name="tipo"]:checked'
        ).value;


    const labelMatricula =
        document.getElementById("labelMatricula");


    const campoMatricula =
        document.getElementById("matricula");


    const labelCurso =
        document.getElementById("labelCurso");


    const curso =
        document.getElementById("curso");

    const outroCurso = document.getElementById("outroCurso");

    if (tipo === "professor") {

        labelMatricula.innerText = "Matrícula / SIAPE";

        campoMatricula.placeholder =
            "Digite sua matrícula ou SIAPE";


        labelCurso.innerText =
            "Setor / Área";


        curso.innerHTML = `

            <option value="" selected disabled>
                Selecione seu setor
            </option>

            <option value="Informática">
                                Informática
                            </option>

            <option value="Administração">
                                Administração
                            </option>

            <option value="Coordenação">
                                Coordenação
                            </option>

            <option value="Ensino">
                                Ensino
                            </option>

            <option value="Outro">
                                Outro
                            </option>

        `;

    } else {

        labelMatricula.innerText =
            "Matrícula";


        campoMatricula.placeholder =
            "Digite sua matrícula";


        labelCurso.innerText =
            "Curso";


        curso.innerHTML = `

            <option value="" selected disabled>
                Selecione seu curso
            </option>

            <option value="Informática">
                                Informática
                            </option>

            <option value="Administração">
                                Administração
                            </option>

            <option value="Agropecuária">
                                Agropecuária
                            </option>

            <option value="Edificações">
                                Edificações
                            </option>

            <option value="Outro">
                                Outro
                            </option>

        `;

    }

    outroCurso.hidden = true;
    outroCurso.required = false;
    curso.onchange = function () {
        const isOutro = this.value === "Outro";
        outroCurso.hidden = !isOutro;
        outroCurso.required = isOutro;
        outroCurso.placeholder = tipo === "professor" ? "Informe seu setor ou área" : "Informe seu curso";
        if (!isOutro) outroCurso.value = "";
    };
}

document.addEventListener("DOMContentLoaded", alterarTipo);
</script>



<!-- =====================================
     BOOTSTRAP JS
===================================== -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>


</body>

</html>
