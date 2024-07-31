<?php
    // Enable error reporting for debugging
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    // Fetch form data
    $name = $_POST['name'];
    $role = $_POST['role'];
    $ig = $_POST['ig'];
    $twt = $_POST['twt'];
    $fb = $_POST['fb'];
    $li = $_POST['li'];
    $yt = $_POST['yt'];
    $th = $_POST['th'];
    $snap = $_POST['snap'];
    $git = $_POST['git'];
    $caption = $_POST['caption'];

    // Create connection
    $conn = new mysqli('localhost', 'root', '', 'test',3306);

    // Check connection
    if ($conn->connect_error) {
        die('Connection Failed: '.$conn->connect_error);
    }

    // Prepare statement
    $stmt = $conn->prepare("INSERT INTO entry (ig, nam, rol, twt, fb, li, yt, th, snap, git, caption) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt === false) {
        die('Prepare Failed: '.$conn->error);
    }

    // Bind parameters
    $stmt->bind_param("sssssssssss", $ig, $name, $role, $twt, $fb, $li, $yt, $th, $snap, $git, $caption);

    // Execute statement
    if ($stmt->execute()) {
        echo "Hey, your profile is ready! Rock with your link!";
    } else {
        echo 'Execute Failed: ' . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
?>
