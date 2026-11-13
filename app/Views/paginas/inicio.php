<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Achou.IFRO - Achados & Perdidos</title>

    <!-- BOOTSTRAP CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->
    <link rel="stylesheet"
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
            background-color: #ffffff;
            color: #171717;
        }

        a {
            text-decoration: none;
        }

        /* MENU */

        .navbar-nav {
            gap: 25px;
        }

        .navbar-nav .nav-link {
            color: #222222;
            font-weight: 500;
            padding: 10px 5px;
        }

        .navbar-nav .nav-link:hover {
            color: #d4a900;
        }

        .navbar-nav .nav-link.active {
            color: #c49a00;
            font-weight: bold;
        }


        /* BOTÕES */

        .btn-entrar {
            border: 1px solid #dddddd;
            background-color: white;
            color: #222222;
            padding: 10px 22px;
            border-radius: 7px;
        }

        .btn-entrar:hover {
            background-color: #f7f7f7;
        }

        .btn-cadastrar {
            background-color: #f2c400;
            color: #111111;
            font-weight: bold;
            padding: 10px 22px;
            border-radius: 7px;
            border: none;
        }

        .btn-cadastrar:hover {
            background-color: #dcae00;
            color: #000000;
        }


        /*BANNER DO INICIO*/

        .hero {
            background-color: #ffee8c;
            min-height: 390px;

            position: relative;
            overflow: hidden;
        }

        .hero-conteudo {
            min-height: 390px;

            display: flex;
            align-items: center;
        }

        .hero h1 {
            color: #111111;
            font-size: 40px;
            font-weight: 700;
            line-height: 1.25;
        }

        .hero p {
            color: #222222;
            font-size: 17px;
            line-height: 1.6;
            margin-top: 15px;
        }


        /*BARRA DE PESQUISA*/

        .busca {
            background-color: white;
            border-radius: 8px;

            padding: 7px;

            display: flex;
            align-items: center;

            max-width: 750px;

            box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        }

        .busca .form-control {
            border: none;
            box-shadow: none;
        }

        .busca .input-group-text {
            background-color: white;
            border: none;
            color: #777777;
        }

        .btn-buscar {
            background-color: #111111;
            color: white;

            border: none;

            padding: 12px 25px;

            border-radius: 6px;

            font-weight: bold;
        }

        .btn-buscar:hover {
            background-color: #333333;
            color: white;
        }


        /*CAIXA ILUSTRATIVA*/

        .caixa-container {
            display: flex;
            justify-content: center;
            align-items: center;

            height: 100%;
        }

        .caixa {
            width: 300px;
            height: 175px;

            background-color: #c98c3c;

            position: relative;

            border-radius: 5px;

            box-shadow: 0 15px 25px rgba(0,0,0,0.20);

            display: flex;
            justify-content: center;
            align-items: center;
        }

        .objetos {
            position: absolute;

            top: -75px;

            font-size: 55px;

            white-space: nowrap;
        }

        .texto-caixa {
            font-size: 21px;
            font-weight: bold;

            color: #171717;

            text-align: center;
        }


        /*CATEGORIAS*/

        .categorias {
            padding: 30px 0 20px;
        }

        .titulo-secao {
            color: #171717;
            font-size: 23px;
            font-weight: bold;
            text-align: center;

            margin-bottom: 25px;
        }

        .categoria {
            height: 105px;

            background-color: white;

            border: 1px solid #e4e4e4;

            border-radius: 9px;

            display: flex;
            flex-direction: column;

            align-items: center;
            justify-content: center;

            gap: 9px;

            transition: 0.2s;

            cursor: pointer;

            box-shadow: 0 2px 7px rgba(0,0,0,0.05);
        }

        .categoria:hover {
            transform: translateY(-4px);

            border-color: #f2c400;

            box-shadow: 0 5px 15px rgba(0,0,0,0.10);
        }

        .categoria i {
            font-size: 28px;
            color: #d0a600;
        }

        .categoria span {
            font-size: 13px;
            color: #222222;
            font-weight: 500;
        }


        /*ANÚNCIOS*/

        .anuncios {
            padding: 15px 0 60px;
        }

        .titulo-anuncios {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 18px;
        }

        .titulo-anuncios h2 {
            font-size: 22px;
            color: #171717;
            font-weight: bold;
        }

        .ver-todos {
            color: #9b7a00;
            font-weight: bold;
            text-decoration: underline;
        }


        /* ==============================
           CARDS
        ============================== */

        .card {
            border: 1px solid #e2e2e2;

            border-radius: 8px;

            overflow: hidden;

            box-shadow: 0 2px 8px rgba(0,0,0,0.06);

            transition: 0.2s;

            height: 100%;
        }

        .card:hover {
            transform: translateY(-4px);

            box-shadow: 0 7px 18px rgba(0,0,0,0.12);

            border-color: #f2c400;
        }

        .card-img-top {
            height: 150px;

            object-fit: cover;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 17px;
            font-weight: bold;
            color: #171717;
        }

        .card-text {
            color: #777777;
            font-size: 13px;
            margin-bottom: 8px;
        }

        .card-text i {
            margin-right: 5px;
        }


        /* ==============================
           BADGES
        ============================== */

        .badge-encontrado {
            background-color: #dff3df;
            color: #31733b;

            font-size: 11px;

            padding: 7px 10px;

            border-radius: 5px;
        }

        .badge-perdido {
            background-color: #f8dddd;
            color: #a33737;

            font-size: 11px;

            padding: 7px 10px;

            border-radius: 5px;
        }


        /*RESPONSIVIDADE*/

        @media (max-width: 992px) {

            .navbar-nav {
                gap: 5px;
            }

            .hero h1 {
                font-size: 32px;
            }

            .caixa-container {
                display: none;
            }

        }


        @media (max-width: 768px) {

            .hero {
                padding: 40px 0;
            }

            .hero-conteudo {
                min-height: auto;
            }

            .hero h1 {
                font-size: 30px;
            }

            .hero p {
                font-size: 15px;
            }

            .busca {
                flex-direction: column;
                align-items: stretch;

                padding: 10px;
            }

            .busca .input-group {
                margin-bottom: 5px;
            }

            .btn-buscar {
                width: 100%;
            }

            .titulo-anuncios {
                align-items: flex-start;
            }

        }


        @media (max-width: 576px) {

            .logo {
                font-size: 18px;
            }

            .logo i {
                font-size: 27px;
            }

            .hero h1 {
                font-size: 27px;
            }

            .categoria {
                height: 95px;
            }

        }

    </style>

