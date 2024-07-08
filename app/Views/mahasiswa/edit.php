<!DOCTYPE html>
<html>

<head>
    <title>Edit Mahasiswa</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Edit Mahasiswa</h1>
        <?php if (session()->get('errors')) : ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach (session()->get('errors') as $error) : ?>
                        <li><?= $error ?></li>
                    <?php endforeach ?>
                </ul>
            </div>
        <?php endif ?>

        <form action="/mahasiswa/update/<?= $mahasiswa['id']; ?>" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" name="nim" id="nim" class="form-control" value="<?= $mahasiswa['nim']; ?>" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?= $mahasiswa['nama']; ?>" required>
            </div>
            <div class="form-group">
                <label for="foto_diri">Foto Diri</label>
                <input type="file" name="foto_diri" id="foto_diri" class="form-control">
                <input type="hidden" name="cropped_foto_diri" id="croppedFotoDiri">
                <?php if ($mahasiswa['foto_diri']) : ?>
                    <img src="/uploads/foto_diri/<?= $mahasiswa['foto_diri']; ?>" width="100">
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="foto_ktp">Foto KTP</label>
                <input type="file" name="foto_ktp" id="foto_ktp" class="form-control">
                <input type="hidden" name="cropped_foto_ktp" id="croppedFotoKtp">
                <?php if ($mahasiswa['foto_ktp']) : ?>
                    <img src="/uploads/foto_ktp/<?= $mahasiswa['foto_ktp']; ?>" width="100">
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <!-- Modal for cropping images -->
    <div class="modal fade" id="cropModal" tabindex="-1" aria-labelledby="cropModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cropModalLabel">Crop Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <img id="cropImage" src="" class="img-fluid">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="cropButton">Crop</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.12/cropper.min.js"></script>
    <script>
        var cropper;
        var currentInput;

        $('#foto_diri, #foto_ktp').on('change', function(event) {
            currentInput = event.target;
            var files = event.target.files;
            var done = function(url) {
                $('#cropImage').attr('src', url);
                $('#cropModal').modal('show');
            };
            if (files && files.length > 0) {
                var file = files[0];
                var reader = new FileReader();
                reader.onload = function(e) {
                    done(reader.result);
                };
                reader.readAsDataURL(file);
            }
        });

        $('#cropModal').on('shown.bs.modal', function() {
            cropper = new Cropper(document.getElementById('cropImage'), {
                aspectRatio: NaN,
                viewMode: 1
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $('#cropButton').on('click', function() {
            var canvas = cropper.getCroppedCanvas({
                width: 300,
                height: 300
            });
            canvas.toBlob(function(blob) {
                var url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    if (currentInput.id === 'foto_diri') {
                        $('#croppedFotoDiri').val(base64data);
                    } else if (currentInput.id === 'foto_ktp') {
                        $('#croppedFotoKtp').val(base64data);
                    }
                    $('#cropModal').modal('hide');
                };
            }, currentInput.files[0].type);
        });
    </script>
</body>

</html>