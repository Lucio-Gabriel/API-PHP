<?php
require('../config.php');

// pegando qual tipo de método
$method = strtolower($_SERVER['REQUEST_METHOD']);



// inicando a verificação do metodo e pegando os dados do banco
if( $method === 'put' ) {

    // função para pegar métodos além de GET e POST
    parse_str(file_get_contents('php://input'), $input);
    
    // preenchendo em uma váriavel & verificando
    $id = $input['id'] ?? null;
    $title = $input['title'] ?? null;
    $body = $input['body'] ?? null;

    // usando filter var para limpar/garantir processos de segurança
    $id = filter_var($id);
    $title = filter_var($title);
    $body = filter_var($body);

    // verificando se eles existem
    if($id && $title && $body){

        // verificando se o ID existe
        $sql = $pdo->prepare("SELECT * FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();

        // verificando se teve algum resultado
        if($sql->rowCount() > 0){

            $sql = $pdo->prepare("UPDATE notes SET title = :title, body = :body WHERE id  = :id");
            $sql->bindValue(':id', $id);
            $sql->bindValue(':title', $title);
            $sql->bindValue(':body', $body);
            $sql->execute();

            // retornando o objeto final atualizado
            $array['result'] = [
                'id' => $id,
                'title' => $title,
                'bodyy' => $body
            ];

        } else{
            $array['error'] = 'ID inexistente';
        }

    }else
    {
        $array['error'] = 'Dados não enviados';
    }

} 
else{
    $array['error'] = 'Método não permitido (apenas PUT)';
}

require('../return.php');