<?php
$files = scandir('./'); // Get files in the current directory

echo "Files in directory:<br>";
foreach ($files as $file) {
    if ($file !== '.' && $file !== '..') {
        echo $file . "<br>";
    }
}
?>
