<?php

function formatName($name) {
    return ucwords(trim($name));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(",", $string);
    return array_map("trim", $skills);
}

function saveStudent($name, $email, $skillsArray) {
    $data = $name . "|" . $email . "|" . implode(",", $skillsArray) . PHP_EOL;
    file_put_contents("students.txt", $data, FILE_APPEND);
}

function uploadPortfolioFile($file) {
    $allowedTypes = ["application/pdf", "image/jpeg", "image/png"];
    $maxSize = 2 * 1024 * 1024; // 2MB

    // Validate file type
    if (!in_array($file["type"], $allowedTypes)) {
        throw new Exception("Invalid file type.");
    }

    // Validate file size
    if ($file["size"] > $maxSize) {
        throw new Exception("File size exceeds 2MB.");
    }

    $uploadDir = "uploads/";

    // Create upload directory if it doesn't exist
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Rename the file with timestamp to avoid conflicts
    $newName = time() . "_" . basename($file["name"]);

    if (!move_uploaded_file($file["tmp_name"], $uploadDir . $newName)) {
        throw new Exception("Failed to move uploaded file.");
    }

    return $newName;
}

?>
