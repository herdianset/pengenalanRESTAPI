<?php

// Mendefinisikan header HTTP untuk memastikan response dalam format JSON
header("Content-Type: application/json; charset=UTF-8");

// Mendefinisikan metode HTTP yang diterima
$method = $_SERVER["REQUEST_METHOD"];

function sendResponse($status, $data = null)
{
    http_response_code($status);
    echo json_encode($data);
}

$mahasiwa = [
    ["nim" => 22001010, "nama" => "Made Budi", "Alamat" => "Denpasar"],
    ["nim" => 22001011, "nama" => "Putu Silvia", "Alamat" => "Tabanan"],
];

if($method == "GET"){
    
    sendResponse(200, $mahasiwa);
}elseif($method == "POST"){
    // Menerima data dari request
    $data = json_decode(file_get_contents("php://input"), true);

    sendResponse(200, $data['nama']);
}elseif($method == "PUT"){
    // Menerima data dari request
    $data = json_decode(file_get_contents("php://input"), true);

    sendResponse(200, "Data edit " . $data['nim']);

}elseif($method == "DELETE"){
    // Menerima data dari request
    $data = json_decode(file_get_contents("php://input"), true);

    sendResponse(200, "Data delete " . $data['nim']);
}else{
    sendResponse(405, "Method invalid");

}
