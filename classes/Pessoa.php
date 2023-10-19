<?php

    class Pessoa{

        public static function save($pessoa){
            $conexao= new PDO("mysql:host=127.0.0.1;dbname=HORUS_TREINO",'root','');
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if(empty($pessoa['id'])){
                $result= $conexao->query("SELECT MAX(Id) AS maior_id FROM Pessoa");
                $linha = $result->fetch();
                $maior_id = (int) $linha['maior_id'] +1; //incremento do maximo id já existente
                $sql = "INSERT INTO Pessoa (Id,Nome, Telefone, Email, Endereco, Bairro) VALUES ('{$maior_id}','{$pessoa['nome']}','{$pessoa['telefone']}','{$pessoa['email']}','{$pessoa['endereco']}','{$pessoa['bairro']}')";
            }
            else {
                $sql = "UPDATE Pessoa SET Nome = '{$pessoa['nome']}',
                Telefone = '{$pessoa['telefone']}',
                Email = '{$pessoa['email']}',
                Bairro = '{$pessoa['bairro']}',
                Endereco = '{$pessoa['endereco']}'
                WHERE Id = '{$pessoa['id']}';
                ";
            }

            return $conexao->query($sql);
        }
        
        public static function find($id){
            $conexao= new PDO("mysql:host=127.0.0.1;dbname=HORUS_TREINO",'root','');
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result=$conexao->query("SELECT * FROM Pessoa WHERE Id = '{$id}'");

            return $result->fetch();
        }

        public static function delete($id){
            $conexao= new PDO("mysql:host=127.0.0.1;dbname=HORUS_TREINO",'root','');
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result=$conexao->query("DELETE FROM Pessoa WHERE Id ='{$id}'");

            return $result;
        } 
    
        public static function all(){
            $conexao= new PDO("mysql:host=127.0.0.1;dbname=HORUS_TREINO",'root','');
            $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $result= $conexao->query("SELECT * FROM Pessoa ORDER BY Id");

            return $result->fetchAll();
        }

    }
