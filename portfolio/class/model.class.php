<?php
class Model {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    
    public function getContentBySection($section) {
        $query = "SELECT * FROM sections WHERE section_name = :section";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':section', $section);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    
    public function insertContent($section, $content) {
        $query = "INSERT INTO sections (section_name, content) VALUES (:section, :content)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':section', $section);
        $stmt->bindParam(':content', $content);
        return $stmt->execute();
    }

    
    public function updateContent($section, $content) {
        $query = "UPDATE sections SET content = :content WHERE section_name = :section";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':section', $section);
        $stmt->bindParam(':content', $content);
        return $stmt->execute();
    }

    
    public function deleteContent($section) {
        $query = "DELETE FROM sections WHERE section_name = :section";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':section', $section);
        return $stmt->execute();
    }
}
?>
