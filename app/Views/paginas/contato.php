<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contato</title>


    <!-- BOOTSTRAP 5 -->

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

            background-color: #fffef0;

            color: #222;

            min-height: 100vh;
        }


        /* BOTÃO ENTRAR */

        .btn-entrar {
            border: 1px solid #dddddd;

            background-color: #ffffff;

            color: #222222;

            padding: 10px 22px;

            border-radius: 7px;
        }


        .btn-entrar:hover {
            background-color: #f7f7f7;
        }


        /* BOTÃO CADASTRAR */

        .btn-cadastrar {
            background-color: #e7c94f;

            border: none;

            color: #222222;

            font-weight: bold;

            padding: 10px 22px;

            border-radius: 7px;
        }


        .btn-cadastrar:hover {
            background-color: #d5b73b;

            color: #111111;
        }


        /*ÁREA PRINCIPAL*/

        .contato-section {
            min-height: calc(100vh - 80px);

            padding: 60px 0 70px;

            background-color: #fffde7;
        }


        /*TÍTULO */

        .titulo-contato {
            text-align: center;

            margin-bottom: 45px;
        }


        .titulo-contato h1 {
            font-size: 38px;

            font-weight: 700;

            color: #b49416;

            margin-bottom: 10px;
        }


        .titulo-contato h1 span {
            color: #b49416;
        }


        .titulo-contato p {
            font-size: 16px;

            color: #666666;

            margin: 0;
        }


        /* =========================================
           CARTÃO PRINCIPAL
        ========================================= */

        .contato-card {
            background-color: #ffffff;

            border-radius: 12px;

            border: 1px solid #eee4a8;

            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);

            overflow: hidden;
        }


        /* =========================================
           LADO DAS INFORMAÇÕES
        ========================================= */

        .informacoes {
            background-color: #f5ed9a;

            padding: 45px 35px;

            height: 100%;
        }


        .informacoes h2 {
            font-size: 25px;

            font-weight: bold;

            color: #222222;

            margin-bottom: 15px;
        }


        .informacoes > p {
            color: #555555;

            font-size: 15px;

            line-height: 1.6;

            margin-bottom: 35px;
        }


        /* ITEM DE INFORMAÇÃO */

        .info-item {
            display: flex;

            align-items: center;

            gap: 15px;

            margin-bottom: 25px;
        }


        .info-icon {
            width: 45px;

            height: 45px;

            background-color: #ffffff;

            border-radius: 50%;

            display: flex;

            align-items: center;

            justify-content: center;

            flex-shrink: 0;
        }


        .info-icon i {
            color: #b4961d;

            font-size: 20px;
        }


        .info-item h3 {
            font-size: 15px;

            font-weight: bold;

            margin: 0 0 3px;

            color: #222222;
        }


        .info-item p {
            font-size: 13px;

            color: #555555;

            margin: 0;
        }


        /* =========================================
           FORMULÁRIO
        ========================================= */

        .formulario {
            padding: 45px 40px;
        }


        .formulario h2 {
            font-size: 25px;

            font-weight: bold;

            color: #222222;

            margin-bottom: 25px;
        }


        /* LABEL */

        .form-label {
            font-size: 14px;

            font-weight: bold;

            color: #333333;

            margin-bottom: 8px;
        }


        /* INPUTS */

        .form-control {
            border: 1px solid #dcdcdc;

            border-radius: 7px;

            padding: 12px 14px;

            font-size: 14px;

            box-shadow: none;
        }


        .form-control:focus {
            border-color: #dfc443;

            box-shadow: 0 0 0 0.2rem rgba(231, 201, 79, 0.25);
        }


        textarea.form-control {
            resize: none;

            min-height: 150px;
        }


        /* =========================================
           BOTÃO ENVIAR
        ========================================= */

        .btn-enviar {
            background-color: #e7c94f;

            color: #222222;

            border: none;

            width: 100%;

            padding: 13px;

            border-radius: 7px;

            font-size: 16px;

            font-weight: bold;

            transition: 0.2s;
        }


        .btn-enviar:hover {
            background-color: #d5b73b;

            color: #111111;

            transform: translateY(-1px);
        }


        .btn-enviar i {
            margin-right: 7px;
        }


        /* =========================================
           MENSAGEM DE SUCESSO
        ========================================= */

        .mensagem-sucesso {
            display: none;

            margin-top: 20px;

            padding: 12px;

            border-radius: 7px;

            background-color: #e1f3df;

            color: #347438;

            font-size: 14px;

            text-align: center;
        }

        /* =========================================
           RESPONSIVIDADE
        ========================================= */

        @media (max-width: 991px) {

            .navbar-nav {
                gap: 5px;

                margin-top: 15px;
            }


            .botoes-menu {
                margin-top: 15px;
            }

        }


        @media (max-width: 768px) {

            .contato-section {
                padding: 40px 15px;
            }


            .titulo-contato h1 {
                font-size: 30px;
            }


            .informacoes {
                padding: 35px 25px;
            }


            .formulario {
                padding: 35px 25px;
            }

        }


        @media (max-width: 576px) {

            .titulo-contato h1 {
                font-size: 27px;
            }


            .titulo-contato p {
                font-size: 14px;
            }

        }

    </style>

