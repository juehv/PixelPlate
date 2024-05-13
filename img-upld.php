<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo "Method Not Allowed";
    exit;
}

$apiKey = $_SERVER['HTTP_X_API_KEY'] ?? null;
if (!$apiKey) {
    http_response_code(400);
    echo "API Key is missing";
    exit;
}

if (empty($_FILES['images'])) {
    http_response_code(400);
    echo "No images provided";
    exit;
}

$directory = "img/$apiKey";
if (!file_exists($directory)) {
    if (!mkdir($directory, 0777, true)) {
        http_response_code(500);
        echo "Failed to create directory";
        exit;
    }
}

$date = date('YmdHis');
foreach ($_FILES['images']['tmp_name'] as $index => $tmpName) {
    $destination = "$directory/$date-$index.jpg";
    if (!move_uploaded_file($tmpName, $destination)) {
        http_response_code(500);
        echo "Failed to save image $index";
        exit;
    }
}

http_response_code(200);
echo "Images uploaded successfully";
?>