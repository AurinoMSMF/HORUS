<?php
    function lista_pessoa($id){

        $conexao = mysqli_connect("localhost","root","","HORUS_TREINO");

        mysqli_select_db($conexao,'HORUS_TREINO');

        $query_list="SELECT * FROM Pessoa ORDER BY Id";

        $list_pessoas=mysqli_query($conexao,$query_list);

    }