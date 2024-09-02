<?php
header('Content-Type: application/json');

// Get JSON input from the request
$input = json_decode(file_get_contents('php://input'), true);

// Check if IDs are received and are an array
if (isset($input['ids']) && is_array($input['ids'])) {
    $ids = $input['ids'];

    // Connect to the database
    $mysqli = new mysqli('localhost', 'username', 'password', 'database');

    // Check the database connection
    if ($mysqli->connect_error) {
        echo json_encode(['success' => false, 'message' => 'Database connection failed']);
        exit;
    }

    // Escape IDs to prevent SQL Injection
    $ids = array_map([$mysqli, 'real_escape_string'], $ids);
    $id_list = implode(',', $ids);

    // Query to update rows status to 'deactivated'
    $query = "UPDATE tsf_data SET status = 'deactivated' WHERE id IN ($id_list)";
    $result = $mysqli->query($query);

    if ($result) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update database']);
    }

    // Close the database connection
    $mysqli->close();
} else {
    echo json_encode(['success' => false, 'message' => 'No IDs provided']);
}
?>
