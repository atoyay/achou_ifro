<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>como funciona</title>

    <style>

        * { /* Configurações gerais da página */
            margin: 0; /* Remove as margens padrão */
            padding: 0; /* Remove os espaços internos padrão */
            box-sizing: border-box; /* Facilita o cálculo dos tamanhos */
            font-family: Arial, sans-serif; /* Define a fonte do texto */
        }

        body { /* Configura o corpo da página */
            background: #ffffff; /* Define o fundo branco */
            color: #17251e; /* Define a cor dos textos */
        }

    /* BANNER */

        .banner { /* Configura a parte principal do banner */
            background: #ffee8c; /* Define o fundo amarelo-claro */
            color: black; /* Define a cor do texto */
            text-align: center; /* Centraliza os textos */
            padding: 45px 20px; /* Adiciona espaço interno */
        }

        .banner h1 { /* Configura o título do banner */
            font-size: 38px; /* Define o tamanho do título */
            margin-bottom: 12px; /* Adiciona espaço abaixo do título */
        }

        .banner p { /* Configura o parágrafo do banner */
            font-size: 16px; /* Define o tamanho da letra */
        }

    /* COMO FUNCIONA */

        .passos { /* Organiza os quatro passos na página */
            width: 85%; /* Define a largura em 85% da tela */
            margin: 45px auto; /* Centraliza e adiciona espaço externo */
            display: grid; /* Ativa o sistema de grade */
            grid-template-columns: repeat(4, 1fr); /* Cria quatro colunas iguais */
            gap: 35px; /* Define o espaço entre as colunas */
        }

        .passo { /* Configura cada etapa */
            text-align: center; /* Centraliza o conteúdo */
            position: relative; /* Permite posicionar elementos em relação a ele */
        }

        .numero {/* Configura os números dos passos */
            width: 45px; /* Define a largura */
            height: 45px; /* Define a altura */
            margin: 0 auto 18px; /* Centraliza e adiciona espaço abaixo */
            border-radius: 50%; /* Deixa o formato redondo */
            background: #ddc566; /* Define o fundo amarelo */
            color: black; /* Define a cor do número */
            display: flex; /* Ativa o Flexbox */
            justify-content: center; /* Centraliza na horizontal */
            align-items: center; /* Centraliza na vertical */
            font-size: 20px; /* Define o tamanho do número */
            font-weight: bold; /* Deixa o número em negrito */
        }

        .imagem { /* Configura o espaço das imagens */
            width: 100%; /* Ocupa toda a largura disponível */
            height: 170px; /* Define a altura */
            background: #f1f7f2; /* Define o fundo verde-claro */
            border-radius: 10px; /* Arredonda os cantos */
            display: flex; /* Ativa o Flexbox */
            align-items: center; /* Centraliza na vertical */
            justify-content: center; /* Centraliza na horizontal */
            font-size: 70px; /* Define o tamanho do ícone */
            margin-bottom: 20px; /* Adiciona espaço abaixo */
        }

        .passo h2 { /* Configura os títulos de cada passo */
            font-size: 19px; /* Define o tamanho do título */
            color: #111; /* Define a cor preta */
            margin-bottom: 12px; /* Adiciona espaço abaixo */
        }

        .passo p { /* Configura os textos de cada passo */
            color: #555; /* Define a cor cinza */
            line-height: 1.6; /* Aumenta o espaço entre as linhas */
            font-size: 14px; /* Define o tamanho da letra */
        }

    /* SEGURANÇA */

        .seguranca { /* Configura a caixa de segurança */
            width: 70%; /* Define a largura da caixa */
            margin: 20px auto 45px; /* Centraliza e define os espaços externos */
            padding: 25px; /* Adiciona espaço interno */
            background: #f0f7f1; /* Define o fundo verde-claro */
            border-radius: 10px; /* Arredonda os cantos */
            display: flex; /* Coloca os elementos lado a lado */
            align-items: center; /* Alinha os elementos verticalmente */
            justify-content: center; /* Centraliza os elementos */
            gap: 20px; /* Define o espaço entre os elementos */
        }

        .seguranca-icon { /* Configura o ícone de segurança */
            font-size: 55px; /* Define o tamanho do ícone */
            color: #075c35; /* Define a cor verde-escura */
        }

        .seguranca h2 { /* Configura o título da segurança */
            color: #075c35; /* Define a cor verde-escura */
            margin-bottom: 8px; /* Adiciona espaço abaixo do título */
            font-size: 20px; /* Define o tamanho da letra */
        }

        .seguranca p { /* Configura o parágrafo da segurança */
            color: #333; /* Define a cor cinza-escura */
            font-size: 14px; /* Define o tamanho da letra */
            line-height: 1.6; /* Define o espaçamento entre as linhas */
        }

    /* RESPONSIVO */

        @media (max-width: 1000px) { /* Adapta o site para telas de até 1000 pixels */

    header {
        padding: 15px 3%; /* Ajusta o espaço interno do cabeçalho */
    }

    nav {
        gap: 15px; /* Diminui o espaço entre os links */
    }

    .passos {
        width: 90%; /* Aumenta a largura da área dos passos */
        grid-template-columns: repeat(2, 1fr); /* Organiza em duas colunas */
    }

    .seguranca {
        width: 90%; /* Aumenta a largura da caixa de segurança */
    }

}

</style>

<!-- ================= BANNER ================= -->

<section class="banner">

    <h1>
        Como funciona o Achou IFRO
    </h1>

    <p>
        Veja como é simples usar a plataforma Achados e Perdidos.
    </p>

</section>


<!-- ================= PASSOS ================= -->

<section class="passos">


    <!-- PASSO 1 -->

    <div class="passo">

        <div class="numero">
            1
        </div>

        <div class="imagem">
            💻
        </div>

        <h2>
            Procurar ou anunciar
        </h2>

        <p>
            Use a busca para encontrar algo que perdeu
            ou cadastre um objeto que você encontrou.
        </p>

    </div>


    <!-- PASSO 2 -->

    <div class="passo">

        <div class="numero">
            2
        </div>

        <div class="imagem">
            📢
        </div>

        <h2>
            Publicamos para ajudar
        </h2>

        <p>
            Seu anúncio será publicado em nossa
            plataforma para que mais pessoas possam ver.
        </p>

    </div>


    <!-- PASSO 3 -->

    <div class="passo">

        <div class="numero">
            3
        </div>

        <div class="imagem">
            💬
        </div>

        <h2>
            Entramos em contato
        </h2>

        <p>
            Quando houver um possível duvida ou sugestão,
            vocês poderão conversar pelo sistema
            com segurança.
        </p>

    </div>


    <!-- PASSO 4 -->

    <div class="passo">

        <div class="numero">
            4
        </div>

        <div class="imagem">
            🎁
        </div>

        <h2>
            Devolução
        </h2>

        <p>
            Combinem a devolução de forma segura
            e juntos fazemos a diferença!
        </p>

    </div>

</section>


<!-- ================= SEGURANÇA ================= -->

<section class="seguranca">

    <div class="seguranca-icon">
        🛡️
    </div>

    <div>

        <h2>
            Segurança em primeiro lugar
        </h2>

        <p>
            Não compartilhamos seus dados pessoais
            com terceiros.
            <br>
            Toda comunicação acontece dentro da plataforma.
        </p>

    </div>

</section>

</body>

</html>
