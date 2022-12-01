<?php

namespace App\Models;

class Agenda
{

    private static $table = "agendas";

    public static function insert($data)
    {

        $connPDO = new \PDO(DBDRIVE . ':host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);
        session_start();
        $id = $_SESSION["id_usuario"];
        $sql = 'INSERT INTO ' . self::$table . ' VALUES(:id_profissional,:nome, :dataNascimento, :dataConsulta, false, :cns)';
        $stmt = $connPDO->prepare($sql);
        $stmt->bindValue(":id_profissional", $data['idProfissional']);
        $stmt->bindValue(":nome", $data['nomePaciente']);
        $stmt->bindValue(":dataNascimento", $data['dataNascimentoPaciente']);
        $stmt->bindValue(":dataConsulta", $data['dataConsulta']);
        $stmt->bindValue(":cns", $data['cns']);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "<div class='text-success'><i class='bi bi-check-circle-fill'></i> Cadastrado com sucesso!</div>";
        } else {
            return "<div class='text-danger'><i class='bi bi-x-circle-fill'></i>  Falha ao realizar cadastrado.</div>";
        }
        $connPDO = null;
    }

    public static function select()
    {
        session_start();
        $connPDO = new \PDO(DBDRIVE . ':host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);
        $sql = "SELECT * FROM agendas WHERE id_profissional = {$_GET['id_profissional']}";
        $stmt = $connPDO->query($sql);
        $dados = $stmt->fetchAll(\PDO::FETCH_OBJ);
        return $dados;
    }

    public static function update($data)
    {
        $connPDO = new \PDO(DBDRIVE . ':host=' . DBHOST . ';dbname=' . DBNAME, DBUSER, DBPASS);

        session_start();
        $id = $_SESSION['id_usuario'];
        $sql = "UPDATE usuarios SET nome = :nome, sobrenome = :sobrenome WHERE id_usuario = :id";
        $stmt = $connPDO->prepare($sql);
        $stmt->bindValue(":nome", $data['nome']);
        $stmt->bindValue(":sobrenome", $data['sobrenome']);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return "Atualizado com sucesso!";
        } else {
            return "Algo deu errado";
        }
    }
}
