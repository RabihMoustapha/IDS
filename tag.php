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
    $sql = "SELECT * FROM tag";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function handlePost($pdo, $input)
{
    $sql = "INSERT INTO tag (hashtag, mention) VALUES (:hashtag, :mention)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['hashtag' => $input['hashtag'], 'mention' => $input['mention']]);
    echo json_encode(['message' => 'Tag created successfully']);
}

function handlePut($pdo, $input)
{
    $sql = "UPDATE tag SET hashtag = :hashtag, mention = :mention WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id'], 'hashtag' => $input['hashtag'], 'mention' => $input['mention']]);
    echo json_encode(['message' => 'Tag updated successfully']);
}

function handleDelete($pdo, $input)
{
    $sql = "DELETE FROM tag WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id']]);
    echo json_encode(['message' => 'Tag deleted successfully']);
}
