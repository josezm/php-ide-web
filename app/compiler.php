<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}



$language = strtolower($_POST['language']);
$code = $_POST['code'];

$filePath = "temp/" . 'file' . "." . $language;
$programFile = fopen($filePath, "w");
fwrite($programFile, $code);
fclose($programFile);

if ($language == "php") {
    $output = shell_exec("php $filePath 2>&1");
    echo $output;
}
if ($language == "python") {
    $output = shell_exec("python3 $filePath 2>&1");
    echo $output;
}
if ($language == "javascript") {
    rename($filePath, $filePath . ".js");
    $output = shell_exec("node $filePath.js 2>&1");
    echo $output;
}
