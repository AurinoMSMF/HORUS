    <?php

        require_once('./classes/Pessoa.php');
        if(!empty($_REQUEST['action'])){
            try{
                if($_REQUEST['action'] == 'edit'){
                    $id = (int) $_GET['id'];
                    $pessoa =  Pessoa::find($id);
                    //Direto do banco
                    $id=$pessoa['Id'];
                    $nome=$pessoa['Nome'];
                    $endereco=$pessoa['Endereco'];
                    $email=$pessoa['Email'];
                    $telefone=$pessoa['Telefone'];
                    $bairro=$pessoa['Bairro'];
                } 
                else if ($_REQUEST['action'] =='save'){
                    $pessoa=$_POST; //Vindo do POST do formulário. (Notar letras minusculas em relação as chaves vindas do banco)
                    Pessoa::save($pessoa);
                    $id=$_POST['id'];
                    $nome=$_POST['nome'];
                    $telefone=$_POST['telefone'];
                    $email=$_POST['email'];
                    $endereco=$_POST['endereco'];
                    $bairro=$_POST['bairro'];

                    echo "<script>
                            alert('Registro inserido com sucesso!');
                        </script>";
                }
            }
            catch(Exception $e){
                print $e->getMessage();
            }
        }
        else{
            $id = '';
            $nome = '';
            $endereco = '';
            $bairro = '';
            $telefone = '';
            $email = '';
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
