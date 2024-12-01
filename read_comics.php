<?php
$host = 'localhost';
$db = 'fableforge';
$user = 'root';
$pass = '';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['file'])) {
    $title = $conn->real_escape_string($_GET['file']);

    $sql = "SELECT * FROM comics WHERE title = '$title'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $comic = $result->fetch_assoc();
    } else {
        echo "Error: Comic not found.";
        exit;
    }
} else {
    echo "Error: No comic specified.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($comic['title']); ?> - Comic Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #121212;
            color: #ffffff;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        .comic-detail {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 5px;
            padding: 20px;
            margin: auto;
            max-width: 800px;
        }
        .coverpage {
            width: 100%;
            height: auto;
            max-width: 250px;
            border: 1px solid #444;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            margin-top: 10px;
        }
        .info {
            font-size: 14px;
            color: #bbbbbb;
        }
        .description {
            margin: 20px 0 20px 0;
            font-size: 14px;
            color: #dddddd;
        }
        iframe {
            width: 100%;
            height: 600px;
            border: none;
        }
    </style>
</head>
<body>

<div class="comic-detail">
    <img src="<?php echo htmlspecialchars($comic['coverpage']); ?>" alt="Cover Image" class="coverpage">
    <div class="title"><?php echo htmlspecialchars($comic['title']); ?></div>
    <div class="info">Writer: <?php echo htmlspecialchars($comic['writer']); ?></div>
    <div class="info">Penciller: <?php echo htmlspecialchars($comic['penciller']); ?></div>
    <div class="info">Cover Artist: <?php echo htmlspecialchars($comic['cover_artist']); ?></div>
    <div class="info">Publication Date: <?php echo htmlspecialchars($comic['publication_date']); ?></div>
    <div class="description"><?php echo nl2br(htmlspecialchars($comic['description'])); ?></div>

    <?php if (!empty($comic['comic_path'])): ?>
        <iframe src="<?php echo htmlspecialchars($comic['comic_path']) .'?viewer=embed'; ?>" type="application/pdf"></iframe>
    <?php else: ?>
        <div>Error: PDF not available.</div>
    <?php endif; ?>
</div>

</body>
</html>

<?php
$conn->close();
?>
