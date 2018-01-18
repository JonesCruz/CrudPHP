<?php


class ContatosController extends Conexao
{
    //MÉTODO DE CADASTRO

    public function cadastrar(array $dados)
    {


        $conn = $this->conn();
        $sql = 'INSERT INTO contatos(nome, telefone, email) VALUES (?, ?,?)';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $dados['nome'], $dados['telefone'], $dados['email']);
        $stmt->execute();
        return true;
    }

    //MÉTODO DE EDIÇÃO

    public function editar(array $dados, $id)
    {

        $conn = $this->conn();
        $sql = 'UPDATE contatos SET nome = ?, telefone = ?, email = ? WHERE id_contato= ?';
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $dados['nome'], $dados['telefone'], $dados['email'], $id);
        $stmt->execute();
        return true;
    }

    //MÉTODO DE EXCLUSÃO

    public function excluir($id)
    {

        $conn = $this->conn();
        $sql = "DELETE FROM contatos WHERE id_contato = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return true;
    }

    //MÉTODO DE LISTAGEM

    public function listar($param = null, $campos = "*")
    {
        $conn = $this->conn();
        $sql = "SELECT $campos FROM contatos $param";
        $stmt = $conn->query($sql);
        return $stmt;
    }

}