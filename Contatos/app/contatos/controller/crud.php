<?php
if (!file_exists('../../../config/conexao.php') || !file_exists('contatosController.php'))
    exit;

require_once "../../../config/conexao.php";
require_once "contatosController.php";

$getContatosController = new ContatosController();

$acao = $_REQUEST['acao'];
$id = $_REQUEST['id_contato'];
$dados = $_REQUEST;

//LAÇO PARA COMPARAR A AÇÃO SOLICITADA

switch ($acao) {
    case 'cadastrar':
        $getContatosController->cadastrar($dados);
        header('location:../../../');
        break;
    case 'editar':
        $getContatosController->editar($dados, $id);
        header('location:../../../');
        break;
    case 'excluir':
        $getContatosController->excluir($id);
        header('location:../../../');//
        break;
}