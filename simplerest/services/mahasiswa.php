<?php

include 'db_conn.php';
include 'api_gate.php';

class Mahasiswa
{
    private $db, $gate;
    function __construct() {

        $this->db = new DbConn();
        $this->gate = new ApiGate();
        $this->db->connectNow();
    }

    public function show() {
        $validate = $this->gate->validate(array(),'get');

        if($validate['status']) {
            try {
                $sql = "SELECT * FROM mahasiswa a LEFT JOIN jurusan b ON a.jurusan = b.code_jurusan ";
                $exec = $this->db->conn->query($sql);

                $this->gate->customResponse(1, 'Show all data', $exec->fetch_all());

                $this->conn->close();
            } catch (Exception $e) {
                $this->gate->customResponse(0, $e->getMessage(), array());
            }
        }
    }

    public function get() {
        $validate = $this->gate->validate(array('nim'),'post');

        if($validate['status']) {
            try {
                $sql = "SELECT * FROM mahasiswa a LEFT JOIN jurusan b ON a.jurusan = b.code_jurusan WHERE nim = " . $_POST['nim'];
                $exec = $this->db->conn->query($sql);

                $this->gate->customResponse(1, 'Get specific data', $exec->fetch_assoc());

                $this->conn->close();
            } catch (Exception $e) {
                $this->gate->customResponse(0, $e->getMessage(), array());
            }
        }
    }

    public function create() {
        $validate = $this->gate->validate(array('nim', 'nama', 'tanggal_lahir', 'jurusan'),'post');

        if($validate['status']) {
            try {
                $sql = "INSERT INTO mahasiswa (nim, nama, tanggal_lahir, jurusan) VALUES (?,?,?,?)";
                $exec = $this->db->conn->prepare($sql);
                $exec->bind_param("sssi", $nim, $nama, $tanggal_lahir, $jurusan);
                $nim = $_POST['nim'];
                $nama = $_POST['nama'];
                $tanggal_lahir = $_POST['tanggal_lahir'];
                $jurusan = $_POST['jurusan'];

                if ($exec->execute()) {
                    $this->gate->customResponse(1, 'New record created', array());
                } else {
                    $this->gate->customResponse(1, $this->db->conn->error, array());
                }

                $this->conn->close();
            } catch (Exception $e) {
                $this->gate->customResponse(0, $e->getMessage(), array());
            }
        }
    }

    public function update() {
        $validate = $this->gate->validate(array('column', 'value', 'nim'),'post');

        if($validate['status']) {
            try {
                $sql = "UPDATE mahasiswa SET ".$_POST['column']." = ?  WHERE nim = ?";
                $exec = $this->db->conn->prepare($sql);
                $exec->bind_param("ss", $value, $nim);
                $value = $_POST['value'];
                $nim = $_POST['nim'];

                if ($exec->execute()) {
                    $this->gate->customResponse(1, 'Data updated', array());
                } else {
                    $this->gate->customResponse(0, $this->db->conn->error, array());
                }

                $this->conn->close();
            } catch (Exception $e) {
                $this->gate->customResponse(0, $e->getMessage(), array());
            }
        }
    }

    public function destroy() {
        $validate = $this->gate->validate(array('nim'),'post');

        if($validate['status']) {
            try {
                $sql = "DELETE FROM mahasiswa where nim = ?";
                $exec = $this->db->conn->prepare($sql);
                $exec->bind_param("s", $nim);
                $nim = $_POST['nim'];

                if ($exec->execute()) {
                    $this->gate->customResponse(1, 'Data removed', array());
                } else {
                    $this->gate->customResponse(0, $this->db->conn->error, array());
                }

                $this->conn->close();
            } catch (Exception $e) {
                $this->gate->customResponse(0, $e->getMessage(), array());
            }
        }
    }

    public function storeTugas() {
        $validate = $this->gate->validate(array('nim','judul'),'post');

        if($validate['status']) {
            $sql = "SELECT * FROM mahasiswa a LEFT JOIN jurusan b ON a.jurusan = b.code_jurusan WHERE nim = " . $_POST['nim'];
            $exec = $this->db->conn->query($sql);
            $data = $exec->fetch_assoc();
            $tugasId = $data['code_jurusan'].$data['nim'].date('ymd').$this->generateTugasId();

            try {
                $sqlTugas = "INSERT INTO tugas (tugas_id, judul) VALUES (?,?)";
                $execTugas = $this->db->conn->prepare($sqlTugas);
                $execTugas->bind_param("ss", $nim, $judul);
                $nim = $tugasId;
                $judul = $_POST['judul'];

                if ($execTugas->execute()) {
                    $this->gate->customResponse(1, 'New record created', array());
                } else {
                    $this->gate->customResponse(1, $this->db->conn->error, array());
                }

                $this->conn->close();
            } catch (Exception $e) {
                $this->gate->customResponse(0, $e->getMessage(), array());
            }


        }
    }

    public function generateTugasId() {
        $sqlTugas = "SELECT MAX(tugas_id) tugas_id FROM tugas";
        $execTugas = $this->db->conn->query($sqlTugas);
        $dataTugas = $execTugas->fetch_assoc();

        $order = intval(substr($dataTugas['tugas_id'], 3, 3));
        $order++;
        return sprintf("%03s", $order);;

        $this->conn->close();

    }


}