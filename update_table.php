<?php
// update_table.php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_projek";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['column']) && isset($data['value'])) {
    $id = $data['id'];
    $column = $data['column'];
    $value = $data['value'];

    // Debugging: Check received data
    error_log("Received data: ID = $id, Column = $column, Value = $value");

    // Validate column name to prevent SQL injection
    $allowed_columns = ['no_tsrf', 'date', 'target_date', 'work_category', 'divisi', 'customer', 'end_customer', 'judul', 'status'];
    if (!in_array($column, $allowed_columns)) {
        echo json_encode(['success' => false, 'error' => 'Invalid column name']);
        exit();
    }

    // Update query
    $sql = "UPDATE tsf_data SET $column = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('si', $value, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Invalid input']);
}

$conn->close();
?>
