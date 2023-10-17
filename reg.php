<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <title>Signup Page</title>
</head>
<body>
    <header class="header">
        <a href="#" class="logo"> <i class="fas fa-heartbeat"></i> <strong>SS</strong> Health Care </a>
    </header>
    <h2>Signup</h2>
    <div class="container">
        <form id="signup-form" action="signup.php" method="POST">
            <div class="form-group">
                <label for="signup-as">Signup As</label>
                <select id="signup-as" name="signup-as" required>
                    <option value="receptionist">Receptionist</option>
                    <option value="doctor">Doctor</option>
                    <option value="nurse">Nurse</option>
                    <option value="nonmedicalstaff">NonMedicalStaff</option>
                </select>
            </div>
            <div class="form-group">
                <label for="email">Gmail ID</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>
            <button type="submit" name="submit">Sign Up</button>
        </form>
    </div>
    <?php
    if (isset($_POST['submit'])) {
        $signupAs = $_POST['signup-as'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm-password'];

        if ($password === $confirmPassword) {
            $mysqli = new mysqli("localhost", "root", "", "signup_db");

            if ($mysqli->connect_error) {
                die("Connection failed: " . $mysqli->connect_error);
            }

            // Use password_verify for password validation
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users (signup_as, email, username, password) VALUES (?, ?, ?, ?)";
            $stmt = $mysqli->prepare($sql);
            $stmt->bind_param("ssss", $signupAs, $email, $username, $hashedPassword);

            if ($stmt->execute()) {
                header("Location: login.php");
                exit;
            } else {
                echo "Error: " . $stmt->error;
            }

            $stmt->close();
            $mysqli->close();
        } else {
            echo "Password and confirm password do not match.";
        }
    }
    ?>
    <script src="signup.js"></script>
</body>
</html>
