<?php

namespace App\Models;

class Login
{
    public static function logar($data)
    {
        $connPDO = new \PDO(DBDRIVE . ':host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);

        $SQL = "SELECT * FROM usuarios WHERE email = :email AND senha = :senha";
        $verificar = $connPDO->prepare($SQL);
        $verificar->bindValue(":email", $data['loginemail']);
        $verificar->bindValue(":senha", sha1($data['loginsenha']));
        $verificar->execute();
        session_start();
        return sha1($data['loginsenha']);
        $_SESSION["login"] = 0;

        if ($verificar->rowCount() === 1) {
            $usuario = $verificar->fetch(\PDO::FETCH_OBJ);
            $_SESSION["id_usuario"] = $usuario->id_usuario;
            $_SESSION["nome"] = $usuario->nome;
            $_SESSION["login"] = 1;
            return $_SESSION;
        } else {
            $_SESSION["login"] = 0;
            return "<div class='text-danger'><i class='bi bi-x-circle-fill'></i> E-mail ou senha incorreto(s). </div> ";
        }
    }

    public static function verificaLogin()
    {
        session_start();
        if (empty($_SESSION['id_usuario'])) {
            return $_SESSION;
        } else {
            $_SESSION['mensagem'] = "Bem vindo, " . $_SESSION['nome'] . '!';
            return $_SESSION;
        }
    }
}
