<?php
require_once 'include.inc.php';


$newPassword = 'newpassword';


$hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

try {
    
    $stmt = $db->prepare("UPDATE admins SET password = :password WHERE username = 'admin'");
    $stmt->bindParam(':password', $hashedPassword);
    $stmt->execute();

    echo "The Password updated successfully!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
