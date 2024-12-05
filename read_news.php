<?php
session_start();

$timeout_duration = isset($_GET['timeout']) ? intval($_GET['timeout']) : 10;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    session_unset();
    session_destroy();
}

$_SESSION['last_activity'] = time();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FableForge";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$title = $writer = $newsType = $publishDate = $descriptionPath = $thumbnail = "N/A";

if (isset($_GET['NewsID'])) {
    $newsID = intval($_GET['NewsID']); 
    $stmt = $conn->prepare("SELECT * FROM news WHERE NewsID = ?");
    $stmt->bind_param("i", $newsID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row["Title"] ?? "N/A";
        $publishDate = $row["PublishDate"] ?? "N/A";
        $descriptionPath = $row["DescriptionPath"] ?? "N/A";
        $thumbnail = $row["Thumbnail"] ?? "N/A";
        $writer = $row["Writer"] ?? "N/A";
        $newsType = $row["NewsType"] ?? "N/A";
    } else {
        echo "<p>News not found.</p>";
        exit;
    }

    $stmt->close();
} else {
    echo "<p>Invalid request. No news ID provided.</p>";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($title); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            background: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            position: relative;
        }
        .news-details img {
            width: 100%;
            height: auto;
            border-radius: 5px;
        }
        .news-details h1 {
            font-size: 30px;
            margin-top: 10px;
            color: #35424a;
        }
        .news-details p {
            font-size: 16px;
            color: #666;
        }
        .back-icon {
            position: absolute;
            top: 20px;
            right: 20px;
            cursor: pointer;
        }
        .back-icon img {
            width: 30px;
            height: 30px;
        }
    </style>
    <script>

        const inactivityTimeout = <?php echo $timeout_duration * 1000; ?>;
        let timeout;

        function resetTimeout() {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                window.history.back(); 
            }, inactivityTimeout);
        }

        window.onload = resetTimeout;
        document.onmousemove = resetTimeout;
        document.onkeypress = resetTimeout;
        document.onclick = resetTimeout;
    </script>
</head>
<body>

<div class="container">
    <a href="javascript:history.back()" class="back-icon" title="Go Back">
        <abbr title="Go Back">
            <img src="assests/images/open-door.png" alt="Go Back">
        </abbr>
    </a>
    
    <div class="news-details">
        <img src="<?php echo htmlspecialchars($thumbnail); ?>" alt="Thumbnail">
        <h1><?php echo htmlspecialchars($title); ?></h1>
        <p><strong>By:</strong> <?php echo htmlspecialchars($writer); ?></p>
        <p><strong>Type:</strong> <?php echo htmlspecialchars($newsType); ?></p>
        <p><strong>Published on:</strong> <?php echo htmlspecialchars($publishDate); ?></p>
        <div>
            <h2>Content:</h2>
            <?php
            if (file_exists($descriptionPath)) {
                echo nl2br(htmlspecialchars(file_get_contents($descriptionPath)));
            } else {
                echo "<p>Content not available.</p>";
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>
