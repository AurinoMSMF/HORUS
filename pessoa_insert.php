<?php

    $nome=$_POST['nome'];
    $telefone=$_POST['telefone'];
    $email=$_POST['email'];
    $endereco=$_POST['endereco'];
    $bairro=$_POST['bairro'];

    $conexao= mysqli_connect('localhost','root','','HORUS_TREINO');

    mysqli_select_db($conexao,'HORUS_TREINO');

    if (!$conexao) {
        die('Erro ao conectar ao banco de dados: ' . mysqli_connect_error());
    }

    $query_increment="SELECT MAX(Id) AS maior_id FROM Pessoa";

    $retorno_max_id= mysqli_query($conexao,$query_increment);

    if ($retorno_max_id) {
        $linha = mysqli_fetch_assoc($retorno_max_id);
        $maior_id = (int) $linha['maior_id'];
    }
    else{
        echo "Erro na consulta" . mysqli_error($conexao);
    }

    $novo_id=$maior_id+1;

    $query_insert="INSERT INTO Pessoa (Id,Nome, Telefone, Email, Endereco, Bairro) VALUES ('$novo_id','$nome','$telefone','$email','$endereco','$bairro')";

    echo "<script>
        alert('Registro inserido com sucesso!');
        window.location.href='index.php';
    </script>";

    mysqli_query($conexao,$query_insert);

    mysqli_close($conexao);