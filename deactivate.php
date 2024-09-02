<?php
include("db_connect.php");

if (isset($_GET['id'])) {
    $id = intval($_GET['id']); // Pastikan ID adalah integer

    // Gunakan prepared statement untuk mencegah SQL injection
    $stmt = $db->prepare("UPDATE tsf_data SET deleted_at = CURDATE() WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Data successfully deactivated.";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No ID specified.";
}

$db->close();
?>