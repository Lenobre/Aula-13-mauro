<?php
$pdo = new PDO("mysql:host=localhost;dbname=sch", 'root', '');
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

$name = isset($_POST['name']) ? $_POST['name'] : null;
$response = [
    'Message' => "Erro interno.",
    'Status'=> 'Error',
];
if ($name != null) {
    $query = "INSERT INTO sectors (name) values ('$name');";

    $queryResult = $pdo->query($query);

    if (!$queryResult) 
        $response["Message"] = "Não foi possível criar o setor.";

    $response["Message"] = "Cadastrado com sucesso.";
    $response["Status"] = "Sucess";
}

echo json_encode($response);