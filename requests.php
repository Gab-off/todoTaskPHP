<?php
session_start();

require_once 'functions.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $index = $_POST['index'] ?? null;
    $priority = $_POST['priority'] ?? null;

    if (is_numeric($index) && $index >= 0 && is_string($priority) && in_array($priority, $_SESSION['priorityTasks'])) {
        if (isset($_SESSION['tasks'][$index]) && isset($_SESSION['tasks'][$index]['prioridade'])) {
            $setPriority = array_search($priority, $_SESSION['priorityTasks']);
            if ($setPriority >= 0 && $setPriority <= 1) {
                $_SESSION['tasks'][$index]['prioridade'] = $_SESSION['priorityTasks'][$setPriority + 1];
            } else {
                $_SESSION['tasks'][$index]['prioridade'] = $_SESSION['priorityTasks'][0];
            }
            echo json_encode(['status' => 'ok', 'new_priority' => $_SESSION['tasks'][$index]['prioridade']]);
            exit;
        } else {
            echo json_encode(['status' => http_response_code(404)]);
            exit;
        }
    } else {
        echo json_encode(['status' => http_response_code(400)]);
        exit;
    }

} else {
    echo json_encode(['status' => http_response_code(405)]);
    exit;
}
