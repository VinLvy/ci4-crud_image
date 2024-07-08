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
                    <?php foreach ($mahasiswa as $mhs) : ?>
                        <tr>
                            <td><?= $mhs['nim']; ?></td>
                            <td><?= $mhs['nama']; ?></td>
                            <td><img src="/uploads/foto_diri/<?= $mhs['foto_diri']; ?>" width="100" data-toggle="modal" data-target="#fotoModal" data-img="/uploads/foto_diri/<?= $mhs['foto_diri']; ?>"></td>
                            <td><img src="/uploads/foto_ktp/<?= $mhs['foto_ktp']; ?>" width="100" data-toggle="modal" data-target="#fotoModal" data-img="/uploads/foto_ktp/<?= $mhs['foto_ktp']; ?>"></td>
                            <td>
                                <a href="/mahasiswa/edit/<?= $mhs['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                                <button type="button" class="btn btn-danger btn-sm" onclick="hapus(<?php echo $mhs['id'] ?>)">Delete</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="fotoModal" tabindex="-1" aria-labelledby="fotoModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img id="modalImage" src="" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script>
            $('#fotoModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget)
                var imgSrc = button.data('img')
                var modal = $(this)
                modal.find('#modalImage').attr('src', imgSrc)
            })

            function hapus($id) {
                var result = confirm('Are you sure want to delete?');
                if (result) {
                    window.location = "<?php echo site_url("mahasiswa/delete") ?>/" + $id;
                }
            }
        </script>
    </body>

    </html>