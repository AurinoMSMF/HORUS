<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FORM</title>
</head>

<?php
    $id=$_GET['id'];

    if(!empty($id)){

        $conexao= mysqli_connect('localhost','root','','HORUS_TREINO');

        mysqli_select_db($conexao,'HORUS_TREINO');

        $id =(int) $id;

        $query_select_pessoa="SELECT * FROM Pessoa WHERE Id = '{$id}' ";

        $result_pessoa=mysqli_query($conexao,$query_select_pessoa);

        $linha=mysqli_fetch_array($result_pessoa);

        $id=$linha['Id'];
        $nome=$linha['Nome'];
        $telefone=$linha['Telefone'];
        $email=$linha['Email'];
        $endereco=$linha['Endereco'];
        $bairro=$linha['Bairro'];

    }

?>

<body>
    
    <form action="pessoa_save_update.php" method="post">
        <p>ID:</p>
        <input readonly="1" name="id" type="text" value="<?=$id?>">
        <p>Nome:</p>
        <input placeholder="Nome" type="text" name="nome" value="<?=$nome?>">
        <br>
        <p>Telefone:</p>
        <input placeholder="(XX) 9XXXX-XXXX" type="text" name="telefone" value="<?=$telefone?>">
        <br>
        <p>E-mail:</p>
        <input placeholder="example@email.com" type="text" name="email" value="<?=$email?>">
        <p>Bairro:</p>
        <input placeholder="Bairro" type="text" name="bairro" value="<?=$bairro?>">
        <p>Endereço:</p>
        <input placeholder="Rua Teste, nº XXX" type="text" name="endereco" value="<?=$endereco?>">
        <br>
        <br>

        <input type="submit" value="Concluir">

    </form>

</body>
</html>

