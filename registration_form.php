<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration form</title>
</head>

<body>
    <h2>Registration Form for Alumni</h2>
    <form action="registration_form.php" method="POST">
        <h3>Personal Details</h3>
        Name: <input type="text" name="name" required><br><br>
        Parentage: <input type="text" name="parentage" required><br><br>
        Date of Birth: <input type="date" name="dob" required><br><br>
        Engg. Branch: <input type="text" name="branch" required><br><br>
        Admission Year: <input type="number" name="admission_year" required><br><br>
        Year of Passing: <input type="number" name="passing_year" required><br><br>
        Updated Qualification: <input type="text" name="qualification"><br><br>
        Employed (Govt/Semi-Govt/Private/Self): <input type="text" name="employment"><br><br>
        Presently Working At: <input type="text" name="working_at"><br><br>
        Designation: <input type="text" name="designation"><br><br>

        <h3>Contact Details</h3>
        E-Mail ID: <input type="email" name="email" required><br><br>
        Contact No.: <input type="text" name="contact_no" required><br><br>
        Address: <textarea name="address" rows="4" cols="40" required></textarea><br><br>

        <input type="submit" value="Submit">
    </form>

    <?php
    // Database connection details
    $servername = "localhost";
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $dbname = "registration form"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $name = $_POST['name'];
    $parentage = $_POST['parentage'];
    $dob = $_POST['dob'];
    $branch = $_POST['branch'];
    $admission_year = $_POST['admission_year'];
    $passing_year = $_POST['passing_year'];
    $qualification = $_POST['qualification'];
    $employment = $_POST['employment'];
    $working_at = $_POST['working_at'];
    $designation = $_POST['designation'];
    $email = $_POST['email'];
    $contact_no = $_POST['contact_no'];
    $address = $_POST['address'];

    // Insert data into database
    $sql = "INSERT INTO register (name, parentage, dob, branch, admission_year, passing_year, qualification, employment, working_at, designation, email, contact_no, address) 
        VALUES ('$name', '$parentage', '$dob', '$branch', '$admission_year', '$passing_year', '$qualification', '$employment', '$working_at', '$designation', '$email', '$contact_no', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
    ?>
</body>

</html>