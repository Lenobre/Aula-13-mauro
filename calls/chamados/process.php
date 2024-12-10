<?php
$pdo = new PDO("mysql:host=localhost;dbname=sch", 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
session_start();

$creator_id = $_SESSION["userID"];
$department = isset($_POST['departament']) ? $_POST['departament'] : null;
$description = isset($_POST['description']) ? $_POST['description'] : null;
$priority = isset($_POST['priority']) ? $_POST['priority'] : null;
$responsible_id = isset($_POST['responsible_id']) ? $_POST['responsible_id'] : null;
$deadline = isset($_POST['deadline']) ? $_POST['deadline'] : null;

$response = [
    'Message' => "Erro interno.",
    'Status' => 'Error',
];
echo ("Creator ID: " . $creator_id . "<br>");
echo ("Department: " . $department . "<br>");
echo ("Description: " . $description . "<br>");
echo ("Priority: " . $priority) . "<br>";
echo ("Responsible ID: " . $responsible_id . "<br>");
echo ("Deadline: " . $deadline . "<br>");

if ($creator_id && $department && $description && $priority && $responsible_id && $deadline) {
    $query = "INSERT INTO callbacks (creator_id, department, description, priority, responsible_id, deadline, created_at) 
              VALUES (:creator_id, :department, :description, :priority, :responsible_id, :deadline, NOW())";
    $stmt = $pdo->prepare($query);

    $stmt->bindParam(':creator_id', $creator_id, PDO::PARAM_INT);
    $stmt->bindParam(':department', $department, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':priority', $priority, PDO::PARAM_STR);
    $stmt->bindParam(':responsible_id', $responsible_id, PDO::PARAM_INT);
    $stmt->bindParam(':deadline', $deadline, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $response["Message"] = "Chamado cadastrado com sucesso.";
        $response["Status"] = "Success";
    } else {
        $response["Message"] = "Não foi possível criar o chamado.";
    }
}

echo json_encode($response);
