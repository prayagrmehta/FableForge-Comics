<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assests/images/logo.webp">
    <title>FableForge Comics</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #fff;
            color: #000;
        }

        .image-container {
            margin: 0;
            text-align: center;
        }

        .image-container img {
            width: 100%;
            height: auto;
        }

        .new-section {
            padding: 20px;
            background-color: #000;
            text-align: center;
        }

        .new-section h2 {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .new-section p {
            font-size: 16px;
            line-height: 1.5;
        }

        .container3 {
            display: flex;
            align-items: center; 
            padding: 20px;
            background-color: #474747;
            width: 100%;
            box-sizing: border-box;
        }

        .youtube-iframe {
            border: 8px solid #000000;
            margin-right: 20px;
            flex-shrink: 0;
            width: 560px; 
            height: 315px; 
        }

        .description {
            color: #fff;
            font-family: 'Comic Sans MS', cursive, sans-serif;
            font-size: 18px;
            line-height: 1.5;
            max-width: calc(100% - 580px);
        }
    </style>
</head>
<body>

<?php include 'header.php'; ?>

<div class="image-container">
    <img src="assests/images/john_constantine.jpg" alt="John Constantine Image">
</div>

<div class="new-section">
    <h2>Welcome to FableForge Comics</h2>
    <p>Discover a world of comics, TV shows, movies, and games. Explore our extensive collection and stay updated with the latest news and events. Join us on this exciting journey and immerse yourself in the universe of FableForge Comics.</p>
</div>

<div class="container3">
    <iframe class="youtube-iframe" src="https://www.youtube.com/embed/FbiRAcbCiGE" 
            title="YouTube video player" frameborder="0" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen>
    </iframe>
    <div class="description">
        In this scene, Lucifer Morningstar (the Devil) and John Constantine are discussing a plan to retrieve someone's soul from Purgatory. Lucifer is agreeing to help Constantine due to a debt he owes him, related to a character named Maze.
    </div>
</div>

<?php include 'footer.php'; ?> 

</body>
</html>
