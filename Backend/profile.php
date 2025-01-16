<?php
header("Content-Type: application/json");
include 'db.php';
include '../Frontend/Login.php';

$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$email = $_GET['email'];
$password = $_GET['password'];

switch ($method) {
    case 'GET':
        handleGet($pdo, $email, $password);
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

function handleGet($pdo, $email, $password)
{
    $sql = "SELECT * FROM profile where email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result && password_verify($password, $result['password'])) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
    }
}

function handlePost($pdo, $input)
{
    $sql = "INSERT INTO profile (email, password, name) VALUES (:email, :password, :name)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $input['email'], 'password' => $input['password'], 'name' => $input['name']]);
    echo json_encode(['message' => 'Profile created successfully']);
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
