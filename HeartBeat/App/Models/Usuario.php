<?php

namespace App\Models;

class Usuario
{

    private static $table = "usuarios";

    public static function insert($data)
    {

        $connPDO = new \PDO(DBDRIVE . ':host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = 'INSERT INTO ' . self::$table . ' VALUES(0,:nome, :sobrenome, :email, :senha)';
        $stmt = $connPDO->prepare($sql);
        $stmt->bindValue(":nome", $data['nome']);
        $stmt->bindValue(":sobrenome", $data['sobrenome']);
        $stmt->bindValue(":email", $data['email']);
        $stmt->bindValue(":senha", sha1($data['senha']));
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "<div class='text-success'><i class='bi bi-check-circle-fill'></i> Cadastrado com sucesso!</div>";
        } else {
            return "<div class='text-danger'><i class='bi bi-x-circle-fill'></i>  Email já cadastrado.</div>";
        }
        $connPDO = null;
    }
    
    // public static function select(){
    //     session_start();
    //     $id= $_SESSION["id_usuario"];
    //     $connPDO = new \PDO(DBDRIVE . ':host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);
    //     $sql = "SELECT * FROM usuarios WHERE id_usuario = $id";
    //     $stmt= $connPDO->query($sql);
    //     $dados = $stmt->fetch(\PDO::FETCH_OBJ);
    //     return $dados;
    // }

    // public static function update($data){
    //     $connPDO = new \PDO(DBDRIVE . ':host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);

    //     session_start();
    //     $id = $_SESSION['id_usuario'];
    //     $sql = "UPDATE usuarios SET nome = :nome, sobrenome = :sobrenome WHERE id_usuario = :id";
    //     $stmt = $connPDO->prepare($sql);
    //     $stmt->bindValue(":nome", $data['nome']);
    //     $stmt->bindValue(":sobrenome", $data['sobrenome']);
    //     $stmt->bindValue(":id", $id);
    //     $stmt->execute();
        
    //     if($stmt->rowCount() > 0){
    //         return "Atualizado com sucesso!";
    //     }else{
    //         return "Algo deu errado";
    //     }
    // }
}
