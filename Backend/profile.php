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
    $sql = 'SELECT * FROM profile';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        echo json_encode(array('success' => true, 'data' => $result));
    } else {
        echo json_encode(array('success' => false, 'message' => 'No data found.'));
    }
}

function handlePost($pdo, $input)
{
    $sql = 'SELECT * FROM profile WHERE email = :email and password = :password';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $input['email']);
    $stmt->bindParam(':password', $input['password']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $token = bin2hex(random_bytes(16));
        echo json_encode(['success' => true, 'message' => 'Login successful', 'token' => $token]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
}

function handlePut($pdo, $input)
{
    $sql = 'UPDATE profile SET name = :name, password = :password WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':name', $input['name']);
    $stmt->bindParam(':email', $input['email']);
    $stmt->bindParam(':password', $input['password']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Profile updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Profile not found']);
    }
}

function handleDelete($pdo, $input)
{
    $sql = 'DELETE FROM profile WHERE email = :email and password = :password';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $input['email']);
    $stmt->bindParam(':password', $input['password']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        echo json_encode(['success' => true, 'message' => 'Profile deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
}
