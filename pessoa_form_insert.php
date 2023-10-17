<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de cadastro</title>
    <?php
        $id =$nome=$endereco=$email=$bairro=$telefone ='';
        if(!empty($_REQUEST['action'])){
            $conexao= mysqli_connect('localhost','root','','HORUS_TREINO');

            mysqli_select_db($conexao,'HORUS_TREINO');

            if($_REQUEST['action'] == 'edit'){
                $id = (int) $_GET['id'];
                
                $query_select_pessoa="SELECT * FROM Pessoa WHERE Id = '{$id}' ";

                $result_pessoa=mysqli_query($conexao,$query_select_pessoa);
            
                if($linha=mysqli_fetch_array($result_pessoa)){
                    $id=$linha['Id'];
                    $nome=$linha['Nome'];
                    $telefone=$linha['Telefone'];
                    $email=$linha['Email'];
                    $endereco=$linha['Endereco'];
                    $bairro=$linha['Bairro'];
                }
            } 
            else if ($_REQUEST['action'] =='save'){
                $id=$_POST['id'];
                $nome=$_POST['nome'];
                $telefone=$_POST['telefone'];
                $email=$_POST['email'];
                $endereco=$_POST['endereco'];
                $bairro=$_POST['bairro'];
                if(empty($_POST['id'])){
                    $query_increment="SELECT MAX(Id) AS maior_id FROM Pessoa";

                    $retorno_max_id= mysqli_query($conexao,$query_increment);

                    $linha = mysqli_fetch_assoc($retorno_max_id);
                    $maior_id = (int) $linha['maior_id'];

                    $novo_id=$maior_id+1;

                    $query_insert="INSERT INTO Pessoa (Id,Nome, Telefone, Email, Endereco, Bairro) VALUES ('$novo_id','$nome','$telefone','$email','$endereco','$bairro')"; 
                    
                    mysqli_query($conexao,$query_insert);
                }else{

                    $query_save_update="UPDATE Pessoa SET Nome = '{$nome}',
                    Telefone = '{$telefone}',
                    Email = '{$email}',
                    Bairro = '{$bairro}',
                    Endereco = '{$endereco}'
                    WHERE Id = '{$id}';
                    ";

                    $result_pessoa_save=mysqli_query($conexao,$query_save_update);

                }
                echo "<script>
                        alert('Registro inserido com sucesso!');
                    </script>";
                mysqli_close($conexao);
        }
    }
    ?>
</head>
<body style="background-color: LightBlue; align-items: center; display: flex; justify-content: center;">
    
    <form style="background-color: white; border: none; border-radius: 10px; padding: 10px;" action="pessoa_form_insert.php?action=save" method="post">
        <input type="hidden" readonly name="id" value="<?=$id?>">
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

        <input type="submit" value="Enviar">
        <a href="index.php"><button type="button">Voltar</button></a>
    </form>
    <br>
</body>
</html>

