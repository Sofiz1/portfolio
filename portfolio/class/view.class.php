<?php
class View {
    public function renderSection($sectionContent) {
        if ($sectionContent) {
            echo "<div class='section'>";
            echo "<h2>" . htmlspecialchars($sectionContent['section_name']) . "</h2>";
            echo "<p>" . htmlspecialchars($sectionContent['content']) . "</p>";
            echo "</div>";
        } else {
            echo "<div class='section'>";
            echo "<p>Content not available.</p>";
            echo "</div>";
        }
    }
}
?>
