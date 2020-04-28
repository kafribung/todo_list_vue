<?php

header('Content-Type: application/json');

$localhost = 'localhost';
$username  = 'root';
$pass      = '';
$db        = 'vuejstodolist';
$link      = mysqli_connect($localhost, $username, $pass, $db) or die('Error Bosku') . mysqli_connect_error();

$request =  $_SERVER['REQUEST_METHOD'];

switch ($request) {
    case 'GET':
        $query  = "SELECT * FROM list";
        $result = mysqli_query($link, $query);
        if (mysqli_num_rows($result) > 0) {
            echo (json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC)));
            http_response_code(200);
        } else die('gagal bro');
        break;
    case 'POST':
        $text = $_POST['text'];
        $done = $_POST['done'];

        if (isset($text)) {
            $query  = "INSERT INTO list (text, done) VALUES ('$text', $done)";
            $result = mysqli_query($link, $query); 
            http_response_code(200);
        } else die('POST gagal bro');
        break;
    case 'DELETE':
        $id     = $_GET['id'];
        if (isset($id)) {
            $query  = "DELETE FROM list WHERE id=$id";
            $result = mysqli_query($link, $query);
            http_response_code(200);
        } else {
            http_response_code(400) ;
            die('POST gagal bro') ;
        }
        break;
    case 'PATCH':
        $id  = $_GET['id'];
        $done= $_GET['done'];

        if (isset($id) && isset($done)) {
            $query   = "UPDATE list SET done=$done WHERE id=$id";
            $request = mysqli_query($link, $query);
            http_response_code(200);
        } else {
            http_response_code(400);
            die('PATCH php gagal');
        }
        break;

    default:
        # code...
        break;
}
