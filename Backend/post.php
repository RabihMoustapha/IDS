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
    $sql = 'SELECT * FROM post';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function handlePost($pdo, $input)
{
    $sql = 'INSERT INTO post (title, description, codesnippets) VALUES (:title, :description, :codesnippets)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $input['title'], 'description' => $input['description'], 'codesnippets' => $input['codesnippets']]);
    echo json_encode(['message' => 'Post created successfully']);
}

function handlePut($pdo, $input)
{
    $sql = 'UPDATE post SET codesnippets = :codesnippets, title = :title, description = :description WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id'], 'title' => $input['title'], 'description' => $input['description'], 'codesnippets' => $input['codesnippets']]);
    echo json_encode(['message' => 'Post updated successfully']);
}

function handleDelete($pdo, $input)
{
    $sql = 'DELETE FROM post WHERE title = :title AND description = :description AND codesnippets = :codesnippets';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':title', $input['title']);
    $stmt->bindParam(':description', $input['description']);
    $stmt->bindParam(':codesnippets', $input['codesnippets']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Post deleted successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Post undeleted successful']);
    }
}
