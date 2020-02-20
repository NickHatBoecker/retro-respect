<?php
require_once 'helper.php';

$title = $_POST['title'] ?? uniqid();
$theme = $_POST['theme'] ?? 'pink';
$img = $_POST['imgBase64'] ?? '';
$img = str_replace(array('data:image/png;base64,', ' '), array('', '+'), $img);

$data = base64_decode($img);
$file = generateFilename($title, $theme);

file_put_contents($file, $data);
