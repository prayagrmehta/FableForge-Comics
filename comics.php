<?php
$host = 'localhost';  
$db = 'fableforge';   
$user = 'root';       
$pass = '';           

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchQuery = '';
if (isset($_GET['search'])) {
    $searchQuery = $conn->real_escape_string($_GET['search']);
}

$limit = 21; 
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$sql = "SELECT * FROM comics WHERE 
        title LIKE '%$searchQuery%' OR 
        writer LIKE '%$searchQuery%' OR 
        penciller LIKE '%$searchQuery%' OR 
        cover_artist LIKE '%$searchQuery%' 
        ORDER BY publication_date DESC LIMIT $limit OFFSET $offset";
$result = $conn->query($sql);

$totalSql = "SELECT COUNT(*) AS total FROM comics WHERE 
             title LIKE '%$searchQuery%' OR 
             writer LIKE '%$searchQuery%' OR 
             penciller LIKE '%$searchQuery%' OR 
             cover_artist LIKE '%$searchQuery%'";
$totalResult = $conn->query($totalSql);
$totalRow = $totalResult->fetch_assoc();
$totalComics = $totalRow['total'];
$totalPages = ceil($totalComics / $limit);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comics Collection</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #1a1a1a;
            color: #e0e0e0;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: left;
            color: #e0e0e0;
            font-size: 36px;
            margin-bottom: 20px;
            padding-left: 20px;
        }
        h1:hover{
            text-shadow: 0 0 10px #00bfff, 0 0 20px #00bfff, 0 0 30px #00bfff, 0 0 40px #00bfff;
        }
        .search-bar {
            margin-bottom: 20px;
        }
        .search-bar input[type="text"] {
            width: 300px;
            padding: 10px;
            border-radius: 4px;
            border: 1px solid #ccc;
            margin-right: 10px;
        }
        .search-bar button {
            padding: 10px 15px;
            border: none;
            background-color: #00bfff;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }
        .search-bar button:hover {
            background-color: #007bbf;
        }
        .comic-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            padding-left: 20px;
        }
        .comic-card {
            background-color: #222;
            border: 2px solid #00bfff;
            border-radius: 8px;
            margin: 10px;
            padding: 15px;
            text-align: center;
            cursor: pointer;
            width: calc(30% - 20px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }
        .comic-card:hover {
            transform: scale(1.05);
            background-color: #333;
            box-shadow: 0 6px 15px rgba(0, 188, 255, 0.5);
        }
        .coverpage {
            width: 100%;
            height: auto;
            max-width: 160px;
            border-radius: 4px;
        }
        .title {
            font-size: 26px;
            font-weight: bold;
            color: #00bfff;
            margin: 10px 0;
        }
        .info {
            font-size: 14px;
            color: #ccc;
        }
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }
        .pagination a {
            color: #00bfff;
            padding: 10px 15px;
            margin: 0 5px;
            border: 1px solid #00bfff;
            border-radius: 5px;
            text-decoration: none;
        }
        .pagination a:hover {
            background-color: #333;
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?> 

<h1>Comics Collection</h1>

<!-- Search bar -->
<div class="search-bar">
    <form method="GET" action="">
        <input type="text" name="search" placeholder="Search by Title, Writer, Penciller, Cover Artist" value="<?php echo htmlspecialchars($searchQuery); ?>">
        <button type="submit">Search</button>
    </form>
</div>

<div class="comic-container">
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="comic-card" onclick="window.location.href=\'read_comics.php?file=' . urlencode($row['title']) . '\'">';
            echo '<img src="' . htmlspecialchars($row['coverpage']) . '" alt="Cover Image" class="coverpage">';
            echo '<div class="title">' . htmlspecialchars($row['title']) . '</div>';
            echo '<div class="info">Writer: ' . htmlspecialchars($row['writer']) . '</div>';
            echo '<div class="info">Penciller: ' . htmlspecialchars($row['penciller']) . '</div>';
            echo '<div class="info">Cover Artist: ' . htmlspecialchars($row['cover_artist']) . '</div>';
            echo '</div>';
        }
    } else {
        echo '<p>No comics found.</p>';
    }
    ?>
</div>

<div class="pagination">
    <?php
    for ($i = 1; $i <= $totalPages; $i++) {
        echo '<a href="?page=' . $i . '&search=' . urlencode($searchQuery) . '">' . $i . '</a>';
    }
    ?>
</div>

<?php include 'footer.php'; ?> 

</body>
</html>

<?php
$conn->close();
?>
