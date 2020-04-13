<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../objects/mahasiswa.php';

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);
$data = json_decode(file_get_contents("php://input"));

if(
    !empty($data->npm) &&
    !empty($data->nama) &&
    !empty($data->program_studi)
) {
    $mahasiswa->npm = $data->npm;
    $mahasiswa->nama = $data->nama;
    $mahasiswa->program_studi = $data->program_studi;

    if($mahasiswa->addMahasiswa()) {
        http_response_code(201);
        echo json_encode(array("message" => "Data mahasiswa berhasil disimpan"));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Data mahasiswa gagal disimpan"));
    }
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Data mahasiswa gagal disimpan. Data tidak lengkap"));
}