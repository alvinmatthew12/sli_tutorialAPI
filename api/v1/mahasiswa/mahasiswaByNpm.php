<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json;");

include_once '../../config/database.php';
include_once '../../objects/mahasiswa.php';

$database = new Database();
$db = $database->getConnection();

$mahasiswa = new Mahasiswa($db);
$mahasiswa->npm = isset($_GET['npm']) ? $_GET['npm'] : null;
$mhs = $mahasiswa->getMahasiswaByNpm();

if($mahasiswa->npm != null) {
    $item = array();
    while($row = $mhs->fetch(PDO::FETCH_ASSOC)) {
        $item = array(
            "npm" => $row['npm'],
            "nama" => $row['nama'],
            'program_studi' => $row['program_studi']
        );
    }
    http_response_code(200);
    echo json_encode($item);
} else {
    http_response_code(400);
    echo json_encode(array("message" => "Data tidak lengkap."));
}