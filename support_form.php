<?php 
// Include database connection (adjust the credentials as needed)
$servername = "localhost";
$username = "root"; // change this to your database username
$password = ""; // change this to your database password
$dbname = "fableforge"; // your database name

// Create a connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form values
    $product = $_POST['product'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $description = $_POST['description'];

    // Insert data into the database
    $sql = "INSERT INTO customer_support (product, email, subject, first_name, last_name, description)
            VALUES ('$product', '$email', '$subject', '$first_name', '$last_name', '$description')";

    if ($conn->query($sql) === TRUE) {
        // Success message (injected as JavaScript for alert)
        echo "<script>
                alert('Your request has been sent successfully!');
                window.location.href = 'support_form.php'; // Optional: redirect to a different page
              </script>";
    } else {
        $errorMessage = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get in Touch - FableForge Support</title>
    <style>
        /* Basic Reset */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            align-items: stretch;
        }

        /* Container Styling */
        .container {
            margin:40px auto 30px auto;
            background-color: #fff;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            width: 90%;
            max-width: 600px;
        }
        
        /* Header Styling */
        h1 {
            font-size: 24px;
            color: #333;
            margin-bottom: 1.5rem;
            text-align: center;
            font-weight: 500;
        }
        
        /* Form Group Styling */
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        /* Label Styling */
        label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            color: #555;
            margin-bottom: 0.5rem;
        }
        
        /* Input, Select, Textarea Styling */
        input[type="text"],
        input[type="email"],
        select,
        textarea {
            width: 100%;
            padding: 0.8rem;
            font-size: 14px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f9f9f9;
            transition: border-color 0.3s;
        }
        input:focus,
        select:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
        }
        
        /* Two Columns for First and Last Name */
        .name-fields {
            display: flex;
            gap: 1rem;
        }
        .name-fields input[type="text"] {
            width: 100%;
        }

        /* Textarea Styling */
        textarea {
            resize: vertical;
            min-height: 100px;
        }

        /* Submit Button Styling */
        .submit-button {
            width: 100%;
            padding: 0.75rem;
            font-size: 16px;
            color: #fff;
            background-color: #d9534f;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: bold;
            transition: background-color 0.3s;
        }
        .submit-button:hover {
            background-color: #c9302c;
        }

        /* Success Message Styling */
        .success-message {
            display: none;
            text-align: center;
            color: #4CAF50;
            font-size: 18px;
            margin-top: 1rem;
            font-weight: bold;
        }

        /* Error Message Styling */
        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Get in Touch with FableForge Customer Support</h1>
        <form id="supportForm" action="support_form.php" method="POST">
            <div class="form-group">
                <label for="product">Please select a product</label>
                <select id="product" name="product" required>
                    <option value="" disabled selected>Select a product</option>
                    <option value="product1">Product 1</option>
                    <option value="product2">Product 2</option>
                    <option value="product3">Product 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
                <div class="error-message" id="emailError"></div>
            </div>
            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" id="subject" name="subject" required>
                <div class="error-message" id="subjectError"></div>
            </div>
            <div class="form-group name-fields">
                <div>
                    <label for="first-name">First Name</label>
                    <input type="text" id="first-name" name="first-name" required>
                </div>
                <div>
                    <label for="last-name">Last Name</label>
                    <input type="text" id="last-name" name="last-name" required>
                </div>
            </div>
            <div class="form-group">
                <label for="description">How can we help?</label>
                <textarea id="description" name="description" placeholder="Describe your issue in detail..." required></textarea>
                <div class="error-message" id="descriptionError"></div>
            </div>
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </div>
</body>
</html>
<?php include 'footer.php'; ?>
