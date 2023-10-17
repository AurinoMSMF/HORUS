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
        else{
            $_POST = [];
            $_POST['id'] = '';
            $_POST['nome'] = '';
            $_POST['endereco'] = '';
            $_POST['bairro'] = '';
            $_POST['telefone'] = '';
            $_POST['email'] = '';
        }

        $form = file_get_contents('html/form.html');
        $form = str_replace('{id}', $id, $form);
        $form = str_replace('{nome}', $nome, $form);
        $form = str_replace('{endereco}', $endereco, $form);
        $form = str_replace('{bairro}', $bairro, $form);
        $form = str_replace('{telefone}', $telefone, $form);
        $form = str_replace('{email}', $email, $form);
        print $form;
    ?>
