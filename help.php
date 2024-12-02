<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "fableforge";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $product = $_POST['product'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $firstName = $_POST['first-name'];
    $lastName = $_POST['last-name'];
    $description = $_POST['description'];

    $sql = "INSERT INTO customer_support (product, email, subject, first_name, last_name, description)
            VALUES ('$product', '$email', '$subject', '$firstName', '$lastName', '$description')";

    if ($conn->query($sql) === TRUE) {
        header("Location: ?status=success");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FableForge Comics Help Center</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: stretch;
        }

        .container {
            margin: 40px auto 30px auto;
            max-width: 800px;
            padding: 30px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .welcome-section {
            position: relative;
            padding: 60px 20px;
            border-radius: 8px;
            margin-bottom: 40px;
            color: #ffffff;
            text-align: center;
            overflow: hidden;
        }

        .welcome-section::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('https://hips.hearstapps.com/hmg-prod/images/mhcomics-landingpage-lead-6659f1a3c2a2d.jpg?crop=0.753xw:1.00xh;0.125xw,0&resize=1200:*') no-repeat center center/cover;
            opacity: 0.3;
            z-index: 0;
        }

        .welcome-section::after {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .welcome-section h1,
        .welcome-section p {
            position: relative;
            z-index: 2;
        }

        .welcome-section h1 {
            font-size: 2.5em;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .welcome-section p {
            font-size: 1.1em;
            line-height: 1.6;
        }

        h2 {
            font-size: 1.8em;
            color: #333;
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 5px;
            text-align: center;
        }

        .popular-topics {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Helvetica, Arial, sans-serif;
            text-align: center;
            margin-bottom: 40px;
        }

        .topic-item {
            display: block;
            background-color: #f5f5f5;
            border: 1px solid #e0e0e0;
            padding: 18px 20px;
            border-radius: 4px;
            margin: 8px auto;
            max-width: 600px;
            color: #e62429;
            font-weight: 600;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .topic-item:hover {
            background-color: #e0e0e0;
        }

        .get-in-support_form {
            position: relative;
            display: inline-block;
            background-color: #e62429;
            color: #ffffff;
            padding: 12px 24px;
            margin-top: 20px;
            font-size: 1.1em;
            font-weight: bold;
            text-decoration: none;
            overflow: hidden;
        }

        .get-in-support_form::after {
            content: '';
            position: absolute;
            top: 0; left: 0;
            border-top: 20px solid white;
            border-right: 20px solid #e62429;
            width: 0;
        }

        .get-in-support_form:hover {
            background-color: #c81e25;
        }

        .business-hours {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e0e0e0;
        }

        .hours-list {
            list-style: none;
            padding-left: 0;
            font-size: 1.1em;
            color: #555;
            text-align: center;
        }

        .hours-item {
            margin-bottom: 8px;
        }

        .success-message {
            color: green;
            font-size: 1.2em;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>

    <script>
        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('status') === 'success') {
                alert("Your request has been submitted successfully!");
            }
        };
    </script>
</head>
<body>

    <div class="container">
        
        <section class="welcome-section">
            <h1>Welcome to FableForge Customer Support</h1>
            <p>Explore the world of FableForge, manage your subscriptions, and dive into exclusive content! We’re here to assist you every step of the way.</p>
        </section>

        <section class="popular-topics">
            <h2>POPULAR TOPICS</h2>
            
            <a href="#" class="topic-item">What is FableForge?</a>
            <a href="#" class="topic-item">How do I create an account?</a>
            <a href="#" class="topic-item">How can I upgrade my subscription?</a>
            <a href="#" class="topic-item">I want to learn more about purchased/redeemed digital comics.</a>

            <a href="support_form.php" class="get-in-support_form">GET IN TOUCH WITH US</a>
        </section>

        <section class="business-hours">
            <h2>Business Hours</h2>
            <ul class="hours-list">
                <li class="hours-item">Monday - Friday: 9:00 AM - 5:00 PM (PST)</li>
                <li class="hours-item">Saturday: 10:00 AM - 2:00 PM (PST)</li>
                <li class="hours-item">Sunday: Closed</li>
            </ul>
        </section>
    </div>

</body>
</html>

<?php include 'footer.php'; ?>
