<!DOCTYPE html>
<html>
<head>
    <title>Tambah Mahasiswa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container">
    <h1 class="mt-4">Tambah Data Mahasiswa</h1>
    <form action="/mahasiswa/store" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="nim">NIM</label>
            <input type="text" name="nim" id="nim" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" id="nama" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="foto_diri">Foto Diri</label>
            <input type="file" name="foto_diri" id="foto_diri" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="foto_ktp">Foto KTP</label>
            <input type="file" name="foto_ktp" id="foto_ktp" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
