<?php

// permitindo sites requistar nossa api
header("Access-Control-Allow-Origin: *");

// permitindo o PUT e DELETE
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

// avisando que o retorno sempre vai ser um JSON
header("Content-Type: application/json");

echo json_encode($array);
exit;
