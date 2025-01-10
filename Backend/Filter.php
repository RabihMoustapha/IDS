<?php
header("Content-Type: application/json");
include 'db.php';

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'GET':
        handleGet($pdo);
        break;
    case 'POST':
        handlePost($pdo, $input);
        break;
    case 'PUT':
        handlePut($pdo, $input);
        break;
    case 'DELETE':
        handleDelete($pdo, $input);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

function handleGet($pdo)
{
    $sql = "SELECT * FROM filter";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function handlePost($pdo, $input)
{
    $sql = "INSERT INTO filter (popularity) VALUES (:popularity)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['popularity' => $input['popularity']]);
    echo json_encode(['message' => 'Filter created successfully']);
}

function handlePut($pdo, $input)
{
    $sql = "UPDATE filter SET popularity = :popularity WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['popularity' => $input['popularity']]);
    echo json_encode(['message' => 'Filter updated successfully']);
}

function handleDelete($pdo, $input)
{
    $sql = "DELETE FROM filter WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id']]);
    echo json_encode(['message' => 'Filter deleted successfully']);
}
