<?php
require_once 'include.inc.php';

if (isset($_POST['section_name'])) {
    $section_name = $_POST['section_name'];

    
    $stmt = $db->prepare("SELECT * FROM sections WHERE section_name = :section_name");
    $stmt->bindParam(':section_name', $section_name);
    $stmt->execute();
    $section = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($section) {
        echo json_encode($section);
    } else {
        echo json_encode(['error' => 'Section not found']);
    }
}
?>
