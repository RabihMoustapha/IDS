<?php
header('Content-Type: application/json');
include '../../Backend/db.php';

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
    if (empty($input['email'])) {
        echo json_encode(['success' => false, 'message' => 'Email is required.']);
        return;
    }

    $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
        return;
    }

    $sql = 'DELETE FROM profile WHERE email = :email';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Profile deleted successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Profile deletion failed']);
    }
}
?>