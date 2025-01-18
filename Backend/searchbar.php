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
    $query = isset($_GET['q']) ? $_GET['q'] : '';
    $sql = "SELECT * FROM searchbar WHERE title LIKE :query OR content LIKE :query";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['query' => "%$query%"]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($result);
}

function handlePost($pdo, $input)
{
    $sql = "INSERT INTO searchbar (title, hashtag, keyword) VALUES (:title, :hashtag, :keyword)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $input['title'], 'hashtag' => $input['hashtag'], 'keyword' => $input['keyword']]);
    // Assuming the backend sends a token upon successful login
    $token = bin2hex(random_bytes(16)); // Generate a random token
    echo json_encode(['message' => 'Searchbar created successfully', 'token' => $token]);
}

function handlePut($pdo, $input)
{
    $sql = "UPDATE searchbar SET keyword = :keyword where hashtag = :hashtag and title = :title";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $input['title'], 'hashtag' => $input['hashtag'], 'keyword' => $input['keyword']]);
    echo json_encode(['message' => 'Searchbar updated successfully']);
}

function handleDelete($pdo, $input)
{
    $sql = "DELETE FROM searchbar WHERE title = :title and hashtag = :hashtag";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['title' => $input['title'], 'hashtag' => $input['hashtag']]);
    echo json_encode(['message' => 'Searchbar deleted successfully']);
}
