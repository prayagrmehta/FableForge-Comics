<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "FableForge";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM news ORDER BY PublishDate DESC";
$result = $conn->query($sql);

$newsByType = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $newsType = isset($row["NewsType"]) ? $row["NewsType"] : "General";
        $newsByType[$newsType][] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FableForge News</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #121212;
            color: #e0e0e0;
            line-height: 1.6;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 80px auto 20px;
            padding: 20px;
            background: #1e1e1e;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            border-radius: 10px;
        }

        .news-section {
            margin-bottom: 30px;
        }

        .news-section h3 {
            color: #ffffff;
            margin-bottom: 15px;
            border-bottom: 2px solid #007bff;
            padding-bottom: 5px;
            font-size: 28px;
        }

        .news-items {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: flex-start;
        }

        .news-item {
            flex: 1 1 calc(25% - 20px);
            padding: 20px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            background: #2c2c2c;
            transition: transform 0.3s ease, background-color 0.3s ease;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
            display: flex;
            flex-direction: column;
            height: 300px;
            min-width: 250px;
            max-width: calc(25% - 20px);
        }

        .news-thumbnail img {
            width: 100%;
            height: 150px;
            border-radius: 8px;
            object-fit: cover;
        }

        .news-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .news-content h2 {
            font-size: 20px;
            color: #ffffff;
            margin-bottom: 10px;
        }

        .news-content p {
            font-size: 14px;
            color: #d1d1d1;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
        }

        .news-content a {
            color: #007bff;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease, color 0.3s ease;
            margin-top: 10px;
        }

        .news-content a:hover {
            color: #ffffff;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
            position: relative;
        }

        .pagination a {
            color: #007bff;
            text-decoration: none;
            margin: 0 5px;
            padding: 5px 10px;
            border-radius: 5px;
            transition: color 0.3s;
            display: inline-block;
        }

        .pagination a.current {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 5px;
        }

        .pagination a:hover:not(.current) {
            color: white;
        }

        footer {
            text-align: center;
            padding: 20px;
            background: #35424a;
            color: white;
            position: relative;
            bottom: 0;
            width: 100%;
        }

        @media (max-width: 768px) {
            .news-item {
                flex: 1 1 calc(100% - 20px);
            }
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="container">

<?php
foreach ($newsByType as $type => $newsItems) {
    $typeId = str_replace(' ', '_', $type);
    echo '<div class="news-section" id="' . htmlspecialchars($typeId) . '">';
    echo '<h3>' . htmlspecialchars($type) . ' Related News</h3>';
    echo '<div class="news-items"></div>';
    echo '<div class="pagination"></div>';
    echo '</div>';
}
?>

</div>

<?php include 'footer.php'; ?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const newsData = <?php echo json_encode($newsByType); ?>;
    const itemsPerPage = 4;

    function displayNews(type, page) {
        const section = document.getElementById(type);
        const newsItemsContainer = section.querySelector(".news-items");
        const paginationContainer = section.querySelector(".pagination");

        newsItemsContainer.innerHTML = "";
        paginationContainer.innerHTML = "";

        const newsItems = newsData[type] || [];
        const totalItems = newsItems.length;
        const totalPages = Math.ceil(totalItems / itemsPerPage);

        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, totalItems);

        for (let i = startIndex; i < endIndex; i++) {
            const item = newsItems[i];
            const newsHTML = `
                <div class="news-item">
                    <div class="news-thumbnail">
                        <img src="${item.Thumbnail || 'placeholder.jpg'}" alt="Thumbnail">
                    </div>
                    <div class="news-content">
                        <h2>${item.Title || 'N/A'}</h2>
                        <p><strong>By:</strong> ${item.Writer || 'Unknown Author'}</p>
                        <p><strong>Published on:</strong> ${item.PublishDate || 'N/A'}</p>
                        <p><a href="read_news.php?NewsID=${item.NewsID}">Read More</a></p>
                    </div>
                </div>
            `;
            newsItemsContainer.innerHTML += newsHTML;
        }

        const createPaginationLink = (page, label, isCurrent) => {
            const pageLink = document.createElement("a");
            pageLink.href = "#";
            pageLink.textContent = label;
            if (isCurrent) {
                pageLink.classList.add("current");
            }
            pageLink.addEventListener("click", (event) => {
                event.preventDefault();
                displayNews(type, page);
            });
            return pageLink;
        };

        if (page > 1) {
            const prevLink = createPaginationLink(page - 1, "Previous");
            paginationContainer.appendChild(prevLink);
        }

        for (let p = 1; p <= totalPages; p++) {
            const pageLink = createPaginationLink(p, p, p === page);
            paginationContainer.appendChild(pageLink);
        }

        if (page < totalPages) {
            const nextLink = createPaginationLink(page + 1, "Next");
            paginationContainer.appendChild(nextLink);
        }
    }

    for (const type in newsData) {
        displayNews(type, 1);
    }
});
</script>

</body>
</html>
