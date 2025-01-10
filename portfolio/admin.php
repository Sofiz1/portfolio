<?php
include 'includes/include.inc.php';

$controller = new Controller();

// Handle form submissions for website content
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        if ($_POST['action'] === 'saveWebsite') {
            $controller->updateWebsiteContent(
                $_POST['name'],
                $_POST['email'],
                $_POST['phone'],
                $_POST['about'],
                $_POST['id']
            );
        } elseif ($_POST['action'] === 'createProject') {
            $controller->createProjectContent(
                $_POST['imageurl'],
                $_POST['project_name'],
                $_POST['description']
            );
        } elseif ($_POST['action'] === 'deleteProject') {
            $controller->deleteProjectContent($_POST['id']);
        } elseif ($_POST['action'] === 'createService') {
            $controller->createServicesContent(
                $_POST['name'],
                $_POST['level']
            );
        } elseif ($_POST['action'] === 'deleteService') {
            $controller->deleteServicesContent($_POST['id']);
        }
    }
}

// Fetch website content
$websiteResult = $controller->readWebsiteContent();
if ($websiteResult->num_rows > 0) {
    $websiteRow = $websiteResult->fetch_assoc();
} else {
    $websiteRow = null;
}

// Fetch project content
$projectResult = $controller->readProjectContent();

// Fetch services content
$servicesResult = $controller->readServicesContent();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header class="admin-header">
        <h1 class="admin-title">Admin Dashboard</h1>
    </header>

    <main class="admin-container">
        <!-- Website Content Section -->
        <section class="admin-section">
            <h2 class="section-title">Website Content</h2>
            <form class="form" method="POST">
                <input type="hidden" name="id" value="<?php echo $websiteRow['id']; ?>">

                <label for="name">Name:</label>
                <input class="form-input" type="text" name="name" value="<?php echo htmlspecialchars($websiteRow['name'] ?? ''); ?>" required>

                <label for="email">Email:</label>
                <input class="form-input" type="email" name="email" value="<?php echo htmlspecialchars($websiteRow['email'] ?? ''); ?>" required>

                <label for="phone">Phone:</label>
                <input class="form-input" type="text" name="phone" value="<?php echo htmlspecialchars($websiteRow['phone'] ?? ''); ?>" required>

                <label for="about">About:</label>
                <textarea class="form-textarea" name="about" required><?php echo htmlspecialchars($websiteRow['about'] ?? ''); ?></textarea>

                <button class="form-button" type="submit" name="action" value="saveWebsite">Save Website Content</button>
            </form>
        </section>

        <!-- Project Management Section -->
        <section class="admin-section">
            <h2 class="section-title">Projects</h2>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Image URL</th>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($projectResult && $projectResult->num_rows > 0): ?>
                        <?php while ($project = $projectResult->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $project['id']; ?></td>
                                <td><?php echo htmlspecialchars($project['imageurl']); ?></td>
                                <td><?php echo htmlspecialchars($project['project_name']); ?></td>
                                <td><?php echo htmlspecialchars($project['description']); ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
                                        <button class="table-button" type="submit" name="action" value="deleteProject">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No projects available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <h2>New Project</h2>
            <form class="form" method="POST">
                <label for="imageurl">Image URL:</label>
                <input class="form-input" type="text" name="imageurl" required>

                <label for="project_name">Project Name:</label>
                <input class="form-input" type="text" name="project_name" required>

                <label for="description">Description:</label>
                <textarea class="form-textarea" name="description" required></textarea>

                <button class="form-button" type="submit" name="action" value="createProject">Add Project</button>
            </form>
        </section>

        <!-- Services Management Section -->
        <section class="admin-section">
            <h2 class="section-title">Services</h2>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Service Name</th>
                        <th>Level</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($servicesResult && $servicesResult->num_rows > 0): ?>
                        <?php while ($service = $servicesResult->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $service['id']; ?></td>
                                <td><?php echo htmlspecialchars($service['name']); ?></td>
                                <td><?php echo htmlspecialchars($service['level']); ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="id" value="<?php echo $service['id']; ?>">
                                        <button class="table-button" type="submit" name="action" value="deleteService">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No services available.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
            <h2>New Skill</h2>
            <form class="form" method="POST">
                <label for="name">Skill Name:</label>
                <input class="form-input" type="text" name="name" required>

                <label for="level">Level:</label>
                <input class="form-input" type="number" name="level" required min="0" max="100">

                <button class="form-button" type="submit" name="action" value="createService">Add Skill</button>
            </form>
        </section>
    </main>
</body>
</html>

