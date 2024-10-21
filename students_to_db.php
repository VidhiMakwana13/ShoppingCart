<?php
$xml = simplexml_load_file("students.xml");

foreach ($xml->student as $student) {
    $id = (int)$student->Id;
    $name = (string)$student->name;
    $email = (string)$student->email;

    $conn = new mysqli("localhost", "root", "", "students");
    $stmt = $conn->prepare("INSERT INTO students (Id, name, email) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $id, $name, $email);
    $stmt->execute();
    $mysqli->close();
    echo "Data inserted successfully!";
}
?>
