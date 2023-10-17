<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="login.css">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <header class="header">
        <a href="#" class="logo"> <i class="fas fa-heartbeat"></i> <strong>SS</strong> Health Care </a>
    </header>
    <div class="container">
        <h2>Login</h2>
        <form id="login-form" method="POST">
            <div class="form-group">
                <label for="loginAs">Login As</label>
                <select id="loginAs" name="login-as" required>
                    <option value="receptionist">Receptionist</option>
                    <option value="doctor">Doctor</option>
                    <option value="nurse">Nurse</option>
                    <option value="nonmedicalstaff">NonMedicalStaff</option>
                </select>
            </div>
            <div class="form-group">
                <label for="loginID">User Name</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <button type="submit" name="login">Login</button>
            </div>
        </form>
    </div>
    <?php
// Include the database connection configuration file
include('db_config.php'); // Replace 'db_config.php' with the actual filename

// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    // Get the submitted username and password
    $username = $_POST['username'];
    $password = $_POST['password'];

    // SQL query to fetch user data by username
    $sql = "SELECT user_id, password, signup_as FROM users WHERE username = ?";

    // Prepare the SQL statement
    $stmt = $pdo->prepare($sql);

    // Bind the username parameter
    $stmt->bindParam(1, $username, PDO::PARAM_STR);

    // Execute the query
    if ($stmt->execute()) {
        // Check if a row was returned
        if ($stmt->rowCount() == 1) {
            // Fetch the user data
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $storedPassword = $row['password'];
            $userRole = $row['signup_as'];

            // Verify the input password against the stored hashed password
            if (password_verify($password, $storedPassword)) {
                // Passwords match, user is authenticated

                // Define the redirection URLs for different user roles
                $redirections = array(
                    'receptionist' => 'Admin.php',
                    'doctor' => 'doctor_dashboard.php',
                    'nurse' => 'nurse_dashboard.php',
                    'nonmedicalstaff' => 'nonmedicalstaff_dashboard.php'
                );

                if (array_key_exists($userRole, $redirections)) {
                    $redirectURL = $redirections[$userRole];
                    header("Location: $redirectURL");
                    exit(); // Terminate script to ensure redirection
                } else {
                    echo "Invalid user role. Please contact the administrator.";
                }
            } else {
                // Passwords do not match
                echo "Invalid password. Please try again.";
            }
        } else {
            // User not found
            echo "User not found. Please check your username.";
        }
    } else {
        // Database query error
        echo "An error occurred while processing your request. Please try again later.";
    }
}
?>


    <!-- Include your JavaScript file if needed -->
    <script src="login.js"></script>
</body>
</html>
