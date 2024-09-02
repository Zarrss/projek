<?php
include 'db_connect.php'; 

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $id = $data['id'];
    $column = $data['column'];
    $value = $data['value'];

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
    echo json_encode(['success' => false, 'error' => 'No data received']);
}

$conn->close();
?>
