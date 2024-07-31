<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Fetch the Instagram ID from the search input
$ig = htmlspecialchars($_GET['username'], ENT_QUOTES, 'UTF-8');

// Create connection using a configuration file
require 'config.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, DB_PORT);

// Check connection
if ($conn->connect_error) {
    die('Connection Failed: '.$conn->connect_error);
}

// Prepare the SQL statement to fetch user data
$stmt = $conn->prepare("SELECT nam, rol, twt, fb, li, yt, th, snap, git, caption FROM entry WHERE ig = ?");
if ($stmt === false) {
    die('Prepare Failed: '.$conn->error);
}

// Bind the Instagram ID parameter and execute the statement
$stmt->bind_param("s", $ig);
$stmt->execute();
$stmt->bind_result($name, $role, $twt, $fb, $li, $yt, $th, $snap, $git, $caption);
$stmt->fetch();

// Close the statement and connection
$stmt->close();
$conn->close();

// Format URLs
$ig_url = "https://www.instagram.com/" . htmlspecialchars($ig);
$twt_url = "https://www.twitter.com/" . htmlspecialchars($twt);
$th_url = "https://www.threads.net/" . htmlspecialchars($th);
$fb_url = "https://www.facebook.com/" . htmlspecialchars($fb);
$git_url = "https://github.com/" . htmlspecialchars($git);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me!</title>
    <link rel="stylesheet" href="style_pfp.css">
</head>
<body>
    <div class="mycontainer">
        <div><h2 style="text-shadow: brown;"><i><?php echo htmlspecialchars($name); ?></i></h2></div>
        <div><img src="logos/profile.jpg" alt="pfp" class="btn"></div>
        <div><h3><?php echo htmlspecialchars($role); ?></h3></div>
        <div><p><small><?php echo htmlspecialchars($caption); ?></small></p></div>
        <div>
            <a href="<?php echo $ig_url; ?>"><img src="logos/instagram.png" alt="ig"></a>
            <a href="<?php echo $twt_url; ?>"><img src="logos/twitter.png" alt="twt"></a>
            <a href="<?php echo $th_url; ?>"><img srcexit
            "logos/threads.png" alt="thread"></a>
            <a href="<?php echo $fb_url; ?>"><img src="logos/facebook.png" alt="fb"></a>
            <a href="<?php echo $git_url; ?>"><img src="logos/github.png" alt="hub"></a>
            <a href="<?php echo htmlspecialchars($li); ?>"><img src="logos/linkedin.png" alt="in"></a>
            <a href="<?php echo htmlspecialchars($yt); ?>"><img src="logos/youtube.png" alt="youtube"></a>
            <a href="<?php echo htmlspecialchars($snap); ?>"><img src="logos/snapchat.png" alt="snap"></a>
        </div>
    </div>
</body>
</html>
