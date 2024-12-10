<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>
</head>
<body>
    <form method="post" id="form-register-user">
        <label for="name">Nome</label>
        <input type="text" name="name" required>

        <label for="email">E-mail</label>
        <input type="email" name="email" required>

        <label for="password">Senha</label>
        <input type="password" name="password">

        <label for="technical">Técnico</label>
        <input type="checkbox" name="technical">

        <button type="submit">Cadastrar</button>

        <p id="message"></p>
    </form>
    <script>
        let form;

        const handleRequest = async (url = null, options = null) => {
            if (url === null)
                return console.error("handleRequest: Invalid url argument.");
            if (options === null)
                return console.error("handleRequest: Invalid options argument.");

            let result = {response: null, data: null};
            try {
                const response = await fetch(url, options);

                result["response"] = response;
                result["data"] = await response.json();

                return result;
            } catch (error) {
                result["data"] = result["data"] || "Erro interno.";

                return result;
            }
        }

        const handlerForm = async (event) => {
            event.preventDefault();

            const result = await handleRequest("process.php", {
                method: "POST",
                body: new FormData(event.currentTarget)
            });

            console.log(result)
            if (result.response.ok)
                form.querySelector("#message").innerText = result.data["Message"];
        }

        document.addEventListener("DOMContentLoaded", () => {
            form = document.getElementById("form-register-user");
            form.addEventListener("submit", handlerForm);
        });
    </script>
</body>
</html>