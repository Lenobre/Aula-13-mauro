<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="post" action="/usuarios/processLogin.php">
        <label for="email">E-mail</label>
        <input type="email" name="email">

        <label for="password">Senha</label>
        <input type="password" name="password">

        <button type="submit">Entrar</button>
    </form>
</body>

</html>