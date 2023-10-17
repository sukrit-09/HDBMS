<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SS Hospitals</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="BED.css">
</head>
<body>
 
<!-- Header section starts -->
<header class="header">
    <a href="#" class="logo"> <i class="fas fa-heartbeat"></i> <strong>SS</strong> Health Care </a>
</header>
<!-- Header section ends -->

<!-- Register to Get Admitted section starts -->
<section class="registration-section">
    <h2>Register</h2>
    <?php
    if (isset($_POST['register'])) {
        // Create a MySQLi connection
        $conn = new mysqli('localhost', 'root', '', 'Hospital_DB');

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $patientName = $_POST["patientName"];
        $contactNumber = $_POST["contactNumber"];
        $email = $_POST["email"];
        $dateOfBirth = $_POST["dateOfBirth"];

        // Prepare and execute the SQL query to insert a new patient record
        $stmt = $conn->prepare("INSERT INTO Patients (PatientName, ContactNumber, Email, DateOfBirth, BedID) VALUES (?, ?, ?, ?, ?)");
    
        // Retrieve an available bed ID and store it in the Patients table
        $availableBedQuery = "SELECT BedID FROM BedAvailability WHERE AvailableBeds > 0 LIMIT 1";
        $bedResult = $conn->query($availableBedQuery);

        if ($bedResult->num_rows > 0) {
            $bedData = $bedResult->fetch_assoc();
            $bedID = $bedData['BedID'];
            $stmt->bind_param("ssssi", $patientName, $contactNumber, $email, $dateOfBirth, $bedID);

            if ($stmt->execute()) {
                // Registration successful, decrement the available beds count
                $conn->query("UPDATE BedAvailability SET AvailableBeds = AvailableBeds - 1 WHERE BedID = $bedID");
                echo "Registration successful! Bed ID: $bedID";
            } else {
                // Registration failed
                echo "Error: " . $stmt->error;
            }
        } else {
            echo "No available beds.";
        }

        $stmt->close();
        $conn->close();
    }
    ?>


    <form method="POST" action="">
        <label for="patientName">Patient Name:</label>
        <input type="text" id="patientName" name="patientName" required>
        
        <label for="contactNumber">Contact Number:</label>
        <input type="tel" id="contactNumber" name="contactNumber" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="dateOfBirth">Date of Birth:</label>
        <input type="date" id="dateOfBirth" name="dateOfBirth" required>
       
        <button type="submit" name="register">Submit</button>
    </form>
</section>
<!-- Register to Get Admitted section ends -->

<!-- Available Bed section starts -->
<section class="available-bed-section">
    <h2>Available Bed Information</h2>
    <?php
        // Create a MySQLi connection
        $conn = new mysqli('localhost', 'root', '', 'Hospital_DB');
    
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query the BedAvailability table to get available beds
        $sql = "SELECT BedID, AvailableBeds FROM BedAvailability";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<table>";
            echo "<tr><th>Bed ID</th><th>Available Beds</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row['BedID'] . "</td><td>" . $row['AvailableBeds'] . "</td></tr>";
            }

            echo "</table>";
        } else {
            echo "No available beds found.";
        }

        $conn->close();
    ?>
</section>
<!-- Available Bed section ends -->

<script src="register.js"></script>

</body>
</html>
