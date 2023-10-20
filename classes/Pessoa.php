<?php

    class Pessoa{

        private static $conn;

        public static function getConnection(){

            if (empty(self::$conn)){

                $banco = parse_ini_file('config/config.ini');
                $host = $banco['host'];
                $name = $banco['name'];
                $user = $banco['user'];
                $pass = $banco['pass'];

                self::$conn = new PDO("mysql:dbname={$name};user={$user};password={$pass};host={$host}");
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            return self::$conn;
        }

        public static function save($pessoa){
            $conn = self::getConnection();

            if(empty($pessoa['id'])){
                $result= $conn->query("SELECT MAX(id) AS maior_id FROM Pessoa");
                $linha = $result->fetch();
                $pessoa['id'] = (int) $linha['maior_id'] +1; //incremento do maximo id já existente
                $sql = "INSERT INTO Pessoa (id, nome, telefone, email, endereco, bairro) VALUES (:id, :nome, :telefone, :email, :endereco, :bairro)";
            }
            else {
                $sql = "UPDATE Pessoa SET nome = :nome,
                telefone = :telefone,
                email = :email,
                bairro = :bairro,
                endereco = :endereco
                WHERE id = :id;
                ";
            }
            $result = $conn->prepare($sql);
            $result->execute([':id' => $pessoa['id'],
                              ':nome' => $pessoa['nome'],
                              ':telefone' => $pessoa['telefone'],
                              ':email' => $pessoa['email'],
                              ':endereco' => $pessoa['endereco'],
                              ':bairro' => $pessoa['bairro']
            ]);
            
            return $pessoa['id'];
        }
        
        public static function find($id){
            $conn = self::getConnection();

            $sql = "SELECT * FROM Pessoa WHERE id = :id";
            
            $result = $conn->prepare($sql);
            $result->execute([':id' => $id]);

            return $result->fetch();
        }

        public static function delete($id){
            $conn=self::getConnection();

            $sql="DELETE FROM Pessoa WHERE id =:id";
            $result=$conn->prepare($sql);
            $result->execute([':id' => $id]);

            //return $result;
        } 
    
        public static function all(){
            $conn=self::getConnection();
            $result= $conn->query("SELECT * FROM Pessoa ORDER BY id");

            return $result->fetchAll();
        }

    }
