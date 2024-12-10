<?php
$pdo = new PDO("mysql:host=localhost;dbname=sch", 'root', '');
$pdo->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, false);

$email = isset($_POST['email']) ? $_POST['email'] : null;
$password = isset($_POST['password']) ? $_POST['password'] : null;

$response = [
    'Message' => "Erro interno.",
    'Status' => 'Error',
];
if ($email != null && $password != null) {
    $findUser = $pdo->query("SELECT id FROM users WHERE email = '$email' AND password = '$password';")->fetch();

    if (!$findUser)
        header("Location: /calls/usuarios/login");

    session_start();
    $_SESSION["userID"] = $findUser['id'];
    $_SESSION["isLogged"] = true;

    header("Location: /calls/chamados/index.php ");
}
