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
$mhs = $mahasiswa->getAllMahasiswa();
$num = $mhs->rowCount();

if($num > 0) {
    $item_arr = array();
    while($row = $mhs->fetch(PDO::FETCH_ASSOC)) {
        $item = array(
            "npm" => $row['npm'],
            "nama" =>  $row['nama'],
            "program_studi" => $row['program_studi'],
        );
        array_push($item_arr, $item);
    }
    http_response_code(200);
    echo json_encode($item_arr);
} else {
    http_response_code(404);
    echo json_encode(
        array("message" => "Tidak ada mahasiswa")
    );
}
