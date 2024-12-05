<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .header,.footer{
            width: 100%;
        }
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            background: radial-gradient(circle at top, #0f0f1a, #1a1a2e, #111);
            color: #eee;
            overflow: hidden;
        }

        header, footer {
            width: 100%;
            padding: 15px 0;
            background-color: #1a1a2e;
            color: #fff;
            text-align: center;
        }

        .container {
            max-width: 500px;
            width: 100%;
            padding: 30px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 12px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.5);
            animation: fadeIn 1.2s ease-in-out;
            backdrop-filter: blur(8px);
            text-align: center;
            margin: 50px auto;
        }

        h1 {
    font-size: 2.5rem; 
    margin-bottom: 15px;
    color: #ff4d4d;
    text-shadow: 0 0 5px #ff4d4d;
}
        p {
            font-size: 1.2rem;
            color: #bbb;
        }

        .button {
            display: inline-block;
            margin-top: 20px;
            padding: 12px 25px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: bold;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(255, 77, 77, 0.3);
        }

        .button:hover {
            background-color: #ff4d4d;
            box-shadow: 0 0 10px #ff4d4d, 0 0 20px #ff4d4d;
            color: #000;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="header"><?php include 'header.php'; ?></div>

    <div class="container">
        <h1>No Movies and TV Currently Available</h1>
        <p>Please check back later for new releases.</p>
        <a href="#" class="button">Browse Upcoming Releases</a>
    </div>

    <div class="footer"><?php include 'footer.php'; ?></div>
</body>
</html>