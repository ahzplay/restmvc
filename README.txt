
--  Tugas nomor 1 terdapat pada folder mymvc
--  Dapat dijalankan dengan url localhost/mymvc/home

--  Tugas nomor 2 dan 3 terdapat pada folder simplerest
--  Untuk menjalankan rest api bisa melihat route pada file index.php
--  DB bisa diimport dari file mahasiswa.sql

--  Query pada tugas nomor 4
    SELECT
	    jurusan jurusan_code, /*2 digit kode jurusan*/
	    UNIX_TIMESTAMP() timestamp_code, /*10 digit timestamp*/
	    LPAD(DAY(tanggal_lahir),2,0) birthday_code, /*tanggal lahir mahasiswa*/
	    MAX(RIGHT(nim, 3))+1 order_code, /*nomor urut 3 digit*/
	    CONCAT(jurusan, UNIX_TIMESTAMP(), LPAD(DAY(tanggal_lahir),2,0), MAX(RIGHT(nim, 3))+1) kode_mahasiswa
    FROM mahasiswa;

-- Tugas nomor 5 saya tidak begitu mengerti maksud dari soalnya




Tugas ini saya selesaikan dengan bantuan referensi dari internet tentunya,
sebelumnya saya ucapkan terimakasih untuk kesempatan yang telah diberikan kepada saya,
mohon maaf jika terdapat kesalahan..