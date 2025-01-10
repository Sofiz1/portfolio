<?php
session_start();
include 'includes/include.inc.php';

$controller = new Controller();

// Fetch website content
$websiteResult = $controller->readWebsiteContent();
$websiteData = $websiteResult ? $websiteResult->fetch_assoc() : []; // Fallback to empty array if query fails

$name = $websiteData['name'] ?? 'Your Name'; // Default value if no data exists
$about = $websiteData['about'] ?? 'Welcome to my portfolio!';
$email = $websiteData['email'] ?? 'your-email@example.com';
$phone = $websiteData['phone'] ?? 'Your Phone Number';

// Fetch project content
$projectResult = $controller->readProjectContent();
if (!$projectResult) {
    $projectResult = []; // Default to an empty array
}

// Fetch services content
$servicesResult = $controller->readServicesContent();
if (!$servicesResult) {
    $servicesResult = []; // Default to an empty array
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Portfolio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
            color: #333;
            line-height: 1.6;
        }

        nav {
            display: flex;
            justify-content: flex-end;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin-left: 20px;
        }

        nav ul a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        nav ul a:hover {
            color: #007BFF;
        }

        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 50px;
            background-color: #007BFF;
            color: #ffffff;
        }

        .hero .left {
            max-width: 50%;
        }

        .hero h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 1.2em;
        }

        .hero img.profile {
            border-radius: 50%;
            max-width: 150px;
        }

        .hero .right img {
            max-width: 100%;
        }

        .projects, .services, .contact {
            padding: 50px;
            background-color: #ffffff;
            margin-top: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .projects h2, .services h2, .contact h2 {
            font-size: 2em;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th, table td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
        }

        table a {
            color: #007BFF;
            text-decoration: none;
        }

        table a:hover {
            text-decoration: underline;
        }

        .progress-bar {
            background-color: #f3f3f3;
            border-radius: 10px;
            height: 10px;
            margin: 10px 0;
            overflow: hidden;
        }

        .progress-bar-fill {
            background-color: #007BFF;
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
        }

        .contact ul {
            list-style: none;
            padding: 0;
        }

        .contact ul li {
            margin: 10px 0;
        }

        .contact ul a {
            color: #007BFF;
            text-decoration: none;
        }

        .contact ul a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <nav>
        <ul>
            <li><a href="./projects.html">Projects</a></li>
            <li><a href="./contact.html">Contact</a></li>
            <li><a href="https://github.com/kiztopia1/">GitHub</a></li>
        </ul>
    </nav>

    <div class="hero">
        <div class="left">
            <h1>Hi, It's <?php echo htmlspecialchars($name); ?>. Nice to meet you!</h1>
            <p><?php echo $about; ?></p>
        </div>
        <img src="./images/profile.jpg" alt="Profile Image" class="profile" />
        <div class="right">
            <img src="./images/hero.svg" alt="Hero Image" />
        </div>
    </div>
    
    <div class="projects">
        <section>
            <h2>Main Projects</h2>
            <table>
                <thead>
                    <tr>
                        <th>Project Name</th>
                        <th>Description</th>
                        <th>Link</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($project = $projectResult->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($project['project_name']); ?></td>
                            <td><?php echo htmlspecialchars($project['description']); ?></td>
                            <td>
                                <a href="<?php echo htmlspecialchars($project['imageurl']); ?>">
                                    View
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </section>
    </div>
    
    <div class="services">
        <section>
            <h2>Skills</h2>
            <?php while ($service = $servicesResult->fetch_assoc()): ?>
                <div>
                    <h3><?php echo htmlspecialchars($service['name']); ?></h3>
                    <div class="progress-bar">
                        <div class="progress-bar-fill" style="width: <?php echo htmlspecialchars($service['level']); ?>%;"></div>
                    </div>
                </div>
            <?php endwhile; ?>
        </section>
    </div>
    
    <div class="contact">
        <section>
            <h2>Contact Information</h2>
            <ul>
                <li>Email: <a href="mailto:<?php echo htmlspecialchars($email); ?>"><?php echo htmlspecialchars($email); ?></a></li>
                <li>Phone: <?php echo htmlspecialchars($phone); ?></li>
            </ul>
        </section>
    </div>
</body>
</html>
