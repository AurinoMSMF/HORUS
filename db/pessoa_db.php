<?php
    function lista_pessoas(){ //FUNCIONANDO

        $conexao = mysqli_connect("localhost","root","","HORUS_TREINO");

        mysqli_select_db($conexao,'HORUS_TREINO');

        $query_list="SELECT * FROM Pessoa ORDER BY Id";

        $list_pessoas=mysqli_query($conexao,$query_list);

        $list=[];

        while($pessoa=mysqli_fetch_assoc($list_pessoas)){
            array_push($list,$pessoa);
        };

        mysqli_close($conexao);
        return $list;
    }

    function exclui_pessoa($id){ //FUNCIONANDO
        $conexao= mysqli_connect('localhost','root','','HORUS_TREINO');

        mysqli_select_db($conexao,'HORUS_TREINO');

        $query_delete_pessoa="DELETE FROM Pessoa WHERE Id ='{$id}'";

        $result=mysqli_query($conexao,$query_delete_pessoa);
        
        mysqli_close($conexao);
        return $result;
    }

    function get_pessoa($id){
        $conexao= mysqli_connect('localhost','root','','HORUS_TREINO');

        mysqli_select_db($conexao,'HORUS_TREINO');
        
        $query_select_pessoa="SELECT * FROM Pessoa WHERE Id = '{$id}' ";

        $result=mysqli_query($conexao,$query_select_pessoa);

        $pessoa=mysqli_fetch_assoc($result);

        mysqli_close($conexao);

        return $pessoa;
    }

    function get_next_pessoa(){
        $conexao= mysqli_connect('localhost','root','','HORUS_TREINO');

        mysqli_select_db($conexao,'HORUS_TREINO');

        $query_increment="SELECT MAX(Id) AS maior_id FROM Pessoa";

        $retorno_max_id= mysqli_query($conexao,$query_increment);

        $linha = mysqli_fetch_assoc($retorno_max_id);

        $maior_id = (int) $linha['maior_id'];

        $novo_id=$maior_id+1;

        mysqli_close($conexao);

        return $novo_id;
    }

    function insert_pessoa($pessoa){
        $conexao= mysqli_connect('localhost','root','','HORUS_TREINO');

        mysqli_select_db($conexao,'HORUS_TREINO');

        $query_insert="INSERT INTO Pessoa (Id,Nome, Telefone, Email, Endereco, Bairro) VALUES ('{$pessoa['id']}','{$pessoa['nome']}','{$pessoa['telefone']}','{$pessoa['email']}','{$pessoa['endereco']}','{$pessoa['bairro']}')"; 
                    
        $result=mysqli_query($conexao,$query_insert);

        mysqli_close($conexao);

        return $result;
    }

    function update_pessoa($pessoa){
        $conexao= mysqli_connect('localhost','root','','HORUS_TREINO');

        mysqli_select_db($conexao,'HORUS_TREINO');

        $query_save_update="UPDATE Pessoa SET Nome = '{$pessoa['nome']}',
                    Telefone = '{$pessoa['telefone']}',
                    Email = '{$pessoa['email']}',
                    Bairro = '{$pessoa['bairro']}',
                    Endereco = '{$pessoa['endereco']}'
                    WHERE Id = '{$pessoa['id']}';
                    ";

        $result=mysqli_query($conexao,$query_save_update);

        mysqli_close($conexao);

        return $result;
    }
