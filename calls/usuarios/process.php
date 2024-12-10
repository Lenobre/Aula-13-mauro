<?php
$pdo = new PDO("mysql:host=localhost;dbname=sch", 'root', '');
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

$name = isset($_POST['name']) ? $_POST['name'] : null;
$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;
$technical = isset($_POST['technical']) ? $_POST['technical'] : null;

$response = [
    'Message' => "Erro interno.",
    'Status'=> 'Error',
];
if ($name != null && $email != null && $password != null) {
    $createUserQuery = "INSERT INTO users (name, email, password, technical) values ('$name', '$email', '$password', '$technical');";

    $createUserResult = $pdo->query($createUserQuery);

    if (!$createUserResult) 
        $response["Message"] = "Não foi possível criar o usuário.";

    $response["Message"] = "Cadastrado com sucesso.";
    $response["Status"] = "Sucess";
    
    echo json_encode($response);
}