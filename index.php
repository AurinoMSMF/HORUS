<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista Pessoas</title>
</head>
<body style="background-color: LightBlue; align-itens: center; display: flex; justify-itens: center; border-radius: 10px;">
    <a style="margin-left: 500px;" href="pessoa_form_insert.php"><button>NOVO</button></a>
    <?php
        $conexao= mysqli_connect('localhost','root','','HORUS_TREINO');

        mysqli_select_db($conexao,'HORUS_TREINO');

        if(!empty($_GET['action']) AND $_GET['action']=="delete"){

            $id = (int) $_GET['id'];
            $result=mysqli_query($conexao,"DELETE FROM Pessoa WHERE Id ='{$id}'");

        }


        $query_list="SELECT * FROM Pessoa ORDER BY Id";

        $list_pessoas=mysqli_query($conexao,$query_list);

        print "<table border=1; style='background-color: white;>";
        print "<thead style='background-color: white;'>";
        print "<tr>";
        print "<th></th>";
        print "<th></th>";
        print "<th> ID </th>";
        print "<th> Nome </th>";
        print "<th> Telefone </th>";
        print "<th> E-mail </th>";
        print "<th> Endereço </th>";
        print "<th> Bairro </th>";
        print "<tr>";
        print "</thead>";
        print "<tbody>";

        while ($linha= mysqli_fetch_array($list_pessoas)){
            $id=$linha['Id'];
            $nome=$linha['Nome'];
            $telefone=$linha['Telefone'];
            $email=$linha['Email'];
            $endereco=$linha['Endereco'];
            $bairro=$linha['Bairro'];

        print "<tr>";

        print "<td align='center'>
            <a href='pessoa_form_insert.php?action=edit&id={$id}'>
            <img src='.\components\image_edit.png' style='width:25px'>
            </a></td>";
        
        print "<td align='center'>
            <a href='index.php?action=delete&id={$id}'>
            <img src='.\components\image_remove.png' style='width:25px'>
            </a></td>";

        print "<td>{$id}</td>";
        print "<td>{$nome}</td>";
        print "<td>{$telefone}</td>";
        print "<td>{$email}</td>";
        print "<td>{$endereco}</td>";
        print "<td>{$bairro}</td>";
        
        print "</tr>";

        }

        print "</tbody>";
        print "</table>";

        mysqli_close($conexao);

    ?>

</body> 
</html>

    