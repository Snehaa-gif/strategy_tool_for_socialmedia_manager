<?php
// Database connection parameters
$host = 'localhost';  // Change if you're using a different host
$username = 'root';   // MySQL username (default for XAMPP is root)
$password = '';       // MySQL password (default for XAMPP is empty)
$dbname = 'your_database_name'; // Replace with your database name

// Create a connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $category = $_POST['category'];
    $post_type = $_POST['posttype'];
    $content_type = $_POST['contenttype'];
    $google_drive_link = $_POST['link'];

    // Check if the Google Drive link starts with the valid URL
    if (!filter_var($google_drive_link, FILTER_VALIDATE_URL) || !strpos($google_drive_link, 'https://drive.google.com/')) {
        echo "Please enter a valid Google Drive link.";
    } else {
        // Insert the data into the database
        $sql = "INSERT INTO archive_trends (category, post_type, content_type, google_drive_link)
                VALUES ('$category', '$post_type', '$content_type', '$google_drive_link')";

        if ($conn->query($sql) === TRUE) {
            echo "Trend saved successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
    // Close the connection
    $conn->close();
}
?>