</head>


<body>

<!-- =========================================
     CONTATO
========================================= -->

<section class="contato-section">


    <div class="container">


        <!-- TÍTULO -->

        <div class="titulo-contato">

            <h1>

                Entre em <span>contato</span>

            </h1>

            <p>

                Tem alguma dúvida, sugestão ou precisa de ajuda?
                Fale conosco!

            </p>

        </div>



        <!-- CARD -->

        <div class="contato-card">

            <div class="row g-0">


                <!-- INFORMAÇÕES -->

                <div class="col-lg-5">

                    <div class="informacoes">


                        <h2>
                            Fale conosco
                        </h2>


                        <p>

                            Estamos aqui para ajudar você.
                            Envie sua mensagem e nossa equipe
                            entrará em contato.

                        </p>



                        <!-- EMAIL -->

                        <div class="info-item">

                            <div class="info-icon">

                                <i class="bi bi-envelope-fill"></i>

                            </div>


                            <div>

                                <h3>
                                    E-mail
                                </h3>

                                <p>
                                    achou@ifro.edu.br
                                </p>

                            </div>

                        </div>



                        <!-- TELEFONE -->

                        <div class="info-item">

                            <div class="info-icon">

                                <i class="bi bi-telephone-fill"></i>

                            </div>


                            <div>

                                <h3>
                                    Telefone
                                </h3>

                                <p>
                                    (69) 0000-0000
                                </p>

                            </div>

                        </div>



                        <!-- LOCAL -->

                        <div class="info-item">

                            <div class="info-icon">

                                <i class="bi bi-geo-alt-fill"></i>

                            </div>


                            <div>

                                <h3>
                                    Localização
                                </h3>

                                <p>
                                    Instituto Federal de Rondônia
                                </p>

                            </div>

                        </div>



                        <!-- HORÁRIO -->

                        <div class="info-item">

                            <div class="info-icon">

                                <i class="bi bi-clock-fill"></i>

                            </div>


                            <div>

                                <h3>
                                    Atendimento
                                </h3>

                                <p>
                                    Segunda a sexta-feira
                                </p>

                            </div>

                        </div>


                    </div>

                </div>



                <!-- =================================
                     FORMULÁRIO
                ================================== -->

                <div class="col-lg-7">

                    <div class="formulario">


                        <h2>
                            Envie uma mensagem
                        </h2>


                        <form
                            action="<?=URL?>/paginas/contato"
                            method="POST"
                            onsubmit="enviarMensagem(event)">


                            <!-- NOME -->

                            <div class="mb-3">

                                <label
                                    for="nome"
                                    class="form-label">

                                    Nome

                                </label>


                                <input
                                    type="text"
                                    class="form-control"
                                    id="nome"
                                    name="nome"
                                    placeholder="Digite seu nome"
                                    required>

                            </div>



                            <!-- EMAIL -->

                            <div class="mb-3">

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
                                    placeholder="Digite seu e-mail"
                                    required>

                            </div>



                            <!-- ASSUNTO -->

                            <div class="mb-3">

                                <label
                                    for="assunto"
                                    class="form-label">

                                    Assunto

                                </label>


                                <input
                                    type="text"
                                    class="form-control"
                                    id="assunto"
                                    name="assunto"
                                    placeholder="Digite o assunto"
                                    required>

                            </div>



                            <!-- MENSAGEM -->

                            <div class="mb-4">

                                <label
                                    for="mensagem"
                                    class="form-label">

                                    Mensagem

                                </label>


                                <textarea
                                    class="form-control"
                                    id="mensagem"
                                    name="mensagem"
                                    placeholder="Digite sua mensagem..."
                                    required></textarea>

                            </div>



                            <!-- BOTÃO -->

                            <button
                                type="submit"
                                class="btn btn-enviar">

                                <i class="bi bi-send-fill"></i>

                                Enviar mensagem

                            </button>


                        </form>



                        <!-- MENSAGEM -->

                        <div
                            id="mensagemSucesso"
                            class="mensagem-sucesso">

                            <i class="bi bi-check-circle-fill"></i>

                            Mensagem enviada com sucesso!

                        </div>


                    </div>

                </div>


            </div>

        </div>

    </div>

</section>

<!-- =========================================
     BOOTSTRAP JAVASCRIPT
========================================= -->

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js">
</script>



<!-- =========================================
     FUNÇÃO DO FORMULÁRIO
========================================= -->

<script>

function enviarMensagem(event) {

    event.preventDefault();

    const nome = document.getElementById("nome").value;

    const email = document.getElementById("email").value;

    const mensagem = document.getElementById("mensagem").value;


    if (nome === "" || email === "" || mensagem === "") {

        alert("Preencha todos os campos!");

        return;

    }


    document.getElementById("mensagemSucesso").style.display = "block";


    document.querySelector("form").reset();

}

</script>


</body>

</html>
