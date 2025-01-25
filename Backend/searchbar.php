<?php
header('Content-Type: application/json');
include 'db.php';
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'POST':
        handlePost($pdo, $input);
        break;

    case 'GET':
        handleGet($pdo);
        break;

    default:
        echo json_encode(['error' => 'Unsupported request method']);
        break;
}

function handlePost($pdo, $input)
{
    $query = 'SELECT * FROM searchbar WHERE (keyword LIKE :search OR keyword = :search) AND (hashtag LIKE :search OR hashtag = :search) AND (title LIKE :search OR title = :search)';
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':search', $input['query']);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        echo json_encode(['success' => true, 'item' => $result]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No data found']);
    }
}

function handleGet($pdo)
{
    $query = 'SELECT * FROM searchbar';
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if($result){
        echo json_encode(['success' => true, 'item' => $result]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No data found']);
    }
}
