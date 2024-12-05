<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";  // Set your MySQL password here
$dbname = "fableforge";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$signupMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);
    $confirm_password = trim($_POST["confirm_password"]);

    // Basic validation
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $signupMessage = "Invalid email format.";
    } elseif (strlen($password) < 6) {
        $signupMessage = "Password must be at least 6 characters long.";
    } elseif ($password !== $confirm_password) {
        $signupMessage = "Passwords do not match.";
    } else {
        // Check if email already exists
        $email_check = $conn->prepare("SELECT email FROM users WHERE email = ?");
        $email_check->bind_param("s", $email);
        $email_check->execute();
        $email_check->store_result();

        if ($email_check->num_rows > 0) {
            $signupMessage = "Email already exists!";
            $email_check->close();
        } else {

            // Insert user into database
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?,?, ?)");
            $stmt->bind_param("sss",$name, $email, $password);

            if ($stmt->execute()) {
                $signupMessage = "Sign-up successful!";
                header("Location: sign_in.php");
                exit();
            } else {
                $signupMessage = "Error: " . $stmt->error;
            }

            $stmt->close();
        }
    }
}

// Close connection
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Glassmorphism Sign-Up Form</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@200;300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Open Sans", sans-serif;
    }
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      width: 100%;
      padding: 0 10px;
      position: relative;
    }
    body::before {
      content: "";
      position: absolute;
      width: 100%;
      height: 100%;
      background: url("assests/images/login_bg.jpg"), #000;
      background-position: center;
      background-size: cover;
      z-index: -1;
    }
    .wrapper {
      width: 400px;
      border-radius: 8px;
      padding: 30px;
      text-align: center;
      border: 1px solid rgba(255, 255, 255, 0.5);
      backdrop-filter: blur(8px);
      -webkit-backdrop-filter: blur(8px);
    }
    form {
      display: flex;
      flex-direction: column;
    }
    h2 {
      font-size: 2rem;
      margin-bottom: 20px;
      color: #fff;
    }
    .input-field {
      position: relative;
      border-bottom: 2px solid #ccc;
      margin: 15px 0;
    }
    .input-field label {
      position: absolute;
      top: 50%;
      left: 0;
      transform: translateY(-50%);
      color: #fff;
      font-size: 16px;
      pointer-events: none;
      transition: 0.15s ease;
    }
    .input-field input {
      width: 100%;
      height: 40px;
      background: transparent;
      border: none;
      outline: none;
      font-size: 16px;
      color: #fff;
    }
    .input-field input:focus ~ label,
    .input-field input:valid ~ label {
      font-size: 0.8rem;
      top: 10px;
      transform: translateY(-120%);
    }
    .forget {
      display: flex;
      align-items: center;
      justify-content: space-between;
      margin: 25px 0 35px 0;
      color: #fff;
    }
    #remember {
      accent-color: #fff;
    }
    .forget label {
      display: flex;
      align-items: center;
    }
    .forget label p {
      margin-left: 8px;
    }
    .wrapper a {
      color: #efefef;
      text-decoration: none;
    }
    .wrapper a:hover {
      text-decoration: underline;
    }
    button {
      background: #fff;
      color: #000;
      font-weight: 600;
      border: none;
      padding: 12px 20px;
      cursor: pointer;
      border-radius: 3px;
      font-size: 16px;
      border: 2px solid transparent;
      transition: 0.3s ease;
    }
    button:hover {
      color: #fff;
      border-color: #fff;
      background: rgba(255, 255, 255, 0.15);
    }
    .register {
      text-align: center;
      margin-top: 30px;
      color: #fff;
    }
  </style>
</head>
<body>
  <div class="wrapper">
    <form action="" method="POST">
      <h2>Sign Up</h2>
      <div class="input-field">
        <input type="text" name="name" required>
        <label>Enter your name</label>
      </div>
      <div class="input-field">
        <input type="email" name="email" required>
        <label>Enter your email</label>
      </div>
      <div class="input-field">
        <input type="password" name="password" required>
        <label>Create a password</label>
      </div>
      <div class="input-field">
        <input type="password" name="confirm_password" required>
        <label>Confirm your password</label>
      </div>
      <button type="submit">Sign Up</button>
      <div class="register">
        <p>Already have an account? <a href="sign_in.php">Log In</a></p>
      </div>
    </form>
    <?php
      if ($signupMessage != "") {
          echo "<p style='color: red;'>" . $signupMessage . "</p>";
      }
    ?>
  </div>
</body>
</html>
