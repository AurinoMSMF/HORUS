<?php

        require_once('./classes/Pessoa.php');
        if(!empty($_REQUEST['action'])){
            try{
                if($_REQUEST['action'] == 'edit'){
                    $id = (int) $_GET['id'];
                    $pessoa =  Pessoa::find($id);
                    //Direto do banco
                } 
                else if ($_REQUEST['action'] =='save'){
                    $pessoa=$_POST; //Vindo do POST do formulário.
                    Pessoa::save($pessoa);
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
            $pessoa['id']='';
            $pessoa['nome'] ='';
            $pessoa['endereco']= '';
            $pessoa['email'] = '';
            $pessoa['telefone'] = '';
            $pessoa['bairro'] = '';
        }

        $form = file_get_contents('html/form.html');
        $form = str_replace('{id}', $pessoa['id'], $form);
        $form = str_replace('{nome}', $pessoa['nome'], $form);
        $form = str_replace('{endereco}', $pessoa['endereco'], $form);
        $form = str_replace('{bairro}', $pessoa['bairro'], $form);
        $form = str_replace('{telefone}', $pessoa['telefone'], $form);
        $form = str_replace('{email}', $pessoa['endereco'], $form);
        print $form;
?>
