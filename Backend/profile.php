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

// Get request
function handleGet($pdo)
{
    $sql = "SELECT * FROM profile";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        echo json_encode(array("status" => "success", "data" => $result));
    } else {
        echo json_encode(array("status" => "error", "message" => "No data found."));
    }
}

// Post request
function handlePost($pdo, $input)
{
    $sql = "SELECT * FROM profile WHERE email = :email and password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $input['email']);
    $stmt->bindParam(':password', $input['password']);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        $token = bin2hex(random_bytes(16)); // Generate a simple token
        echo json_encode(['success' => true, 'message' => 'Login successful', 'token' => $token]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
}

// Put request
function handlePut($pdo, $input)
{
    $sql = "UPDATE profile SET name = :name, email = :email, password = :password WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id'], 'email' => $input['email'], 'password' => $input['password'], 'name' => $input['name']]);
    echo json_encode(['message' => 'Profile updated successfully']);
}

// Delete request
function handleDelete($pdo, $input)
{
    $sql = "DELETE FROM profile WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id']]);
    echo json_encode(['message' => 'Profile deleted successfully']);
}
?>
