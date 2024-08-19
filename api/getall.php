<?php
require('../config.php');

// pegando qual tipo de método
$method = strtolower($_SERVER['REQUEST_METHOD']);

// inicando a verificação do metodo e pegando os dados do banco
if( $method === 'get' ) {

    $sql = $pdo->query("SELECT * FROM notes");
    if($sql->rowCount() > 0){
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);

        // pegando todos os valores de registro no banco
        foreach($data as $item){
            $array['result'][] = [
                'id' => $item['id'],
                'title' => $item['title'],
                'body' => $item['body']
            ];
        }
    }
} 
else{
    $array['error'] = 'Método não permitido (apenas GET)';
}

require('../return.php');