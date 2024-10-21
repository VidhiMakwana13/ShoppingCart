<?php
$conn = new mysqli("localhost", "root", "", "students");
$result = $conn->query("SELECT * FROM students");

$xml = new SimpleXMLElement('<students/>');

while ($row = $result->fetch_assoc()) {
    $student = $xml->addChild('student');
    $student->addChild('Id', $row['Id']);
    $student->addChild('name', $row['name']);
    $student->addChild('email', $row['email']);
}

$xml->asXML('students.xml');
echo "students.xml has been saved!";

?>
