<?php
require('../config.php');

// pegando qual tipo de método
$method = strtolower($_SERVER['REQUEST_METHOD']);



// inicando a verificação do metodo e pegando os dados do banco
if( $method === 'get' ) {

    // quais dados vou receber
    $id = filter_input(INPUT_GET, 'id');

    if($id){
        // se o ID for enviado - se existe - se existe
        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        // verificando se teve algum resultado 
        if($sql->rowCount() > 0){

            $data = $sql->fetch(PDO::FETCH_ASSOC);

            $array['result'] = [
                'id' => $data['id'],
                'title' => $data['title'],
                'body' => $data['body']
            ];

        }
        else{
            $array['error'] = 'ID inexistente';
        }
    }
    else {
        $array['error'] = 'ID não enviado';
    }
} 
else{
    $array['error'] = 'Método não permitido (apenas GET)';
}

require('../return.php');