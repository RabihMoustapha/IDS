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

    case 'PUT':
        handlePut($pdo, $input);
        break;

    case 'DELETE':
        handleDelete($pdo, $input);
        break;

    default:
        echo json_encode(["error" => "Unsupported request method"]);
        break;
}

function handlePost($pdo, $input)
{
    $query = "SELECT name FROM searchbar WHERE hashtag LIKE :searchTerm";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":searchTerm", $input['query']);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        echo json_encode(["status" => true, "data" => $result]);
    } else {
        echo json_encode(["status" => false, "message" => "No data found"]);
    }
}

function handleGet($pdo)
{
    $query = "SELECT * FROM searchbar";
    $stmt = $pdo->prepare($query);
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($results);
}

function handlePut($pdo, $input)
{
    // Add your PUT logic here
    echo json_encode(["message" => "PUT request received"]);
}

function handleDelete($pdo, $input)
{
    // Add your DELETE logic here
    echo json_encode(["message" => "DELETE request received"]);
}
