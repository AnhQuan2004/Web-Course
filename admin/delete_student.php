<?php
include '../components/connect.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa user khỏi database
    $delete_query = "DELETE FROM users WHERE id = :id";
    $statement = $conn->prepare($delete_query);
    $statement->bindParam(':id', $id);
    $statement->execute();

    // Chuyển hướng trở lại trang danh sách user
    header("Location: students_management.php");
    exit;
}