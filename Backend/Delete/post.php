<?php
header('Content-Type: application/json');
include '../db.php';
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'DELETE':
        handleDelete($pdo, $input);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

function handleDelete($pdo, $input)
{
    $sql = 'DELETE FROM profile WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $_POST['id']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Profile deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
}