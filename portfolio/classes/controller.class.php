<?php

class Controller extends Model {

    // Create new content in the website table
    public function createWebsiteContent($name, $email, $phone, $about) {
        $content = $this->insertWebsiteData($name, $email, $phone, $about);
        return $content;
    }

    // Read all content from the website table
    public function readWebsiteContent() {
        $content = $this->fetchWebsiteData();
        return $content;
    }

    // Update content in the website table
    public function updateWebsiteContent($name, $email, $phone, $about, $id) {
        $content = $this->modifyWebsiteData($name, $email, $phone, $about, $id);
        return $content;
    }

    // Delete content from the website table
    public function deleteWebsiteContent($id) {
        $content = $this->removeWebsiteData($id);
        return $content;
    }

    // Create new project content
    public function createProjectContent($imageurl, $project_name, $description) {
        $content = $this->insertProjectData($imageurl, $project_name, $description);
        return $content;
    }

    // Read all content from the project table
    public function readProjectContent() {
        $content = $this->fetchProjectData();
        return $content;
    }

    // Delete a project
    public function deleteProjectContent($id) {
        $content = $this->removeProjectData($id);
        return $content;
    }

    // Create new service content
    public function createServicesContent($name, $level) {
        $content = $this->insertServicesData($name, $level);
        return $content;
    }

    // Read all content from the services table
    public function readServicesContent() {
        $content = $this->fetchServicesData();
        return $content;
    }

    // Delete a service
    public function deleteServicesContent($id) {
        $content = $this->removeServicesData($id);
        return $content;
    }}
?>
