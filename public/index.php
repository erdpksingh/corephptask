<?php
require_once '../src/controllers/CustomerController.php';

// Set headers
header('Content-Type: application/json');

// Parse the URL
$requestMethod = $_SERVER['REQUEST_METHOD'];
$uri = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
$resource = $uri[2] ?? null;
$id = $uri[3] ?? null;

// Simple Router
if ($uri[1] === 'api') {
    switch ($resource) {
        case 'customers':
            handleCustomerRoutes($requestMethod, $id);
            break;
        default:
            http_response_code(404);
            echo json_encode(['message' => 'Not Found']);
            break;
    }
} else {
    http_response_code(404);
    echo json_encode(['message' => 'Not Found']);
}

// Router function for Customer routes
function handleCustomerRoutes($requestMethod, $id) {
    $controller = new CustomerController();
    switch ($requestMethod) {
        case 'GET':
            handleGetRequest($controller, $id);
            break;
        case 'POST':
            handlePostRequest($controller);
            break;
        case 'PUT':
            handlePutRequest($controller, $id);
            break;
        case 'DELETE':
            handleDeleteRequest($controller, $id);
            break;
        default:
            http_response_code(405);
            echo json_encode(['message' => 'Method Not Allowed']);
            break;
    }
}

// Handlers for each HTTP method
function handleGetRequest($controller, $id) {
    if ($id) {
        $response = $controller->read($id);
        echo json_encode($response);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Bad Request']);
    }
}

function handlePostRequest($controller) {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($data) {
        $response = $controller->create($data);
        http_response_code($response['status']);
        echo json_encode($response);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Bad Request']);
    }
}

function handlePutRequest($controller, $id) {
    $data = json_decode(file_get_contents('php://input'), true);
    if ($id && $data) {
        $response = $controller->update($id, $data);
        http_response_code($response['status']);
        echo json_encode($response);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Bad Request']);
    }
}

function handleDeleteRequest($controller, $id) {
    if ($id) {
        $response = $controller->delete($id);
        http_response_code($response['status']);
        echo json_encode($response);
    } else {
        http_response_code(400);
        echo json_encode(['message' => 'Bad Request']);
    }
}