</head>


<body>

<!-- ==================================================
     BANNER
================================================== -->

<section class="hero">

    <div class="container">

        <div class="row hero-conteudo align-items-center">


            <!-- TEXTO -->

            <div class="col-lg-7">

                <h1>

                    Perdeu algo?<br>

                    A gente ajuda você a encontrar.

                </h1>


                <p>

                    Encontre objetos perdidos ou cadastre algo
                    que você encontrou.

                    <br>

                    Juntos, podemos devolver o que é de alguém.

                </p>


                <!-- BUSCA -->

                <div class="busca">


                    <!-- CAMPO OBJETO -->

                    <div class="input-group">

                        <span class="input-group-text">

                            <i class="bi bi-search"></i>

                        </span>

                        <input
                            type="text"
                            class="form-control"
                            placeholder="O que você perdeu?">

                    </div>


                    <!-- CAMPO LOCAL -->

                    <div class="input-group">

                        <span class="input-group-text">

                        </span>

                    </div>


                    <button class="btn-buscar">

                        <i class="bi bi-search"></i>

                        Buscar

                    </button>

                </div>

            </div>



            <!-- ILUSTRAÇÃO -->

            <div class="col-lg-5">

                <div class="caixa-container">

                    <div class="caixa">

                        <div class="objetos">

                            🧸 📱 🔑

                        </div>

                        <div class="texto-caixa">

                            ACHOU<br>

                            IFRO

                        </div>

                    </div>

                </div>

            </div>


        </div>

    </div>

