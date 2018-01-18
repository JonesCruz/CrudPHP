<?php
require_once "config/conexao.php";
require_once "app/contatos/controller/contatosController.php";

// ISTANCIANDO A CLASSE CONTATOSCONTROLLER
$getContatosController = new ContatosController();

$dados = $getContatosController->listar(null, "id_contato, nome, telefone, email");

//RECEBENDO OS PARAMETROS DO METODO CADASTRAR

$id = isset($_GET['id_contato'])?$_GET['id_contato']:null;
$acao = "cadastrar";
$dados_contatos = array();

//RECEBENDO OS PARAMETROS DO METODO EDITAR

if (isset($_GET['acao']) && $_GET['acao'] == "editar") {
    $acao = "editar";
    $dados_contatos = $getContatosController->listar("WHERE id_contato = '$id'", "nome, telefone, email");
    $dados_contatos = $dados_contatos->fetch_assoc();
}
?>

<h1>Agenda de Contatos</h1>
<br>
<form action="app/contatos/controller/crud.php" method="POST">
    <input type="hidden" name="acao" value="<?= $acao ?>">
    <input type="hidden" name="id_contato" value="<?= $id ?>">
    <label>Nome: </label><br>
    <input type="text" class="form-control" name="nome" placeholder="Informe o nome!" value="<?= isset($dados_contatos['nome'])?$dados_contatos['nome']:null ?>">
    <label>Telefone: </label><br>
    <input type="tel" class="form-control" name="telefone" maxlength="15" placeholder="Informe o numero do telefone!" value="<?= isset($dados_contatos['telefone'])?$dados_contatos['telefone']:null  ?>">
    <label>Email: </label><br>
    <input type="email" class="form-control" name="email" placeholder="Informe um e-mail válido!" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?= isset($dados_contatos['email'])?$dados_contatos['email']:null ?>">
    <br>
    <button type="submit" class="btn btn-success" value="cadastrar">Salvar</button>
</form><br><br>

<table class="table table-striped">
    <thead align="center">
    <tr>
        <th style="text-align: center">Nome</th>
        <th style="text-align: center">Telefone</th>
        <th style="text-align: center">Email</th>
        <th style="text-align: center">Opções</th>
    </tr>
    </thead>
    <tbody>
    <?php

    //LAÇO PARA PRENCHER OS CAMPOS DA TABELA

    while ($values = $dados->fetch_assoc()) {
        ?>
        <tr align="center">
            <td>&nbsp&nbsp<?= $values['nome'] ?>&nbsp&nbsp</td>
            <td>&nbsp&nbsp<?= $values['telefone'] ?>&nbsp&nbsp</td>
            <td>&nbsp&nbsp<?= $values['email'] ?>&nbsp&nbsp</td>
            <td>
                <a href="./?acao=editar&id_contato=<?= $values['id_contato'] ?>" class="btn btn-warning">Editar</a>
                <a href="app/contatos/controller/crud.php?acao=excluir&id_contato=<?= $values['id_contato'] ?>" class="btn btn-danger">Excluir</a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
