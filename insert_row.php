<?php
// Ambil data POST
$data = json_decode(file_get_contents('php://input'), true);

if (!$data) {
    echo json_encode(['success' => false, 'error' => 'No data received']);
    exit;
}

// Koneksi ke database
include 'db_connect.php';

// Siapkan query untuk INSERT
$columns = implode(", ", array_keys($data));
$placeholders = implode(", ", array_fill(0, count($data), '?'));

$stmt = $conn->prepare("INSERT INTO tsf_data ($columns) VALUES ($placeholders)");

if ($stmt === false) {
    echo json_encode(['success' => false, 'error' => 'Failed to prepare the statement']);
    exit;
}

// Bind data
$types = str_repeat('s', count($data)); // 's' untuk string, sesuaikan jika tipe data berbeda
$values = array_values($data);
$stmt->bind_param($types, ...$values);

// Eksekusi query
if ($stmt->execute()) {
    // Ambil ID yang baru saja dimasukkan
    $inserted_id = $stmt->insert_id;
    
    // Ambil data yang baru saja dimasukkan berdasarkan ID
    $result_stmt = $conn->prepare("SELECT * FROM tsf_data WHERE id = ?");
    $result_stmt->bind_param('i', $inserted_id);
    $result_stmt->execute();
    $result = $result_stmt->get_result();
    
    // Fetch data dan konversi ke JSON
    $inserted_data = $result->fetch_assoc();
    echo json_encode(['success' => true, 'data' => $inserted_data]);

    // Tutup statement untuk SELECT
    $result_stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => $stmt->error]);
}

// Tutup statement dan koneksi
$stmt->close();
$conn->close();
?>
