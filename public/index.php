<?php
include "../app/configuracao.php";
include "../app/Libraries/Rota.php";
include "../app/Libraries/Controller.php";
include "../app/Libraries/Database.php";
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= APP_NOME?></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="<?=URL?>/public/css/estilo.css">
    <script src="<?=URL?>/public/js/jquery.funcoes.js"></script>
    <link rel="stylesheet" href="<?=URL?>/public/bootstrap/css/bootstrap.min.css"/>
    <script src="<?=URL?>/public/bootstrap/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        include '../app/views/header.php';
        $rotas = new Rota();
       // $rotas->url();
        include '../app/views/footer.php';

    ?>

    <div vw class="enabled">
    <div vw-access-button class="active">

    </div>
      <div vw-plugin-wrapper>
        <div vw-plugin-top-wrapper>

        </div>
      </div>
  </div>
  <script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
  <script> new window.VLibras.Widget('https://vlibras.gov.br/app');</script>
<!-- Fim do Código do VLibras -->
<!-- -- Permite aumentar ou diminuir o tamanho do texto sem recarregar a página. -->
<script>

    
let tamanhoFonte = 16;
function alterarFonte(delta) {
    tamanhoFonte = Math.min(24, Math.max(12, tamanhoFonte + delta * 2));
    document.documentElement.style.fontSize = tamanhoFonte + 'px';
}
</script>
<screen-reader-only>
    <button onclick="alterarFonte(12)">A+</button>
    <button onclick="alterarFonte(-12)">A-</button>
</body>
</html>
