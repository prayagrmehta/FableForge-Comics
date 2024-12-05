<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Characters</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #121212;
            color: #ffffff;
            display: flex;
            flex-direction: column;
        }
        .container {
            padding: 20px;
        }
        h1 {
            margin-bottom: 20px;
            color: #f0f0f0;
        }
        .filter-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px;
        }
        .filter-section input,
        .filter-section select {
            padding: 10px;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #1e1e1e;
            color: #ffffff;
        }
        .character-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 20px;
            padding: 10px;
        }
        .character {
            cursor: pointer;
            padding: 15px;
            border: 1px solid #444;
            border-radius: 8px;
            text-align: center;
            transition: transform 0.3s, background-color 0.3s;
            background-color: #1e1e1e;
        }
        .character:hover {
            background-color: #333;
            transform: scale(1.05);
        }
        .character img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 10px;
            max-height: 250px;
            object-fit: cover;
        }
        .sliding-menu {
            position: fixed;
            top: -100%;
            left: 0;
            right: 0;
            background-color: #212121;
            border-bottom: 2px solid #007bff;
            padding: 30px;
            transition: top 0.5s;
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.5);
            z-index: 1000;
            border-radius: 0 0 10px 10px;
            height: auto;
            overflow-y: auto;
        }
        .sliding-menu.active {
            top: 0;
        }
        .close-menu {
            cursor: pointer;
            float: right;
            font-size: 30px;
            color: #dc3545;
        }
        .close-menu:hover {
            color: #c82333;
        }
        .details {
            margin-top: 20px;
            color: #f0f0f0;
        }
        .details strong {
            color: #007bff;
            display: inline-block;
            margin-top: 10px;
        }
        .details p {
            margin: 5px 0;
        }
    </style>
    <script>
        let totalCharacters = 0;

        function showSlidingMenu(id) {
            const menu = document.getElementById('sliding-menu');
            const details = document.getElementById('details-' + id).innerHTML;
            document.getElementById('menu-content').innerHTML = details;
            menu.classList.add('active');
        }

        function closeSlidingMenu() {
            const menu = document.getElementById('sliding-menu');
            menu.classList.remove('active');
        }

        function filterCharacters() {
            const filterInput = document.getElementById('filter').value.toLowerCase();
            const typeFilter = document.getElementById('type').value;
            const characters = document.querySelectorAll('.character');
            let visibleCount = 0;

            characters.forEach(character => {
                const characterName = character.querySelector('.character-name').textContent.toLowerCase();
                const characterRealName = character.querySelector('.character-realname').textContent.toLowerCase();
                const characterType = character.getAttribute('data-type');

                const matchesName = characterName.includes(filterInput);
                const matchesRealName = characterRealName.includes(filterInput);
                const matchesType = (typeFilter === 'all') || (characterType === typeFilter);

                if ((matchesName || matchesRealName) && matchesType) {
                    character.style.display = '';
                    visibleCount++;
                } else {
                    character.style.display = 'none';
                }
            });

            document.getElementById('character-count').textContent = `(${visibleCount})`;
        }

        function updateCharacterCount(count) {
            totalCharacters = count;
            document.getElementById('character-count').textContent = `(${totalCharacters})`;
        }
    </script>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">
    <h1>BROWSE CHARACTERS <span id="character-count"></span></h1>

    <div class="filter-section">
        <input type="text" id="filter" placeholder="Filter by Keyword" onkeyup="filterCharacters()">
        <div>
            <label for="type">Type:</label>
            <select id="type" onchange="filterCharacters()">
                <option value="all">All</option>
                <option value="superhero">Superheroes</option>
                <option value="villain">Villains</option>
                <option value="complicated">Complicated</option>
            </select>
        </div>
    </div>

    <div class="character-grid">
        <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "FableForge";

        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM characters";
        $result = $conn->query($sql);
        $totalCount = 0;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="character" data-type="' . strtolower($row['type']) . '" onclick="showSlidingMenu(' . $row['id'] . ')">';
                echo '<img src="' . htmlspecialchars($row['photo']) . '" alt="' . htmlspecialchars($row['supname']) . '">';
                echo '<div class="character-name">' . htmlspecialchars($row['supname']) . '</div>';
                echo '<div class="character-realname">' . htmlspecialchars($row['realname']) . '</div>';
                echo '</div>';
                
                echo '<div class="details" id="details-' . $row['id'] . '" style="display:none;">';
                echo '<strong>Description:</strong><p>' . htmlspecialchars($row['description']) . '</p>';
                echo '<strong>Powers:</strong><p>' . implode(', ', json_decode($row['powers'])) . '</p>';
                echo '<strong>First Appearance:</strong><p>' . htmlspecialchars($row['first_appearance']) . '</p>';
                echo '<strong>Base of Operation:</strong><p>' . htmlspecialchars($row['base_of_operation']) . '</p>';
                echo '<strong>Status:</strong><p>' . ucfirst($row['status']) . '</p>';
                echo '</div>';

                $totalCount++;
            }
        } else {
            echo "No characters found.";
        }

        $conn->close();
        ?>
    </div>

    <script>
        updateCharacterCount(<?php echo $totalCount; ?>);
    </script>
</div>

<div class="sliding-menu" id="sliding-menu">
    <span class="close-menu" onclick="closeSlidingMenu()">×</span>
    <h2>Character Details</h2>
    <div id="menu-content"></div>
</div>

<?php include 'footer.php'; ?>

</body>
</html>
