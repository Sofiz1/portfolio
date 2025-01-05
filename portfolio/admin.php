<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin dashboard</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6c63ff, #92f3fc);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .header {
            background: #574fdb;
            color: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header .buttons {
            display: flex;
            gap: 10px;
        }

        .header .home-btn {
            background: transparent;
            color: #fff;
            border: 2px solid #fff;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            text-decoration: none;
            cursor: pointer;
            transition: 0.3s;
        }

        .header .home-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        .header .logout-btn {
            background: #e74c3c;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .header .logout-btn:hover {
            background: #c0392b;
        }

        .container {
            flex: 1;
            padding: 20px;
        }

        .add-section {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }

        .add-section form input {
            width: 70%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .add-section form button {
            padding: 10px 15px;
            background: #6c63ff;
            color: #fff;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }

        .add-section form button:hover {
            background: #574fdb;
        }

        .section-selector select {
            padding: 10px;
            font-size: 16px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        .section {
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
    <script>
        function loadSectionContent(sectionName) {
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'fetch_section.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    document.getElementById('section-title').innerText = response.section_name;
                    document.getElementById('section-content').value = response.content;
                    document.getElementById('hidden-section-name').value = response.section_name;
                }
            };
            xhr.send('section_name=' + sectionName);
        }
    </script>
</head>
<body>
    <header class="header">
        <span>Admin Panel</span>
        <div class="buttons">
            <a href="home.php" class="home-btn">Home</a>
            <form method="POST" style="display: inline;">
                <button type="submit" name="logout" class="logout-btn">Logout</button>
            </form>
        </div>
    </header>

    <div class="container">
       
        <div class="add-section">
            <h2>Adding New Section</h2>
            <form method="POST">
                <input type="text" name="new_section" placeholder="Section Name" required>
                <button type="submit" name="add_section">Adding Section</button>
            </form>
        </div>

       
        <div class="section-selector">
            <form method="POST">
                <select name="selected_section" onchange="loadSectionContent(this.value)">
                    <option disabled selected>Select a Section</option>
                    <?php foreach ($sections as $section): ?>
                        <option value="<?php echo htmlspecialchars($section['section_name']); ?>">
                            <?php echo htmlspecialchars($section['section_name']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>

        <!-- Current Section -->
        <div class="section">
            <h2 id="section-title"><?php echo htmlspecialchars($sections[0]['section_name'] ?? ''); ?></h2>
            <form method="POST">
                <textarea id="section-content" name="content" rows="5"><?php echo htmlspecialchars($sections[0]['content'] ?? ''); ?></textarea>
                <input type="hidden" id="hidden-section-name" name="section" value="<?php echo htmlspecialchars($sections[0]['section_name'] ?? ''); ?>">
                <button type="submit" name="update_section">Save Changes</button>
            </form>
        </div>
    </div>
</body>
</html>