</section>



<!-- ==================================================
     CATEGORIAS
================================================== -->

<section class="categorias">

    <div class="container">

        <h2 class="titulo-secao">

            O que você está procurando?

        </h2>


</section>



<!-- ANÚNCIOS RECENTES -->

<section class="anuncios">

    <div class="container">


        <div class="titulo-anuncios">

            <h2>

                Anúncios recentes

            </h2>

            <a href="#" class="">

            </a>

        </div>



        <div class="row g-4">


            <!-- ================= CARD 1 ================= -->

            <div class="col-md-6 col-lg-3">

                <div class="card">

                    <div class="position-relative">

                        <img
                            src="https://images.unsplash.com/photo-1627123424574-724758594e93?auto=format&fit=crop&w=600&q=80"
                            class="card-img-top"
                            alt="Carteira preta">


                        <span class="badge-encontrado position-absolute top-0 start-0 m-3">

                            Encontrado

                        </span>

                    </div>


                    <div class="card-body">

                        <h3 class="card-title">

                            Carteira preta

                        </h3>


                        <p class="card-text">

                            <i class="bi bi-geo-alt"></i>

                            Guajará-Mirim - IFRO

                        </p>


                        <p class="card-text">

                            <i class="bi bi-calendar"></i>

                            12/05/2025

                        </p>

                    </div>

                </div>

            </div>



            <!-- ================= CARD 2 ================= -->

            <div class="col-md-6 col-lg-3">

                <div class="card">

                    <div class="position-relative">

                        <img
                            src="https://images.unsplash.com/photo-1582139329536-e7284fece509?auto=format&fit=crop&w=600&q=80"
                            class="card-img-top"
                            alt="Chaves">


                        <span class="badge-encontrado position-absolute top-0 start-0 m-3">

                            Encontrado

                        </span>

                    </div>


                    <div class="card-body">

                        <h3 class="card-title">

                            Chaves com chaveiro

                        </h3>


                        <p class="card-text">

                            <i class="bi bi-geo-alt"></i>

                            Guajará-Mirim - IFRO

                        </p>


                        <p class="card-text">

                            <i class="bi bi-calendar"></i>

                            11/06/2026

                        </p>

                    </div>

                </div>

            </div>



            <!-- ================= CARD 3 ================= -->

            <div class="col-md-6 col-lg-3">

                <div class="card">

                    <div class="position-relative">

                        <img
                            src="https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?auto=format&fit=crop&w=600&q=80"
                            class="card-img-top"
                            alt="Smartphone Samsung">


                        <span class="badge-perdido position-absolute top-0 start-0 m-3">

                            Perdido

                        </span>

                    </div>


                    <div class="card-body">

                        <h3 class="card-title">

                            Smartphone Samsung

                        </h3>


                        <p class="card-text">

                            <i class="bi bi-geo-alt"></i>

                            Guajará-Mirim - IFRO

                        </p>


                        <p class="card-text">

                            <i class="bi bi-calendar"></i>

                            10/07/2026

                        </p>

                    </div>

                </div>

            </div>



            <!-- ================= CARD 4 ================= -->

            <div class="col-md-6 col-lg-3">

                <div class="card">

                    <div class="position-relative">

                        <img
                            src="https://images.unsplash.com/photo-1553062407-98eeb64c6a62?auto=format&fit=crop&w=600&q=80"
                            class="card-img-top"
                            alt="Mochila preta">


                        <span class="badge-encontrado position-absolute top-0 start-0 m-3">

                            Encontrado

                        </span>

                    </div>


                    <div class="card-body">

                        <h3 class="card-title">

                            Mochila preta

                        </h3>


                        <p class="card-text">

                            <i class="bi bi-geo-alt"></i>

                            Paulista, São Paulo - SP

                        </p>


                        <p class="card-text">

                            <i class="bi bi-calendar"></i>

                            09/09/2026

                        </p>

                    </div>

                </div>

            </div>


        </div>

    </div>

</section>



<!-- BOOTSTRAP JS -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
