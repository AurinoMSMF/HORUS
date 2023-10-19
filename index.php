<?php

        require_once('./classes/Pessoa.php');
        try{
            if(!empty($_GET['action']) AND $_GET['action']=="delete"){
                $id = (int) $_GET['id'];
                Pessoa::delete($id);

            }
            $pessoas = Pessoa::all();
        }
        catch(Exception $e){
            print $e->getMessage();
        }

        $items='';

        if($pessoas){
            foreach ($pessoas as $pessoa){
                $item = file_get_contents('./html/item.html');
                $item = str_replace('{id}', $pessoa['Id'], $item);
                $item = str_replace('{nome}', $pessoa['Nome'], $item);
                $item = str_replace('{telefone}', $pessoa['Telefone'], $item);
                $item = str_replace('{email}', $pessoa['Email'], $item);
                $item = str_replace('{endereco}', $pessoa['Endereco'], $item);
                $item = str_replace('{bairro}', $pessoa['Bairro'], $item);
                $items.= $item;
            }
        }

        $list = file_get_contents('./html/list.html');
        $list = str_replace('{items}', $items, $list);
        print $list;

?>