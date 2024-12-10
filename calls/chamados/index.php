<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Callback</title>
</head>

<body>
    <form method="post" id="form-register-callback">
        <label for="department">Departamento</label>
        <select name="departament" id="departament" required>
            <?php
            $pdo = new PDO("mysql:host=localhost;dbname=sch", 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->query("SELECT name FROM sectors");

            while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $name = htmlspecialchars($user['name']);
                echo "<option value='$name'>$name</option>";
            }
            ?>
        </select>

        <label for="description">Descrição</label>
        <textarea name="description" id="description" required></textarea>

        <label for="priority">Prioridade</label>
        <select name="priority" id="priority" required>
            <option value="Baixa">Baixa</option>
            <option value="Média">Média</option>
            <option value="Alta">Alta</option>
        </select>

        <label for="responsible_id">Responsible ID</label>
        <select name="responsible_id" id="responsible_id">
            <?php
            $pdo = new PDO("mysql:host=localhost;dbname=sch", 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $pdo->query("SELECT id, name FROM users WHERE technical = 'on'");

            while ($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $name = htmlspecialchars($user['name']);
                $id = $user['id'];
                echo "<option value='$id'>$name</option>";
            }
            ?>
        </select>

        <label for="deadline">Data e hora limite</label>
        <input type="datetime-local" name="deadline" id="deadline" required>

        <button type="submit">Registrar chamado</button>

        <p id="message"></p>
    </form>

    <script>
        let form;

        const handleRequest = async (url = null, options = null) => {
            if (url === null)
                return console.error("handleRequest: Invalid url argument.");
            if (options === null)
                return console.error("handleRequest: Invalid options argument.");

            let result = {
                response: null,
                data: {
                    Message: null
                }
            };
            try {
                const response = await fetch(url, options);
                result["response"] = response;
                result["data"] = await response.json();
                return result;
            } catch (error) {
                result["data"]["Message"] = "Erro interno.";
                return result;
            }
        }

        const handlerForm = async (event) => {
            event.preventDefault();

            const result = await handleRequest("chamados/process.php", {
                method: "POST",
                body: new FormData(event.currentTarget)
            });

            const messageElement = form.querySelector("#message");

            if (result.response.ok) {
                messageElement.innerText = result.data["Message"];
            } else {
                messageElement.innerText = result.data["Message"];
            }
        }

        document.addEventListener("DOMContentLoaded", () => {
            form = document.getElementById("form-register-callback");
            form.addEventListener("submit", handlerForm);
        });
    </script>
</body>

</html>