<?php
include "header.php";
include "functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name = formatName($_POST["name"]);
        $email = $_POST["email"];
        $skills = cleanSkills($_POST["skills"]);

        if (!validateEmail($email)) {
            throw new Exception("Invalid email format.");
        }

        saveStudent($name, $email, $skills);
        echo "<p>Student saved successfully!</p>";

    } catch (Exception $e) {
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }
}
?>

<form method="post">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Skills (comma-separated): <input type="text" name="skills" required><br><br>
    <button type="submit">Save Student</button>
</form>

<?php include "footer.php"; ?>
