<?php
include "header.php";

if (file_exists("students.txt")) {
    $students = file("students.txt");

    foreach ($students as $student) {
        list($name, $email, $skills) = explode("|", trim($student));
        $skillsArray = explode(",", $skills);

        echo "<h3>$name</h3>";
        echo "<p>Email: $email</p>";
        echo "<p>Skills:</p><ul>";

        foreach ($skillsArray as $skill) {
            echo "<li>$skill</li>";
        }

        echo "</ul><hr>";
    }
} else {
    echo "<p>No students found.</p>";
}

include "footer.php";
?>
