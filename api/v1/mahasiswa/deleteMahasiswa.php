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

if(!empty($data->npm)) {
    $mahasiswa->npm = $data->npm;

    if($mahasiswa->deleteMahasiswa()) {
        http_response_code(200);
        echo json_encode(array("message" => "Mahasiswa berhasil dihapus"));
    } else {
        http_response_code(503);
        echo json_encode(array("message" => "Mahasiswa gagal dihapus"));   
    }

} else {
    http_response_code(400);
    echo json_encode(array("message" => "Data mahasiswa gagal dihapus. Data tidak lengkap"));
}