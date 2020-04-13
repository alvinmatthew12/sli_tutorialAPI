<?php

class Mahasiswa {
    private $connection;

    public $npm;
    public $nama;
    public $program_studi;

    public function __construct($db) {
        $this->connection = $db;
    }

    function getAllMahasiswa() {
        $query = "SELECT * FROM mahasiswa";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    function getMahasiswaByNpm() {
        $query = "SELECT * FROM mahasiswa WHERE npm=:npm";
        $stmt = $this->connection->prepare($query);

        $this->npm = htmlspecialchars(strip_tags($this->npm));
        $stmt->bindParam(":npm", $this->npm);

        $stmt->execute();
        return $stmt;
    }

    function addMahasiswa() {
        $query = "INSERT INTO mahasiswa(npm, nama, program_studi) VALUES (:npm, :nama, :program_studi)";
        $stmt = $this->connection->prepare($query);

        $this->npm = htmlspecialchars(strip_tags($this->npm));
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->program_studi = htmlspecialchars(strip_tags($this->program_studi));

        $stmt->bindParam(":npm", $this->npm);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":program_studi", $this->program_studi);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    function updateMahasiswa() {
        $query = "UPDATE mahasiswa SET nama=:nama, program_studi=:program_studi WHERE npm=:npm";
        $stmt = $this->connection->prepare($query);

        $this->npm = htmlspecialchars(strip_tags($this->npm));
        $this->nama = htmlspecialchars(strip_tags($this->nama));
        $this->program_studi = htmlspecialchars(strip_tags($this->program_studi));

        $stmt->bindParam(":npm", $this->npm);
        $stmt->bindParam(":nama", $this->nama);
        $stmt->bindParam(":program_studi", $this->program_studi);

        $stmt->execute();
        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    function deleteMahasiswa() {
        $query = "DELETE FROM mahasiswa WHERE npm=:npm";
        $stmt = $this->connection->prepare($query);

        $this->npm = htmlspecialchars(strip_tags($this->npm));
        $stmt->bindParam(":npm", $this->npm);

        $stmt->execute();
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}