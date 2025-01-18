<?php
header("Content-Type: application/json");
include 'db.php';
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'));

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

function handlePost($pdo, $input)
{
    $sql = "SELECT * FROM profile where email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $input['email']);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result && password_verify($input['password'], $result['password'])) {
        echo json_encode(['success' => true, 'message' => 'Login successful']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid username or password']);
    }
}


function handlePut($pdo, $input)
{
    $sql = "UPDATE profile SET name = :name, email = :email, password = :password WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id'], 'email' => $input['email'], 'password' => $input['password'], 'name' => $input['name']]);
    echo json_encode(['message' => 'Profile updated successfully']);
}

function handleDelete($pdo, $input)
{
    $sql = "DELETE FROM profile WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $input['id']]);
    echo json_encode(['message' => 'Profile deleted successfully']);
}
