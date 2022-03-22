<?php
include 'validador.php';

$mensagemEnviada = @$_GET['submit'];

if ($mensagemEnviada) {
    $host = @$_ENV['db_host'] ?? 'localhost';
    $user = @$_ENV['db_user'] ?? 'app';
    $pass = @$_ENV['db_pass'] ?? 'z&Y2pyUvys4fIAy*r$AFgbPnZSD';
    $name = @$_ENV['db_name'] ?? 'db_sua_empresa';

    $nome = @$_GET['nome'];
    $telefone = @$_GET['telefone'];
    $mensagem = @$_GET['mensagem'];

    $validateData = validateName($nome)
        && validatePhoneNumber($telefone)
        && validateText($mensagem);

    $funcionou = $validateData;

    if ($validateData) {
        $conexaoDb = new Mysqli($host,  $user, $pass, $name);
        $sql = "INSERT INTO tb_mensagens(nome, telefone, mensagem) VALUES (?, ?, ?)";
        $stmt = $conexaoDb->prepare($sql);
        $stmt->bind_param('sss', $nome, $telefone, $mensagem);

        //Testando se tudo ocorreu bem
        $funcionou = $stmt->execute();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
    <title>Contato</title>
</head>

<body>
    <?php if ($mensagemEnviada) : ?>
        <script>
            alert('A mensagem <?= $funcionou ? '' : 'não ' ?>foi enviada.');
            window.location.replace('/form.php');
        </script>
    <?php endif; ?>
    <form action="/form.php" method="get" class="formulario">
        <div class="input-area">
            <h1 class="titulo-formulario">Contate-nos</h1>
            <div class="item-form">
                <label for="nome" class="descricao">Nome: </label>
                <input type="text" id="nome" name="nome" class="inputs" placeholder="Seu primeiro e segundo nome">
            </div>

            <div class="item-form">
                <label for="telefone" class="descricao">Telefone:</label>
                <input type="tel" id="telefone" name="telefone" class="inputs" placeholder="O numero deve ser assim:(00) 00000-0000" maxlength="15" pattern="\([0-9]{2}\) [0-9]{4,6}-[0-9]{3,4}$">
            </div>

            <div class="item-form">
                <label for="mensagem" class="descricao">Mensagem:</label>
                <textarea name="mensagem" class="mensagem" id="mensagem" cols="30" rows="10" placeholder="Oque gostaria de nos falar?"></textarea>
            </div>
        </div>

        <input type="submit" class="submit" name="submit" value="Enviar mensagem">

    </form>
</body>

</html>