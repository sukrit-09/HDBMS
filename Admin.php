<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header class="header">
        <a href="#" class="logo"> <i class="fas fa-heartbeat"></i> <strong>SS</strong> Health Care Reception </a>
    </header>

    <section id="admitted-patients">
        <h1>Booked Bed</h1>
        <!-- Search bar for Admitted Patients -->
        <input type="text" id="admitted-patient-search" placeholder="Search Patient Name">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Bed ID</th>
                    <th>Booking Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database configuration for admitted patients
                $host = "localhost"; // Change this to your MySQL server hostname
                $username = "root"; // Change this to your MySQL username
                $password = ""; // Change this to your MySQL password
                $database = "Hospital_DB"; // Change this to your MySQL database name

                // Create a database connection for admitted patients
                $mysqli = new mysqli($host, $username, $password, $database);

                // Check the connection
                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }

                // SQL query to fetch admitted patient data
                $query = "SELECT * FROM Patients";

                // Execute the query
                $result = $mysqli->query($query);

                // Check if the query was successful
                if ($result) {
                    // Fetch and display admitted patient data
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["PatientID"] . "</td>";
                        echo "<td>" . $row["PatientName"] . "</td>";
                        echo "<td>" . $row["BedID"] . "</td>";
                        echo "<td>" . $row["AdmissionDate"] . "</td>";
                        echo "</tr>";
                    }

                    // Free the result set
                    $result->free();
                } else {
                    echo "Error: " . $mysqli->error;
                }

                // Close the database connection
                $mysqli->close();
                ?>
            </tbody>
        </table>
    </section>

    <section id="appointments">
        <h1>Patients Appointments</h1>
        <!-- Search bar for Patients Appointments -->
        <input type="text" id="appointment-search" placeholder="Search Patient Name">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Database configuration for patient appointments
                $host = "localhost"; // Change this to your MySQL server hostname
                $username = "root"; // Change this to your MySQL username
                $password = ""; // Change this to your MySQL password
                $database = "contact_db"; // Change this to your MySQL database name

                // Create a database connection for patient appointments
                $mysqli = new mysqli($host, $username, $password, $database);

                // Check the connection
                if ($mysqli->connect_error) {
                    die("Connection failed: " . $mysqli->connect_error);
                }

                // SQL query to fetch data from the "contact_form" table
                $query = "SELECT * FROM contact_form";

                // Execute the query
                $result = $mysqli->query($query);

                // Check if the query was successful
                if ($result) {
                    // Fetch and display patient appointment data
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["number"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "</tr>";
                    }

                    // Free the result set
                    $result->free();
                } else {
                    echo "Error: " . $mysqli->error;
                }

                // Close the database connection
                $mysqli->close();
                ?>
            </tbody>
        </table>
    </section>

    <script src="admin.js"></script>
</body>
</html>
