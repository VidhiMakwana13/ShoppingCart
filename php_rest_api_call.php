<?php
$url = 'http://localhost:3000/api/students'; // Replace with your Express API endpoint

$response = file_get_contents($url);
$data = json_decode($response, true);

if ($data) {
    foreach ($data as $students) {
        echo " Name: " . htmlspecialchars($students['name']) . ", Email: " . htmlspecialchars($students['email']) . "<br>";
    }
} else {
    echo "Failed to retrieve data.";
}
?>
