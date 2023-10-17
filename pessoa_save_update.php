<?php

    $dados=$_POST;

    if(!empty($dados['id'])){
        $conexao= mysqli_connect('localhost','root','','HORUS_TREINO');

        mysqli_select_db($conexao,'HORUS_TREINO');

        $query_save_update="UPDATE Pessoa SET Nome = '{$dados['nome']}',
        Telefone = '{$dados['telefone']}',
        Email = '{$dados['email']}',
        Bairro = '{$dados['bairro']}',
        Endereco = '{$dados['endereco']}'
        WHERE Id = '{$dados['id']}';
        ";

        $result_pessoa_save=mysqli_query($conexao,$query_save_update);
        header('Location: .\index.php');
    }

    