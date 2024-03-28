<?php
// Establish database connection with default values for username and password
$servername = "localhost";
$username = "root"; // Change this to your MySQL username
$password = ""; // Change this to your MySQL password

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database and switch to it
$sql = "CREATE DATABASE IF NOT EXISTS myDB";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully<br>";
    $conn->select_db("myDB");
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Create patients table if not exists
$sql = "CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    age INT,
    patient_condition VARCHAR(255) -- Changed from 'condition' to 'patient_condition'
)";
if ($conn->query($sql) === TRUE) {
    echo "Table 'patients' created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Collect form data
$patient_name = $_POST['patient_name'] ?? '';
$patient_age = $_POST['patient_age'] ?? '';
$patient_condition = $_POST['patient_condition'] ?? '';

// Insert patient data
$sql = "INSERT INTO patients (name, age, patient_condition) VALUES ('$patient_name', '$patient_age', '$patient_condition')";
if ($conn->query($sql) === TRUE) {
    echo "Patient data inserted successfully<br>";
} else {
    echo "Error inserting patient data: " . $conn->error . "<br>";
}

$conn->close();
?>
