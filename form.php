<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Admission Form</title>

    <!-- Font Awesome CDN link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="form.css">
</head>
<body>
    <header class="header">
        <a href="#" class="logo">
            <i class="fas fa-heartbeat"></i> <strong>SS</strong> Health Care
        </a>
    </header>

    <h1>Patient Admission Form</h1>

    <form action="process_form.php" method="post">
        <label for="doctor_name">Doctor's Name:</label>
        <input type="text" id="doctor_name" name="doctor_name" required><br>

        <label for="admission_date">Admission Date:</label>
        <input type="date" id="admission_date" name="admission_date" required><br>

        <label for="planned_procedure">Planned Procedure:</label>
        <input type="text" id="planned_procedure" name="planned_procedure" required><br>

        <label for="patient_name">Patient Name:</label>
        <input type text" id="patient_name" name="patient_name" required><br>

        <label for="date_of_birth">Date of Birth:</label>
        <input type="date" id="date_of_birth" name="date_of_birth" required><br>

        <label for="parent_name">Parent Name:</label>
        <input type="text" id="parent_name" name="parent_name" required><br>

        <label for="gender">Gender:</label>
        <div class="gender-input">
            <input type="radio" id="male" name="gender" value="Male">
            <label for="male">Male</label>

            <input type="radio" id="female" name="gender" value="Female">
            <label for="female">Female</label>

            <input type="radio" id="other" name="gender" value="Other">
            <label for="other">Other</label>
        </div>

        <label for="marital_status">Marital Status:</label>
        <select id="marital_status" name="marital_status">
            <option value="Single">Single</option>
            <option value="Married">Married</option>
            <option value="Divorced">Divorced</option>
            <option value="Widowed">Widowed</option>
        </select><br>

        <label for="employment_status">Employment Status:</label>
        <select id="employment_status" name="employment_status">
            <option value="Employed">Employed</option>
            <option value="Unemployed">Unemployed</option>
            <option value="Student">Student</option>
            <option value="Retired">Retired</option>
        </select><br>

        <label for="phone_number">Phone Number:</label>
        <input type="tel" id="phone_number" name="phone_number" required><br>

        <label for="emergency_phone_number">Emergency Phone Number:</label>
        <input type="tel" id="emergency_phone_number" name="emergency_phone_number" required><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="4" required></textarea><br>

        <input type="submit" value="Submit">
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the form when it's submitted
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "admitted_patients_db";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Retrieve and sanitize data from the form (do this for all fields)
    $doctor_name = mysqli_real_escape_string($conn, $_POST['doctor_name']);
    $admission_date = mysqli_real_escape_string($conn, $_POST['admission_date']);
    // Repeat for other fields

    // Build and execute the SQL query
    $sql = "INSERT INTO admitted_patients (doctor_name, admission_date, planned_procedure, patient_name, date_of_birth, parent_name, gender, marital_status, employment_status, phone_number, emergency_phone_number, email, address)
            VALUES ('$doctor_name', '$admission_date', '$planned_procedure', '$patient_name', '$date_of_birth', '$parent_name', '$gender', '$marital_status', '$employment_status', '$phone_number', '$emergency_phone_number', '$email', '$address')";

    if (mysqli_query($conn, $sql)) {
        echo "Patient details have been successfully stored.";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
    ?>

<script src="form.js"></script>
</body>
</html>
