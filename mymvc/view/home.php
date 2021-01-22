<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <h3>Daftar Starting Lineup Chelsea FC</h3>
    <table border="1">
        <tr>
            <td>Nama Pemain</td>
            <td>Posisi Pemain</td>
        </tr>
        <?php foreach ($data as $val) { ?>
        <tr>
            <td><?= $val['name'] ?></td>
            <td><?= $val['position'] ?></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>