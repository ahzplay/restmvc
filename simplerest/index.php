<?php
require_once('route.php');
require_once('services/mahasiswa.php');

$mahasiswa = new Mahasiswa();

//service request
switch ($request) {
    case 'show': //method=get parameter=tidak ada
        $mahasiswa->show();
    break;
    case 'get': //method=post parameter=nim
        $mahasiswa->get();
        break;
    case 'create': //method=post parameter='nim', 'nama', 'tanggal_lahir', 'jurusan' (kode_jurusan)
        $mahasiswa->create();
    break;
    case 'update': //method=post parameter='column', 'value', 'nim'
        $mahasiswa->update();
    break;
    case 'destroy': //method=post parameter=nim
        $mahasiswa->destroy();
    break;
    case 'store-tugas': //method=post parameter='nim', 'judul'
        $mahasiswa->storeTugas();
    break;

    default:
        http_response_code(404);
        echo json_encode(array('status'=>404,'message'=>'Request not found','data'=>array()));
}

//UNTUK MEMANGGIL API -> localhost/simplerest/<nama service request>
//HEADERS :
//  api-key = theblueschelseaisthebest
?>