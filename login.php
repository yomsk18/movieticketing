<?php
header('Content-Type: application/json');
include_once 'database.php';

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';
$role     = $_POST['role'] ?? '';

$sql = "SELECT * FROM user WHERE username=? AND password=? AND role=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $username, $password, $role);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(["success" => true, "role" => $row['role']]);
} else {
    echo json_encode(["success" => false]);
}
?>
