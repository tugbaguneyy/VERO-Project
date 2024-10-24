<?php
// upload.php

$targetDir = "uploads/";

$targetFile = $targetDir . basename($_FILES["image"]["name"]);
$uploadOk = 1;

$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Allow image files only
if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "Dosya bir resim - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Bu dosya bir resim değil.";
        $uploadOk = 0;
    }
}

// check the file size
if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, the file is too large.";
    $uploadOk = 0;
}

if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
    echo "Sorry, only JPG, JPEG, PNG and GIF files are allowed.";
    $uploadOk = 0;
}

if ($uploadOk == 0) {
    echo "Sorry, the file could not be loaded.";
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false]);
    }
}
