<?php
header('Content-Type: application/json');
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
    $sql = 'SELECT * FROM link';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function handlePost($pdo, $input)
{
    $sql = 'INSERT INTO link (url) VALUES (:url)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['url'=>$input['url']]);
    echo json_encode(['message' => 'Link created successfully']);
}

function handlePut($pdo, $input)
{
    $sql = 'UPDATE link SET url = :url';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['url' => $input['url']]);
    echo json_encode(['message' => 'Link updated successfully']);
}

function handleDelete($pdo, $input)
{
    $sql = 'DELETE FROM link WHERE url = :url';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['url' => $input['url']]);
    echo json_encode(['message' => 'Link deleted successfully']);
}
