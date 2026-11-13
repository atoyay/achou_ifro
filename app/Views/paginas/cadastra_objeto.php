<?php
require_once __DIR__ . '/conexao.php';

$mensagem = '';
$tipoMensagem = 'danger';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $tipo = trim($_POST['tipo'] ?? '');
    $nome = trim($_POST['nome'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $cor = trim($_POST['cor'] ?? '');
    $descricao = trim($_POST['descricao'] ?? '');
    $local = trim($_POST['local'] ?? '');
    $data = trim($_POST['data'] ?? '');
    $horario = trim($_POST['horario'] ?? '');

    $foto = null;

    try {

        // Verifica o tipo do anúncio
        if (!in_array($tipo, ['perdido', 'encontrado'], true)) {
            throw new RuntimeException('Selecione se o objeto foi perdido ou encontrado.');
        }

        // Verifica os campos obrigatórios
        if (
            $nome === '' ||
            $categoria === '' ||
            $descricao === '' ||
            $local === '' ||
            $data === '' ||
            $horario === ''
        ) {
            throw new RuntimeException('Preencha todos os campos obrigatórios.');
        }

        // Verifica o tamanho dos campos
        if (
            mb_strlen($nome) > 100 ||
            mb_strlen($categoria) > 50 ||
            mb_strlen($cor) > 50 ||
            mb_strlen($local) > 200
        ) {
            throw new RuntimeException('Um ou mais campos excedem o tamanho permitido.');
        }

        // Verifica a data
        $dataObjeto = DateTime::createFromFormat('Y-m-d', $data);

        if (!$dataObjeto || $dataObjeto->format('Y-m-d') !== $data) {
            throw new RuntimeException('Informe uma data válida.');
        }

        // Verifica o horário
        if (!preg_match('/^(?:[01]\d|2[0-3]):[0-5]\d$/', $horario)) {
            throw new RuntimeException('Informe um horário válido.');
        }

        // Verifica a descrição
        if (mb_strlen($descricao) > 2000) {
            throw new RuntimeException('A descrição deve ter no máximo 2000 caracteres.');
        }

        // Verifica se foi enviada uma foto
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] !== UPLOAD_ERR_NO_FILE) {

            if ($_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
                throw new RuntimeException('Erro ao enviar a foto.');
            }

            if ($_FILES['foto']['size'] > 5 * 1024 * 1024) {
                throw new RuntimeException('A foto deve ter no máximo 5 MB.');
            }

            $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'webp'];

            $extensao = strtolower(
                pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION)
            );

            if (!in_array($extensao, $extensoesPermitidas, true)) {
                throw new RuntimeException('Formato de foto não permitido.');
            }

            $tipoArquivo = mime_content_type($_FILES['foto']['tmp_name']);

            $tiposPermitidos = [
                'image/jpeg',
                'image/png',
                'image/webp'
            ];

            if (!in_array($tipoArquivo, $tiposPermitidos, true)) {
                throw new RuntimeException('O arquivo enviado não é uma imagem válida.');
            }

            // Cria a pasta de imagens, caso não exista
            $pasta = __DIR__ . '/uploads/objetos/';

            if (!is_dir($pasta) && !mkdir($pasta, 0755, true)) {
                throw new RuntimeException('Não foi possível criar a pasta de imagens.');
            }

            // Gera um nome seguro para a imagem
            $nomeFoto = bin2hex(random_bytes(16)) . '.' . $extensao;

            $destino = $pasta . $nomeFoto;

            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $destino)) {
                throw new RuntimeException('Não foi possível salvar a foto.');
            }

            $foto = 'uploads/objetos/' . $nomeFoto;
        }

        // Recupera o usuário que está logado
        if (!isset($_SESSION['usuario_id'])) {
            throw new RuntimeException('Faça login para cadastrar um objeto.');
        }

        $usuarioId = (int) $_SESSION['usuario_id'];

        $pdo->beginTransaction();

        // Insere o objeto no banco de dados
        $insereObjeto = $pdo->prepare(
            'INSERT INTO objetos
            (
                usuario_id,
                tipo,
                nome,
                categoria,
                cor,
                descricao,
                local_encontrado,
                data_encontrado,
                horario,
                foto
            )
            VALUES
            (
                :usuario_id,
                :tipo,
                :nome,
                :categoria,
                :cor,
                :descricao,
                :local,
                :data,
                :horario,
                :foto
            )'
        );

        $insereObjeto->execute([
            'usuario_id' => $usuarioId,
            'tipo' => $tipo,
            'nome' => $nome,
            'categoria' => $categoria,
            'cor' => $cor !== '' ? $cor : null,
            'descricao' => $descricao,
            'local' => $local,
            'data' => $data,
            'horario' => $horario,
            'foto' => $foto
        ]);

        $pdo->commit();

        $mensagem = 'Objeto cadastrado com sucesso!';
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

        error_log('Falha ao cadastrar objeto: ' . $e->getMessage());

        $mensagem = 'Não foi possível cadastrar o objeto. Verifique os dados e tente novamente.';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>cadastre o objeto</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, Helvetica, sans-serif;
        }

        body {
            background: #f5ec9e;
            color: #17251e;
        }

        
        /* CONTEÚDO */

        .container {
            width: 120%;
            margin: 40px auto;
        }

        .titulo h1 {
            color: #0f0f0f;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .titulo p {
            color: #0f0f0f;
            margin-bottom: 30px;
        }

        .conteudo {
            display: center;
            grid-template-columns: 2fr 0.75fr;
            gap: 25px;
        }

        /* FORMULÁRIO */

        .formulario {
            border: 1px solid #e5e5e5;
            border-radius: 8px;
            padding: 20px;
            background: #fffcfc;
        }

        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .obrigatorio {
            color: #e33;
        }

        .tipo {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .tipo label {
            width: 50%;
            border: 1px solid #fffbfb;
            border-radius: 6px;
            padding: 14px;
            text-align: center;
            cursor: pointer;
            font-weight: bold;
        }

        .tipo input {
            display: none;
        }

        .tipo input:checked + label {
            border: 2px solid #e1c13c;
            background: #f9fffb;
            color: #e1c13c;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 13px;
            border: 1px solid #f5f5f5;
            border-radius: 5px;
            outline: none;
            font-size: 14px;
            margin-bottom: 18px;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: #e1c13c;
        }

        textarea {
            height: 110px;
            resize: none;
        }

        .linha {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .upload {
            border: 1px dashed #f7ebbb;
            border-radius: 6px;
            padding: 35px;
            text-align: center;
            margin-bottom: 8px;
            cursor: pointer;
        }

        .upload:hover {
            background: #ffffff;
        }

        .upload-icon {
            font-size: 32px;
            color: #ffec7d;
            margin-bottom: 10px;
        }

        .upload strong {
            display: block;
            margin-bottom: 6px;
        }

        .upload small {
            color: #777;
        }

        .quantidade {
            font-size: 12px;
            color: #666;
            margin-bottom: 18px;
        }

        .acoes {
            display: flex;
            gap: 15px;
        }

        .cancelar {
            width: 35%;
            padding: 14px;
            background: white;
            border: 1px solid #ffec7d;
            border-radius: 5px;
            color: #ff0000;
            font-weight: bold;
            cursor: pointer;
        }

        .publicar {
            width: 65%;
            padding: 14px;
            background: #f9ff8f;
            border: none;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }

        .publicar:hover {
            background: #afbe0a;
        }

        /* MENSAGEM */

        .mensagem {
            padding: 15px;
            margin-bottom: 20px;
            background: #e7f5eb;
            color: #075c35;
            border-radius: 6px;
            font-weight: bold;
        }

        /* RODAPÉ */

        footer {
            background: white;
            color: white;
            margin-top: 50px;
            padding: 40px 7% 20px;
        }

        .footer-conteudo {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr 1.5fr;
            gap: 50px;
        }

        footer h3 {
            margin-bottom: 15px;
        }

        footer p,
        footer a {
            color: #ddd;
            font-size: 13px;
            text-decoration: none;
            display: block;
            margin-bottom: 10px;
        }

        .social {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social span {
            width: 30px;
            height: 30px;
            border: 1px solid white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .copyright {
            text-align: center;
            margin-top: 30px;
            padding-top: 18px;
            font-size: 12px;
            color: #ddd;
        }

        /* RESPONSIVO */

        @media (max-width: 1000px) {

            header {
                padding: 20px;
            }

            nav {
                gap: 15px;
            }

            .container {
                width: 94%;
            }

            .conteudo {
                grid-template-columns: 1fr;
            }

            .lateral {
                display: grid;
                grid-template-columns: 1fr 1fr;
            }

        }

    </style>
</head>

<body>

<main class="container">

    <div class="titulo">

        <h1>Cadastre o objeto</h1>

        <p>
            Preencha as informações para ajudar a encontrar o dono.
        </p>

    </div>


    <?php if (!empty($mensagem)): ?>

        <div class="mensagem">
            <?= htmlspecialchars($mensagem) ?>
        </div>

    <?php endif; ?>


    <div class="conteudo">


        <!-- FORMULÁRIO -->

        <form method="POST"
              enctype="multipart/form-data"
              class="formulario">


            <label>
                Tipo de anúncio
                <span class="obrigatorio">*</span>
            </label>


            <div class="tipo">

                <input
                    type="radio"
                    name="tipo"
                    id="encontrei"
                    value="Encontrei"
                    checked
                >

                <label for="encontrei">
                    🔍 &nbsp; Encontrei
                </label>


                <input
                    type="radio"
                    name="tipo"
                    id="perdi"
                    value="Perdi"
                >

                <label for="perdi">
                    ‼️ &nbsp; Perdi
                </label>

            </div>


            <label for="nome">
                Nome do objeto
                <span class="obrigatorio">*</span>
            </label>

            <input
                type="text"
                id="nome"
                name="nome"
                placeholder="Ex.: Carteira preta, Celular Samsung, Chaves..."
                required
            >


            <div class="linha">

                <div>

                    <label for="categoria">
                        Categoria
                        <span class="obrigatorio">*</span>
                    </label>

                    <select
                        id="categoria"
                        name="categoria"
                        required
                    >

                        <option value="">
                            Selecione uma categoria
                        </option>

                        <option value="Eletrônicos">
                            Eletrônicos
                        </option>

                        <option value="Documentos">
                            Documentos
                        </option>

                        <option value="Chaves">
                            Chaves
                        </option>

                        <option value="Carteiras">
                            Carteiras
                        </option>

                        <option value="Roupas">
                            Roupas
                        </option>

                        <option value="Materiais escolares">
                            Materiais escolares
                        </option>

                        <option value="Outros">
                            Outros
                        </option>

                    </select>

                </div>


                <div>

                    <label for="cor">
                        Cor
                    </label>

                    <input
                        type="text"
                        id="cor"
                        name="cor"
                        placeholder="Ex.: Preto, Azul, Marrom..."
                    >

                </div>

            </div>


            <label for="descricao">
                Descrição
                <span class="obrigatorio">*</span>
            </label>

            <textarea
                id="descricao"
                name="descricao"
                placeholder="Descreva o objeto com o máximo de detalhes possíveis..."
                required
            ></textarea>


            <label for="local">
                Local onde foi encontrado/perdido
                <span class="obrigatorio">*</span>
            </label>

            <input
                type="text"
                id="local"
                name="local"
                placeholder="Ex.: IFRO Campus Guajará-Mirim"
                required
            >


            <div class="linha">

                <div>

                    <label for="data">
                        Data
                        <span class="obrigatorio">*</span>
                    </label>

                    <input
                        type="date"
                        id="data"
                        name="data"
                        required
                    >

                </div>


                <div>

                    <label for="horario">
                        Horário (aprox.)
                    </label>

                    <input
                        type="time"
                        id="horario"
                        name="horario"
                    >

                </div>

            </div>


            <label>
                Fotos do objeto
            </label>


            <div class="upload">

                <div class="upload-icon">
                    ☁️
                </div>

                <strong>
                    Clique ou arraste as imagens para enviar
                </strong>

                <small>
                    PNG, JPG ou JPEG (máx. 5MB cada)
                </small>

                <br><br>

                <input
                    type="file"
                    name="fotos[]"
                    accept="image/png,image/jpeg"
                    multiple
                >

            </div>


            <div class="quantidade">
                Você pode enviar até 5 fotos.
            </div>


            <div class="acoes">

                <button
                    type="reset"
                    class="cancelar"
                >
                    Cancelar
                </button>

                <button
                    type="submit"
                    class="publicar"
                >
                    Publicar
                </button>

            </div>

        </form>

    </div>

</main>

</body>

</html>
