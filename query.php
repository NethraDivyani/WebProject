<?php
// Establishing connection to the database
$conn = mysqli_connect('localhost', 'root', '', 'shop_DB');

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Checking if form data is submitted
if (isset($_POST['query']) && isset($_POST['name']) && isset($_POST['email'])) {
    // Sanitizing and securing user inputs
    $query = mysqli_real_escape_string($conn, $_POST['query']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Inserting data into the 'contact_us' table
    $insert = "INSERT INTO contact_us (user_query, user_name, user_email) VALUES ('$query', '$name', '$email')";
    if (mysqli_query($conn, $insert)) {
        echo '<script>alert("Your message has been submitted successfully!"); window.location.href = "ContactUs.html";</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '"); window.location.href = "ContactUs.html";</script>';
    }
}

// Closing database connection
mysqli_close($conn);
?>
