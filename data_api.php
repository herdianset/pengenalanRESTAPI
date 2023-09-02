<?php

header("Content-Type: application/json; charset=UTF-8");
include "class/mahasiswa_class.php";
$mhs = new mahasiswa();

$method = $_SERVER["REQUEST_METHOD"];

function sendResponse($status, $data = null)
{
    http_response_code($status);
    echo json_encode($data);
}

if($method == "GET"){
    //ambil data dari database
    $datamhs = $mhs->getMahasiswa();
    //kirim respons ke klient
    sendResponse(200, $datamhs);
}elseif($method == "POST"){
    //mengambil data
    $data = json_decode(file_get_contents("php://input"), true);
    //insert data ke database
    $insert = $mhs->insertMahasiswa($data);
    if($insert){
        $res = "Data berhasil disimpan";
    }else{
        $res = "Data gagal disimpan";
    }
    sendResponse(200, $res);
}elseif($method == "PUT"){
    $data = json_decode(file_get_contents("php://input"), true);
    $update = $mhs->updateMahasiswa($data);
    if($update){
        $res = $data['nim'] . " Berhasil di Update";
    }else{
        $res = $data['nim'] . " Gagal di Update";
    }
    sendResponse(200,"Data ". $res);

}elseif($method == "DELETE"){
    $data = json_decode(file_get_contents("php://input"), true);
    $delete = $mhs->deleteMahasiswa($data['nim']);
    if($delete){
        $res = $data['nim'] . " Berhasil di Hapus";
    }else{
        $res = $data['nim'] . " Gagal di Hapus";
    }
    sendResponse(200, $res);
}else{
    sendResponse(405, "Method invalid");
}