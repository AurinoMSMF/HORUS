<?php

        $conexao= mysqli_connect('localhost','root','','HORUS_TREINO');

        mysqli_select_db($conexao,'HORUS_TREINO');

        if(!empty($_GET['action']) AND $_GET['action']=="delete"){

            $id = (int) $_GET['id'];
            $result=mysqli_query($conexao,"DELETE FROM Pessoa WHERE Id ='{$id}'");

        }

        $query_list="SELECT * FROM Pessoa ORDER BY Id";

        $list_pessoas=mysqli_query($conexao,$query_list);

        $items='';

        while ($linha = mysqli_fetch_assoc($list_pessoas)) {
            $item = file_get_contents('./html/item.html');
            $item = str_replace('{id}', $linha['Id'], $item);
            $item = str_replace('{nome}', $linha['Nome'], $item);
            $item = str_replace('{telefone}', $linha['Telefone'], $item);
            $item = str_replace('{email}', $linha['Email'], $item);
            $item = str_replace('{endereco}', $linha['Endereco'], $item);
            $item = str_replace('{bairro}', $linha['Bairro'], $item);
            $items.= $item;
        }

        $list = file_get_contents('./html/list.html');
        $list = str_replace('{items}', $items, $list);
        print $list;

?>