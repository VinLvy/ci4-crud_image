<!DOCTYPE html>
<html>
<head>
    <title>Data Mahasiswa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="mt-4">Data Mahasiswa</h1>
    <a href="/mahasiswa/create" class="btn btn-primary mb-3">Tambah Mahasiswa</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Foto Diri</th>
                <th>Foto KTP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($mahasiswa as $mhs): ?>
            <tr>
                <td><?= $mhs['nim']; ?></td>
                <td><?= $mhs['nama']; ?></td>
                <td><img src="/uploads/foto_diri/<?= $mhs['foto_diri']; ?>" width="100"></td>
                <td><img src="/uploads/foto_ktp/<?= $mhs['foto_ktp']; ?>" width="100"></td>
                <td>
                    <a href="/mahasiswa/edit/<?= $mhs['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="/mahasiswa/delete/<?= $mhs['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
