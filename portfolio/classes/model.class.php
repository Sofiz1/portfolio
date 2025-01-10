<?php

class Model extends Db {

    protected function initializeWebsiteDataIfEmpty() {
    $conn = $this->conn();
    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM website");
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    // Initialize only if no rows exist
    if ($row['count'] == 0) {
        $stmt = $conn->prepare("INSERT INTO website (name, email, phone, about) VALUES ('', '', '', '')");
        $stmt->execute();
    }
}

protected function fetchWebsiteData() {
    // Ensure initialization happens only once
    $this->initializeWebsiteDataIfEmpty();

    $conn = $this->conn();
    $stmt = $conn->prepare("SELECT * FROM website LIMIT 1");
    $stmt->execute();
    return $stmt->get_result();
}

protected function modifyWebsiteData($name, $email, $phone, $about) {
    $conn = $this->conn();
    // Update the first row in the table
    $stmt = $conn->prepare("UPDATE website SET name=?, email=?, phone=?, about=? ORDER BY id ASC LIMIT 1");
    $stmt->bind_param("ssss", $name, $email, $phone, $about);
    $stmt->execute();
    return $stmt->affected_rows > 0;
}



    // Create website content
    protected function insertWebsiteData($name, $email, $phone, $about) {
        $conn = $this->conn();
        $stmt = $conn->prepare("INSERT INTO website (name, email, phone, about) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $phone, $about);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    // Delete website content (not applicable, but kept for consistency)
    protected function removeWebsiteData() {
        $conn = $this->conn();
        $stmt = $conn->prepare("DELETE FROM website");
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    // Fetch project content
    protected function fetchProjectData() {
        $conn = $this->conn();
        $stmt = $conn->prepare("SELECT * FROM project");
        $stmt->execute();
        return $stmt->get_result();
    }

    // Create project content
    protected function insertProjectData($imageurl, $project_name, $description) {
        $conn = $this->conn();
        $stmt = $conn->prepare("INSERT INTO project (imageurl, project_name, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $imageurl, $project_name, $description);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    // Delete project content
    protected function removeProjectData($id) {
        $conn = $this->conn();
        $stmt = $conn->prepare("DELETE FROM project WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->affected_rows > 0;
    }

    protected function fetchServicesData() {
    $conn = $this->conn();
    $stmt = $conn->prepare("SELECT * FROM services");
    $stmt->execute();
    return $stmt->get_result(); // Return result set for services
}
    protected function insertServicesData($name, $level) {
    $conn = $this->conn();
    $stmt = $conn->prepare("INSERT INTO services (name, level) VALUES (?, ?)");
    $stmt->bind_param("si", $name, $level); // "si" means string and integer
    $stmt->execute();
    return $stmt->affected_rows > 0;
}
protected function removeServicesData($id) {
    $conn = $this->conn();
    $stmt = $conn->prepare("DELETE FROM services WHERE id = ?");
    $stmt->bind_param("i", $id); // "i" means integer
    $stmt->execute();
    return $stmt->affected_rows > 0;
}



}
