<?php
require('../config.php');

// pegando qual tipo de método
$method = strtolower($_SERVER['REQUEST_METHOD']);

// inicando a verificação do metodo e pegando os dados do banco
if( $method === 'post' ) {

    // pegando os itens 
    $title = filter_input(INPUT_POST, 'title');
    $body = filter_input(INPUT_POST, 'body');

    // verificando se ambos estão preenchidos
    if($title && $body){

        $sql = $pdo->prepare("INSERT INTO notes (title, body) VALUES (:title, :body)");
        $sql->bindValue(':title', $title);
        $sql->bindValue(':body', $body);
        $sql->execute();

        // criando o objeto inteiro de retorno de dados
        $id = $pdo->lastInsertId();

        $array['result'] = [
            'id' => $id,
            'title' => $title,
            'body' => $body
        ];
    }
    else{
        $array['error'] = 'Algum dos campos não foram preenchidos';
    }

} 
else{
    $array['error'] = 'Método não permitido (apenas POST)';
}

require('../return.php');