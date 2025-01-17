<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json, charset=UTF-8");
include 'db.php';
include '../Frontend/Login.php';
$method = $_SERVER['REQUEST_METHOD'];
$input = json_decode(file_get_contents('php://input'), true);
$email = $_GET['email'] ?? null;
$password = $_GET['password'] ?? null;

if (empty($email) || empty($password)) {
    echo json_encode(['message' => 'Email and password are required.']);
    exit;
}

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
    $sql = "SELECT * FROM profile where email = :email and password = :password";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email, 'password' => $password]);
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        echo json_encode(array("status" => "success", "data" => $result));
    } else {
        echo json_encode(array("status" => "error", "message" => "No data found."));
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
