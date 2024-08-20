<?php
require('../config.php');

// pegando qual tipo de método
$method = strtolower($_SERVER['REQUEST_METHOD']);

// inicando a verificação do metodo e pegando os dados do banco
if( $method === 'delete' ) {

    // função para pegar métodos além de GET e POST
    parse_str(file_get_contents('php://input'), $input);
    
    // preenchendo em uma váriavel & verificando
    $id = $input['id'] ?? null;
    

    // usando filter var para limpar/garantir processos de segurança
    $id = filter_var($id);
   

    // processo de deletar
    if($id){

        $sql = $pdo->prepare("DELETE FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

    }
    else
    {
        $array['error'] = 'ID não enviado';
    }

} 
else{
    $array['error'] = 'Método não permitido (apenas DELETE)';
}

require('../return.php');