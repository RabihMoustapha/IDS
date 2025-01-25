<?php
header('Content-Type: application/json');
include '../db.php';
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);

switch ($method) {
    case 'POST':
        handleCreate($pdo, $input);
        break;
    default:
        echo json_encode(['message' => 'Invalid request method']);
        break;
}

function handleCreate($pdo, $input)
{
    $sql = 'INSERT INTO profile (email, password, name) VALUES(:email, :password, :name))';
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
?>