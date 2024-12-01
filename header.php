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
            background-color: #0d0d0d;
            color: #ffffff;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .navbar {
            display: flex;
            align-items: center;
            background: #1a1a1a;
            padding: 15px 30px;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
            transition: background 0.3s;
        }

        .navbar:hover {
            background: #121212;
        }

        .navbar-logo img {
            height: 50px;
            margin-right: 20px;
            border-radius: 10%;
        }

        .navbar-nav {
            display: flex;
            align-items: center;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .navbar-nav li {
            margin-right: 25px;
            position: relative;
        }

        .navbar-nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            transition: color 0.3s, transform 0.3s;
            padding: 10px 0;
        }

        .navbar-nav a:hover {
            color: #ffdd57;
            transform: scale(1.1);
        }

        .search-bar {
            flex-grow: 1;
            display: flex;
            justify-content: flex-end;
            margin-left: 20px;
        }

        .search-bar input[type="search"] {
            width: 220px;
            padding: 8px 10px;
            border: none;
            border-radius: 20px;
            outline: none;
            font-size: 14px;
            transition: box-shadow 0.3s, background 0.3s;
            background-color: #333;
            color: #ffffff;
        }

        .search-bar input[type="search"]:focus {
            box-shadow: 0px 0px 5px #ffdd57;
            background-color: #444;
        }

        .user-account {
            margin-left: 20px;
        }

        .user-account a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
            padding: 10px 20px;
            border: 1px solid #ffdd57;
            border-radius: 20px;
            transition: background-color 0.3s, color 0.3s;
        }

        .user-account a:hover {
            background-color: #ffdd57;
            color: #333;
        }

        .navbar-nav li:hover .dropdown-menu {
            display: block;
        }

        .more .dropdown-menu {
            display: none;
            position: absolute;
            top: calc(100% + 5px);
            left: 0;
            background-color: #2a2a2a;
            border-radius: 5px;
            margin-top: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.5);
            z-index: 999;
        }

        .more:hover .dropdown-menu {
            display: block;
        }

        .dropdown-menu li {
            padding: 10px;
        }

        .dropdown-menu li a {
            color: #ffffff;
        }

        .dropdown-menu li a:hover {
            color: #ffdd57;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="navbar-logo">
        <a href="Homepage.php">
            <img src="assests/images/logo.webp" alt="FableForge Logo">
        </a>
        </div>
        <ul class="navbar-nav">
            <li><a href="news.php">News</a></li>
            <li><a href="comics.php">Comics</a></li>
            <li><a href="chararcters.php">Characters</a></li>
            <li><a href="movies&tvshows.php">Movies & TV</a></li>
            <li><a href="#">Games</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li class="more">
                <a href="#">More</a>
                <ul class="dropdown-menu">
                    <li><a href="#">Events</a></li>
                    <li><a href="#">Videos</a></li>
                </ul>
            </li>
        </ul>
        <div class="search-bar">
            <input type="search" placeholder="Search FableForge">
        </div>
        <div class="user-account">
            <a href="sign_in.php">Login | Join</a>
        </div>
    </div>
</body>
</html>
