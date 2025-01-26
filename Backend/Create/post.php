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
    if (empty($input['email']) || empty($input['title']) || empty($input['codesnippets']) || empty($input['content'])) {
        echo json_encode(['success' => false, 'message' => 'All fields (email, title, codesnippets, content) are required.']);
        return;
    }

    $email = filter_var($input['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['success' => false, 'message' => 'Invalid email format.']);
        return;
    }

    $checkEmailQuery = 'SELECT email FROM profile WHERE email = :email';
    $stmtCheck = $pdo->prepare($checkEmailQuery);
    $stmtCheck->bindParam(':email', $email);
    $stmtCheck->execute();
    $emailExists = $stmtCheck->fetchColumn();

    if (!$emailExists) {
        echo json_encode(['success' => false, 'message' => 'Email does not exist in profile.']);
        return;
    }

    $sql = 'INSERT INTO post (email, title, codesnippets, content) VALUES (:email, :title, :codesnippets, :content)';
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':title', $input['title']);
    $stmt->bindParam(':codesnippets', $input['codesnippets']);
    $stmt->bindParam(':content', $input['content']);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Post created successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Post creation failed.']);
    }
}
?>
